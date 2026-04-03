<?php

namespace App\Livewire\User;

use App\Actions\Profile\AppendAccountAuditLogAction;
use App\Actions\Profile\PaginateAccountAuditLogsAction;
use App\Actions\Profile\RegenerateAccountApiKeyAction;
use App\Actions\Profile\UpdateAccountPasswordAction;
use App\Actions\Profile\UpdateAccountProfileAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProfileManager extends Component
{
    use WithPagination;

    public $activeTab = 'info';

    public $name;
    public $email;
    public $phone;
    public $username;

    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $api_key_plain;

    public $searchLog = '';
    public $filterAction = '';

    protected $listeners = ['tabChanged' => 'setTab'];

    private AppendAccountAuditLogAction $appendAccountAuditLog;

    public function boot(AppendAccountAuditLogAction $appendAccountAuditLog): void
    {
        $this->appendAccountAuditLog = $appendAccountAuditLog;
    }

    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->username = $user->username;
    }

    public function updatingSearchLog(): void
    {
        $this->resetPage();
    }

    public function updatingFilterAction(): void
    {
        $this->resetPage();
    }

    public function setTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function updateProfile(UpdateAccountProfileAction $action, Request $request): void
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|numeric',
        ]);

        $user = Auth::user();
        $action->execute($user, [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->logActivity($request, 'Update Profile', 'Người dùng cập nhật thông tin cá nhân.');
        session()->flash('status', 'Cập nhật thông tin thành công.');
    }

    public function changePassword(UpdateAccountPasswordAction $action, Request $request): void
    {
        if (!$this->current_password || !$this->new_password) {
            $this->dispatch('notify', [
                'icon' => 'warning',
                'title' => 'Dữ liệu thiếu',
                'message' => 'Vui lòng điền đầy đủ các thông tin mật khẩu để hệ thống xử lý.',
            ]);

            return;
        }

        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        try {
            $action->execute(Auth::user(), $this->current_password, $this->new_password);
        } catch (\Illuminate\Validation\ValidationException $e) {
            foreach ($e->errors() as $key => $messages) {
                foreach ($messages as $message) {
                    $this->addError($key, $message);
                }
            }

            return;
        }

        $this->dispatch('notify', [
            'icon' => 'success',
            'title' => 'Cập nhật thành công',
            'message' => 'Mật khẩu truy cập của bạn đã được thay đổi an toàn.',
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('status_password', 'Đổi mật khẩu thành công.');
        $this->logActivity($request, 'Change Password', 'Người dùng đổi mật khẩu truy cập.');
    }

    public function generateApiKey(RegenerateAccountApiKeyAction $action, Request $request): void
    {
        $this->api_key_plain = $action->execute(Auth::user());
        $this->logActivity($request, 'Generate API Key', 'Khởi tạo API Key mới.');

        $this->dispatch('notify', [
            'icon' => 'success',
            'title' => 'Khởi tạo thành công',
            'message' => 'API Key mới của bạn đã sẵn sàng. Vui lòng SAO CHÉP và LƯU LẠI ngay.',
        ]);
    }

    private function logActivity(Request $request, string $action, string $description): void
    {
        $this->appendAccountAuditLog->execute(
            (string) Auth::id(),
            $action,
            $description,
            $request->ip() ?? '',
            $request->userAgent()
        );
    }

    public function render(PaginateAccountAuditLogsAction $paginateAuditLogs): \Illuminate\Contracts\View\View
    {
        $data = $paginateAuditLogs->execute(
            (string) Auth::id(),
            $this->searchLog,
            $this->filterAction,
            10,
            $this->getPage()
        );

        return view('livewire.user.profile-manager', [
            'logs' => $data['logs'],
            'availableActions' => $data['availableActions'],
        ]);
    }
}
