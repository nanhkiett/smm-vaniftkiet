<div class="card shadow-sm border-0">
    <div class="card-header border-0 pt-6">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Khởi tạo đơn hàng mới</span>
            <span class="text-muted mt-1 fw-semibold fs-7 text-uppercase">Vui lòng lựa chọn dịch vụ và nhập đầy đủ thông tin để bắt đầu</span>
        </h3>
    </div>
    <div class="card-body py-5">
        <form wire:submit.prevent="submit">
            <!-- 1. Tìm nhanh -->
            <div class="mb-8">
                <label class="form-label fw-bold text-gray-700 fs-7 text-uppercase">Tìm mã dịch vụ nhanh</label>
                <div class="d-flex flex-column">
                    {{-- Không dùng wire:model trùng với select dịch vụ chi tiết (Select2 + morph sẽ lệch / nháy). Đồng bộ qua $wire.set. --}}
                    <select class="form-select" data-control="select2" data-placeholder="Nhập ID hoặc tên dịch vụ..."
                        wire:change="$wire.set('service_id', $event.target.value ? $event.target.value : null)">
                        <option value=""></option>
                        @foreach($allServices as $s)
                            <option value="{{ $s->id }}" @selected((string) $service_id === (string) $s->id)>[{{ $s->id }}] {{ $s->name }} - {{ number_format($s->price, 0, ',', '.') }}đ</option>
                        @endforeach
                    </select>
                    <div class="text-muted fs-7 mt-2">Tính năng này giúp bạn tìm kiếm và đặt hàng nhanh chóng bằng ID dịch vụ</div>
                </div>
            </div>

            <div class="separator border-gray-200 mb-8 border-dashed"></div>
            <div class="row g-5">
                <!-- 2. Nền tảng -->
                <div class="col-md-6">
                    <label class="form-label fw-bold text-gray-700 fs-7 text-uppercase">Chọn nền tảng</label>
                    <select class="form-select" wire:model.live="platform_id" data-control="select2" data-placeholder="Lựa chọn một nền tảng">
                        <option value="">-- Chọn nền tảng --</option>
                        @foreach($platforms as $platform)
                            <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- 3. Phân loại -->
                <div class="col-md-6">
                    <label class="form-label fw-bold text-gray-700 fs-7 text-uppercase">Chọn phân loại</label>
                    <select class="form-select" wire:model.live="category_id" data-control="select2" data-placeholder="Lựa chọn một phân loại">
                        <option value="">-- Chọn phân loại --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- 4. Dịch vụ chi tiết -->
            <div class="mt-5 mb-8">
                <label class="form-label fw-bold text-gray-700 fs-7 text-uppercase">Chọn dịch vụ chi tiết</label>
                <select class="form-select" wire:model.live="service_id" data-control="select2" data-placeholder="Lựa chọn một dịch vụ chi tiết">
                    <option value="">-- Chọn dịch vụ --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">[{{ $service->id }}] {{ $service->name }} - ({{ number_format($service->price, 0, ',', '.') }}đ / 1000)</option>
                    @endforeach
                </select>
            </div>

            @if($selectedService)
                <div class="alert alert-dismissible bg-light-info d-flex flex-column flex-sm-row p-5 mb-10 border-info border border-dashed rounded-3" wire:ignore>
                    <i class="ki-duotone ki-information fs-2hx text-info me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <div class="d-flex flex-column pe-0 pe-sm-10">
                        <h4 class="fw-bold text-info fs-5 text-uppercase">Thông tin dịch vụ:</h4>
                        <span class="text-gray-800 fw-semibold fs-6">{!! nl2br(e($selectedService->description)) !!}</span>
                    </div>
                </div>

                <div class="row g-5 mb-8">
                    <div class="col-md-8">
                        <label class="form-label fw-bold text-gray-700 fs-7 text-uppercase">Nhập liên kết bài viết (Link)</label>
                        <input type="text" class="form-control" placeholder="Dán link bài viết hoặc ID đối tượng tại đây..." />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold text-gray-700 fs-7 text-uppercase">Số lượng mua (Tối thiểu {{ number_format($selectedService->min) }})</label>
                        <input type="number" wire:model.live="quantity" min="{{ $selectedService->min }}" max="{{ $selectedService->max }}" class="form-control" />
                    </div>
                </div>

                <div class="card bg-light-primary border-primary border border-dashed mb-8 rounded-3">
                    <div class="card-body p-5 d-flex align-items-center justify-content-between">
                        <span class="fw-bold fs-5 text-gray-800 text-uppercase">Tổng phí thanh toán:</span>
                        <span class="fw-bolder fs-2 text-primary">{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 fs-4 py-4 rounded-3 shadow-hover transform-hover">
                    <span class="indicator-label fw-bold text-uppercase">Tạo đơn hàng ngay</span>
                </button>
            @endif
        </form>
    </div>
</div>
