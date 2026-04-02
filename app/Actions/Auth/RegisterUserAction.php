<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterUserAction
{
    /**
     * Thực hiện đăng kí người dùng mới.
     * Sử dụng Transaction để bảo vệ tính toàn vẹn dữ liệu.
     * 
     * @param array $data
     * @return User
     */
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
