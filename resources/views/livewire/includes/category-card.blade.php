<div class="relative p-3 mb-2 bg-white border border-gray-300 rounded-md shadow-sm">
    <div class="flex items-center gap-4 max-sm:flex-col max-sm:gap-0">
        <div class="overflow-hidden rounded-lg w-40 h-32 shrink-0 mx-auto sm:h-auto sm:aspect-[3/4]">
            <img src="{{ asset('storage/' . $category->image) }}" class="object-cover w-full h-full object-top border border-gray-200" />
        </div>
        <div class="w-full rounded-lg sm:border-l sm:pl-4 sm:border-gray-300">
            <div class="mt-2 mb-1">
                <h3 class="text-base font-semibold text-center text-[#1A1A1A]">{{ $category->name }}</h3>
            </div>
            
            <hr class="my-2 border-gray-200" />
            
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex justify-center w-full space-x-3">
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
            </div>
        </div>
    </div>
</div>
