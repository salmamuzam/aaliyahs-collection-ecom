<div class="hidden md:block overflow-hidden brand-card">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white table-fixed">
            <thead class="brand-table-thead">
                <tr>
                    <th class="brand-table-th w-1/3">
                        Image
                    </th>
                    <th class="brand-table-th w-1/3">
                        Name
                        @include('livewire.admin.partials.table-sort-icon', ['field' => 'name'])
                    </th>
                    <th class="brand-table-th w-1/3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 whitespace-nowrap">
                @forelse($categories as $category)
                    <tr class="hover:bg-gray-100 transition-colors">
                        <td class="p-4 text-center">
                            <div class="flex justify-center">
                                @if(!empty($category->image))
                                    <img class="w-12 h-auto aspect-[3/4] rounded-md object-cover object-top border border-gray-200" src="{{ \App\Helpers\ImageHelper::getUrl($category->image) }}">
                                @endif
                            </div>
                        </td>
                        <td class="p-4 text-base text-brand-black font-medium text-center">
                            {{ $category->name }}
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center space-x-3">
                                <a wire:navigate href="{{ route('admin.categories.edit', $category->id) }}" title="Edit"
                                    class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-md transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <a wire:navigate href="{{ route('admin.categories.view', $category->id) }}" title="Preview"
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
                    @include('livewire.admin.partials.no-results', ['message' => 'No categories found.', 'colspan' => 3])
                @endforelse
            </tbody>
        </table>
    </div>
</div>
