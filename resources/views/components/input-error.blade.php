@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-base text-brand-burgundy']) }}>{{ $message }}</p>
@enderror

