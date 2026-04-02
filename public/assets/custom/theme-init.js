/**
 * THEME MODE INITIALIZER:
 * Trích xuất từ Metronic 8 - Quản lý chế độ sáng/tối (Dark/Light Mode) ngay khi nạp trang.
 * Giúp tránh hiện tượng 'nháy' trắng màn hình trước khi nạp xong CSS.
 */
(function() {
    var defaultThemeMode = "light";
    var themeMode;

    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }

        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }

        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }

    // SHIM: Khắc phục lỗi searchObject.on is not a function của Metronic 8 trong môi trường SPA
    // Phải chạy TRƯỚC KHI nạp scripts.bundle.js
    window.KTSearch = {
        init: function() {
            console.log("KTSearch shim active - preventing crash");
        }
    };
})();
