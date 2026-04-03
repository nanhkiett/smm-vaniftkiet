<?php

namespace App\Actions\Admin\Member;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Danh bạ thành viên trong console — lọc + phân trang.
 */
class PaginateMemberDirectoryAction
{
    public function execute(string $search, string $filterRole, string $filterStatus, string $sortCreated, int $perPage = 15): LengthAwarePaginator
    {
        $dir = $sortCreated === 'oldest' ? 'asc' : 'desc';

        return User::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('username', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->when($filterRole !== '', fn ($q) => $q->where('role', $filterRole))
            ->when($filterStatus !== '', fn ($q) => $q->where('status', $filterStatus))
            ->orderBy('created_at', $dir)
            ->paginate($perPage);
    }
}
