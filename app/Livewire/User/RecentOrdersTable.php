<?php

namespace App\Livewire\User;

use Livewire\Component;

class RecentOrdersTable extends Component
{
    /**
     * Component hiển thị 10 bản ghi thành công gần nhất của User.
     * Dùng để lấp đầy giao diện và tạo độ chuyên nghiệp.
     */
    public function render()
    {
        return view('livewire.user.recent-orders-table');
    }
}
