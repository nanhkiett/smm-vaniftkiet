@extends('layouts.client.app')

@section('title', 'Bảng điều khiển')
@section('page-title', 'Bảng điều khiển')

@section('content')
<div class="row g-5 g-xl-10">
    <!-- Cột bên trái: Số dư tài khoản -->
    <div class="col-xl-4 col-md-5">
        <!-- Chiêu 3: Dùng lazy để hiện Skeleton Loading trước, data điền sau -->
        <livewire:user.balance-card lazy />
    </div>

    <!-- Cột bên phải: Đơn hàng gần đây -->
    <div class="col-xl-8 col-md-7">
        <!-- Chiêu 3: Dùng lazy nạp sau các thành phần nặng -->
        <livewire:user.order-table lazy />
    </div>
</div>

<div class="row g-5 g-xl-10 mt-5">
    <div class="col-12">
        <div class="card shadow-sm border-0 bg-light-info">
             <div class="card-body py-10">
                 <h2 class="text-info fw-bold fs-2x mb-5">Chào mừng quay trở lại!</h2>
                 <p class="text-gray-800 fs-5">Muasubngon.com đã nâng cấp hệ thống mới cực kỳ nhanh và mượt mà. 
                    Mọi thắc mắc vui lòng liên hệ đội ngũ hỗ trợ để được giải đáp sớm nhất.</p>
             </div>
        </div>
    </div>
</div>
@endsection