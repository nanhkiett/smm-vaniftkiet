<?php

namespace App\Livewire\Auth;

use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    /**
     * Xử lý đăng xuất theo cơ chế SPA (Livewire 3 navigate).
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->redirect('/login', navigate: true);
    }

    public function render()
    {
        return <<<'BLADE'
            <div class="menu-item px-5">
                <a href="javascript:void(0)" wire:click="logout" class="menu-link px-5">Đăng xuất</a>
            </div>
        BLADE;
    }
}
