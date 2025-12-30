<div class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8">
    <div class="flex items-center justify-between pt-16 mb-4 space-x-4 lg:pt-0">
        <h1 class="text-2xl font-bold font-playfair uppercase text-[#004D61]">All categories</h1>
        <a wire:navigate href="{{ route('categories.create') }}"
            class="flex items-center px-5 py-2.5 text-base font-semibold text-center text-white rounded-lg bg-[#3E5641] hover:bg-[#2F4232] transition-colors shadow-sm shadow-green-100">
            <svg class="h-4 w-4 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
            </svg>
            Add category
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


    <div class="hidden md:block overflow-hidden border border-gray-300 rounded-md shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white table-fixed">
                <thead class="bg-[#004D61] whitespace-nowrap">
                    <tr>
                        <th class="p-4 text-center text-base font-semibold text-white w-1/3">
                            Image
                        </th>
                        <th class="p-4 text-center text-base font-semibold text-white w-1/3">
                            Name
                            <span class="ml-1 cursor-pointer" wire:click="sortBy('name')">
                                @if($sortColumn === 'name')
                                    @if($sortOrder === 'asc')
                                        <i class="fa-solid fa-sort-up"></i>
                                    @else
                                        <i class="fa-solid fa-sort-down"></i>
                                    @endif
                                @else
                                    <i class="fa-solid fa-sort opacity-50"></i>
                                @endif
                            </span>
                        </th>
                        <th class="p-4 text-center text-base font-semibold text-white w-1/3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 whitespace-nowrap">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-100 transition-colors">
                            <td class="p-4 text-center">
                                <div class="flex justify-center">
                                    <img class="w-12 h-auto aspect-[3/4] rounded-md object-cover object-top border border-gray-200" src="{{ asset('storage/' . $category->image) }}">
                                </div>
                            </td>
                            <td class="p-4 text-base text-[#1A1A1A] font-medium text-center">
                                {{ $category->name }}
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-center space-x-3">
                                    <a wire:navigate href="{{ route('categories.edit', $category->id) }}" title="Edit"
                                        class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <a wire:navigate href="{{ route('categories.view', $category->id) }}" title="Preview"
                                        class="p-2 text-amber-600 hover:bg-amber-50 rounded-md transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <button wire:click="deleteCategory({{ $category->id }})" wire:confirm="Are you sure?" title="Delete"
                                        class="p-2 text-rose-600 hover:bg-rose-50 rounded-md transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-gray-500 font-sans">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="md:hidden">
        @forelse($categories as $category)
            @include('livewire.includes.category-card')
        @empty
        @endforelse
    </div>
</div>
