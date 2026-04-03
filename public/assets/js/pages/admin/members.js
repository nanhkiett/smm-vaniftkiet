"use strict";

/**
 * Bootstrap đôi khi để lại .modal-backdrop sau khi Livewire morph thay DOM:
 * getInstance(modal) = null nên hide() không chạy. Gỡ backdrop khi không còn .modal.show.
 */
function cleanupOrphanModalBackdrops() {
    if (document.querySelector(".modal.show")) {
        return;
    }
    document.querySelectorAll(".modal-backdrop").forEach(function (node) {
        node.remove();
    });
    document.body.classList.remove("modal-open");
    document.body.style.removeProperty("padding-right");
    document.body.style.removeProperty("overflow");
}

// Class definition
var KTAdminMembers = function () {
    // Shared variables
    var table;
    var datatable;
    var browserListenersBound = false;

    // Private functions
    var initDatatable = function () {
        if (!browserListenersBound) {
            browserListenersBound = true;
            window.addEventListener("open-modal", function (event) {
                var modalId = event.detail[0];
                var el = document.getElementById(modalId);
                if (!el) {
                    return;
                }
                var modal = bootstrap.Modal.getOrCreateInstance(el);
                modal.show();
            });

            window.addEventListener("close-modal", function (event) {
                var modalId = event.detail[0];
                var el = document.getElementById(modalId);
                if (el) {
                    var inst = bootstrap.Modal.getInstance(el);
                    if (inst) {
                        inst.hide();
                    } else {
                        el.classList.remove("show");
                        el.style.display = "none";
                        el.setAttribute("aria-hidden", "true");
                        el.setAttribute("aria-modal", "false");
                    }
                }
                requestAnimationFrame(cleanupOrphanModalBackdrops);
                setTimeout(cleanupOrphanModalBackdrops, 350);
            });

            window.addEventListener('swal:success', event => {
                Swal.fire({
                    text: event.detail[0],
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Đã hiểu!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            });

            window.addEventListener('swal:error', event => {
                Swal.fire({
                    text: event.detail[0],
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Thử lại",
                    customClass: {
                        confirmButton: "btn btn-danger"
                    }
                });
            });

            window.addEventListener('swal:api-key-show', event => {
                var key = event.detail && event.detail[0];
                if (typeof key !== 'string' || !key.length) {
                    return;
                }
                Swal.fire({
                    title: "API key mới",
                    html: '<p class="text-start text-gray-700 mb-4 fs-6">Chỉ hiển thị một lần. Hãy sao chép và lưu an toàn.</p>' +
                        '<input type="text" class="form-control form-control-solid font-monospace" readonly value="' +
                        String(key).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;') + '" id="swal-api-key-field" />',
                    icon: "info",
                    showCancelButton: true,
                    confirmButtonText: "Sao chép",
                    cancelButtonText: "Đóng",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-light"
                    },
                    didOpen: function () {
                        var el = document.getElementById('swal-api-key-field');
                        if (el) {
                            el.focus();
                            el.select();
                        }
                    }
                }).then(function (result) {
                    if (result.isConfirmed && key) {
                        if (navigator.clipboard && navigator.clipboard.writeText) {
                            navigator.clipboard.writeText(key).then(function () {
                                Swal.fire({
                                    text: "Đã sao chép vào bộ nhớ tạm.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Đã hiểu!",
                                    customClass: { confirmButton: "btn btn-primary" }
                                });
                            }).catch(function () { /* noop */ });
                        }
                    }
                });
            });
        }
    }

    // Public methods
    return {
        init: function () {
            initDatatable();
        }
    };
}();

// Confirmation helper
window.confirmAction = function(id, actionCode) {
    let title = "Bạn có chắc chắn?";
    let text = "Hành động này có thể thay đổi dữ liệu người dùng!";
    let confirmText = "Xác nhận thực hiện";

    if (actionCode === 'deleteUser') {
        title = "Xóa người dùng này?";
        text = "Tất cả dữ liệu liên quan sẽ biến mất vĩnh viễn!";
        confirmText = "Xóa ngay";
    } else if (actionCode === 'toggleBan') {
        title = "Khóa/Mở khóa thành viên?";
        text = "Trạng thái truy cập của người dùng sẽ bị thay đổi.";
    } else if (actionCode === 'resetApiKey') {
        title = "Cấp lại API key?";
        text = "Khóa cũ sẽ ngừng hoạt động ngay. Khóa mới chỉ hiển thị một lần sau khi xác nhận.";
        confirmText = "Cấp lại";
    } else if (actionCode === 'logoutAllSessions') {
        title = "Đăng xuất mọi phiên?";
        text = "Xóa session trên máy chủ (hiệu quả khi dùng SESSION_DRIVER=database). Người dùng phải đăng nhập lại.";
        confirmText = "Thu hồi phiên";
    }

    Swal.fire({
        title: title,
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: "Hủy bỏ",
        customClass: {
            confirmButton: actionCode === 'resetApiKey' || actionCode === 'logoutAllSessions' || actionCode === 'toggleBan'
                ? "btn btn-primary"
                : "btn btn-danger",
            cancelButton: "btn btn-light"
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatch(actionCode, { id: id });
        }
    });
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAdminMembers.init();
});

// Handle Livewire reload (SPA)
document.addEventListener("livewire:navigated", function () {
    KTAdminMembers.init();
});

// Sau morph DOM: gỡ backdrop lạc (modal instance mất sau Livewire render).
function attachMembersMorphBackdropCleanup() {
    if (window.__ktAdminMembersBackdropCleanup) {
        return;
    }
    if (typeof Livewire === "undefined" || typeof Livewire.hook !== "function") {
        return;
    }
    window.__ktAdminMembersBackdropCleanup = true;
    Livewire.hook("morph.updated", function () {
        requestAnimationFrame(cleanupOrphanModalBackdrops);
    });
}

document.addEventListener("livewire:init", attachMembersMorphBackdropCleanup);
attachMembersMorphBackdropCleanup();
