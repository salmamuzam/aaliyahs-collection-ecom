@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'brand-form-input text-brand-black shadow-sm']) !!}>
