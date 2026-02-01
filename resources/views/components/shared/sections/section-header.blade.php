@props(['title', 'align' => 'left', 'size' => 'text-2xl', 'color' => 'text-brand-teal'])

@php
    $alignmentClass = match($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };
@endphp

<h2 {{ $attributes->merge(['class' => "mb-6 font-bold font-playfair $alignmentClass $size $color"]) }}>
    {{ $title }}
</h2>
