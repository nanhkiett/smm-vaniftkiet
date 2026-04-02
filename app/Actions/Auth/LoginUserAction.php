<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginUserAction
{
    /**
     * Thực hiện đăng nhập người dùng.
     * 
     * @param array $credentials ['username' => '...', 'password' => '...']
     * @param bool $remember
     * @return bool
     * @throws ValidationException
     */
    public function execute(array $credentials, bool $remember = false): bool
    {
        // Kiểm tra xem đầu vào là email hay username
        $loginField = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        $attempt = [
            $loginField => $credentials['username'],
            'password' => $credentials['password']
        ];

        if (Auth::attempt($attempt, $remember)) {
            request()->session()->regenerate();
            return true;
        }

        throw ValidationException::withMessages([
            'username' => 'Tên đăng nhập hoặc mật khẩu không chính xác.',
        ]);
    }
}
