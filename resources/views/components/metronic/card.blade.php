@props(['title' => null, 'class' => ''])

<div class="card {{ $class }}">
    @if($title || isset($toolbar))
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold @if($title) text-gray-900 @endif fs-3 mb-1">{{ $title }}</span>
        </h3>
        @if(isset($toolbar))
        <div class="card-toolbar">
            {{ $toolbar }}
        </div>
        @endif
    </div>
    @endif
    <div class="card-body py-3">
        {{ $slot }}
    </div>
</div>
