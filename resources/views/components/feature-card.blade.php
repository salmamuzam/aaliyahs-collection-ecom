@props(['icon', 'title'])

<div class="flex flex-col items-center justify-center text-center transition duration-500 transform hover:scale-105">
    <img src="{{ $icon }}" class="object-contain mb-6 w-28 h-28" alt="{{ $title }}">
    <h2 class="text-sm font-medium text-brand-black">{{ $title }}</h2>
</div>
