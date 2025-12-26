{{-- Hero Section --}}
<div>
    <section class="px-3 py-5 lg:py-10">
        <div class="grid items-center gap-5 lg:grid-cols-2 justify-items-center">
            <div class="flex flex-col items-center justify-center order-2 lg:order-1">
                <p class="text-4xl font-bold text-[#822659] md:text-7xl font-playfair">25% OFF</p>
                <p class="text-4xl text-[#1A1A1A] font-bold md:text-7xl font-playfair">RAMADAN SALE</p>
                <p class="mt-2 text-[#1A1A1A] text-sm md:text-lg">For limited time only!</p>
                <a href="/shop" wire:navigate
                    class="px-5 py-2 mt-10 rounded-md text-lg text-[#F0F0F0] bg-[#3E5641] md:text-2xl hover:bg-[#004D61]">Shop
                    Now</a>
            </div>
            <div class="order-1 lg:order-2">
                <img class="h-80 w-80 object-cover rounded-md border border-gray-300 hover:shadow-md aspect-square lg:w-[500px] lg:h-[500px]"
                    src="{{ asset('images/hero/hero_image.jpg') }}" alt="Hero Image">
            </div>
        </div>
    </section>

    {{-- About Us Section --}}

    <div class="bg-[#ccdbdf] pt-10 pb-4 md:py-4 px-6 sm:px-8">
      <div class="grid items-center justify-center max-w-screen-xl gap-2 mx-auto md:gap-12 md:grid-cols-2">
        <div class="text-left">
          <h2 class="text-2xl font-bold text-[#004D61] mb-6 md:mb-10 !leading-tight text-center font-playfair">WHO WE ARE</h2>
          <p class="text-base leading-relaxed text-center text-[#1A1A1A] md:text-lg">Aaliyah's Collection is a modest fashion store dedicated to timeless designs that empower women to feel confident, beautiful, and authentic. Each piece is meticulously designed with ethical practices and elevated simplicity at its core.</p>
        </div>
        <div class="flex justify-center -mt-6 translate-x-6 md:justify-center">
          <img src="{{ asset('images/about_us.png') }}" alt="Premium Benefits" class="w-auto h-[400px]" />
        </div>
      </div>
    </div>

    {{-- Categories Section --}}

    <div class=" rounded-[20px] sm:p-8 p-6">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="mb-6 text-2xl font-bold text-[#004D61] text-center font-playfair">OUR COLLECTIONS</h2>

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
                                <h6 class="text-sm font-bold truncate text-[#1A1A1A]">{{ $category->name }}</h6>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Why Us Section --}}

    <section class="text-[#004D61] py-10 px-6 sm:px-8 bg-[#e6d3dd]">
        <div class="max-w-screen-xl mx-auto">
            <div class="mb-8 text-2xl font-bold text-center font-playfair">
                WHY US?
            </div>
            <div class="grid grid-cols-2 gap-y-12 gap-x-8 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                {{-- Item 1 --}}
                <div class="flex flex-col items-center justify-center text-center transition duration-500 transform hover:scale-105">
                    <img src="{{ asset('images/icons/delivery.png') }}" class="object-contain mb-6 w-28 h-28" alt="Delivery">
                    <h2 class="text-sm font-medium text-[#1A1A1A]">Island-wide Delivery</h2>
                </div>

                {{-- Item 2 --}}
                <div class="flex flex-col items-center justify-center text-center transition duration-500 transform hover:scale-105">
                    <img src="{{ asset('images/icons/click.png') }}" class="object-contain mb-6 w-28 h-28" alt="Click & Collect">
                    <h2 class="text-sm font-medium text-[#1A1A1A]">Click & Collect</h2>
                </div>

                {{-- Item 3 --}}
                <div class="flex flex-col items-center justify-center text-center transition duration-500 transform hover:scale-105">
                    <img src="{{ asset('images/icons/ethical.png') }}" class="object-contain mb-6 w-28 h-28" alt="Ethical">
                    <h2 class="text-sm font-medium text-[#1A1A1A]">Ethical & Responsible</h2>
                </div>

                {{-- Item 4 --}}
                <div class="flex flex-col items-center justify-center text-center transition duration-500 transform hover:scale-105">
                    <img src="{{ asset('images/icons/handcrafted.png') }}" class="object-contain mb-6 w-28 h-28" alt="Handcrafted">
                    <h2 class="text-sm font-medium text-[#1A1A1A]">Handcrafted Clothing</h2>
                </div>
            </div>
        </div>
    </section>
</div>
