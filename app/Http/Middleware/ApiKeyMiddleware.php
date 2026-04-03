<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class ApiKeyMiddleware
{
    /**
     * Xác thực API Key theo chuẩn Secret Hash (SHA-256).
     * Middleware này băm Key từ request rồi mới so khớp với DB để đảm bảo hacker không thể giải mã ngược.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');

        if (!$apiKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'API Key is required.'
            ], 401);
        }

        // HASH input từ người dùng (Senior Protection)
        $hashedInput = hash('sha256', $apiKey);

        // Tìm User sở hữu bản Hash này
        $user = User::where('api_key_hashed', $hashedInput)
                    ->where('status', 'active')
                    ->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or inactive API Key.'
            ], 403);
        }

        // Cập nhật thời gian sử dụng cuối (Batch Update Optimization)
        DB::table('users')->where('id', $user->id)->update([
            'api_key_last_used_at' => now()
        ]);

        // Gán User vào request để dùng ở Controller
        $request->merge(['api_user' => $user]);

        return $next($request);
    }
}
