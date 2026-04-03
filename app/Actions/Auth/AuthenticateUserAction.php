<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthenticateUserAction
{
    /**
     * @param  array{username: string, password: string}  $credentials
     *
     * @throws ValidationException
     */
    public function execute(array $credentials, bool $remember = false): bool
    {
        $loginField = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $attempt = [
            $loginField => $credentials['username'],
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($attempt, $remember)) {
            Session::regenerate();

            return true;
        }

        throw ValidationException::withMessages([
            'username' => 'Tên đăng nhập hoặc mật khẩu không chính xác.',
        ]);
    }
}
