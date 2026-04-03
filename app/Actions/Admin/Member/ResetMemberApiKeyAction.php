<?php

namespace App\Actions\Admin\Member;

use App\Actions\Profile\RegenerateAccountApiKeyAction;
use App\Models\User;

/**
 * Quản trị cấp lại API key cho thành viên — tái sử dụng logic reseller đã chuẩn hóa.
 */
class ResetMemberApiKeyAction
{
    public function execute(User $target): string
    {
        return app(RegenerateAccountApiKeyAction::class)->execute($target);
    }
}
