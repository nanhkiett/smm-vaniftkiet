<?php

namespace App\Livewire\Admin;

use App\Actions\Admin\Member\AdjustMemberBalanceAction;
use App\Actions\Admin\Member\InvalidateMemberSessionsAction;
use App\Actions\Admin\Member\PaginateMemberDirectoryAction;
use App\Actions\Admin\Member\RemoveMemberAccountAction;
use App\Actions\Admin\Member\ResetMemberApiKeyAction;
use App\Actions\Admin\Member\ToggleMemberStatusAction;
use App\Actions\Admin\Member\UpdateMemberAccountAction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MemberManager extends Component
{
    use WithPagination;

    public $search = '';

    public $filterRole = '';

    public $filterStatus = '';

    /** newest | oldest — sắp xếp theo ngày tạo */
    public string $sortCreated = 'newest';

    public $selectedUserId = null;
    public $name;
    public $email;
    public $username;
    public $phone;
    public $role;
    public $status;
    public $password;
    public $adjustAmount = 0;

    /** plus | minus — áp dụng lên abs(số tiền nhập) */
    public string $adjustMode = 'plus';

    public $adjustReason = 'Điều chỉnh số dư bởi quản trị';

    /** Hiển thị trên modal điều chỉnh số dư */
    public string $balanceSnapshotLabel = '';

    public string $balanceSnapshotAmount = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterRole' => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'sortCreated' => ['except' => 'newest'],
    ];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterRole(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function updatedSortCreated(): void
    {
        $this->resetPage();
    }

    public function editUser($id): void
    {
        $user = User::findOrFail($id);
        $this->selectedUserId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->phone = $user->phone;
        $this->role = $user->role;
        $this->status = $user->status;
        $this->password = '';

        $this->dispatch('open-modal', 'modal_edit_user');
    }

    public function saveUserInfo(UpdateMemberAccountAction $action): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->selectedUserId . ',id',
            'role' => 'required|in:admin,user',
            'status' => 'required|in:active,banned',
            'password' => 'nullable|min:6',
        ]);

        $action->execute($this->selectedUserId, [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'status' => $this->status,
            'password' => $this->password,
        ]);

        $this->dispatch('close-modal', 'modal_edit_user');
        $this->dispatch('swal:success', 'Cập nhật thông tin thành công!');
    }

    public function openBalanceModal($id): void
    {
        $user = User::findOrFail($id);
        $this->selectedUserId = $user->id;
        $this->username = $user->username;
        $this->balanceSnapshotLabel = $user->name;
        $this->balanceSnapshotAmount = number_format((float) $user->balance, 0, ',', '.') . 'đ';
        $this->adjustAmount = 0;
        $this->adjustMode = 'plus';
        $this->dispatch('open-modal', 'modal_adjust_balance');
    }

    public function adjustBalance(AdjustMemberBalanceAction $action): void
    {
        $this->adjustMode = in_array($this->adjustMode, ['plus', 'minus'], true) ? $this->adjustMode : 'plus';

        $this->validate([
            'adjustAmount' => 'required|numeric|gt:0',
            'adjustReason' => 'required|string|max:255',
        ]);

        $base = (float) $this->adjustAmount;
        $delta = $this->adjustMode === 'minus' ? -abs($base) : abs($base);

        $action->execute($this->selectedUserId, $delta, $this->adjustReason);

        $this->dispatch('close-modal', 'modal_adjust_balance');
        $this->dispatch('swal:success', ($delta >= 0 ? 'Cộng' : 'Trừ') . ' tiền thành công!');
    }

    #[On('deleteUser')]
    public function deleteUser(mixed $id, RemoveMemberAccountAction $action): void
    {
        $userId = is_array($id) ? (string) ($id['id'] ?? '') : (string) $id;
        if ($userId === '') {
            return;
        }

        $ok = $action->execute((string) Auth::id(), $userId);
        if (!$ok) {
            $this->dispatch('swal:error', 'Bạn không thể tự xóa chính mình!');

            return;
        }

        $this->dispatch('swal:success', 'Đã xóa thành viên khỏi hệ thống!');
    }

    #[On('toggleBan')]
    public function toggleBan(mixed $id, ToggleMemberStatusAction $action): void
    {
        $userId = is_array($id) ? (string) ($id['id'] ?? '') : (string) $id;
        if ($userId === '') {
            return;
        }

        $user = $action->execute($userId);
        $this->dispatch('swal:success', ($user->status === 'banned' ? 'Đã khóa' : 'Đã mở khóa') . ' thành viên!');
    }

    #[On('resetApiKey')]
    public function resetMemberApiKey(mixed $id, ResetMemberApiKeyAction $action): void
    {
        $userId = is_array($id) ? (string) ($id['id'] ?? '') : (string) $id;
        if ($userId === '') {
            return;
        }

        $user = User::findOrFail($userId);
        $plain = $action->execute($user);
        $this->dispatch('swal:api-key-show', $plain);
    }

    #[On('logoutAllSessions')]
    public function logoutAllMemberSessions(mixed $id, InvalidateMemberSessionsAction $action): void
    {
        $userId = is_array($id) ? (string) ($id['id'] ?? '') : (string) $id;
        if ($userId === '') {
            return;
        }

        $n = $action->execute($userId);
        $msg = $n > 0
            ? "Đã đăng xuất {$n} phiên trên máy chủ (session database)."
            : 'Không có phiên nào trong bảng sessions (thường gặp khi SESSION_DRIVER=file).';

        $this->dispatch('swal:success', $msg);
    }

    public function render(PaginateMemberDirectoryAction $paginateMembers): \Illuminate\Contracts\View\View
    {
        $sort = in_array($this->sortCreated, ['newest', 'oldest'], true) ? $this->sortCreated : 'newest';
        $users = $paginateMembers->execute($this->search, $this->filterRole, $this->filterStatus, $sort, 15);

        return view('livewire.admin.member-manager', [
            'users' => $users,
        ]);
    }
}
