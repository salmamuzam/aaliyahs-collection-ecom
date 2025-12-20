<div class="relative p-6 mb-2 bg-white border border-gray-300 rounded-md shadow-sm md:hidden">
    <div class="flex items-center gap-4 max-sm:flex-col max-sm:gap-6">
        <div class="overflow-hidden rounded-lg w-52 h-52 shrink-0">
            <img src='{{ asset('storage/' . $product->image) }}' class="object-cover w-full h-auto" />
        </div>
        <div class="w-full rounded-lg sm:border-l sm:pl-4 sm:border-gray-300">
            <div class="text-center">
                <h2
                    class="text-pink-600 text-sm font-medium bg-pink-50 px-3 py-1.5 inline-block tracking-wide rounded-lg">
                    {{ $product->category->name }}
                </h2>
            </div>
            <h3 class="mt-4 font-semibold text-left text-slate-900">{{ $product->name }}</h3>
            <ul class="space-y-2 text-sm font-medium text-slate-500">
                <li class="pt-4 text-rose-600">Rs. {{ $product->price }}</li>
                <li class="pt-2 text-justify">{{ $product->description }}</li>
            </ul>
            <hr class="my-6 border-gray-300" />
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex justify-center w-full gap-4">
                    <a wire:navigate href="" type="button" data-drawer-target="drawer-update-product"
                        data-drawer-show="drawer-update-product" aria-controls="drawer-update-product"
                        class="flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path fill-rule="evenodd"
                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                clip-rule="evenodd" />
                        </svg>
                        Edit
                    </a>
                    <a wire:navigate href="" type="button" data-drawer-target="drawer-read-product-advanced"
                        data-drawer-show="drawer-read-product-advanced" aria-controls="drawer-read-product-advanced"
                        class="flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-amber-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor"
                            class="w-4 h-4 mr-2 -ml-0.5">
                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                        </svg>
                        Preview
                    </a>
                    <button type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal"
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
</div>
