<?php

namespace App\Actions\Profile;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Ghi nhật ký hành vi tài khoản (audit) — đối soát bảo mật.
 */
class AppendAccountAuditLogAction
{
    public function execute(
        string $userId,
        string $action,
        string $description,
        string $ipAddress,
        ?string $userAgent
    ): void {
        DB::table('activity_logs')->insert([
            'id' => (string) Str::ulid(),
            'user_id' => $userId,
            'action' => $action,
            'description' => $description,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
