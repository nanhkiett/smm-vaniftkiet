<div class="admin-members-page" id="kt_admin_member_manager">
    {{-- Khối ngữ cảnh — gọn trên mobile --}}
    <div class="notice d-flex bg-light-primary rounded border border-primary border-dashed mb-5 mb-lg-8 px-4 py-5 px-lg-6 py-lg-6">
        <i class="ki-duotone ki-information-5 fs-2x fs-lg-2tx text-primary me-3 me-lg-4 flex-shrink-0 mt-1"><span
                class="path1"></span><span class="path2"></span><span class="path3"></span></i>
        <div class="min-w-0">
            <h3 class="text-gray-900 fw-bold mb-1 mb-lg-2 fs-4 fs-lg-3">Thư mục thành viên</h3>
            <p class="text-gray-700 fs-7 fs-lg-6 fw-semibold mb-0 lh-lg">Tra cứu, chỉnh hồ sơ, ví và trạng thái.
                Thao tác được ghi nhận trong nhật ký kiểm toán.</p>
        </div>
    </div>

    <div class="card shadow-sm">
        {{-- Toolbar Metronic: search + lọc --}}
        <div class="card-header border-0 pt-6 pt-lg-7 pb-0 px-6 px-lg-9">
            <div class="card-title flex-column align-items-stretch w-100 gap-5 gap-lg-6">
                <div class="row g-4 g-lg-5 align-items-lg-center w-100 m-0">
                    <div class="col-12 col-lg px-0 order-1 order-lg-0">
                        <div class="position-relative w-100">
                            <i
                                class="ki-duotone ki-magnifier fs-4 text-gray-500 position-absolute top-50 translate-middle-y ms-4 z-index-1"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <input type="search" wire:model.live.debounce.300ms="search"
                                class="form-control form-control-solid ps-13 min-h-45px min-h-lg-50px admin-members-search"
                                placeholder="Tìm theo tên, đăng nhập hoặc email…" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-12 col-lg-auto px-0 order-2 order-lg-0">
                        <div
                            class="d-flex flex-column flex-sm-row flex-lg-nowrap align-items-stretch gap-3 admin-members-toolbar">
                            <div class="w-100 w-lg-200px flex-shrink-0">
                                <select wire:model.live="filterRole" data-control="select2" data-hide-search="true"
                                    data-placeholder="Vai trò"
                                    class="form-select form-select-solid form-select-sm min-h-45px admin-members-filter"
                                    aria-label="Lọc vai trò">
                                    <option value="">Mọi vai trò</option>
                                    <option value="admin">Quản trị viên</option>
                                    <option value="user">Người dùng</option>
                                </select>
                            </div>
                            <div class="w-100 w-lg-200px flex-shrink-0">
                                <select wire:model.live="filterStatus" data-control="select2" data-hide-search="true"
                                    data-placeholder="Trạng thái"
                                    class="form-select form-select-solid form-select-sm min-h-45px admin-members-filter"
                                    aria-label="Lọc trạng thái">
                                    <option value="">Mọi trạng thái</option>
                                    <option value="active">Đang hoạt động</option>
                                    <option value="banned">Đã khóa truy cập</option>
                                </select>
                            </div>
                            <div class="w-100 w-lg-225px flex-shrink-0">
                                <select wire:model.live="sortCreated" data-control="select2" data-hide-search="true"
                                    data-placeholder="Sắp xếp"
                                    class="form-select form-select-solid form-select-sm min-h-45px admin-members-filter"
                                    aria-label="Sắp xếp theo ngày tạo">
                                    <option value="newest">Mới nhất trước</option>
                                    <option value="oldest">Lâu nhất trước</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body pt-6 pt-lg-8 pb-0 px-0 px-lg-9">
            @if ($users->isEmpty())
                <div
                    class="admin-members-empty d-flex flex-column flex-center text-center py-12 py-lg-15 px-5 mx-6 mx-lg-0 mb-9 border border-dashed border-gray-300 rounded bg-secondary-subtle">
                    <i class="ki-duotone ki-people fs-3x text-gray-400 mb-4"><span class="path1"></span><span
                            class="path2"></span><span class="path3"></span><span class="path4"></span><span
                            class="path5"></span></i>
                    <div class="fs-4 fw-bold text-gray-800 mb-2">Chưa có thành viên phù hợp</div>
                    <p class="text-gray-600 fs-7 fw-semibold mb-0 px-md-10">Thử điều chỉnh bộ lọc hoặc từ khóa tìm
                        kiếm.</p>
                </div>
            @else
                {{-- Mobile: danh sách thẻ --}}
                <div class="d-lg-none px-6 mb-2">
                    @foreach ($users as $u)
                        <div class="card border border-gray-300 shadow-xs mb-5 admin-members-mobile-card"
                            wire:key="admin-member-m-{{ $u->id }}">
                            <div class="card-body p-5 p-sm-6">
                                <div class="d-flex align-items-start justify-content-between gap-3">
                                    <div class="d-flex align-items-center min-w-0 flex-grow-1">
                                        <div class="symbol symbol-circle symbol-45px me-3 flex-shrink-0">
                                            <div class="symbol-label bg-light-primary text-primary fs-5 fw-bold">
                                                {{ $u->nameInitial() }}
                                            </div>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-gray-900 fw-bold text-truncate fs-6">{{ $u->name }}</div>
                                            <div class="text-muted fs-8 fw-semibold text-truncate">{{ $u->username }}
                                            </div>
                                        </div>
                                    </div>
                                    @include('livewire.admin.partials.member-actions-dropdown', [
                                        'u' => $u,
                                        'compact' => true,
                                    ])
                                </div>
                                <div class="separator separator-dashed my-4"></div>
                                <div class="d-flex flex-column gap-3 fs-7">
                                    <div>
                                        <span class="text-muted fw-bold text-uppercase fs-8 d-block mb-1">Email</span>
                                        <span class="text-gray-800 fw-semibold text-break">{{ $u->email }}</span>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <span
                                            class="badge badge-light-success fs-8 fw-bold px-3 py-2">{{ number_format((float) $u->balance, 0, ',', '.') }}đ</span>
                                        <span
                                            class="badge {{ $u->role === 'admin' ? 'badge-light-danger' : 'badge-light-primary' }} fs-8 fw-bold px-3 py-2">{{ $u->role === 'admin' ? 'Quản trị' : 'Người dùng' }}</span>
                                        @if ($u->status === 'active')
                                            <span class="badge badge-success fs-8 fw-bold px-3 py-2">Hoạt động</span>
                                        @else
                                            <span class="badge badge-light-danger fs-8 fw-bold px-3 py-2">Đã khóa</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Desktop: bảng --}}
                <div class="d-none d-lg-block table-responsive mx-0">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4 gx-6 mb-0 min-w-800px">
                        <thead>
                            <tr class="fw-bold text-muted text-uppercase fs-8 border-bottom border-gray-200">
                                <th class="min-w-275px ps-lg-0">Thành viên</th>
                                <th class="min-w-120px">Số dư ví</th>
                                <th class="min-w-100px">Vai trò</th>
                                <th class="min-w-120px">Trạng thái</th>
                                <th class="min-w-100px text-end pe-lg-0">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6 fw-semibold text-gray-700">
                            @foreach ($users as $u)
                                <tr wire:key="admin-member-{{ $u->id }}">
                                    <td class="ps-lg-0">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-45px me-4 flex-shrink-0">
                                                <div class="symbol-label bg-light-primary text-primary fs-4 fw-bolder">
                                                    {{ $u->nameInitial() }}
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column min-w-0">
                                                <span class="text-gray-900 fw-bold mb-1 text-truncate">{{ $u->name }}</span>
                                                <span class="text-muted fs-7 fw-semibold">{{ $u->username }}</span>
                                                <span class="text-gray-500 fs-8 text-truncate d-none d-xl-inline">{{ $u->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-light-success fs-7 fw-bold px-3 py-2">{{ number_format((float) $u->balance, 0, ',', '.') }}đ</span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $u->role === 'admin' ? 'badge-light-danger' : 'badge-light-primary' }} fw-bold px-3 py-2">{{ $u->role === 'admin' ? 'Quản trị' : 'Người dùng' }}</span>
                                    </td>
                                    <td>
                                        @if ($u->status === 'active')
                                            <span class="badge badge-success fw-bold px-3 py-2">Hoạt động</span>
                                        @else
                                            <span class="badge badge-light-danger fw-bold px-3 py-2">Đã khóa</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-lg-0">
                                        @include('livewire.admin.partials.member-actions-dropdown', [
                                            'u' => $u,
                                            'compact' => false,
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div
                    class="d-flex flex-column flex-sm-row flex-stack flex-wrap gap-3 gap-sm-4 pt-8 pt-lg-10 pb-8 pb-lg-9 px-6 px-lg-0">
                    <div class="fs-7 fw-semibold text-gray-600 order-2 order-sm-1 text-center text-sm-start">
                        @if ($users->total() > 0)
                            Hiển thị <span class="text-gray-800">{{ $users->firstItem() }}</span>–<span
                                class="text-gray-800">{{ $users->lastItem() }}</span>
                            / <span class="text-gray-800">{{ $users->total() }}</span> thành viên
                        @endif
                    </div>
                    <div
                        class="order-1 order-sm-2 ms-sm-auto d-flex justify-content-center justify-content-sm-end w-100 w-sm-auto admin-members-pagination">
                        {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Modal: hiệu chỉnh hồ sơ --}}
    <div class="modal fade" id="modal_edit_user" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div
            class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-650px modal-fullscreen-sm-down px-4 px-sm-0">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h2 class="fw-bold text-gray-900 fs-3">Hiệu chỉnh thành viên</h2>
                        <span class="text-muted fw-semibold fs-7">Tài khoản <span
                                class="text-primary fw-bold">{{ $username }}</span></span>
                    </div>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body pt-6 px-lg-10 pb-2">
                    <div class="fv-row mb-7">
                        <label class="required form-label fw-bold text-gray-700">Họ và tên</label>
                        <input type="text" wire:model="name" class="form-control form-control-solid"
                            autocomplete="name" />
                        @error('name')
                            <span class="text-danger fs-7 mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required form-label fw-bold text-gray-700">Email</label>
                        <input type="email" wire:model="email" class="form-control form-control-solid"
                            autocomplete="email" />
                        @error('email')
                            <span class="text-danger fs-7 mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-7">
                        <label class="form-label fw-bold text-gray-700">Số điện thoại</label>
                        <input type="text" wire:model="phone" class="form-control form-control-solid"
                            autocomplete="tel" />
                        @error('phone')
                            <span class="text-danger fs-7 mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row g-6 mb-7">
                        <div class="col-md-6 fv-row">
                            <label class="required form-label fw-bold text-gray-700">Vai trò</label>
                            <select wire:model="role" class="form-select form-select-sm form-select-solid">
                                <option value="user">Người dùng</option>
                                <option value="admin">Quản trị viên</option>
                            </select>
                            @error('role')
                                <span class="text-danger fs-7 mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required form-label fw-bold text-gray-700">Trạng thái</label>
                            <select wire:model="status" class="form-select form-select-sm form-select-solid">
                                <option value="active">Đang hoạt động</option>
                                <option value="banned">Đã khóa truy cập</option>
                            </select>
                            @error('status')
                                <span class="text-danger fs-7 mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="fv-row mb-2">
                        <label class="form-label fw-bold text-gray-700">Mật khẩu mới</label>
                        <input type="password" wire:model="password" class="form-control form-control-solid"
                            placeholder="Để trống nếu không đổi (tối thiểu 6 ký tự)" autocomplete="new-password" />
                        @error('password')
                            <span class="text-danger fs-7 mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer border-0 pt-4 pb-8 px-lg-10 flex-nowrap gap-2">
                    <button type="button" class="btn btn-light flex-grow-1 flex-sm-grow-0" data-bs-dismiss="modal">Đóng
                    </button>
                    <button type="button" wire:click="saveUserInfo" wire:loading.attr="disabled"
                        class="btn btn-primary flex-grow-1 flex-sm-grow-0">
                        <span class="indicator-label" wire:loading.remove>Lưu thay đổi</span>
                        <span class="indicator-progress" wire:loading>
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                            Đang xử lý
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: biến động số dư --}}
    <div class="modal fade" id="modal_adjust_balance" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div
            class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-500px modal-fullscreen-sm-down px-4 px-sm-0">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <h2 class="fw-bold text-gray-900 fs-3">Biến động số dư</h2>
                        <span class="text-muted fw-semibold fs-7">{{ $balanceSnapshotLabel }} · <span
                                class="text-gray-800">{{ $username }}</span></span>
                    </div>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body pt-6 px-lg-10 pb-2">
                    <div
                        class="rounded-3 bg-light-primary bg-opacity-50 border border-primary border-dashed p-4 mb-6 text-center">
                        <span class="text-gray-600 fs-7 fw-semibold d-block mb-1">Số dư hiện tại</span>
                        <span class="fs-2 fw-bolder text-primary">{{ $balanceSnapshotAmount }}</span>
                    </div>
                    <div class="fv-row mb-5">
                        <label class="form-label fw-bold text-gray-700 mb-3 d-block">Loại biến động</label>
                        <div class="btn-group w-100" role="group" aria-label="Loại biến động">
                            <button type="button"
                                class="btn btn-sm btn-light-primary fw-bold {{ $adjustMode === 'plus' ? 'active' : '' }}"
                                wire:click="$set('adjustMode', 'plus')">
                                + Cộng tiền
                            </button>
                            <button type="button"
                                class="btn btn-sm btn-light-danger fw-bold {{ $adjustMode === 'minus' ? 'active' : '' }}"
                                wire:click="$set('adjustMode', 'minus')">
                                − Trừ tiền
                            </button>
                        </div>
                    </div>
                    <div class="fv-row mb-5">
                        <label class="form-label fw-bold text-gray-700">Số tiền (nhập số dương)</label>
                        <input type="number" step="1" inputmode="numeric" wire:model="adjustAmount"
                            class="form-control form-control-sm form-control-solid text-center fw-bold fs-5 admin-members-no-spin"
                            placeholder="Ví dụ: 50000" onwheel="this.blur()" />
                        @error('adjustAmount')
                            <span class="text-danger fs-7 mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-2">
                        <label class="required form-label fw-bold text-gray-700">Lý do ghi nhận</label>
                        <input type="text" wire:model="adjustReason"
                            class="form-control form-control-sm form-control-solid"
                            placeholder="Mô tả ngắn cho nhật ký kiểm toán" />
                        @error('adjustReason')
                            <span class="text-danger fs-7 mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer border-0 flex-center flex-wrap gap-2 pt-4 pb-8 px-lg-10">
                    <button type="button" class="btn btn-light flex-grow-1 flex-sm-grow-0" data-bs-dismiss="modal">Hủy
                    </button>
                    <button type="button" wire:click="adjustBalance" wire:loading.attr="disabled"
                        class="btn btn-primary flex-grow-1 flex-sm-grow-0">
                        <span class="indicator-label" wire:loading.remove>Xác nhận biến động</span>
                        <span class="indicator-progress" wire:loading>
                            <span class="spinner-border spinner-border-sm align-middle me-2"></span>
                            Đang ghi nhận
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
