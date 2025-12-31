@props(['title'])

<div class="mb-6 text-left">
    <h1 {{ $attributes->merge(['class' => 'text-2xl font-bold font-playfair text-brand-teal']) }}>
        {{ $title }}
    </h1>
</div>
