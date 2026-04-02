@section('title', 'Đăng kí')
<form class="form w-100" wire:submit="register">
    <!--begin::Heading-->
    <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-gray-900 fw-bolder mb-3">Tạo tài khoản mới</h1>
        <!--end::Title-->
        <!--begin::Subtitle-->
        <div class="text-gray-500 fw-semibold fs-6">Tham gia hệ thống SMM Panel lớn nhất</div>
        <!--end::Subtitle-->
    </div>
    <!--begin::Heading-->

    <div class="row fv-row mb-8">
        <!--begin::Col-->
        <div class="col-xl-6">
            <input type="text" placeholder="Họ và tên" wire:model="form.name" autocomplete="off" class="form-control bg-transparent @error('form.name') is-invalid @enderror" />
            @error('form.name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <!--end::Col-->
        <div class="col-xl-6">
            <input type="text" placeholder="Tên đăng nhập" wire:model="form.username" autocomplete="off" class="form-control bg-transparent @error('form.username') is-invalid @enderror" />
            @error('form.username') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="fv-row mb-8">
        <input type="text" placeholder="Email" wire:model="form.email" autocomplete="off" class="form-control bg-transparent @error('form.email') is-invalid @enderror" />
        @error('form.email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="fv-row mb-8">
        <input type="text" placeholder="Số điện thoại" wire:model="form.phone" autocomplete="off" class="form-control bg-transparent @error('form.phone') is-invalid @enderror" />
        @error('form.phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="row fv-row mb-8">
        <div class="col-xl-6">
            <input type="password" placeholder="Mật khẩu" wire:model="form.password" autocomplete="off" class="form-control bg-transparent @error('form.password') is-invalid @enderror" />
            @error('form.password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-xl-6">
            <input type="password" placeholder="Nhập lại mật khẩu" wire:model="form.password_confirmation" autocomplete="off" class="form-control bg-transparent @error('form.password_confirmation') is-invalid @enderror" />
            @error('form.password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <!--begin::Accept-->
    <div class="fv-row mb-8">
        <label class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="toc" value="1" checked="checked" />
            <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">Tôi đồng ý với 
            <a href="#" class="ms-1 link-primary">Điều khoản &amp; Dịch vụ</a>.</span>
        </label>
    </div>
    <!--end::Accept-->

    <!--begin::Submit button-->
    <div class="d-grid mb-10">
        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
            <span class="indicator-label" wire:loading.remove>Đăng kí ngay</span>
            <span class="indicator-progress" wire:loading>Đang tạo tài khoản...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
    <!--end::Submit button-->

    <!--begin::Sign up-->
    <div class="text-center text-gray-500 fw-semibold fs-6">Đã có tài khoản?
    <a href="{{ route('login') }}" class="link-primary" wire:navigate>Đăng nhập ngay</a></div>
    <!--end::Sign up-->
</form>
