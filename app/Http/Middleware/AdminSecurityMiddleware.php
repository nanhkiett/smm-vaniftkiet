<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AdminSecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $blockKey = 'blocked_ip_' . $ip;
        $attemptKey = 'admin_failed_attempts_' . $ip;

        // 1. Kiểm tra IP có đang bị khóa không (Senior Hardcore Protection)
        if (Cache::has($blockKey)) {
            abort(404); // Trả về 404 để hacker ko biết trang này tồn tại
        }

        // 2. Kiểm tra quyền Admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            // Nếu là Admin, reset số lần thử sai (nếu có)
            Cache::forget($attemptKey);
            return $next($request);
        }

        // 3. Xử lý truy cập trái phép (Non-admin hoặc Guest)
        $attempts = Cache::increment($attemptKey);
        
        // Đặt thời gian hết hạn cho lần thử (ví dụ: 1 giờ)
        if ($attempts == 1) {
            Cache::put($attemptKey, 1, now()->addHour());
        }

        // 4. Nếu số lần thử vượt quá 5 -> KHÓA IP TRONG 24 GIỜ
        if ($attempts >= 5) {
            Cache::put($blockKey, true, now()->addDay());
            
            // Log hành vi nghi vấn vào Activity Logs (Strict Audit)
            DB::table('activity_logs')->insert([
                'id' => (string) Str::ulid(),
                'user_id' => Auth::id(), // Có thể null nếu chưa login
                'action' => 'SECURITY_LOCKDOWN',
                'description' => "IP {$ip} đã bị khóa 24h do cố gắng truy cập trái phép vào quản trị 5 lần.",
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'payload' => json_encode(['attempts' => $attempts]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Luôn trả về 404 để đánh lạc hướng
        abort(404);
    }
}
