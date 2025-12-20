<div class="p-5 pt-0 lg:p-5 lg:pt-5">
    <div class="flex items-center justify-between pt-16 mb-4 space-x-4 lg:pt-0">
        <h1 class="text-xl">All products</h1>
        <a wire:navigate href="{{ route('products.create') }}" type="button"
            class="flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300">
            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
            </svg>
            Add product
        </a>
    </div>
    {{-- Display session flash message --}}
    @if(session('success'))
        <div class="flex items-center w-full p-4 mb-4 font-semibold tracking-wide text-white rounded-md shadow-md bg-emerald-500 min-w-xs shadow-green-100"
            role="alert">
            <div class="mr-3 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5 fill-white" viewBox="0 0 512 512">
                    <ellipse cx="256" cy="256" fill="#fff" data-original="#fff" rx="256" ry="255.832" />
                    <path class="fill-green-600"
                        d="m235.472 392.08-121.04-94.296 34.416-44.168 74.328 57.904 122.672-177.016 46.032 31.888z"
                        data-original="#ffffff" />
                </svg>
            </div>
            <span class="text-[15px] mr-3">{{ session('success') }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 ml-auto cursor-pointer shrink-0 fill-white"
                viewBox="0 0 320.591 320.591">
                <path
                    d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                    data-original="#000000" />
                <path
                    d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                    data-original="#000000" />
            </svg>
        </div>
    @elseif(session('error'))
        <div class="flex items-center w-full p-4 mb-4 font-semibold tracking-wide text-white rounded-md shadow-md bg-rose-500 min-w-xs shadow-red-100"
            role="alert">
            <div class="mr-3 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5 fill-white" viewBox="0 0 32 32">
                    <path
                        d="M16 1a15 15 0 1 0 15 15A15 15 0 0 0 16 1zm6.36 20L21 22.36l-5-4.95-4.95 4.95L9.64 21l4.95-5-4.95-4.95 1.41-1.41L16 14.59l5-4.95 1.41 1.41-5 4.95z"
                        data-original="#ea2d3f" />
                </svg>
            </div>
            <span class="text-[15px] mr-3">{{ session('error') }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 ml-auto cursor-pointer shrink-0 fill-white"
                viewBox="0 0 320.591 320.591">
                <path
                    d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                    data-original="#000000" />
                <path
                    d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                    data-original="#000000" />
            </svg>
        </div>
    @endif
    @include('livewire.includes.search-box')
    <div class="hidden overflow-auto rounded-lg shadow md:block">
        <table class="w-full">
            <thead class="border-b-2 text-white border-[#822659] bg-[#3E5641]">
                <tr>
                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">Image</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Name<span class="cursor-pointer"
                            wire:click="sortBy('name')">
                            {{-- @if($sortColumn === 'name')
                                @if($sortOrder === 'asc') --}}
                                    <i class="fa-solid fa-sort-up"></i>
                                {{-- @else --}}
                                    <i class="fa-solid fa-sort-down"></i>
                                {{-- @endif --}}
                            {{-- @else --}}
                                <i class="fa-solid fa-sort"></i>
                            {{-- @endif --}}
                        </span></th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center"">Description<span
                            class="cursor-pointer" wire:click="sortBy('description')">
                            {{-- @if($sortColumn === 'description')
                                @if($sortOrder === 'asc') --}}
                                    <i class="fa-solid fa-sort-up"></i>
                                {{-- @else --}}
                                    <i class="fa-solid fa-sort-down"></i>
                                {{-- @endif --}}
                            {{-- @else --}}
                                <i class="fa-solid fa-sort"></i>
                            {{-- @endif --}}
                        </span></th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Category<span
                            class="cursor-pointer" wire:click="sortBy('category')">
                            {{-- @if($sortColumn === 'category')
                                @if($sortOrder === 'asc') --}}
                                    <i class="fa-solid fa-sort-up"></i>
                                {{-- @else --}}
                                    <i class="fa-solid fa-sort-down"></i>
                                {{-- @endif
                            @else --}}
                                <i class="fa-solid fa-sort"></i>
                            {{-- @endif --}}
                        </span></th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Price<span
                            class="cursor-pointer" wire:click="sortBy('price')">
                            {{-- @if($sortColumn === 'price')
                                @if($sortOrder === 'asc') --}}
                                    <i class="fa-solid fa-sort-up"></i>
                                {{-- @else --}}
                                    <i class="fa-solid fa-sort-down"></i>
                                {{-- @endif
                            @else --}}
                                <i class="fa-solid fa-sort"></i>
                            {{-- @endif --}}
                        </span></th>
                    <th class="w-24 p-3 text-sm font-semibold tracking-wide text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                {{-- @forelse($products as $product) --}}
                    @include('livewire.includes.product-row')
                {{-- @empty
                @endforelse --}}
            </tbody>
        </table>
    </div>
    {{-- @forelse($products as $product) --}}
        @include('livewire.includes.product-card')
    {{-- @empty
    @endforelse --}}
</div>
