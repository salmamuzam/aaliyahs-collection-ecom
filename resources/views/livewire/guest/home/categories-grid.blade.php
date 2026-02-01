@props(['categories'])

<div class=" rounded-[20px] sm:p-8 p-6">
    <div class="max-w-screen-xl mx-auto">
        <x-shared.section-header title="OUR COLLECTIONS" align="center" />

        <div class="grid grid-cols-2 gap-4 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
            @foreach ($categories as $category)
                <!-- Category 1 -->
                <div wire:key="{{ $category->id }}"
                    class="shadow-sm bg-white p-1.5 overflow-hidden cursor-pointer relative hover:shadow-md rounded-md border border-gray-300">
                    <a href="/shop?selected_categories[0]={{ $category->id }}" class="block" wire:navigate>
                        <div class="bg-gray-200 aspect-square rounded-md overflow-hidden">
                            <img src='{{ \App\Helpers\ImageHelper::getUrl($category->image) }}' alt="{{ $category->name }}"
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
