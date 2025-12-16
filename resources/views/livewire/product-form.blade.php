<div class="m-10 p-5 mx-auto sm:w-full sm:max-w-sm shadow rounded-lg border-[#004D61] border-t-2">
    <div class="flex">
        <h2 class="font-semibold text-center text-2x text-[#1A1A1A] mb-5">Add New Product</h2>
    </div>
    @if(session('success'))
        <span class="text-emerald-500">{{ session('success') }}</span>
    @endif
    <form wire:submit="createProduct" action="" class="">

        <label class="mt-3 block text-sm font-medium leading-6 text-[#1A1A1A]">Name</label>
        <input wire:model="name" type="text" id="name" placeholder="Luxury Rich Wineberry Velvet Embellished Cape"
            class="mt-2 ring-1 ring-inset ring-[#004D61] bg-[#F0F0F0] text-[#1A1A1A] text-sm rounded-lg block w-full">
        @error('name')
            <span class="text-xs text-rose-500">{{ $message }}</span>
        @enderror
        <div class="mt-3 sm:col-span-2">
            <label for="description" class="block mb-2 text-sm font-medium text-[#1A1A1A]">Description</label>
            <textarea wire:model="description" id="description"
                placeholder="The luxurious velvet drapes beautifully, creating a flowing, graceful silhouette that enhances your movement. Each embellishment is thoughtfully placed, subtly elevating the piece to reflect the artistry behind its creation."
                rows="6"
                class="ring-1 ring-inset ring-[#004D61] bg-[#F0F0F0] text-[#1A1A1A] text-sm rounded-lg block w-full"></textarea>
            @error('description')
                <span class="text-xs text-rose-500"> {{ $message }}</span>
            @enderror
        </div>

        <div class="mt-3">
            <label for="category" class="mt-3 block text-sm font-medium leading-6 text-[#1A1A1A]">Category</label>
            <select
                class="mt-2 ring-1 ring-inset ring-[#004D61] bg-[#F0F0F0] text-[#1A1A1A] text-sm rounded-lg block w-full"
                aria-label="Select Category" id="category" wire:model="category_id">
                <option>-- Select Category --</option>
                {{-- @foreach --}}
                <option value=""></option>
                {{-- @endforeach --}}
            </select>
        </div>
        <label class="mt-3 block text-sm font-medium leading-6 text-[#1A1A1A]">Price</label>
        <input wire:model="price" type="number" id="price" placeholder="Rs. 69,600"
            class="mt-2 ring-1 ring-inset ring-[#004D61] bg-[#F0F0F0] text-[#1A1A1A] text-sm rounded-lg block w-full">
        @error('price')
            <span class="text-xs text-rose-500">{{ $message }}</span>
        @enderror
        <label class="mt-3 block text-sm font-medium leading-6 text-[#1A1A1A]">Images</label>
        <input multiple wire:model="images" accept="image/png, image/jpeg, image/webp, image/jpg" type="file" id="image"
            class="mt-2 ring-1 ring-inset ring-[#004D61] bg-[#F0F0F0] text-[#1A1A1A] text-sm rounded-lg block w-full">
        @error('images')
            <span class="text-xs text-rose-500">{{ $message }}</span>
        @enderror
        {{-- Image Preview --}}
        @if($images)
            @foreach($images as $image)
                <img class="block w-10 h-10 mt-5 rounded-lg" src="{{ $image->temporaryUrl() }}" alt="">
            @endforeach
        @endif
        {{-- <div wire:loading wire:target="images">
            <span class="text-emerald-500">Uploading ...</span>
        </div>
        <div wire:loading.delay>
            <span class="text-emerald-500">Sending ...</span>
        </div> --}}
        <button wire:loading.class="bg-[#004D61]" wire:loading.attr="disabled" type="submit"
            class="block px-4 py-2 mt-3 bg-[#3E5641] text-white font-semibold rounded-lg hover:bg-[#822659]">Add
            +</button>
    </form>
</div>
