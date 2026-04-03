@props([
    'title' => '',
    'icon' => '',
    'color' => 'primary',
    'value' => '0',
    'badge' => ''
])

<div class="card card-flush h-md-100 shadow-sm border-0 mb-7 bg-light-{{ $color }} bg-opacity-50 hover-grow">
    <div class="card-body d-flex flex-column justify-content-center p-6">
        <div class="d-flex flex-stack mb-3">
            <div class="symbol symbol-40px me-3">
                <span class="symbol-label bg-{{ $color }} shadow-sm">
                    <i class="{{ $icon }} fs-2 text-white"></i>
                </span>
            </div>
            @if($badge)
                <span class="badge badge-{{ $color }} fw-bold fs-8">{{ $badge }}</span>
            @endif
        </div>

        <div class="d-flex flex-column">
            <span class="fs-2x fw-bold text-gray-900 lh-1 ls-n1 mb-1">{{ $value }}</span>
            <span class="text-gray-600 fw-bold fs-8 text-uppercase ls-1">{{ $title }}</span>
        </div>
    </div>
</div>

<style>
    .hover-grow { transition: all 0.3s ease; }
    .hover-grow:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; }
</style>
