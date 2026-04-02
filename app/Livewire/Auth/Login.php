<?php

namespace App\Livewire\Auth;

use App\Actions\Auth\LoginUserAction;
use App\Livewire\Forms\LoginForm;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public LoginForm $form;

    /**
     * Xử lý đăng nhập.
     * 
     * @param LoginUserAction $action
     */
    public function login(LoginUserAction $action)
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
                'text' => $e->validator->errors()->first()
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
        return view('livewire.auth.login')->layout('layouts.auth');
    }
}
