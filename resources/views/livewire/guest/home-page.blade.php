{{-- Hero Section --}}
<div>
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
                    src="{{ asset('images/hero/hero_image.jpg') }}" alt="Hero Image">
            </div>
        </div>
    </section>

    {{-- About Us Section --}}

    <div class="bg-brand-teal bg-opacity-10 pt-10 pb-4 md:py-4 px-6 sm:px-8">
      <div class="grid items-center justify-center max-w-screen-xl gap-2 mx-auto md:gap-12 md:grid-cols-2">
        <div class="text-left">
          <x-section-header title="WHO WE ARE" align="center" class="mb-6 md:mb-10 !leading-tight text-brand-teal" />
          <p class="text-base leading-relaxed text-center text-brand-black md:text-lg">Aaliyah's Collection is a modest fashion store dedicated to timeless designs that empower women to feel confident, beautiful, and authentic. Each piece is meticulously designed with ethical practices and elevated simplicity at its core.</p>
        </div>
        <div class="flex justify-center -mt-6 translate-x-6 md:justify-center">
          <img src="{{ asset('images/pages/about_us.png') }}" alt="Premium Benefits" class="w-auto h-[400px]" />
        </div>
      </div>
    </div>

    {{-- Categories Section --}}

    <div class=" rounded-[20px] sm:p-8 p-6">
        <div class="max-w-screen-xl mx-auto">
            <x-section-header title="OUR COLLECTIONS" align="center" />

            <div class="grid grid-cols-2 gap-4 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                @foreach ($categories as $category)
                    <!-- Category 1 -->
                    <div wire:key="{{ $category->id }}"
                        class="shadow-sm bg-white p-1.5 overflow-hidden cursor-pointer relative hover:shadow-md rounded-md border border-gray-300">
                        <a href="/shop?selected_categories[0]={{ $category->id }}" class="block" wire:navigate>
                            <div class="bg-gray-200 aspect-square rounded-md overflow-hidden">
                                <img src='{{ url('storage', $category->image) }}' alt="{{ $category->name }}"
                                    class="object-cover object-top w-full h-full" />
                            </div>
                            <div class="p-3 pb-1.5 text-center">
                                <h6 class="text-sm font-bold truncate text-brand-black">{{ $category->name }}</h6>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Why Us Section --}}

    <section class="text-brand-teal py-10 px-6 sm:px-8 bg-brand-burgundy bg-opacity-10">
        <div class="max-w-screen-xl mx-auto">
            <x-section-header title="WHY US?" align="center" class="mb-8" />
            <div class="grid grid-cols-2 gap-y-12 gap-x-8 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-feature-card :icon="asset('images/icons/delivery.png')" title="Island-wide Delivery" />
                <x-feature-card :icon="asset('images/icons/click.png')" title="Click & Collect" />
                <x-feature-card :icon="asset('images/icons/ethical.png')" title="Ethical & Responsible" />
                <x-feature-card :icon="asset('images/icons/handcrafted.png')" title="Handcrafted Clothing" />
            </div>
        </div>
    </section>
</div>
