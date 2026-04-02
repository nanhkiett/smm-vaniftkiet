<?php

namespace App\Livewire\User;

use Livewire\Component;

class OrderTable extends Component
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
        // Giả lập lấy data chậm
        // sleep(1); 

        return <<<'HTML'
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Lịch sử đơn hàng gần đây</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th>ID</th>
                                <th>Dịch vụ</th>
                                <th>Số lượng</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#8892</td>
                                <td>Tăng Like Facebook</td>
                                <td>1.000</td>
                                <td><span class="badge badge-light-success">Đã hoàn thành</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        HTML;
    }
}
