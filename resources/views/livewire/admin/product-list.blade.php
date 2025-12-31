<div class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8">
    <x-admin.page-header title="All products">
        <x-slot:actions>
            <a wire:navigate href="{{ route('products.create') }}"
                class="flex items-center px-5 py-2.5 text-base font-semibold text-center text-white rounded-lg bg-brand-green hover:bg-opacity-90 transition-colors shadow-sm shadow-green-100">
                <svg class="h-4 w-4 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg>
                Add product
            </a>
        </x-slot:actions>
    </x-admin.page-header>
    @include('livewire.includes.admin-alerts')
    @include('livewire.includes.search-box')



    <div class="hidden md:block overflow-hidden brand-card">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white table-fixed">
                <thead class="brand-table-thead">
                    <tr>
                        <th class="brand-table-th w-1/5">
                            Image
                        </th>
                        <th class="brand-table-th w-1/5">
                            Name
                            @include('livewire.includes.table-sort-icon', ['field' => 'name'])
                        </th>
                        <th class="brand-table-th w-1/5">
                            Category
                            @include('livewire.includes.table-sort-icon', ['field' => 'category.name'])
                        </th>
                        <th class="brand-table-th w-1/5">
                            Price
                            @include('livewire.includes.table-sort-icon', ['field' => 'price'])
                        </th>
                        <th class="brand-table-th w-1/5">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 whitespace-nowrap">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-100 transition-colors">
                            <td class="p-4 text-center">
                                <div class="flex justify-center">
                                    @if(!empty($product->images) && isset($product->images[0]))
                                        <img class="w-12 h-auto aspect-[3/4] rounded-md object-cover object-top border border-gray-200" src="{{ asset('storage/' . $product->images[0]) }}">
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-2 text-base text-brand-black font-medium text-center whitespace-normal">
                                {{ $product->name }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                @php
                                    $categoryColors = [
                                        'bg-purple-50 text-purple-700 border-purple-100',
                                        'bg-blue-50 text-blue-700 border-blue-100',
                                        'bg-cyan-50 text-cyan-700 border-cyan-100',
                                        'bg-emerald-50 text-emerald-700 border-emerald-100',
                                        'bg-amber-50 text-amber-700 border-amber-100',
                                        'bg-indigo-50 text-indigo-700 border-indigo-100',
                                    ];
                                    $badgeColor = $categoryColors[$product->category->id % count($categoryColors)];
                                @endphp
                                <span class="px-2 py-1 text-xs font-bold uppercase tracking-wider rounded-md border {{ $badgeColor }}">
                                    {{ $product->category->name }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-base text-brand-black font-medium text-center">
                                LKR {{ number_format($product->price, 2) }}
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-center space-x-3">
                                    <a wire:navigate href="{{ route('products.edit', $product->id) }}" title="Edit"
                                        class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <a wire:navigate href="{{ route('products.view', $product->id) }}" title="Preview"
                                        class="p-2 text-amber-600 hover:bg-amber-50 rounded-md transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <button wire:click="deleteProduct({{ $product->id }})" wire:confirm="Are you sure?" title="Delete"
                                        class="p-2 text-rose-600 hover:bg-rose-50 rounded-md transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        @include('livewire.includes.admin-no-results', ['message' => 'No products found.', 'colspan' => 5])
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
            <div class="p-4 border-t border-gray-200 uppercase bg-gray-50 text-sm">
                {{ $products->links() }}
            </div>
        @endif
    </div>


    <div class="md:hidden grid grid-cols-2 gap-4">
        @forelse($products as $product)
            <x-admin.mobile-product-card :product="$product" />
        @empty
        @endforelse

        {{-- Pagination --}}
        <div class="mt-4 col-span-2">
            {{ $products->links() }}
        </div>

    </div>
</div>
