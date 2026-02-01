@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-base text-brand-black font-sans mb-2']) }}>
    {{ $value ?? $slot }}
</label>
