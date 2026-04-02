<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Rule;

class RegisterForm extends Form
{
    #[Rule('required|string|min:3|max:255', as: 'Họ và tên')]
    public string $name = '';

    #[Rule('required|string|min:3|max:50|unique:users,username', as: 'Tên đăng nhập')]
    public string $username = '';

    #[Rule('required|email|max:255|unique:users,email', as: 'Email')]
    public string $email = '';

    #[Rule('required|numeric|digits_between:9,12|unique:users,phone', as: 'Số điện thoại')]
    public string $phone = '';

    #[Rule('required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', as: 'Mật khẩu')]
    public string $password = '';

    #[Rule('required|same:password', as: 'Nhập lại mật khẩu')]
    public string $password_confirmation = '';
}
