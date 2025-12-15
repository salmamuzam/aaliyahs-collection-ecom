@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#1A1A1A]']) }}>
    {{ $value ?? $slot }}
</label>
