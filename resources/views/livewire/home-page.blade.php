{{-- Hero Section --}}
<div>
    <section class="px-3 py-5 lg:py-10">
        <div class="grid items-center gap-5 lg:grid-cols-2 justify-items-center">
            <div class="flex flex-col items-center justify-center order-2 lg:order-1">
                <p class="text-4xl font-bold text-[#822659] md:text-7xl">25% OFF</p>
                <p class="text-4xl text-[#1A1A1A] font-bold md:text-7xl">RAMADAN SALE</p>
                <p class="mt-2 text-[#1A1A1A] text-sm md:text-lg">For limited time only!</p>
                <button
                    class="px-5 py-2 mt-10 rounded-lg text-lg text-[#F0F0F0] bg-[#3E5641] md:text-2xl hover:bg-[#004D61]">Shop
                    Now</button>
            </div>
            <div class="order-1 lg:order-2">
                <img class="h-80 w-80 object-cover shadow-md rounded-lg lg:w-[500px] lg:h-[500px]"
                    src="{{ asset('images/hero/hero_image.jpg') }}" alt="Hero Image">
            </div>
        </div>
    </section>

    {{-- Categories Section --}}

    <div class="bg-[#FFF0F5] rounded-[20px] sm:p-8 p-6">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="mb-6 text-2xl font-bold text-[#004D61]">OUR COLLECTIONS</h2>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                @foreach($categories as $category)
                <!-- Category 1 -->
                <div wire:key="{{ $category->id }}" class="shadow-sm bg-white p-1.5 overflow-hidden cursor-pointer relative hover:shadow-md">
                    <a href="/shop?selected_categories[0]={{ $category->id }}" class="block">
                        <div class="bg-gray-200 aspect-square">
                            <img src='{{ url('storage', $category->image) }}'
                              alt="{{ $category->name }}"  class="object-cover object-top w-full h-full" />
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
</div>
