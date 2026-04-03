git status<?php

namespace App\Actions\Profile;

use App\Models\User;

class UpdateAccountProfileAction
{
    public function execute(User $user, array $data): User
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
        ]);

        return $user->fresh();
    }
}
