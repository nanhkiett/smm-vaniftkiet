<?php

namespace App\Http\Middleware\Security;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProtectLivewireMiddleware
{
    /**
     * Middleware bảo vệ các endpoint của Livewire khỏi việc truy cập trực tiếp
     * hoặc mô phỏng trình duyệt mà không thông qua cơ chế AJAX của Livewire.
     * Trả về 404 để "ẩn" các endpoint này khỏi bots/hackers.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem request có trỏ vào Livewire Update hay không
        if ($request->is('livewire/*') || $request->is('api/v1/internal/*')) {
            // Chặn các lượt truy cập trực tiếp bằng trình duyệt (GET) hoặc thiếu header xác thực của Livewire
            if (!$request->hasHeader('X-Livewire')) {
                abort(404);
            }

            // Kiểm tra CSRF Token bắt buộc
            if (!$request->hasHeader('X-CSRF-TOKEN') && !$request->input('_token')) {
                abort(404);
            }
        }

        return $next($request);
    }
}
