<?php

namespace App\Actions\Admin\Member;

use Illuminate\Support\Facades\DB;

/**
 * Xóa mọi bản ghi session gắn user_id — buộc đăng nhập lại trên thiết bị khác (driver database).
 */
class InvalidateMemberSessionsAction
{
    public function execute(string $userId): int
    {
        return (int) DB::table('sessions')->where('user_id', $userId)->delete();
    }
}
