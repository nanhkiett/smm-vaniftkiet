<?php

namespace App\Actions\Profile;

use App\Models\User;
use App\Services\SecurityService;
use Illuminate\Validation\ValidationException;

class UpdateAccountPasswordAction
{
    public function execute(User $user, string $currentPassword, string $newPassword): void
    {
        if (!SecurityService::verifyWithPepper($currentPassword, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Mật khẩu hiện tại không chính xác.',
            ]);
        }

        $user->update([
            'password' => SecurityService::hashWithPepper($newPassword),
        ]);
    }
}
