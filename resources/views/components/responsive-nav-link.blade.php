@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-btn primary w-full text-left'
            : 'nav-btn w-full text-left';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
