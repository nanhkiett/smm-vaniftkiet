@props(['color' => 'primary', 'light' => false, 'class' => ''])

<span class="badge badge-{{ $light ? 'light-' : '' }}{{ $color }} fw-bold {{ $class }}">
    {{ $slot }}
</span>
