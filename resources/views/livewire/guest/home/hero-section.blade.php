<section class="px-3 py-5 lg:py-10">
    <div class="grid items-center gap-5 lg:grid-cols-2 justify-items-center">
        <div class="flex flex-col items-center justify-center order-2 lg:order-1">
            <p class="text-4xl font-bold text-brand-burgundy md:text-7xl brand-heading-playfair">25% OFF</p>
            <p class="text-4xl text-brand-black font-bold md:text-7xl brand-heading-playfair">RAMADAN SALE</p>
            <p class="mt-2 text-brand-black text-sm md:text-lg">For limited time only!</p>
            <a href="/shop" wire:navigate
                class="px-5 py-2 mt-10 rounded-md text-lg text-white bg-brand-green md:text-2xl hover:bg-brand-teal transition-colors">Shop
                Now</a>
        </div>
        <div class="order-1 lg:order-2">
            <img class="h-80 w-80 object-cover rounded-md border border-gray-300 hover:shadow-md aspect-square lg:w-[500px] lg:h-[500px]"
                src="{{ asset('images/home/hero_image.jpg') }}" alt="Hero Image">
        </div>
    </div>
</section>
