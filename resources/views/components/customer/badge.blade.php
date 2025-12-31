@props(['status'])

@php
    $classes = match($status) {
        'cancelled', 'failed' => 'text-red-800 bg-red-200',
        'delivered', 'paid' => 'text-green-800 bg-green-200',
        'shipped' => 'text-blue-800 bg-blue-200',
        'processing' => 'text-cyan-800 bg-cyan-200',
        'new', 'pending' => 'text-purple-800 bg-purple-200',
        default => 'text-gray-800 bg-gray-200',
    };
@endphp

<span {{ $attributes->merge(['class' => "p-1.5 text-xs font-medium uppercase tracking-wider rounded-lg bg-opacity-50 $classes"]) }}>
    {{ $status }}
</span>
