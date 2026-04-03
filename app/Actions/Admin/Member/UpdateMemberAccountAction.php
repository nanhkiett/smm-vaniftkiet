<?php

namespace App\Actions\Admin\Member;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateMemberAccountAction
{
    public function execute(string $userId, array $data): User
    {
        $user = User::findOrFail($userId);

        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'role' => $data['role'],
            'status' => $data['status'],
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        return $user;
    }
}
