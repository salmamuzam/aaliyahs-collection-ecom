<div class="w-full mb-6">
    <label for="search" class="sr-only">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500 w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </div>
        <input wire:model.live.debounce.300ms="search" type="search" id="search"
            class="block w-full p-3 ps-10 bg-white border border-gray-300 text-brand-black text-sm rounded-lg focus:ring-brand-green focus:border-brand-green shadow-sm placeholder-gray-400 outline-none transition-all"
            placeholder="Search..." />
    </div>
</div>
