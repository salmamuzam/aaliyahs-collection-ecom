<div>
    <div class="tracking-wide max-w-7xl mx-auto py-6 md:py-12 px-4">
      <div class="flex flex-col md:flex-row gap-8 items-stretch">

        <div class="w-full md:w-1/2 relative">
            <img src="{{ url('storage', $product->image) }}" alt="{{ $product->name }}" class="w-full rounded-md border border-gray-300 md:absolute md:inset-0 md:h-full object-cover h-[450px] object-top block" />
        </div>

        <div class="w-full md:w-1/2 bg-white py-4 px-8 rounded-md shadow-sm border border-gray-300">
          <div>
            <h2 class="text-2xl font-bold text-[#1A1A1A]">{{ $product->name }}</h2>
            <div class="flex justify-between items-center mt-4">
                <div>
                   <span class="text-white text-sm font-medium bg-[#004D61] px-3 py-1.5 tracking-wide rounded-md">{{ $product->category->name ?? 'Category' }}</span>
                </div>
                <h3 class="text-[#822659] text-[#1A1A1A] font-bold">LKR {{ number_format($product->price, 2) }}</h3>
            </div>

          <div>
             <div class="mt-2 border-b-2 border-gray-300 w-full py-2">
                <span class="text-[#004D61] text-sm font-bold uppercase">Description</span>
             </div>
            <p class="text-[#1A1A1A] mt-3 text-sm text-justify">{{ $product->description }}</p>
          </div>

          <div class="mt-4">
            <h3 class="text-sm font-bold uppercase text-[#004D61]">Quantity</h3>

            <div class="flex mt-4 rounded-md overflow-hidden bg-[#3E5641] py-2.5 px-4 w-32">
              <button wire:click="decreaseQty" type="button" class="bg-transparent w-full text-white font-semibold flex items-center justify-center cursor-pointer outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-current inline" viewBox="0 0 124 124">
                  <path d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z" data-original="#000000"></path>
                </svg>
              </button>
              <span class="bg-transparent w-full px-4 font-semibold flex items-center justify-center text-white text-sm">
                {{ $quantity }}
              </span>
              <button wire:click="increaseQty" type="button" class="bg-transparent w-full text-white font-semibold flex items-center justify-center cursor-pointer outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-current inline" viewBox="0 0 42 42">
                  <path d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z" data-original="#000000"></path>
                </svg>
              </button>
            </div>
          </div>

          <div class="flex gap-4 mt-4">
            <button type="button" class="w-full max-w-[200px] px-4 py-2.5 bg-[#822659] hover:bg-[#6b1f49] text-white text-sm rounded-md cursor-pointer">Add to favorites</button>
            <button wire:click.prevent="addToCart({{ $product->id }})" type="button" class="w-full max-w-[200px] px-4 py-2.5 bg-[#3E5641] hover:bg-[#324534] text-white text-sm rounded-md cursor-pointer transition-colors">
                <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add to cart</span>
                <span wire:loading wire:target="addToCart({{ $product->id }})">Adding...</span>
            </button>
          </div>
        </div>
      </div>
    </div>
</div>
