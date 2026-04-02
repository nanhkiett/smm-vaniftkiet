<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Rule;

class LoginForm extends Form
{
    #[Rule('required|string', as: 'Tên đăng nhập')]
    public string $username = '';

    #[Rule('required|string', as: 'Mật khẩu')]
    public string $password = '';

    public bool $remember = false;
}
