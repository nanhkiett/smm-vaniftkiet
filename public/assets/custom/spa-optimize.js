/**
 * PHÂN VAI TRÒ: 
 * File quản lý Logic vận hành SPA (Single Page Application) và Re-initialization cho Metronic 8.
 * Đảm bảo các tiến trình AJAX, Navigate và Hiệu ứng Feedback luôn hoạt động ổn định.
 */

/* 1. SweetAlert2 Global Listener */
window.addEventListener('swal', function (event) {
    const data = event.detail[0];
    if (typeof Swal === 'undefined') return;

    Swal.fire({
        title: data.title || 'Thông báo',
        text: data.text || '',
        icon: data.icon || 'info', 
        buttonsStyling: false,
        confirmButtonText: "OK",
        timer: 5000,
        timerProgressBar: true,
        allowOutsideClick: false,
        customClass: {
            confirmButton: "btn btn-primary"
        }
    }).then((result) => {
        if (data.redirect) {
            setTimeout(() => {
                if (typeof Livewire !== 'undefined') {
                    Livewire.navigate(data.redirect);
                }
            }, 500);
        }
    });
});

/* 2. SPA Navigation Strategy (Blur, Laser Bar, Metronic Page Loader) */
// Chặn lỗi searchObject.on bằng cách Shim (gán đè) hàm khởi tạo của nó nếu cần
if (typeof KTSearch !== 'undefined') {
    const oldSearchInit = KTSearch.init;
    KTSearch.init = function() {
        try {
            if (document.querySelector('[data-kt-search-element="form"]')) {
                oldSearchInit.apply(this, arguments);
            }
        } catch (e) {
            console.warn("KTSearch init silenced to prevent crash", e);
        }
    };
}

// Tự động gán hostUrl từ data-attribute của body ngay khi load (Xử lý sạch 100%)
if (document.body && document.body.hasAttribute('data-kt-app-host-url')) {
    window.hostUrl = document.body.getAttribute('data-kt-app-host-url');
}

document.addEventListener('livewire:navigate', function () {
    document.body.classList.add('navigating');
    const loadingBar = document.getElementById('loading-progress-global');
    if (loadingBar) loadingBar.style.display = 'block';

    // Kích hoạt Page Loader
    if (typeof KTApp !== 'undefined' && KTApp.showPageLoading) {
        KTApp.showPageLoading();
    }
});

/* 3. Re-initialization cho Metronic 8 (Safe Execution) */
document.addEventListener('livewire:navigated', function () {
    document.body.classList.remove('navigating');
    
    // Gỡ bỏ ngay Page Loader của Metronic 8 để tránh che khuất Header
    if (typeof KTApp !== 'undefined' && KTApp.hidePageLoading) {
        KTApp.hidePageLoading();
    }
    
    const loadingBar = document.getElementById('loading-progress-global');
    if (loadingBar) loadingBar.style.display = 'none';

    // Cập nhật hostUrl
    if (document.body.hasAttribute('data-kt-app-host-url')) {
        window.hostUrl = document.body.getAttribute('data-kt-app-host-url');
    }

    // Delay 300ms để DOM ổn định
    setTimeout(() => {
        try { if (typeof KTMenu !== 'undefined') { KTMenu.createInstances(); KTMenu.init(); } } catch (e) {}
        try { if (typeof KTApp !== 'undefined') KTApp.init(); } catch (e) {}
        try { if (typeof KTDrawer !== 'undefined') { KTDrawer.createInstances(); KTDrawer.init(); } } catch (e) {}
        try { if (typeof KTScroll !== 'undefined') { KTScroll.createInstances(); KTScroll.init(); } } catch (e) {}
        try { if (typeof KTSticky !== 'undefined') { KTSticky.createInstances(); KTSticky.init(); } } catch (e) {}
        try { if (typeof KTToggle !== 'undefined') { KTToggle.createInstances(); KTToggle.init(); } } catch (e) {}
        try { if (typeof KTScrolltop !== 'undefined') KTScrolltop.init(); } catch (e) {}
        try { if (typeof KTSwapper !== 'undefined') { KTSwapper.createInstances(); KTSwapper.init(); } } catch (e) {}
    }, 300); 

    window.scrollTo({ top: 0, behavior: 'smooth' });
});

/* 4. Global Request Hook (Action Feedback) */
document.addEventListener('livewire:init', () => {
    Livewire.hook('request', ({ respond }) => {
        const spinner = document.getElementById('loading-spinner-global');
        if (spinner) spinner.style.display = 'block';

        respond(() => {
            if (spinner) spinner.style.display = 'none';
        });
    });
});
