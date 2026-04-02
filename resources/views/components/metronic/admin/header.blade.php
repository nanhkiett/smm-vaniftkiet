<!--begin::Header-->
<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}"
    data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}"
    data-kt-sticky-animation="false">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <!--begin::Sidebar mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                    <span class="path1"></span><span class="path2"></span>
                </i>
            </div>
        </div>
        <!--end::Sidebar mobile toggle-->

        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ route('admin.dashboard') }}" class="d-lg-none">
                <img alt="Logo" src="{{ asset('assets/media/logos/default-small.svg') }}" class="h-30px" />
            </a>
        </div>
        <!--end::Mobile logo-->

        <!--begin::Header wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">

            <!--begin::Menu wrapper-->
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                    id="kt_app_header_menu" data-kt-menu="true">
                </div>
            </div>
            <!--end::Menu wrapper-->

            <!--begin::Navbar-->
            <div class="app-navbar flex-shrink-0">
                <!--begin::Search-->
                <div class="app-navbar-item align-items-stretch ms-1 ms-md-4">
                    <div id="kt_header_search" class="header-search d-flex align-items-stretch"
                        data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter"
                        data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-overflow="false"
                        data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end">
                        <div class="d-flex align-items-center" data-kt-search-element="toggle"
                            id="kt_header_search_toggle">
                            <div
                                class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px">
                                <i class="ki-duotone ki-magnifier fs-2">
                                    <span class="path1"></span><span class="path2"></span>
                                </i>
                            </div>
                        </div>
                        <div data-kt-search-element="content"
                            class="menu menu-sub menu-sub-dropdown p-7 w-325px w-md-375px">
                            <div data-kt-search-element="wrapper">
                                <form data-kt-search-element="form" class="w-100 position-relative mb-3"
                                    autocomplete="off">
                                    <i
                                        class="ki-duotone ki-magnifier fs-2 text-gray-500 position-absolute top-50 translate-middle-y ms-0">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    <input type="text" class="search-input form-control form-control-flush ps-10"
                                        name="search" value="" placeholder="Tìm kiếm dịch vụ..."
                                        data-kt-search-element="input" />
                                </form>
                                <div class="separator border-gray-200 mb-6"></div>
                                <div data-kt-search-element="main">
                                    <div class="d-flex flex-stack fw-semibold mb-4">
                                        <span class="text-muted fs-6">Dịch vụ phổ biến:</span>
                                    </div>
                                    <div class="scroll-y mh-200px mh-lg-325px">
                                        <div class="d-flex align-items-center mb-5">
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light"><i
                                                        class="ki-duotone ki-laptop fs-2 text-primary"><span
                                                            class="path1"></span><span class="path2"></span></i></span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="#"
                                                    class="fs-6 text-gray-800 text-hover-primary fw-semibold">Tăng Sub
                                                    Facebook</a>
                                                <span class="fs-7 text-muted fw-semibold">Phổ biến nhất</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Search-->

                <!--begin::Notifications-->
                <div class="app-navbar-item ms-1 ms-md-4">
                    <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end" id="kt_menu_notifications_toggle">
                        <i class="ki-duotone ki-notification-on fs-2">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                class="path4"></span><span class="path5"></span>
                        </i>
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px" data-kt-menu="true">
                        <div class="d-flex flex-column bgi-no-repeat rounded-top"
                            style="background-image:url('{{ asset('assets/media/misc/menu-header-bg.jpg') }}')">
                            <h3 class="text-white fw-semibold px-9 mt-10 mb-6">Thông báo <span
                                    class="fs-8 opacity-75 ps-3">0 mới</span></h3>
                        </div>
                        <div class="scroll-y mh-325px my-5 px-8">
                            <div class="text-center py-10">Không có thông báo mới</div>
                        </div>
                    </div>
                </div>
                <!--end::Notifications-->

                <!--begin::My apps-->
                <div class="app-navbar-item ms-1 ms-md-4">
                    <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-element-11 fs-2">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span
                                class="path4"></span>
                        </i>
                    </div>
                    <!--begin::My apps menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-350px" data-kt-menu="true">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">My Apps</div>
                                <div class="card-toolbar">
                                    <button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n3"
                                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                        data-kt-menu-placement="bottom-end">
                                        <i class="ki-duotone ki-setting-3 fs-2"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span><span class="path5"></span></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body py-5">
                                <div class="mh-450px scroll-y me-n5 pe-5">
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/amazon.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">AWS</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/angular-icon-1.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">AngularJS</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/atica.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Atica</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/beats-electronics.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Music</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/codeigniter.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Codeigniter</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/bootstrap-4.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Bootstrap</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/google-tag-manager.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">GTM</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/disqus.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Disqus</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/dribbble-icon-1.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Dribble</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/google-play-store.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Play Store</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/google-podcasts.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Podcasts</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/figma-1.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Figma</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/github.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Github</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/gitlab.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Gitlab</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/instagram-2-1.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Instagram</span>
                                            </a>
                                        </div>
                                        <div class="col-4">
                                            <a href="#"
                                                class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
                                                <img src="{{ asset('assets/media/svg/brand-logos/pinterest-p.svg') }}"
                                                    class="w-25px h-25px mb-2" alt="" />
                                                <span class="fw-semibold">Pinterest</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::My apps menu-->
                </div>
                <!--end::My apps-->

                <!--begin::Theme mode-->
                <div class="app-navbar-item ms-1 ms-md-4">
                    <a href="#"
                        class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
                        data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-night-day theme-light-show fs-1"><span class="path1"></span><span
                                class="path2"></span><span class="path3"></span><span class="path4"></span><span
                                class="path5"></span><span class="path6"></span><span class="path7"></span><span
                                class="path8"></span><span class="path9"></span><span class="path10"></span></i>
                        <i class="ki-duotone ki-moon theme-dark-show fs-1"><span class="path1"></span><span
                                class="path2"></span></i>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                        data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon"><i
                                        class="ki-duotone ki-night-day fs-2"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span
                                            class="path4"></span><span class="path5"></span><span
                                            class="path6"></span><span class="path7"></span><span
                                            class="path8"></span><span class="path9"></span><span
                                            class="path10"></span></i></span>
                                <span class="menu-title">Light</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon"><i class="ki-duotone ki-moon fs-2"><span
                                            class="path1"></span><span class="path2"></span></i></span>
                                <span class="menu-title">Dark</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon"><i
                                        class="ki-duotone ki-screen fs-2"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span
                                            class="path4"></span></i></span>
                                <span class="menu-title">System</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--end::Theme mode-->

                <!--begin::User menu-->
                <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
                    <!-- Global Loading Spinner -->
                    <div id="loading-spinner-global" class="me-3" style="display: none;">
                        <span class="spinner-border spinner-border-sm text-primary align-middle"></span>
                    </div>

                    @guest
                    <div class="cursor-pointer symbol symbol-35px"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <img src="{{ asset('assets/media/avatars/300-3.jpg') }}" class="rounded-3" alt="user" />
                    </div>
                    <!--begin::User account menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5"><img alt="Logo"
                                        src="{{ asset('assets/media/avatars/300-3.jpg') }}" /></div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">
                                        {{ auth()->user()->name ?? 'Người dùng' }}
                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{
                                        auth()->user()->email ?? 'user@gmail.com' }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5"><a href="#" class="menu-link px-5">Tài khoản</a></div>
                        <div class="menu-item px-5"><a href="#" class="menu-link px-5">Đăng xuất</a></div>
                    </div>
                    <!--end::User account menu-->
                </div>
                <!--end::User menu-->
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div>
<!--end::Header-->