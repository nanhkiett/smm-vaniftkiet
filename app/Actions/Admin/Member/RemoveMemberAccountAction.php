<?php

namespace App\Actions\Admin\Member;

use App\Models\User;

class RemoveMemberAccountAction
{
    /**
     * @return bool false nếu admin tự xóa chính mình.
     */
    public function execute(string $actorUserId, string $targetUserId): bool
    {
        if ($actorUserId === $targetUserId) {
            return false;
        }

        User::whereKey($targetUserId)->delete();

        return true;
    }
}
