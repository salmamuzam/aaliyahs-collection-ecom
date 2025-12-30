<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="bg-white border border-gray-300 rounded-md shadow-sm p-6 sm:p-10">
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-2xl text-[#004D61] font-bold font-playfair uppercase">
                {{ $isView ? 'View' : ($product ? 'Edit' : 'Create') }} Product
            </h2>
            <a wire:navigate href="{{ route('products') }}" class="px-5 py-2.5 text-base font-semibold text-white bg-[#3E5641] rounded-lg hover:bg-[#2F4232] transition-colors shadow-sm">
                Back
            </a>
        </div>

        <form wire:submit="saveProduct" class="grid sm:grid-cols-2 gap-4 text-[#1A1A1A]">
            {{-- Name Input --}}
            <div>
                <label class="text-[#1A1A1A] text-base font-medium mb-2 block">Name</label>
                <input {{ $isView ? 'disabled' : '' }} wire:model="name" type="text"
                    class="w-full bg-white py-2.5 px-4 text-base rounded-md border border-gray-300 focus:border-[#3E5641] focus:ring-1 focus:ring-[#3E5641] outline-none transition-all placeholder-gray-400"
                    placeholder="Enter product name" />
                @error('name')
                    <p class="mt-2 text-base font-medium text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Price Input --}}
            <div>
                <label class="text-[#1A1A1A] text-base font-medium mb-2 block">Price</label>
                <input {{ $isView ? 'disabled' : '' }} wire:model="price" type="number"
                    class="w-full bg-white py-2.5 px-4 text-base rounded-md border border-gray-300 focus:border-[#3E5641] focus:ring-1 focus:ring-[#3E5641] outline-none transition-all placeholder-gray-400"
                    placeholder="Enter price" />
                @error('price')
                    <p class="mt-2 text-base font-medium text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category Select --}}
            <div class="col-span-full">
                <label class="text-[#1A1A1A] text-base font-medium mb-2 block">Category</label>
                <select {{ $isView ? 'disabled' : '' }} wire:model="category_id"
                    class="w-full bg-white py-2.5 px-4 text-base rounded-md border border-gray-300 focus:border-[#3E5641] focus:ring-1 focus:ring-[#3E5641] outline-none transition-all cursor-pointer">
                    <option hidden value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 text-base font-medium text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="col-span-full">
                <label class="text-[#1A1A1A] text-base font-medium mb-2 block">Description</label>
                <textarea {{ $isView ? 'disabled' : '' }} wire:model="description" rows="6"
                    class="w-full bg-white px-4 text-base rounded-md pt-3 border border-gray-300 focus:border-[#3E5641] focus:ring-1 focus:ring-[#3E5641] outline-none transition-all placeholder-gray-400"
                    placeholder="Enter product description"></textarea>
                @error('description')
                    <p class="mt-2 text-base font-medium text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Existing Image --}}
            @if($product && $product->image)
                <div class="col-span-full">
                    <label class="text-[#1A1A1A] text-base font-medium mb-2 block">Current Image</label>
                    <img class="h-40 object-cover rounded-md shadow-sm border border-gray-200" src="{{ Storage::url($product->image) }}" alt="Product Image">
                </div>
            @endif

            {{-- Upload Image --}}
            @if(!$isView)
                <div class="col-span-full">
                    <label class="text-[#1A1A1A] text-base font-medium mb-2 block">Upload Image</label>
                    <input wire:model="image" type="file"
                        class="w-full bg-white py-2.5 px-4 text-base rounded-md border border-gray-300 focus:border-[#3E5641] focus:ring-1 focus:ring-[#3E5641] outline-none transition-all file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#3E5641] file:text-white hover:file:bg-[#2c3e2f]" />
                    <p class="mt-2 text-xs text-gray-500">JPG, JPEG, PNG, SVG, and WEBP supported.</p>

                    @if($image)
                        <div class="mt-4">
                            <p class="text-base font-medium text-[#1A1A1A] mb-2">New Preview:</p>
                            <img src="{{ $image->temporaryUrl() }}" class="h-40 object-cover rounded-md shadow-sm">
                        </div>
                    @endif

                    @error('image')
                        <p class="mt-2 text-base font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            @if(!$isView)
                <div class="col-span-full mt-4">
                        <button type="submit"
                        class="text-white bg-[#3E5641] hover:bg-[#2c3e2f] text-base rounded-md font-medium px-4 py-2.5 cursor-pointer w-full shadow-md hover:shadow-lg transition-all flex items-center justify-center">
                        @if($product)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        @endif
                        {{ $product ? 'Update Product' : 'Create Product' }}
                    </button>
                </div>
            @endif
        </form>
    </div>
</div>
