<div class="relative" x-data="{ expanded: false, open: @entangle('showDropdown') }" @click.away="expanded = false; open = false">
    
    {{-- Search Icon Toggle --}}
    <button @click="expanded = !expanded; if(expanded) $nextTick(() => $refs.searchInput.focus())" 
            class="text-white hover:text-gray-200 transition-colors p-1 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </button>

    {{-- Expandable Input Field --}}
    <div x-show="expanded" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 w-0"
         x-transition:enter-end="opacity-100 w-72"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 w-72"
         x-transition:leave-end="opacity-0 w-0"
         class="absolute right-0 top-1/2 -translate-y-1/2 md:right-8 bg-white rounded-full flex items-center shadow-xl border border-brand-teal/20 overflow-hidden h-10 z-50 origin-right"
         style="display: none;">
         
         <input x-ref="searchInput"
                type="text" 
                wire:model.live.debounce.300ms="query"
                placeholder="Search products..."
                class="w-full pl-4 pr-8 py-2 text-sm text-brand-black outline-none bg-transparent placeholder-gray-400">
        
        <button @click="expanded = false; open = false; $wire.set('query', '')" class="absolute right-2 text-gray-400 hover:text-red-500 p-1">
             <i class="fa-solid fa-times text-xs"></i>
        </button>
    </div>

    {{-- Results Dropdown --}}
    <div x-show="expanded && open && $wire.query.length > 1" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         class="absolute right-0 z-[60] w-80 mt-4 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden ring-1 ring-black ring-opacity-5"
         style="display: none;">
        
        @if(count($results) > 0)
            <div class="max-h-[300px] overflow-y-auto">
                @foreach($results as $product)
                    <a href="{{ route('product.detail', $product->id) }}" 
                       wire:navigate
                       class="flex items-center px-4 py-3 hover:bg-gray-50 border-b border-gray-100 last:border-0 transition-colors group">
                        @if(!empty($product->images))
                            <img src="{{ Storage::url($product->images[0]) }}" class="w-10 h-10 object-cover rounded shadow-sm group-hover:scale-105 transition-transform">
                        @else
                           <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center">
                               <i class="fa-solid fa-image text-gray-400"></i>
                           </div>
                        @endif
                        <div class="ml-3">
                            <p class="text-sm font-bold text-brand-black truncate w-[200px] group-hover:text-brand-burgundy transition-colors">{{ $product->name }}</p>
                            <p class="text-xs text-brand-teal font-medium">LKR {{ number_format($product->price, 2) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <a href="{{ url('/shop?search=' . $query) }}" 
               wire:navigate
               class="block px-4 py-3 text-xs font-bold text-center text-white bg-brand-teal hover:bg-brand-burgundy transition-colors uppercase tracking-widest">
                View All Results
            </a>
        @else
            <div class="px-4 py-8 text-center bg-gray-50">
                <div class="bg-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm text-gray-300">
                    <i class="fa-solid fa-magnifying-glass text-xl"></i>
                </div>
                <p class="text-sm text-gray-500 font-medium">No matches found for "{{ $query }}"</p>
            </div>
        @endif
    </div>
</div>
