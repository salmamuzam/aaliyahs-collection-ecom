<div class="h-screen p-5">
    <div class="flex items-center justify-between flex-1 mb-2 space-x-2">
        <h1 class="text-xl">All Categories</h1>
        <button type="submit" wire:navigate href="{{ route('categories.create') }}"
            class="block px-4 py-2  mt-3 bg-[#3E5641] text-white font-semibold rounded-lg hover:bg-[#822659]">Create
            Category </button>
    </div>
    <div class="mb-2 w-full flex overflow-hidden border-2 rounded-lg border-[#004D61]">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search for Categories ..."
            class="w-full px-4 py-3 text-sm text-[#1A1A1A] bg-[#F0F0F0] outline-none" />
        <button type='button' class="flex items-center justify-center bg-[#004D61] px-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-[#F0F0F0]">
                <path
                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                </path>
            </svg>
        </button>
    </div>
    <div>
        @if(session('success'))
       <div class="w-full px-4 py-3 m-4 bg-teal-100 border-t-4 rounded-b shadow-md border-emerald-500 text-emerald-900" role="alert">
  <div class="flex">
    <div class="py-1"><svg class="w-6 h-6 mr-4 fill-current text-emerald-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
    <div>
      <p class="font-bold">Success!</p>
      <p class="text-sm">{{ session("success") }}</p>
    </div>
  </div>
</div>
@endif
    </div>
    <div class="hidden overflow-auto rounded-lg shadow md:block">
        <table class="w-full">
            <thead class="border-b-2 border-[#822659] bg-[#004D61] text-white">
                <tr>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">
                        Image
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">
                        Name
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#1A1A1A]">
                @foreach($categories as $category)
                    <tr class="bg-[#F0F0F0]">
                        <td class="p-3 text-sm text-[#1A1A1A]"><img class="w-auto h-24 mx-auto rounded-lg"
                                src="{{ Storage::url($category['image']) }}"></td>
                        <td class="p-3 text-sm text-[#1A1A1A] text-center">{{ $category->name }}</td>
                        <td class="p-3 text-sm text-[#1A1A1A] text-center">
                            <div class="flex items-center justify-center space-x-2">
                                 <button wire:click="editCategory({{ $category->id }})" wire:navigate href="{{ route('categories.edit', $category->id) }}" class="mr-1 text-sm font-semibold rounded text-emerald-500 hover:text-amber-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button wire:click="deleteCategory({{ $category->id }})" class="mr-1 text-sm font-semibold rounded text-rose-500 hover:text-emerald-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="grid grid-cols-1 gap-4 md:hidden">
        <div class="bg-[#F0F0F0] p-4 rounded-lg shadow">

        </div>
    </div>
</div>
