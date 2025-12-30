<div class="flex justify-between">
    <div>
        <h3 class="text-xl font-bold font-playfair text-[#3E5641] uppercase">{{ $title }}</h3>

        <p class="mt-1 text-base text-[#1A1A1A] font-sans">
            {{ $description }}
        </p>
    </div>

    <div>
        {{ $aside ?? '' }}
    </div>
</div>
