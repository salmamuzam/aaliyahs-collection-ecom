@props(['category'])

@php
    $colors = [
        'bg-purple-50 text-purple-700 border-purple-100',
        'bg-blue-50 text-blue-700 border-blue-100',
        'bg-cyan-50 text-cyan-700 border-cyan-100',
        'bg-emerald-50 text-emerald-700 border-emerald-100',
        'bg-amber-50 text-amber-700 border-amber-100',
        'bg-indigo-50 text-indigo-700 border-indigo-100',
    ];
    $colorClass = $colors[$category->id % count($colors)] ?? 'bg-gray-50 text-gray-700 border-gray-100';
@endphp

<span {{ $attributes->merge(['class' => "px-2 py-1 text-xs font-bold uppercase tracking-wider rounded-md border $colorClass"]) }}>
    {{ $category->name }}
</span>
