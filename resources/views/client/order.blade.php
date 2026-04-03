@extends('layouts.client.app')

@section('title', 'Khởi tạo đơn hàng dịch vụ')
@section('page-title', 'Hệ thống khởi tạo giao dịch')

@section('content')
    <!-- 1. Thông báo hệ thống (Màu tím Light - Metronic Primary/Info) -->
    <div class="alert alert-dismissible bg-light-primary d-flex flex-column flex-sm-row p-5 mb-10 border border-primary border-dashed rounded-3">
        <!--begin::Icon-->
        <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0">
            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
        </i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <h4 class="fw-bold text-gray-900 fs-5 text-uppercase">Thông báo từ ban quản trị hệ thống:</h4>
            <span class="fs-6 fw-semibold text-gray-700">Chào mừng quý đối tác đã quay trở lại. Hệ thống hiện đang áp dụng chính sách ưu đãi nạp tiền (Bonus +10%) cho toàn bộ các giao dịch chuyển khoản ngân hàng. Xin vui lòng kiểm tra kỹ dịch vụ trước khi khởi tạo.</span>
        </div>
        <!--end::Wrapper-->

        <!--begin::Close-->
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <i class="ki-duotone ki-cross fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i>
        </button>
        <!--end::Close-->
    </div>

    <!-- 2. Bố cục 2 Cột (Order System) -->
    <div class="row g-7">
        <!-- Cột Trái: Đặt hàng & Lịch sử mới nhất -->
        <div class="col-xl-8">
            <livewire:user.order-form />

            <!-- Nhật ký giao dịch thành công (Recent History) -->
            <div class="mt-7">
                <livewire:user.recent-orders-table />
            </div>
        </div>

        <!-- Cột Phải: Trung tâm điều khiển người dùng (User Ops Center) -->
        <div class="col-xl-4">
            <div class="d-flex flex-column gap-7">
                <!-- 1. Thông tin tài khoản Platinum -->
                <livewire:user.balance-card />

                <!-- 2. Thống kê đơn hàng (SMM Stats Grid) -->
                <div class="row g-7">
                    <div class="col-6">
                        <x-metronic.stats-card 
                            title="Số đơn hàng đang chạy" 
                            value="24" 
                            icon="ki-duotone ki-chart-line-star" 
                            color="success" 
                            badge="+3" 
                        />
                    </div>
                    <div class="col-6">
                        <x-metronic.stats-card 
                            title="Tổng đơn hoàn thành" 
                            value="1.2k" 
                            icon="ki-duotone ki-abstract-26" 
                            color="info" 
                        />
                    </div>
                </div>

                <!-- 3. Truy cập nhanh & Tiện ích (Shortcuts) -->
                <div class="card card-flush shadow-sm border-0">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800 fs-5 text-uppercase">Truy cập nhanh</span>
                            <span class="text-muted mt-1 fw-semibold fs-7 ls-1">TIẾP CẬN CÁC TÍNH NĂNG CHÍNH</span>
                        </h3>
                    </div>
                    <div class="card-body pt-2 pb-6">
                        <div class="d-flex flex-stack mb-5">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-40px me-3">
                                    <span class="symbol-label bg-light-primary">
                                        <i class="ki-duotone ki-wallet fs-2 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Nạp tiền vào ví</a>
                                    <span class="text-muted fw-semibold fs-7">Sử dụng VietQR - Tự động 100%</span>
                                </div>
                            </div>
                            <i class="ki-duotone ki-arrow-right fs-2 text-gray-400"></i>
                        </div>

                        <div class="d-flex flex-stack mb-5">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-40px me-3">
                                    <span class="symbol-label bg-light-info">
                                        <i class="ki-duotone ki-abstract-24 fs-2 text-info"><span class="path1"></span><span class="path2"></span></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Lịch sử giao dịch</a>
                                    <span class="text-muted fw-semibold fs-7">Kiểm tra trạng thái đơn hàng</span>
                                </div>
                            </div>
                            <i class="ki-duotone ki-arrow-right fs-2 text-gray-400"></i>
                        </div>

                        <div class="d-flex flex-stack">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-40px me-3">
                                    <span class="symbol-label bg-light-warning">
                                        <i class="ki-duotone ki-rocket fs-2 text-warning"><span class="path1"></span><span class="path2"></span></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Kết nối API Developer</a>
                                    <span class="text-muted fw-semibold fs-7">Tích hợp vào hệ thống của bạn</span>
                                </div>
                            </div>
                            <i class="ki-duotone ki-arrow-right fs-2 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- 4. Trung tâm hỗ trợ (Operation Center) -->
                <div class="card card-flush h-md-100 border-0 shadow-sm" style="background-color: #1E1E2D;">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-white fs-4 text-uppercase">Trung tâm điều hành SMM</span>
                            <span class="text-white opacity-50 mt-1 fw-semibold fs-7 text-uppercase ls-2">Live Support 24/7/365</span>
                        </h3>
                    </div>
                    <div class="card-body pt-5">
                        <div class="d-flex align-items-center mb-8 bg-white bg-opacity-5 p-4 rounded-3 border border-white border-opacity-10 border-dashed">
                            <div class="symbol symbol-45px me-5">
                                <span class="symbol-label bg-primary shadow-hover">
                                    <i class="fab fa-telegram-plane fs-2 text-white"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-white fs-6 fw-bold">Tổng đài viên trực tuyến</span>
                                <span class="text-primary fw-bold fs-7">@SMM_Vietnam_Admin</span>
                            </div>
                        </div>

                        <div class="notice d-flex bg-light-warning rounded-3 border-warning border border-dashed p-5 mb-8">
                            <div class="d-flex flex-stack flex-grow-1">
                                <div class="fw-semibold">
                                    <div class="fs-7 text-gray-800">
                                        Vui lòng đính kèm <strong>Mã đơn hàng (Order ID)</strong> để nhận được hỗ trợ nhanh nhất.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="https://t.me/SMM_Vietnam_Admin" target="_blank" class="btn btn-primary w-100 py-4 fs-7 fw-bold text-uppercase shadow-hover transform-hover">
                            Bắt đầu kết nối hỗ trợ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection