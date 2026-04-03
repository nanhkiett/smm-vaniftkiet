<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class SecurityService
{
    /**
     * Băm mật khẩu với cơ chế Pepper + Argon2id (Senior Hardcore).
     * @param string $password
     * @return string
     */
    public static function hashWithPepper(string $password): string
    {
        $pepper = config('auth.pepper', '');
        return Hash::make($password . $pepper);
    }

    /**
     * Xác minh mật khẩu với Pepper.
     * @param string $password
     * @param string $hashedPassword
     * @return bool
     */
    public static function verifyWithPepper(string $password, string $hashedPassword): bool
    {
        $pepper = config('auth.pepper', '');
        return Hash::check($password . $pepper, $hashedPassword);
    }
}
