@section('title', 'Đăng nhập')
<form class="form w-100" wire:submit="login">
    <!--begin::Heading-->
    <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-gray-900 fw-bolder mb-3">Đăng nhập tài khoản</h1>
        <!--end::Title-->
        <!--begin::Subtitle-->
        <div class="text-gray-500 fw-semibold fs-6">Hệ thống SMM Panel Muasubngon.com</div>
        <!--end::Subtitle-->
    </div>
    <!--begin::Heading-->

    <!--begin::Input group-->
    <div class="fv-row mb-8">
        <!--begin::Username-->
        <input type="text" placeholder="Tên đăng nhập hoặc Email" wire:model="form.username" autocomplete="off" class="form-control bg-transparent @error('form.username') is-invalid @enderror" />
        @error('form.username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <!--end::Username-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="fv-row mb-3">
        <!--begin::Password-->
        <input type="password" placeholder="Mật khẩu" wire:model="form.password" autocomplete="off" class="form-control bg-transparent @error('form.password') is-invalid @enderror" />
        @error('form.password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <!--end::Password-->
    </div>
    <!--end::Input group-->

    <!--begin::Wrapper-->
    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
        <div></div>
        <!--begin::Link-->
        <a href="#" class="link-primary">Quên mật khẩu?</a>
        <!--end::Link-->
    </div>
    <!--end::Wrapper-->

    <!--begin::Submit button-->
    <div class="d-grid mb-10">
        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
            <!--begin::Indicator label-->
            <span class="indicator-label" wire:loading.remove>Đăng nhập ngay</span>
            <!--end::Indicator label-->
            <!--begin::Indicator progress-->
            <span class="indicator-progress" wire:loading>Vui lòng đợi...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            <!--end::Indicator progress-->
        </button>
    </div>
    <!--end::Submit button-->

    <!--begin::Sign up-->
    <div class="text-center text-gray-500 fw-semibold fs-6">Chưa có tài khoản?
    <a href="{{ route('register') }}" class="link-primary" wire:navigate>Đăng kí ngay</a></div>
    <!--end::Sign up-->
</form>
