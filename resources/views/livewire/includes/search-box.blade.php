<div class="w-full mb-6">
    <label for="search" class="sr-only">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input wire:model.live.debounce.300ms="search" type="search" id="search"
            class="block w-full p-3 ps-10 bg-white border border-gray-300 text-[#1A1A1A] text-sm rounded-lg focus:ring-[#3E5641] focus:border-[#3E5641] shadow-sm placeholder-gray-400 outline-none transition-all"
            placeholder="Search..." />
    </div>
</div>
