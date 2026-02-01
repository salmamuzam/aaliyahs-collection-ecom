<div class="relative bg-gray-50 rounded-md overflow-hidden group border border-gray-300 aspect-[4/5] md:aspect-auto md:min-h-0">
    
    @if(!empty($product->images))
    <div class="absolute inset-0 w-full h-full">
        <img class="w-full h-full object-cover object-top transition-all duration-300" 
             src="{{ \App\Helpers\ImageHelper::getUrl($product->images[$currentImageIndex]) }}" alt="{{ $product->name }}">
    </div>
    
    @if(count($product->images) > 1)
    <div class="arrows w-full absolute inset-y-1/2 flex justify-between px-4 z-10 opacity-0 group-hover:opacity-100 transition-opacity">
        <button wire:click="prevImage" class="w-10 h-10 bg-white/80 hover:bg-white text-brand-burgundy rounded-full shadow-lg flex items-center justify-center transition-all active:scale-95 focus:outline-none cursor-pointer">
            <i class="fa-solid fa-chevron-left text-xl"></i>
        </button>
        <button wire:click="nextImage" class="w-10 h-10 bg-white/80 hover:bg-white text-brand-burgundy rounded-full shadow-lg flex items-center justify-center transition-all active:scale-95 focus:outline-none cursor-pointer">
            <i class="fa-solid fa-chevron-right text-xl"></i>
        </button>
    </div>

    {{-- Image Counter Badge --}}
    <div class="absolute bottom-4 right-4 bg-black/50 text-white px-3 py-1 rounded-full text-xs font-medium tracking-wider backdrop-blur-sm z-10">
        {{ $currentImageIndex + 1 }} / {{ count($product->images) }}
    </div>
    @endif
    @endif
</div>
