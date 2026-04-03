<?php

namespace App\Livewire\Auth;

use App\Actions\Auth\AuthenticateUserAction;
use App\Livewire\Forms\LoginForm;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class Login extends Component
{
    public LoginForm $form;

    /**
     * Xử lý đăng nhập.
     * 
     * @param AuthenticateUserAction $action
     */
    public function login(AuthenticateUserAction $action)
    {
        try {
            $this->validate();
            
            if ($action->execute($this->form->all(), $this->form->remember)) {
                $this->dispatch('swal', [
                    'icon' => 'success',
                    'title' => 'Thành công',
                    'text' => 'Đăng nhập thành công! Đang chuyển hướng...',
                    'redirect' => route('client.dashboard')
                ]);
            }
        } catch (ValidationException $e) {
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'Thất bại',
                'text' => $this->firstValidationMessage($e),
            ]);
            // Vẫn ném exception để hiện lỗi inline đỏ dưới ô nhập
            throw $e;
        } catch (\Exception $e) {
            $this->dispatch('swal', [
                'icon' => 'error',
                'title' => 'Lỗi hệ thống',
                'text' => 'Có lỗi xảy ra, vui lòng thử lại sau.'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    private function firstValidationMessage(ValidationException $e): string
    {
        return (string) (collect($e->errors())->flatten()->first() ?? $e->getMessage());
    }
}
