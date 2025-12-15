<div class="flex justify-between md:col-span-1">
    <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium text-[#1A1A1A]">{{ $title }}</h3>

        <p class="mt-1 text-sm text-[#1A1A1A]">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
