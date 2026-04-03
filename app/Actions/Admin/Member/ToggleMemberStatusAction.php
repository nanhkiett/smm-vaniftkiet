<?php

namespace App\Actions\Admin\Member;

use App\Models\User;

/**
 * Khóa / mở khóa tài khoản thành viên (active ↔ banned).
 */
class ToggleMemberStatusAction
{
    public function execute(string $userId): User
    {
        $user = User::findOrFail($userId);
        $newStatus = $user->status === 'active' ? 'banned' : 'active';
        $user->update(['status' => $newStatus]);

        return $user->fresh();
    }
}
