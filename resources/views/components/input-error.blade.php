@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-base text-rose-600 dark:text-rose-400']) }}>{{ $message }}</p>
@enderror

