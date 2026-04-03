<?php

namespace App\Actions\Profile;

use App\Models\User;

/**
 * Cấp lại API key reseller — bản rõ chỉ trả một lần.
 */
class RegenerateAccountApiKeyAction
{
    public function execute(User $user): string
    {
        $plainKey = 'sk_smm_' . bin2hex(random_bytes(16));
        $user->update([
            'api_key_hashed' => hash('sha256', $plainKey),
        ]);

        return $plainKey;
    }
}
