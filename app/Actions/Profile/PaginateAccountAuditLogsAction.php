<?php

namespace App\Actions\Profile;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Tab lịch sử hoạt động + danh mục filter action.
 *
 * @return array{logs: LengthAwarePaginator, availableActions: \Illuminate\Support\Collection<int, string>}
 */
class PaginateAccountAuditLogsAction
{
    public function execute(
        string $userId,
        string $searchLog,
        string $filterAction,
        int $perPage,
        int $page
    ): array {
        $query = DB::table('activity_logs')->where('user_id', $userId);

        if ($filterAction !== '') {
            $query->where('action', $filterAction);
        }

        if ($searchLog !== '') {
            $query->where(function ($q) use ($searchLog) {
                $q->where('description', 'like', '%' . $searchLog . '%')
                    ->orWhere('action', 'like', '%' . $searchLog . '%')
                    ->orWhere('ip_address', 'like', '%' . $searchLog . '%');
            });
        }

        $logs = $query->latest()->paginate($perPage, ['*'], 'page', $page);

        $availableActions = DB::table('activity_logs')
            ->where('user_id', $userId)
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        return [
            'logs' => $logs,
            'availableActions' => $availableActions,
        ];
    }
}
