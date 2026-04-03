<div id="kt_admin_dashboard_stats" 
     wire:ignore.self
     data-chart-labels="{{ json_encode($chartLabels) }}" 
     data-deposit-series="{{ json_encode($depositItems) }}" 
     data-order-series="{{ json_encode($orderItems) }}">
    
    <!--begin::Top Row - Compact Elite Stats-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Stat Item - Doanh thu-->
        <div class="col-xl-3 col-md-6">
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-center h-xl-100 shadow-sm border-0 position-relative overflow-hidden" 
                 style="background: linear-gradient(135deg, #009ef7 0%, #004481 100%); border-radius: 1.5rem;">
                 <div class="position-absolute w-100 h-100 top-0 start-0 opacity-10 bgi-no-repeat bgi-size-cover" 
                      style="background-image: url('{{ asset('assets/media/patterns/vector-1.png') }}'); mix-blend-mode: overlay;"></div>

                <div class="card-header pt-5 position-relative border-0 min-h-auto">
                    <div class="card-title d-flex flex-column">
                        <span class="fs-1 fw-bolder text-white me-2 lh-1 ls-n2">{{ number_format($totalEarnings, 0, ',', '.') }}đ</span>
                        <span class="text-white opacity-75 pt-1 fw-bold fs-7 mt-2">Tổng doanh thu</span>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-end pb-5 position-relative">
                    <div class="d-flex flex-column text-white mt-1">
                        <div class="h-4px w-100 bg-white bg-opacity-20 rounded mb-1">
                            <div class="bg-white rounded h-4px shadow-sm" role="progressbar" style="width: 85%"></div>
                        </div>
                        <span class="text-white opacity-75 fs-8 fw-bold">Goal 85%</span>
                    </div>
                </div>
                <!-- Mini Icon Overlay -->
                <i class="ki-duotone ki-wallet fs-3tx text-white position-absolute bottom-0 end-0 me-n2 mb-n2 opacity-10"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
            </div>
        </div>
        <!--end::Stat Item-->

        <!--begin::Stat Item - Đơn hàng-->
        <div class="col-xl-3 col-md-6">
            <div class="card card-flush h-xl-100 shadow-sm border-0 border-top border-success border-3" style="border-radius: 1.25rem;">
                <div class="card-header pt-5 border-0 min-h-auto">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center mb-1">
                            <span class="fs-1 fw-bolder text-gray-900 me-2 lh-1 ls-n2">{{ number_format($totalOrders) }}</span>
                            <span class="badge badge-light-success fw-bold fs-8 px-2 py-1">ACTIVE</span>
                        </div>
                        <span class="text-gray-500 fw-bold fs-7">Đơn hàng hệ thống</span>
                    </div>
                </div>
                <div class="card-body d-flex flex-stack pt-2 pb-5">
                    <div class="d-flex flex-column">
                        <span class="text-gray-500 fs-8 fw-bold">Chốt 98%</span>
                    </div>
                    <div class="symbol symbol-35px symbol-circle shadow-sm">
                        <div class="symbol-label bg-light-success">
                            <i class="ki-duotone ki-delivery-3 fs-3 text-success"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Stat Item-->

        <!--begin::Stat Item - Đăng ký hôm nay-->
        <div class="col-xl-3 col-md-6">
            <div class="card card-flush h-xl-100 shadow-sm border-0 border-top border-primary border-3" style="background-color: #ffffff; border-radius: 1.25rem;">
                <div class="card-header pt-5 border-0 min-h-auto">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center mb-1">
                            <span class="fs-1 fw-bolder text-gray-900 me-2 lh-1 ls-n2">+{{ $todayMembers }}</span>
                            <span class="badge badge-light-primary fw-bold fs-8 px-2 py-1">NEW</span>
                        </div>
                        <span class="text-gray-500 fw-bold fs-7">Người dùng mới hôm nay</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-5 d-flex align-items-center">
                    <div class="symbol symbol-35px symbol-circle shadow-sm me-3 border border-2 border-gray-100">
                        <div class="symbol-label bg-light-primary text-primary fw-bold fs-8">LIVE</div>
                    </div>
                    <span class="text-muted fw-bold fs-8">Theo dõi thời gian thực</span>
                </div>
            </div>
        </div>
        <!--end::Stat Item-->

        <!--begin::Stat Item - Doanh thu hôm nay (Royal Purple)-->
        <div class="col-xl-3 col-md-6">
            <div class="card card-flush h-xl-100 shadow-sm border-0 border-top border-3" style="border-radius: 1.25rem; border-top-color: #7239ea !important;">
                <div class="card-header pt-5 border-0 min-h-auto">
                    <div class="card-title d-flex flex-column">
                        <div class="d-flex align-items-center mb-1">
                            <span class="fs-1 fw-bolder text-gray-900 me-2 lh-1 ls-n2">{{ number_format($todayEarnings, 0, ',', '.') }}đ</span>
                        </div>
                        <span class="text-gray-500 fw-bold fs-7">Nạp tiền trong 24h</span>
                    </div>
                </div>
                <div class="card-body pt-2 pb-5">
                    <div class="d-flex flex-stack p-2 px-3 rounded-pill border border-opacity-10" style="background-color: rgba(114, 57, 234, 0.1); border-color: rgba(114, 57, 234, 0.2) !important;">
                        <span class="fw-bold fs-8" style="color: #7239ea;">Tăng trưởng</span>
                        <span class="fw-bolder fs-8" style="color: #7239ea;">+100%</span>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Stat Item-->
    </div>

    <!--begin::Bottom Row - Professional Analytics-->
    <div class="row g-5 g-xl-10">
        <!--begin::Main Chart Card-->
        <div class="col-xl-9 col-lg-8 mb-5 mb-xl-10">
            <div class="card card-flush h-xl-100 shadow-sm border-0 overflow-hidden" style="border-radius: 1.5rem;">
                <div class="card-header pt-7 pb-2 px-9 border-0">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-gray-900 fs-3">Phân tích Hiệu suất Vận hành</span>
                        <span class="text-muted mt-1 fw-bold fs-7">Lịch sử thống kê nạp tiền và đơn hàng chi tiết</span>
                    </h3>
                    <div class="card-toolbar">
                        <div class="badge badge-light-primary fw-bolder px-4 py-3">15 DAYS SYNCED</div>
                    </div>
                </div>
                <div class="card-body pt-0 px-5">
                    <div id="kt_charts_main_analytics" class="w-100" style="height: 350px"></div>
                </div>
            </div>
        </div>
        <!--end::Main Chart Card-->

        <!--begin::Latest Users Sidebar-->
        <div class="col-xl-3 col-lg-4 mb-5 mb-xl-10">
            <div class="card card-flush h-xl-100 shadow-sm border-0" style="background-color: #ffffff; border-radius: 1.5rem;">
                <div class="card-header pt-7 border-0 px-8">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-gray-900 fs-4">Thành viên mới</span>
                        <span class="text-muted mt-1 fw-bold fs-8">Vừa gia nhập hệ thống</span>
                    </h3>
                </div>
                <div class="card-body pt-2 px-8">
                    @foreach(\App\Models\User::latest()->take(5)->get() as $u)
                    <div class="d-flex align-items-center mb-6">
                        <div class="symbol symbol-35px symbol-circle me-4">
                            <div class="symbol-label bg-light-info text-info fw-bolder fs-8">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-grow-1">
                            <a href="#" class="text-gray-900 fw-bolder text-hover-primary fs-7">{{ $u->name }}</a>
                            <span class="text-muted fw-bold fs-8">{{ $u->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    @endforeach
                    <div class="separator separator-dashed my-5"></div>
                    <div class="p-4 bg-light-primary rounded-xl border border-dashed border-primary">
                        <span class="text-gray-800 fw-bolder fs-7 d-block mb-1">Server Status</span>
                        <div class="progress h-4px w-100 bg-white">
                            <div class="progress-bar bg-primary" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Sidebar-->
    </div>
</div>
