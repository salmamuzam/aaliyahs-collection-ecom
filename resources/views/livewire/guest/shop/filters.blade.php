<div class="w-full px-3 lg:w-1/4 lg:block">
    <div class="p-4 mb-5 bg-white border border-gray-300 rounded-md">
        <x-shared.section-header title="CATEGORIES" color="text-brand-black" class="mb-2" />
        <div class="w-16 mb-4 border-b border-brand-burgundy"></div>
        <ul>
            @foreach($categories as $category)
                <li class="mb-4" wire:key="{{ $category->id }}">
                    <label for="category-{{ $category->id }}" class="flex items-center">
                        <input type="checkbox" id="category-{{ $category->id }}"
                            wire:model.live="selected_categories" value="{{ $category->id }}"
                            class="w-4 h-4 mr-2 text-brand-burgundy focus:ring-brand-burgundy border-brand-burgundy rounded-md">
                        <span class="text-lg text-brand-black">{{ $category->name }}</span>
                    </label>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="p-4 mb-5 bg-white border border-gray-300 rounded-md">
        <x-shared.section-header title="PRICE" color="text-brand-black" class="mb-2" />
        <div class="w-16 mb-4 border-b border-brand-burgundy"></div>
        <div>
            <div class="text-brand-black">LKR {{ number_format($price_range, 2) }}</div>
            <input wire:model.live="price_range" type="range"
                class="w-full h-1 mb-4 bg-gray-200 rounded appearance-none cursor-pointer accent-brand-burgundy"
                min="0" max="50000" step="1000">
            <div class="flex justify-between ">
                <span class="inline-block text-lg text-brand-burgundy">LKR 0</span>
                <span class="inline-block text-lg text-brand-burgundy">LKR 50,000</span>
            </div>
        </div>
    </div>
</div>
