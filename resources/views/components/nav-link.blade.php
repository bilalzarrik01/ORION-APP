@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-btn primary'
            : 'nav-btn';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
