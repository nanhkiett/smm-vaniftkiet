<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>@yield('title', 'Authentication') - {{ config('app.name') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="SMM Panel Auth - Muasubngon.com" />
    <meta name="keywords" content="smm, auth, login" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

    <!-- Theme Initializer -->
    <script src="{{ asset('assets/custom/theme-init.js') }}" data-navigate-track></script>

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

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

<body id="kt_body" 
    data-kt-app-host-url="{{ asset('assets/') }}"
    class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat"
    style="background-image: url('{{ asset('assets/media/misc/auth-bg.png') }}');">
    
    <!-- Metronic Page Loader (Chiêu 2) -->
    <div class="page-loader flex-column">
        <img alt="Logo" class="theme-light-show h-25px" src="{{ asset('assets/media/logos/default-small.svg') }}" />
        <img alt="Logo" class="theme-dark-show h-25px" src="{{ asset('assets/media/logos/default-dark.svg') }}" />
        <div class="d-flex align-items-center mt-5">
            <span class="spinner-border text-primary" role="status"></span>
            <span class="text-muted fs-6 fw-semibold ms-5">Đang xác thực...</span>
        </div>
    </div>

    <!-- Thanh loading bar SPA (Chiêu 1) -->
    <div id="loading-progress-global" class="livewire-progress"></div>

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid flex-lg-row auth-wrapper">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <!--begin::Aside-->
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <!--begin::Logo-->
                    <a href="/" class="mb-7" wire:navigate>
                        <img alt="Logo" src="{{ asset('assets/media/logos/custom-3.svg') }}" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h2 class="text-white fw-normal m-0" style="font-family: Signika, sans-serif;">Hệ thống SMM Panel tối thượng</h2>
                    <!--end::Title-->
                </div>
                <!--begin::Aside-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <!--begin::Card-->
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                        {{ $slot }}
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Footer-->
                    <div class="d-flex flex-stack px-lg-10">
                        <div class="me-0"></div>
                        <div class="d-flex fw-semibold text-primary fs-base gap-5">
                            <a href="#" target="_blank">Điều khoản</a>
                            <a href="#" target="_blank">Hỗ trợ</a>
                        </div>
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->

    @livewireScripts
    <script src="{{ asset('assets/custom/spa-optimize.js') }}?v=1.1" data-navigate-track></script>
</body>
<!--end::Body-->

</html>
