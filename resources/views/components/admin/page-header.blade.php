@props(['title'])

<div class="flex flex-row items-center justify-between pt-16 mb-4 lg:pt-0">
    <h1 class="text-2xl text-brand-teal brand-heading-playfair text-left">{{ $title }}</h1>
    @if(isset($actions))
        <div class="flex items-center">
             {{ $actions }}
        </div>
    @endif
</div>
