@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'notice']) }}>
        {{ $status }}
    </div>
@endif
