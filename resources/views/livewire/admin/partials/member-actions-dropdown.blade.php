{{-- Menu thao tác thành viên — dùng chung bảng desktop & thẻ mobile ($u = user model) --}}
<div class="dropdown admin-member-actions">
    <button type="button"
        class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center {{ ($compact ?? false) === true ? 'btn-icon' : '' }}"
        data-bs-toggle="dropdown" data-bs-auto-close="outside"
        data-bs-popper-config='{"strategy":"fixed"}' aria-expanded="false">
        @if (($compact ?? false) === true)
            <i class="ki-duotone ki-dots-square-vertical fs-2"><span class="path1"></span><span class="path2"></span><span
                    class="path3"></span><span class="path4"></span></i>
        @else
            <span class="me-2">Thao tác</span>
            <i class="ki-duotone ki-down fs-5"><span class="path1"></span><span class="path2"></span></i>
        @endif
    </button>
    <div class="dropdown-menu dropdown-menu-end mw-250px py-2 shadow-sm">
        <button type="button" class="dropdown-item d-flex align-items-center px-5 py-3"
            wire:click="openBalanceModal('{{ $u->id }}')">
            <i class="ki-duotone ki-wallet fs-2 text-primary me-3"><span class="path1"></span><span
                    class="path2"></span><span class="path3"></span><span class="path4"></span></i>
            <span class="fw-semibold">Biến động số dư</span>
        </button>
        <button type="button" class="dropdown-item d-flex align-items-center px-5 py-3"
            wire:click="editUser('{{ $u->id }}')">
            <i class="ki-duotone ki-pencil fs-2 text-gray-600 me-3"><span class="path1"></span><span
                    class="path2"></span></i>
            <span class="fw-semibold">Hiệu chỉnh hồ sơ</span>
        </button>
        <button type="button" class="dropdown-item d-flex align-items-center px-5 py-3"
            onclick="confirmAction({{ json_encode($u->id) }}, 'resetApiKey')">
            <i class="ki-duotone ki-key fs-2 text-warning me-3"><span class="path1"></span><span
                    class="path2"></span></i>
            <span class="fw-semibold">Cấp lại API key</span>
        </button>
        <button type="button" class="dropdown-item d-flex align-items-center px-5 py-3"
            onclick="confirmAction({{ json_encode($u->id) }}, 'logoutAllSessions')">
            <i class="ki-duotone ki-exit-right fs-2 text-info me-3"><span class="path1"></span><span
                    class="path2"></span></i>
            <span class="fw-semibold">Đăng xuất mọi phiên</span>
        </button>
        <div class="separator my-2"></div>
        <button type="button" class="dropdown-item d-flex align-items-center px-5 py-3"
            onclick="confirmAction({{ json_encode($u->id) }}, 'toggleBan')">
            <i
                class="ki-duotone ki-shield-cross fs-2 {{ $u->status === 'active' ? 'text-warning' : 'text-success' }} me-3"><span
                    class="path1"></span><span class="path2"></span><span class="path3"></span></i>
            <span
                class="fw-semibold">{{ $u->status === 'active' ? 'Khóa truy cập' : 'Mở khóa truy cập' }}</span>
        </button>
        <button type="button" class="dropdown-item d-flex align-items-center px-5 py-3 text-danger"
            onclick="confirmAction({{ json_encode($u->id) }}, 'deleteUser')">
            <i class="ki-duotone ki-trash fs-2 text-danger me-3"><span class="path1"></span><span
                    class="path2"></span><span class="path3"></span><span class="path4"></span><span
                    class="path5"></span></i>
            <span class="fw-semibold">Gỡ tài khoản</span>
        </button>
    </div>
</div>
