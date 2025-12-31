<div class="flex justify-between">
    <div>
        <h3 class="text-xl font-bold brand-heading-playfair text-brand-teal uppercase">{{ $title }}</h3>

        <p class="mt-3 text-base text-brand-black font-sans">
            {{ $description }}
        </p>
    </div>

    <div>
        {{ $aside ?? '' }}
    </div>
</div>
