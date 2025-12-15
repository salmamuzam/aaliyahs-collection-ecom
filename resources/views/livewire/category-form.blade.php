<div class="mt-10 p-5 mx-auto sm:w-full sm:max-w-sm shadow border-[#004D61] border-t-2">
    <div class="flex">
        <h2 class="font-semibold text-center text-2x text-[#1A1A1A] mb-5">Create New Category</h2>
    </div>
    @if(session('success'))
        <span class="text-emerald-500">{{ session('success') }}</span>
    @endif
    <form wire:submit="createCategory" action="" class="">
        <label class="mt-3 block text-sm font-medium leading-6 text-[#1A1A1A]">Name</label>
        <input wire:model="name" type="text" id="name" placeholder="Abaya"
            class="ring-1 ring-inset ring-[#004D61] bg-[#F0F0F0] text-[#1A1A1A] text-sm rounded-lg block w-full">
        @error('name')
            <span class="text-xs text-rose-500">{{ $message }}</span>
        @enderror
        <label class="mt-3 block text-sm font-medium leading-6 text-[#1A1A1A]">Image</label>
        <input wire:model="image" accept="image/png, image/jpeg, image/webp, image/jpg" type="file" id="image"
            class="ring-1 ring-inset ring-[#004D61] bg-[#F0F0F0] text-[#1A1A1A] text-sm rounded-lg block w-full">
        @error('image')
            <span class="text-xs text-rose-500">{{ $message }}</span>
        @enderror
        {{-- Image Preview --}}
        @if($image)
            <img class="block w-10 h-10 mt-5 rounded-lg" src="{{ $image->temporaryUrl() }}" alt="">
        @endif
        <div wire:loading wire:target="image">
            <span class="text-emerald-500">Uploading ...</span>
        </div>
        <button type="submit"
            class="block px-4 py-2 mt-3 bg-[#3E5641] text-white font-semibold rounded-lg hover:bg-[#822659]">Create
            +</button>
    </form>
</div>
