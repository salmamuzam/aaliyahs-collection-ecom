@props(['variant' => 'default'])

@php
    $classes = match($variant) {
        'success' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
        'danger' => 'bg-rose-50 text-rose-700 border-rose-100',
        'warning' => 'bg-amber-50 text-amber-700 border-amber-100',
        'info' => 'bg-blue-50 text-blue-700 border-blue-100',
        'primary' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
        'secondary' => 'bg-purple-50 text-purple-700 border-purple-100',
        'teal' => 'bg-teal-50 text-teal-700 border-teal-100',
        'cyan' => 'bg-cyan-50 text-cyan-700 border-cyan-100',
        default => 'bg-gray-50 text-gray-700 border-gray-100',
    };
@endphp

<span {{ $attributes->merge(['class' => "px-2 py-1 text-xs font-bold uppercase tracking-wider rounded-md border $classes"]) }}>
    {{ $slot }}
</span>
