<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<!--begin::Head-->

<head>
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="Admin Dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

    <!-- Theme Initializer -->
    <script src="{{ asset('assets/custom/theme-init.js') }}" data-navigate-track></script>

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Vendor Stylesheets(used for this page only)-->
    @if (Route::is('admin.members'))
        <link href="{{ asset('assets/css/pages/admin/members.css') }}?v=1.4" rel="stylesheet" type="text/css"
            data-navigate-track />
    @endif
    @stack('styles')
    <!--end::Vendor Stylesheets-->

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" data-navigate-track />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" data-navigate-track />
    <!--end::Global Stylesheets Bundle-->

    <!-- SPA Optimizations Styles -->
    <link href="{{ asset('assets/custom/spa-optimize.css') }}" rel="stylesheet" type="text/css" data-navigate-track />
    
    <!-- Critical Boot Styles (Inline to prevent F5 Scroll & Spinner Lock) -->
    <style>
        html.page-loading, body.page-loading { overflow: hidden !important; height: 100%; }
        .page-loader { 
            display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
            z-index: 100000; background: #ffffff; align-items: center; justify-content: center;
        }
        [data-bs-theme="dark"] .page-loader { background: #1d1e2b; }
        body:not(.page-loading) .page-loader { display: none !important; }
    </style>
    <script>
        // Fail-safe: Tự động gỡ bỏ spinner sau 2 giây nếu Metronic bị kẹt (Xử lý dứt điểm cho F5)
        setTimeout(() => {
            document.body.classList.remove('page-loading');
            const loader = document.querySelector('.page-loader');
            if (loader) loader.style.display = 'none';
        }, 2000);
    </script>

    @livewireStyles

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}?v=1.1" data-navigate-track></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}?v=1.1" data-navigate-track></script>
    <!--end::Global Javascript Bundle-->
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" data-kt-app-host-url="{{ asset('assets/') }}" class="app-default">
    
    <div id="kt_app_layout_sync"
         data-body-class="app-default"
         data-body-attrs="{{ e(json_encode([
             'id' => 'kt_app_body',
             'data-kt-app-layout' => 'dark-sidebar',
             'data-kt-app-header-fixed' => 'true',
             'data-kt-app-header-fixed-mobile' => 'true',
             'data-kt-app-sidebar-enabled' => 'true',
             'data-kt-app-sidebar-fixed' => 'true',
             'data-kt-app-sidebar-hoverable' => 'true',
             'data-kt-app-sidebar-push-header' => 'true',
             'data-kt-app-sidebar-push-toolbar' => 'true',
             'data-kt-app-sidebar-push-footer' => 'true',
             'data-kt-app-toolbar-enabled' => 'true',
             'data-kt-app-host-url' => asset('assets/'),
         ])) }}"
         style="display:none;"></div>
    
    <!-- Metronic Page Loader (Chiêu 2) -->
    <div class="page-loader flex-column">
        <img alt="Logo" class="theme-light-show h-25px" src="{{ asset('assets/media/logos/default-small.svg') }}" />
        <img alt="Logo" class="theme-dark-show h-25px" src="{{ asset('assets/media/logos/default-dark.svg') }}" />
        <div class="d-flex align-items-center mt-5">
            <span class="spinner-border text-primary" role="status"></span>
            <span class="text-muted fs-6 fw-semibold ms-5">Admin Đang nạp...</span>
        </div>
    </div>

    <!-- Thanh loading bar SPA (Chiêu 1) -->
    <div id="loading-progress-global" class="livewire-progress"></div>

    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            <x-metronic.admin.header />

            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

                <x-metronic.admin.sidebar />

                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">

                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">@yield('page-title', 'Admin Dashboard')</h1>
                                    <ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-semibold">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary"
                                                wire:navigate>Admin</a>
                                        </li>
                                        <li class="breadcrumb-item text-muted">@yield('breadcrumb-current', 'Tổng quan')</li>
                                    </ol>
                                </div>
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->

                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                {{ $slot ?? '' }}
                                @yield('content')
                            </div>
                        </div>
                    </div>

                    <x-metronic.admin.footer />
                </div>
            </div>
        </div>
    </div>

    <!--begin::Vendors Javascript(used for this page only)-->
    @if (Route::is('admin.members'))
        <script src="{{ asset('assets/js/pages/admin/members.js') }}?v=1.4" data-navigate-track></script>
    @endif
    @stack('scripts')
    <!--end::Vendors Javascript-->

    @livewireScripts
    <script src="{{ asset('assets/custom/spa-optimize.js') }}?v=1.1" data-navigate-track></script>
</body>
<!--end::Body-->

</html>
