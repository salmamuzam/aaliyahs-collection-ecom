@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-base text-[#1A1A1A] font-sans mb-2']) }}>
    {{ $value ?? $slot }}
</label>
