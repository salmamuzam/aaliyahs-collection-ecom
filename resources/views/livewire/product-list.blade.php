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

    <form class="flex items-center mb-4">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-black" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <input wire:model.live.debounce.300ms="search" type="text" id="simple-search"
                class="block w-full p-2 pl-10 text-sm text-[#1A1A1A] border border-gray-300 rounded-lg bg-white focus:ring-[#822659]-500 focus:border-[#822659]"
                placeholder="Search ..." required="">
        </div>
    </form>

    <div class="hidden overflow-auto rounded-lg shadow md:block ">
        <table class="w-full ">
            <thead class="border-b-2 text-white border-[#822659] bg-[#3E5641]">
                <tr>
                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-center">Image</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Name</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Description</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Category</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Price</th>
                    <th class="w-24 p-3 text-sm font-semibold tracking-wide text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-black-100">
                @forelse($products as $product)
                    <tr class="bg-white">
                        <td class="p-3 text-sm text-center text-gray-700 whitespace-nowrap">
                            <img class="h-auto rounded-lg w-100" src="{{ asset('storage/' . $product->image) }}">
                        </td>
                        <td class="p-3 text-sm text-center text-gray-700 whitespace-nowrap">
                            {{ Str::limit($product->name, 30) }}
                        </td>
                        <td class="p-3 text-sm text-center text-gray-700 whitespace-nowrap">
                            {{ Str::limit($product->description, 50) }}
                        </td>
                        <td class="p-3 text-sm text-center text-gray-700 whitespace-nowrap">
                            {{ $product->category->name}}
                        </td>
                        <td class="p-3 text-sm text-center text-gray-700 whitespace-nowrap">
                            {{ $product->price}}
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                            <div class="flex items-center space-x-4">
                                <a wire:navigate href="" type="button"
                                    class="flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd"
                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Edit
                                </a>
                                <a wire:navigate href="" type="button"
                                    class="flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-amber-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"
                                        class="w-4 h-4 mr-2 -ml-0.5">
                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                    </svg>
                                    Preview
                                </a>
                                <button type="button"
                                    class="flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-rose-700 hover:bg-rose-800 focus:ring-4 focus:outline-none focus:ring-rose-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>

        </table>
<div class="px-4 mt-2 mb-2">
            {{-- Pagination --}}
            {{ $products->links() }}
        </div>
    </div>


    <div class="md:hidden">
        @forelse($products as $product)
            <div class="relative p-6 mb-2 bg-white border border-gray-300 rounded-md shadow-sm md:hidden">
                <div class="flex items-center gap-4 max-sm:flex-col max-sm:gap-6">
                    <div class="overflow-hidden rounded-lg w-52 h-52 shrink-0">
                        <img src='{{ asset('storage/' . $product->image) }}' class="object-cover w-full h-auto" />
                    </div>
                    <div class="w-full rounded-lg sm:border-l sm:pl-4 sm:border-gray-300">
                        <div class="text-center">
                            <h2
                                class="text-pink-600 text-sm font-medium bg-pink-50 px-3 py-1.5 inline-block tracking-wide rounded-lg">
                                {{ $product->category->name }}</h2>
                        </div>
                        <h3 class="mt-4 font-semibold text-left  text-slate-900">{{ $product->name }}</h3>
                        <ul class="space-y-2 text-sm font-medium  text-slate-500">
                            <li class="pt-4 text-rose-600">Rs. {{ $product->price }}</li>
                            <li class="pt-2 text-justify">{{ $product->description }}</li>
                        </ul>
                        <hr class="my-6 border-gray-300" />
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex justify-center w-full gap-4">
                                <a wire:navigate href="" type="button"
                                    class="flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                        <path fill-rule="evenodd"
                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Edit
                                </a>
                                <a wire:navigate href="" type="button"
                                    class="flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-amber-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"
                                        class="w-4 h-4 mr-2 -ml-0.5">
                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                    </svg>
                                    Preview
                                </a>
                                <button type="button"
                                    class="flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-rose-700 hover:bg-rose-800 focus:ring-4 focus:outline-none focus:ring-rose-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse

        {{-- Pagination --}}
        {{ $products->links() }}

    </div>
</div>
