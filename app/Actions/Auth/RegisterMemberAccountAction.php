<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Đăng ký tài khoản thành viên panel (reseller / end user).
 */
class RegisterMemberAccountAction
{
    public function execute(array $data): User
    {
        return DB::transaction(function () use ($data) {
            return User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'password' => Hash::make($data['password']),
                'role' => 'user',
                'status' => 'active',
                'balance' => 0,
            ]);
        });
    }
}
