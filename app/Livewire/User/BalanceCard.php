<?php

namespace App\Livewire\User;

use Livewire\Component;

class BalanceCard extends Component
{
    /**
     * Dùng lazy loading (Chiêu 3 của Senior).
     * Hiện skeleton trước, data lấy sau.
     */
    public function placeholder()
    {
        return view('livewire.placeholders.card-skeleton');
    }

    public function render()
    {
        // sleep(0.5);

        return <<<'HTML'
        <div class="card bg-primary shadow-sm h-md-100 mb-5">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="m-0">
                    <i class="ki-duotone ki-wallet fs-2hx text-white"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                </div>
                <div class="d-flex flex-column text-white pt-5">
                    <span class="fw-bold fs-2x pt-1">500.000đ</span>
                    <span class="fw-semibold fs-6">Số dư tài khoản</span>
                </div>
                <div class="pt-5">
                    <button class="btn btn-sm btn-light fw-bold px-4 py-2">Nạp tiền ngay</button>
                </div>
            </div>
        </div>
        HTML;
    }
}
