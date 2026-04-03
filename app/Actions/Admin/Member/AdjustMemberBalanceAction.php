<?php

namespace App\Actions\Admin\Member;

use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Nạp/trừ ví thành viên — transaction + row lock.
 */
class AdjustMemberBalanceAction
{
    /**
     * @param  string  $ledgerNote  Lý do nạp/trừ — sẽ gắn bảng ledger khi triển khai audit số dư.
     */
    public function execute(string $userId, float $amount, string $ledgerNote): User
    {
        return DB::transaction(function () use ($userId, $amount) {
            $user = User::where('id', $userId)->lockForUpdate()->firstOrFail();

            $user->balance += $amount;
            $user->save();

            return $user;
        });
    }
}
