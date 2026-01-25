@props(['product'])

<div class="bg-white shadow-sm border border-gray-300 rounded-md p-3">
    <div class="aspect-[3/4] overflow-hidden rounded-md">
        @if(!empty($product->images) && isset($product->images[0]))
            <img src='{{ \App\Helpers\ImageHelper::getUrl($product->images[0]) }}' 
                alt="{{ $product->name }}"
                class="w-full h-full object-cover object-top" />
        @endif
    </div>

    <div class="mt-4">
        <div class="mb-2 text-center">
            <x-admin.category-badge :category="$product->category" />
        </div>
        <h5 class="text-base font-sans text-brand-black text-center">{{ $product->name }}</h5>
        <h6 class="text-base text-brand-burgundy font-bold mt-1 text-center">LKR {{ number_format($product->price, 2, '.', ',') }}</h6>
    </div>

    <div class="flex items-center justify-center gap-2 mt-4">
        <a wire:navigate href="{{ route('admin.products.edit', $product->id) }}" title="Edit"
            class="bg-indigo-50 hover:bg-indigo-100 w-10 h-10 flex items-center justify-center rounded-md cursor-pointer transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </a>
        <a wire:navigate href="{{ route('admin.products.view', $product->id) }}" title="View"
            class="bg-amber-50 hover:bg-amber-100 w-10 h-10 flex items-center justify-center rounded-md cursor-pointer transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </a>
        <button wire:click="deleteProduct({{ $product->id }})" wire:confirm="Are you sure?" title="Delete"
            class="bg-rose-50 hover:bg-rose-100 w-10 h-10 flex items-center justify-center rounded-md cursor-pointer transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>
    </div>
</div>
