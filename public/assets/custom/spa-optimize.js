// --- Select2 trong #kt_app_content (Livewire SPA) ---
// livewire:navigated còn bắn khi prefetch (hover link) — URL chưa đổi; reinit Select2 lúc đó phá DOM.
// Chỉ reinit khi location.href thật sự khác lần trước. Không destroy trên livewire:navigate (prefetch cũng bắn).

(function () {
    let select2DebounceTimer = null;
    /** Sau mỗi lần reinit thành công; bỏ qua navigated trùng URL (prefetch hover link, morph cùng trang). */
    let lastSelect2Url = null;
    /** Chỉ refresh Metronic shell khi URL đổi — tránh prefetch + trùng KT* instance. */
    let lastShellUrl = null;
    let domContentReady = false;
    /** Morph có thể bắn nhiều lần liên tiếp (platform → category → …); gom một lần reinit giảm nháy. */
    const DEBOUNCE_MS = 160;

    function getContentRoot() {
        return document.getElementById('kt_app_content');
    }

    /**
     * Khôi phục data-bs-theme trên <html> (giống theme-init.js).
     * Livewire morph có thể làm mất attribute → [data-bs-theme=…] trong style.bundle không khớp
     * → biến --bs-app-header-base-bg-color / form không áp dụng → header trắng, input “trần”.
     */
    function syncBootstrapThemeOnHtml() {
        if (!document.documentElement) {
            return;
        }

        var defaultThemeMode = 'light';
        var themeMode;

        if (document.documentElement.hasAttribute('data-bs-theme-mode')) {
            themeMode = document.documentElement.getAttribute('data-bs-theme-mode');
        } else if (localStorage.getItem('data-bs-theme') !== null) {
            themeMode = localStorage.getItem('data-bs-theme');
        } else {
            themeMode = defaultThemeMode;
        }

        if (themeMode === 'system') {
            themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        document.documentElement.setAttribute('data-bs-theme', themeMode);
    }

    /**
     * Khôi phục class + data-kt-app-* trên body từ #kt_app_layout_sync (sau wire:navigate morph).
     * Thiếu data-kt-app-layout → --bs-app-header-base-bg-color transparent → header trắng/vỡ theme.
     */
    function syncMetronicBodyFromMarker() {
        var marker = document.getElementById('kt_app_layout_sync');
        if (!marker || !document.body) {
            return;
        }

        var bodyClass = marker.getAttribute('data-body-class');
        if (bodyClass) {
            document.body.className = bodyClass.trim();
        }

        var raw = marker.getAttribute('data-body-attrs');
        if (!raw) {
            return;
        }
        try {
            var attrs = JSON.parse(raw);
            Object.keys(attrs).forEach(function (key) {
                if (key === 'class') {
                    return;
                }
                document.body.setAttribute(key, attrs[key]);
            });
        } catch (e) { /* noop */ }
    }

    /** Hủy Popper / class còn sót trên trigger (destroy() của KTMenu không gọi _hideDropdown). */
    function cleanupKtMenuTriggers() {
        if (typeof KTUtil === 'undefined') {
            return;
        }
        var triggers = document.querySelectorAll('[data-kt-menu-trigger]');
        var i;
        var t;
        var to;
        for (i = 0; i < triggers.length; i++) {
            t = triggers[i];
            try {
                if (KTUtil.data(t).has('popper')) {
                    KTUtil.data(t).get('popper').destroy();
                    KTUtil.data(t).remove('popper');
                }
            } catch (e) { /* noop */ }
            try {
                if (KTUtil.data(t).has('timeout')) {
                    to = KTUtil.data(t).get('timeout');
                    if (to) {
                        clearTimeout(to);
                    }
                    KTUtil.data(t).remove('timeout');
                }
                if (KTUtil.data(t).has('hover')) {
                    KTUtil.data(t).remove('hover');
                }
            } catch (e2) { /* noop */ }
            try {
                KTUtil.removeClass(t, 'show');
                KTUtil.removeClass(t, 'menu-dropdown');
            } catch (e3) { /* noop */ }
        }
        var subs = document.querySelectorAll('.menu-sub.show');
        for (i = 0; i < subs.length; i++) {
            try {
                KTUtil.removeClass(subs[i], 'show');
            } catch (e4) { /* noop */ }
        }
    }

    /**
     * Gỡ instance KTMenu cũ trước khi createInstances (bắt buộc sau wire:navigate / morph).
     * Nếu không: KTMenu constructor tái dùng KTUtil.data('menu') trên node được morph → dropdown header admin/user hỏng.
     */
    function destroyExistingKtMenus() {
        if (typeof KTMenu === 'undefined' || typeof KTUtil === 'undefined') {
            return;
        }
        var list = document.querySelectorAll('[data-kt-menu="true"]');
        var i;
        var el;
        var inst;
        for (i = 0; i < list.length; i++) {
            el = list[i];
            inst = KTMenu.getInstance(el);
            if (inst && typeof inst.destroy === 'function') {
                try {
                    inst.destroy();
                } catch (e) { /* noop */ }
            } else if (KTUtil.data(el).has('menu')) {
                try {
                    KTUtil.data(el).remove('menu');
                } catch (e2) { /* noop */ }
            }
        }
        try {
            if (typeof KTMenu.hideDropdowns === 'function') {
                KTMenu.hideDropdowns();
            }
        } catch (e3) { /* noop */ }
    }

    /** Chỉ KTMenu: dọn trigger → destroy root → createInstances (gọi sau morph ổn định). */
    function refreshKtMenusOnly() {
        if (typeof KTMenu === 'undefined' || typeof KTMenu.createInstances !== 'function') {
            return;
        }
        try {
            cleanupKtMenuTriggers();
            destroyExistingKtMenus();
            KTMenu.createInstances();
        } catch (e) { /* noop */ }
    }

    /** Bootstrap 5 dropdown sau morph / wire:navigate (header admin dùng data-bs-toggle thay KTMenu). */
    function refreshBootstrapDropdownsInShell() {
        if (typeof bootstrap === 'undefined' || !bootstrap.Dropdown) {
            return;
        }
        var root = document.getElementById('kt_app_root') || document.body;
        var toggles = root.querySelectorAll('[data-bs-toggle="dropdown"]');
        var i;
        var el;
        for (i = 0; i < toggles.length; i++) {
            el = toggles[i];
            if (!el.isConnected) {
                continue;
            }
            try {
                bootstrap.Dropdown.getOrCreateInstance(el);
            } catch (e) { /* noop */ }
        }
    }

    function refreshKtMenusAndBootstrapDropdowns() {
        refreshKtMenusOnly();
        refreshBootstrapDropdownsInShell();
    }

    var ktMenuPostNavigateTimerIds = [];
    function scheduleKtMenuRefreshAfterNavigate() {
        var j;
        for (j = 0; j < ktMenuPostNavigateTimerIds.length; j++) {
            clearTimeout(ktMenuPostNavigateTimerIds[j]);
        }
        ktMenuPostNavigateTimerIds = [];
        function pushDelayed(ms) {
            ktMenuPostNavigateTimerIds.push(setTimeout(function () {
                refreshKtMenusAndBootstrapDropdowns();
            }, ms));
        }
        pushDelayed(0);
        pushDelayed(90);
        pushDelayed(220);
    }

    /** Drawer / Swapper / … — KTMenu tách riêng + delay sau morph (một rAF thường chạy trước khi DOM xong). */
    function refreshMetronicShellPlugins() {
        try {
            if (typeof KTDrawer !== 'undefined' && KTDrawer.init) {
                KTDrawer.init();
            }
            if (typeof KTSwapper !== 'undefined' && KTSwapper.init) {
                KTSwapper.init();
            }
            if (typeof KTSticky !== 'undefined' && KTSticky.init) {
                KTSticky.init();
            }
            if (typeof KTScroll !== 'undefined' && KTScroll.init) {
                KTScroll.init();
            }
            if (typeof KTToggle !== 'undefined' && KTToggle.createInstances) {
                KTToggle.createInstances();
            }
        } catch (e) { /* noop */ }
    }

    /** Gỡ Select2 + container, tránh chồng listener wheel / nháy UI */
    window.destroySelect2InContent = function (root) {
        if (typeof $ === 'undefined') return;
        root = root || getContentRoot();
        if (!root) return;

        try {
            $(root).find('[data-control="select2"]').each(function () {
                const $el = $(this);
                try {
                    if ($el.data('select2')) {
                        $el.select2('destroy');
                    }
                } catch (e) { /* noop */ }
                $el.removeData('s2OptSig');
                $el.removeClass('select2-hidden-accessible');
                $el.removeAttr('data-select2-id');
                $el.next('.select2-container').remove();
            });
        } catch (e) { /* noop */ }
    };

    window.initSelect2InContent = function (root) {
        if (typeof $ === 'undefined') return;
        root = root || getContentRoot();
        if (!root) return;

        try {
            $(root).find('[data-control="select2"]').each(function () {
                const $el = $(this);
                if ($el.data('select2')) {
                    return;
                }
                if ($el.next('.select2-container').length) {
                    $el.next('.select2-container').remove();
                }
                bindSelect2OnElement($el);
                $el.data('s2OptSig', selectOptionsSignature(this));
            });
        } catch (e) { /* noop */ }
    };

    window.reinitSelect2InContent = function (root) {
        window.destroySelect2InContent(root);
        window.initSelect2InContent(root);
    };

    /** Chữ ký danh sách option (value). Chỉ đổi selected → chữ ký giữ nguyên → không destroy Select2 (hết nháy). */
    function selectOptionsSignature(nativeSelect) {
        var opts = nativeSelect.options;
        var n = opts.length;
        var parts = new Array(n);
        for (var i = 0; i < n; i++) {
            parts[i] = opts[i].value;
        }
        return n + '\x1d' + parts.join('\x1e');
    }

    function bindSelect2OnElement($el) {
        $el.select2({
            minimumResultsForSearch: $el.attr('data-hide-search') === 'true' ? -1 : 0,
            placeholder: $el.attr('data-placeholder') || '',
            width: '100%',
        });
    }

    /**
     * Chỉ destroy+init khi &lt;option&gt; đổi; cùng option chỉ đổi selected → cập nhật UI Select2, không gỡ widget.
     * Tránh reinit toàn #kt_app_content sau mỗi wire:model (gây nháy toàn form).
     */
    window.ensureSelect2InContent = function (root) {
        if (typeof $ === 'undefined') {
            return;
        }
        root = root || getContentRoot();
        if (!root) {
            return;
        }

        try {
            $(root).find('[data-control="select2"]').each(function () {
                var $el = $(this);
                var el = this;
                if (!el.isConnected) {
                    return;
                }

                var sig = selectOptionsSignature(el);
                var hasS2 = !!$el.data('select2');
                var hasContainer = $el.next('.select2-container').length > 0;
                var prevSig = $el.data('s2OptSig');

                if (hasS2 && hasContainer && prevSig === sig) {
                    var v = $el.val();
                    $el.val(v);
                    try {
                        $el.trigger('change.select2');
                    } catch (err) { /* noop */ }
                    return;
                }

                if (hasS2) {
                    try {
                        $el.select2('destroy');
                    } catch (e) { /* noop */ }
                }
                $el.removeData('s2OptSig');
                $el.removeClass('select2-hidden-accessible');
                $el.removeAttr('data-select2-id');
                $el.next('.select2-container').remove();

                bindSelect2OnElement($el);
                $el.data('s2OptSig', sig);
            });
        } catch (e) { /* noop */ }
    };

    function scheduleSelect2Reinit() {
        clearTimeout(select2DebounceTimer);
        select2DebounceTimer = setTimeout(function () {
            window.ensureSelect2InContent();
            lastSelect2Url = window.location.href;
        }, DEBOUNCE_MS);
    }

    var morphSelect2Raf = null;
    function scheduleSelect2AfterMorph() {
        if (morphSelect2Raf !== null) {
            cancelAnimationFrame(morphSelect2Raf);
        }
        morphSelect2Raf = requestAnimationFrame(function () {
            morphSelect2Raf = null;
            if (!domContentReady) {
                return;
            }
            window.ensureSelect2InContent();
        });
    }

    /** Sau morph (kể cả partial): gom bằng rAF, ensure từng select — không destroy cả vùng content. */
    var morphSelect2HookAttached = false;
    function attachLivewireMorphSelect2Hook() {
        if (morphSelect2HookAttached || typeof Livewire === 'undefined' || typeof Livewire.hook !== 'function') {
            return;
        }
        morphSelect2HookAttached = true;
        Livewire.hook('morph.updated', function (payload) {
            if (!domContentReady) {
                return;
            }
            var el = payload && payload.el;
            var root = getContentRoot();
            if (!root || !el || el.nodeType !== 1) {
                return;
            }
            if (!root.contains(el)) {
                return;
            }
            scheduleSelect2AfterMorph();
        });
    }
    document.addEventListener('livewire:init', attachLivewireMorphSelect2Hook);
    attachLivewireMorphSelect2Hook();

    document.addEventListener('livewire:navigate', function () {
        document.body.classList.add('navigating');
        // Không destroy Select2 ở đây: prefetch/hover cũng có thể kích navigate → gỡ UI đang xem.
    });

    document.addEventListener('livewire:navigated', function () {
        document.body.classList.remove('navigating');
        window.scrollTo(0, 0);

        if (!domContentReady) {
            return;
        }

        syncBootstrapThemeOnHtml();

        var href = window.location.href;

        if (lastShellUrl === null || href !== lastShellUrl) {
            lastShellUrl = href;
            syncMetronicBodyFromMarker();
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    refreshMetronicShellPlugins();
                    scheduleKtMenuRefreshAfterNavigate();
                });
            });
        }

        if (lastSelect2Url !== null && href === lastSelect2Url) {
            return;
        }

        scheduleSelect2Reinit();
    });

    function bootSelect2Once() {
        domContentReady = true;
        syncBootstrapThemeOnHtml();
        syncMetronicBodyFromMarker();
        lastShellUrl = window.location.href;
        scheduleSelect2Reinit();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bootSelect2Once);
    } else {
        bootSelect2Once();
    }
})();

// Giữ tên cũ: init KTMenu thiếu + Select2 toàn document (chỉ gọi thủ công khi cần)
window.reinitMetronic = function () {
    if (typeof KTMenu === 'undefined') return;

    try {
        const menuEls = document.querySelectorAll('[data-kt-menu="true"]:not([data-kt-initialized="true"])');
        menuEls.forEach(function (el) {
            new KTMenu(el);
            el.setAttribute('data-kt-initialized', 'true');
        });

        if (typeof $ !== 'undefined') {
            $('[data-control="select2"]').each(function () {
                const el = $(this);
                if (!el.data('select2') && !el.next('.select2-container').length) {
                    el.select2({
                        minimumResultsForSearch: el.attr('data-hide-search') === 'true' ? -1 : 0,
                        placeholder: el.attr('data-placeholder') || '',
                        width: '100%',
                    });
                }
            });
        }
    } catch (e) { /* noop */ }
};

// Delegate: Select2 -> Livewire (chỉ khi không phải change.select2 từ ensure sau morph — tránh round-trip thừa / nháy)
if (typeof $ !== 'undefined') {
    $(document).on('change', '[data-control="select2"]', function (e) {
        if (e && e.namespace === 'select2') {
            return;
        }
        if (typeof e.originalEvent === 'undefined') {
            const event = new Event('change', { bubbles: true });
            this.dispatchEvent(event);
        }
    });
}

document.addEventListener('livewire:init', function () {
    Livewire.on('notify', function (event) {
        var data = (Array.isArray(event) && event[0]) ? event[0] : event;
        if (typeof Swal === 'undefined') return;

        Swal.fire({
            title: data.title || 'Thông báo',
            text: data.message || data.text,
            icon: data.icon || 'info',
            buttonsStyling: false,
            confirmButtonText: 'Đã hiểu',
            customClass: { confirmButton: 'btn btn-primary' },
        });
    });
});

window.addEventListener('swal', function (event) {
    const data = event.detail[0];
    if (typeof Swal === 'undefined') return;
    Swal.fire({
        title: data.title || 'Thông báo',
        text: data.text || '',
        icon: data.icon || 'info',
        buttonsStyling: false,
        confirmButtonText: 'OK',
        customClass: { confirmButton: 'btn btn-primary' },
    }).then(function () {
        if (data.redirect) Livewire.navigate(data.redirect);
    });
});
