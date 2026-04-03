<div>
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <!--begin: Pic-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($name) }}&background=0D8ABC&color=fff&size=256" alt="image" class="rounded" />
                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                    </div>
                </div>
                <!--end::Pic-->

                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $name }}</a>
                                <a href="#">
                                    <i class="ki-duotone ki-verify fs-1 text-primary">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                            </div>
                            <!--end::Name-->

                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-profile-circle fs-4 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>{{ '@' . $username }}</a>
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-phone fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>{{ $phone ?: 'Chưa cập nhật' }}</a>
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                <i class="ki-duotone ki-sms fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>{{ $email }}</a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Title-->

                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Stat-->
                                <div class="profile-stat-card rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ Auth::user()->balance ?? 0 }}" data-kt-countup-suffix="đ">0</div>
                                    </div>
                                    <div class="fw-semibold fs-7 text-gray-400">Số dư hiện tại</div>
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="profile-stat-card rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bold">VIP 1</div>
                                    </div>
                                    <div class="fw-semibold fs-7 text-gray-400">Cấp bậc đối tác</div>
                                </div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->

            <!--begin::Navs-->
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ $activeTab === 'info' ? 'active' : '' }}" href="javascript:;" wire:click="$set('activeTab', 'info')">Thông tin cơ bản</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ $activeTab === 'security' ? 'active' : '' }}" href="javascript:;" wire:click="$set('activeTab', 'security')">Bảo mật & API</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ $activeTab === 'activity' ? 'active' : '' }}" href="javascript:;" wire:click="$set('activeTab', 'activity')">Lịch sử hoạt động</a>
                </li>
            </ul>
            <!--begin::Navs-->
        </div>
    </div>
    <!--end::Navbar-->

    <!--begin::Details content-->
    @if($activeTab === 'info')
    <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer" role="button">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0 text-gray-800">Thông tin cá nhân</h3>
            </div>
        </div>
        <div class="card-body border-top p-9">
            <form wire:submit.prevent="updateProfile">
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Tên đăng nhập</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" class="form-control form-control-lg form-control-solid bg-gray-100" value="{{ $username }}" readonly disabled />
                        <span class="form-text text-muted">Tên đăng nhập là định danh duy nhất và không thể thay đổi.</span>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Họ và tên</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" wire:model="name" class="form-control form-control-lg form-control-solid" placeholder="Nhập họ và tên đầy đủ" />
                        @error('name') <span class="text-danger fs-7 mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Địa chỉ Email</label>
                    <div class="col-lg-8 fv-row">
                        <input type="email" wire:model="email" class="form-control form-control-lg form-control-solid" placeholder="email@example.com" />
                        @error('email') <span class="text-danger fs-7 mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Số điện thoại</label>
                    <div class="col-lg-8 fv-row">
                        <input type="tel" wire:model="phone" class="form-control form-control-lg form-control-solid" placeholder="09xx xxx xxx" />
                        @error('phone') <span class="text-danger fs-7 mt-2">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary px-8">
                        <span wire:loading.remove>Lưu thay đổi</span>
                        <span wire:loading>Đang xử lý...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    @if($activeTab === 'security')
    <div class="row g-5 g-xl-10">
        <!-- Password Card -->
        <div class="col-lg-6">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0 fs-3 text-gray-800">Cấu hình mật khẩu</h3>
                    </div>
                </div>
                <div class="card-body border-top p-9">
                    @if (session()->has('status_password'))
                    <!--begin::Alert-->
                    <div class="alert alert-dismissible bg-light-primary border border-primary d-flex flex-column flex-sm-row p-5 mb-10">
                        <i class="ki-duotone ki-shield-check fs-2hx text-primary me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span></i>
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <h5 class="mb-1 text-primary">Cập nhật thành công</h5>
                            <span>Hệ thống đã ghi nhận mật khẩu mới của bạn. Vui lòng ghi nhớ để đăng nhập lần sau.</span>
                        </div>
                        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                            <i class="ki-duotone ki-cross fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                    </div>
                    <!--end::Alert-->
                    @endif

                    <form wire:submit.prevent="changePassword">
                        <input type="text" name="username_hint" autocomplete="username" value="{{ Auth::user()->username }}" class="visually-hidden" tabindex="-1" aria-hidden="true" readonly />
                        <div class="fv-row mb-6">
                            <label class="form-label fs-7 fw-bold mb-1">Mật khẩu hiện tại</label>
                            <input type="password" wire:model="current_password" class="form-control form-control-solid" placeholder="••••••••" autocomplete="current-password" />
                            @error('current_password') <span class="text-danger fs-8 mt-1 d-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="form-label fs-7 fw-bold mb-1">Mật khẩu mới</label>
                            <input type="password" wire:model="new_password" class="form-control form-control-solid" placeholder="••••••••" autocomplete="new-password" />
                            @error('new_password') <span class="text-danger fs-8 mt-1 d-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <label class="form-label fs-7 fw-bold mb-1">Xác nhận mật khẩu</label>
                            <input type="password" wire:model="new_password_confirmation" class="form-control form-control-solid" placeholder="••••••••" autocomplete="new-password" />
                        </div>
                        <div class="d-flex justify-content-end mt-8">
                            <button type="submit" class="btn btn-primary w-100 fw-bold py-3">Thay đổi mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- API Card -->
        <div class="col-lg-6">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0 fs-3 text-gray-800">Tích hợp API Key</h3>
                    </div>
                </div>
                <div class="card-body border-top p-9">
                    <div class="notice d-flex bg-light-info rounded border-info border border-dashed p-6 mb-8">
                        <i class="ki-duotone ki-code fs-2tx text-info me-4">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                        </i>
                        <div class="d-flex flex-stack flex-grow-1">
                            <div class="fw-semibold">
                                <h4 class="text-gray-900 fw-bold">Developer API access</h4>
                                <div class="fs-7 text-gray-700">Mã này dùng để kết nối SMM Tool qua API.</div>
                            </div>
                        </div>
                    </div>

                    @if($api_key_plain)
                    <div class="alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex flex-row align-items-center p-6 mb-8">
                        <i class="ki-duotone ki-key fs-2hx text-primary me-4"><span class="path1"></span><span class="path2"></span></i>
                        <div class="d-flex flex-column pe-0 pe-sm-10 flex-grow-1">
                            <h5 class="mb-1 text-gray-900 fw-bold fs-5">Secret API Key (Đã khởi tạo)</h5>
                            <div class="text-gray-800 fw-semibold fs-7 mb-3">Vui lòng SAO CHÉP mã bên dưới và lưu trữ an toàn:</div>
                            <code onclick="copyToClipboard('{{ $api_key_plain }}')" 
                                  class="fs-5 fw-bold text-gray-900 p-4 bg-white rounded border border-primary border-opacity-25 w-fit-content shadow-sm cursor-pointer hover-elevate-up transition-3ms"
                                  title="Click để sao chép ngay">
                                {{ $api_key_plain }}
                            </code>
                        </div>
                    </div>
                    @endif

                    <div class="bg-light rounded p-7">
                        <div class="d-flex flex-stack flex-wrap flex-md-nowrap align-items-center">
                            <div class="mb-3 mb-md-0 fw-semibold">
                                <h4 class="text-gray-900 fw-bold">Quản lý API Key</h4>
                                <div class="fs-7 text-gray-700">Key cũ sẽ hết hiệu lực ngay lập tức khi tạo key mới.</div>
                            </div>
                            <button wire:click="generateApiKey" class="btn btn-light-primary fw-bold px-6">Tạo Key mới</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($activeTab === 'activity')
    <div class="card mb-5 mb-xl-10 shadow-sm border-0">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6 pb-2">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center">
                    <i class="ki-duotone ki-shield-search fs-2hx text-primary me-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <div class="d-flex flex-column">
                        <span class="card-label fw-bolder fs-3 text-gray-900">Nhật ký bảo mật hệ thống</span>
                        <span class="text-muted fw-semibold fs-7 mt-1">Truy vết mọi biến động số dư và cấu hình tài khoản</span>
                    </div>
                </div>
            </div>
            <!--end::Card title-->
        </div>
        
        <div class="card-header border-0 pt-0">
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                    <input type="text" wire:model.live.debounce.300ms="searchLog" 
                        class="form-control form-control-solid w-250px ps-13" 
                        placeholder="Tìm theo hành động, IP..." />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" wire:ignore>
                    <!--begin::Filter-->
                    <select wire:model.live="filterAction" 
                        data-control="select2" 
                        data-hide-search="true" 
                        data-placeholder="Tất cả hành động"
                        class="form-select form-select-solid w-200px">
                        <option value=""></option>
                        <option value="">Tất cả hành động</option>
                        @foreach($availableActions as $action)
                            <option value="{{ $action }}">{{ $action }}</option>
                        @endforeach
                    </select>
                    <!--end::Filter-->
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <div class="card-body pt-0">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bolder text-gray-800 bg-light border-bottom border-gray-200">
                            <th class="ps-4 min-w-150px rounded-start">HÀNH ĐỘNG</th>
                            <th class="min-w-200px">MÔ TẢ CHI TIẾT</th>
                            <th class="min-w-120px">IP & THIẾT BỊ</th>
                            <th class="min-w-120px text-end pe-4 rounded-end">THỜI GIAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-5">
                                        <span class="symbol-label bg-light-{{ Str::contains($log->action, ['Update', 'Change']) ? 'warning' : 'primary' }}">
                                            <i class="ki-duotone ki-shield-search fs-2tx text-{{ Str::contains($log->action, ['Update', 'Change']) ? 'warning' : 'primary' }}">
                                                <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-start flex-column">
                                        <span class="text-gray-900 fw-bolder fs-5">{{ $log->action }}</span>
                                        <span class="text-gray-500 fw-bold d-block fs-8 mt-n1">Metronic Audit</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-gray-800 fw-bold fs-6 ls-n1">{{ $log->description }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="badge badge-light-dark fs-7 fw-bolder w-fit-content mb-1 p-3">{{ $log->ip_address }}</span>
                                    <span class="text-gray-500 fs-9 fw-semibold text-truncate max-w-250px" title="{{ $log->user_agent }}">{{ $log->user_agent }}</span>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <span class="text-gray-900 fs-6 fw-bolder">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-20">
                                <i class="ki-duotone ki-search-list fs-5x text-gray-200 mb-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                <div class="fs-6 text-gray-500 fw-semibold">Không tìm thấy nhật ký hoạt động nào phù hợp.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!--end::Table-->

            <!--begin::Pagination-->
            @if ($logs->hasPages())
            <div class="d-flex flex-stack flex-wrap pt-10">
                <div class="fs-6 fw-semibold text-gray-700">
                    Hiển thị {{ $logs->firstItem() }}-{{ $logs->lastItem() }} của {{ $logs->total() }}
                </div>
                <ul class="pagination">
                    {{-- Previous Page --}}
                    @if ($logs->onFirstPage())
                        <li class="page-item previous disabled"><a href="javascript:;" class="page-link"><i class="previous"></i></a></li>
                    @else
                        <li class="page-item previous"><a href="javascript:;" wire:click="previousPage" class="page-link"><i class="previous"></i></a></li>
                    @endif

                    {{-- Simple pagination loop (1 2 3 ... 6) pattern simulated --}}
                    @foreach ($logs->getUrlRange(max(1, $logs->currentPage() - 2), min($logs->lastPage(), $logs->currentPage() + 2)) as $page => $url)
                        <li class="page-item {{ $page == $logs->currentPage() ? 'active' : '' }}">
                            <a href="javascript:;" wire:click="gotoPage({{ $page }})" class="page-link">{{ $page }}</a>
                        </li>
                    @endforeach

                    {{-- Next Page --}}
                    @if ($logs->hasMorePages())
                        <li class="page-item next"><a href="javascript:;" wire:click="nextPage" class="page-link"><i class="next"></i></a></li>
                    @else
                        <li class="page-item next disabled"><a href="javascript:;" class="page-link"><i class="next"></i></a></li>
                    @endif
                </ul>
            </div>
            @endif
            <!--end::Pagination-->
        </div>
    </div>
    @endif
</div>
