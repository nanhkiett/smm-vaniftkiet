<?php

namespace App\Livewire\Auth;

use App\Actions\Auth\RegisterMemberAccountAction;
use App\Livewire\Forms\RegisterForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class Register extends Component
{
    public RegisterForm $form;

    /**
     * Xử lý đăng kí người dùng.
     * 
     * @param RegisterMemberAccountAction $action
     */
    public function register(RegisterMemberAccountAction $action)
    {
        try {
            $this->validate();

            $user = $action->execute($this->form->all());

            if ($user) {
                // Đăng nhập luôn sau khi đăng kí thành công
                Auth::login($user);

                $this->dispatch('swal', [
                    'icon' => 'success',
                    'title' => 'Chào mừng!',
                    'text' => 'Tài khoản của bạn đã được tạo thành công!',
                    'redirect' => route('client.dashboard')
                ]);
            }
        } catch (ValidationException $e) {
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'Dữ liệu không hợp lệ',
                'text' => $this->firstValidationMessage($e),
            ]);
            throw $e;
        } catch (\Exception $e) {
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'Lỗi đăng kí',
                'text' => 'Không thể tạo tài khoản, vui lòng liên hệ hỗ trợ hoặc thử lại sau.'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }

    private function firstValidationMessage(ValidationException $e): string
    {
        return (string) (collect($e->errors())->flatten()->first() ?? $e->getMessage());
    }
}
