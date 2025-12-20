<div class="pt-16 m-4 lg:pt-0">
    <div class="w-full rounded-lg bg-gradient-to-r from-[#004D61] to-[#822659] h-36"></div>
    <div class="px-4 mb-6 -mt-20">
        <div class="relative max-w-6xl p-8 mx-auto bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between space-x-4">
                <h2 class="text-xl font-semibold text-slate-900">
                    product</h2>
                <a wire:navigate href="{{ route('products') }}" type='button'
                    class="text-white font-medium w-max bg-[#004D61] hover:bg-[#3E5641] rounded-lg text-[15px] px-4 py-2.5 !mt-4 tracking-wide cursor-pointer">
                    Back
                </a>
            </div>
            <form wire:submit="saveProduct" class="grid gap-5 mt-8">
                <div>
                    <label class='block mb-2 text-sm font-medium text-[#1A1A1A]'>Name</label>
                    <input  wire:model="name" type='text' placeholder='
Rose glow Abaya'
                        class="w-full rounded-lg py-2.5 px-4 border border-slate-300 focus:border-[#822659] text-sm outline-none" />
                    {{-- Capture Error Messages --}}
                    @error('name')
                        <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-full">
                    <label class="block mb-2 text-sm font-medium text-slate-800">Description</label>
                    <textarea wire:model="description" placeholder='Softly radiant and feminine — Rosé Glow features delicate hand-beaded detailing on the sleeves on overcoat with matching inner and shawl, crafted on a fluid peach-toned fabric that catches light effortlessly. A timeless choice for refined occasions.' rows="6"
                        class="w-full rounded-lg py-2.5 px-4 border border-slate-300 focus:border-[#822659] text-sm outline-none"></textarea>
                </div>
                <div class="relative w-full">
                     <label for="countries" class="block mb-2 text-sm font-medium text-slate-800">Category</label>
  <select wire:model="category_id" id="categories" class="w-full rounded-lg py-2.5 px-4 border border-slate-300 focus:border-[#822659] text-sm outline-none">
    <option hidden selected>Select a category</option>
    @foreach($categories as $category)
    <option value="{{ $category->id }}">{{ $_ENVcategory->name }}</option>
@endforeach
  </select>
                </div>
                <div>
                    <label class='block mb-2 text-sm font-medium text-[#1A1A1A]'>Price</label>
                    <input  wire:model="price" type='number' placeholder='Rs 26,500.00'
                        class="w-full rounded-lg py-2.5 px-4 border border-slate-300 focus:border-[#822659] text-sm outline-none" />
                    {{-- Capture Error Messages --}}
                    @error('price')
                        {{-- <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p> --}}
                    @enderror
                </div>
                {{-- view image --}}
                {{-- @if($product) --}}
                    <div class="my-2">
                        <label class="block mb-2 text-sm font-medium text-[#1A1A1A]">Uploaded image</label>
                        {{-- <img class="h-auto rounded-lg shadow-lg w-200" src="{{ Storage::url($product->image) }}"> --}}
                    </div>
                {{-- @endif --}}
                {{-- @if(!$isView) --}}
                    <div>

                        <label class="block mb-2 text-sm font-medium text-[#1A1A1A]">Upload image</label>

                        <input wire:model="image" type="file"
                            class="w-full text-sm font-medium bg-white  border  border-slate-300  rounded-lg cursor-pointer text-slate-500 file:cursor-pointer file:border-0 file:py-2.5 file:px-4 file:mr-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-slate-500" />
                        <p class="mt-2 text-xs text-slate-500">JPG, JPEG, PNG, SVG, and WEBP are allowed.</p>
                        {{-- Preview Image --}}
                        {{-- @if($image) --}}
                            <div class="my-2">
                                {{-- <img src="{{ $image->temporaryUrl() }}" class="h-auto rounded-lg shadow-lg w-200"> --}}
                            </div>
                        {{-- @endif --}}
                        {{-- Capture Error Messages --}}
                        {{-- @error('image') --}}
                            {{-- <p class="mt-2 text-sm font-medium text-rose-600"">{{ $message }}</p> --}}
                        {{-- @enderror --}}
                                </div>
                {{-- @endif --}}
                  {{-- @if(!$isView) --}}
                    <button type=" submit"
                        class="text-white font-medium w-max bg-[#3E5641] hover:bg-[#004D61] rounded-lg text-[15px] px-4 py-2.5 !mt-4 tracking-wide cursor-pointer"> Save
                        {{-- {{ $product ? 'Update' : 'Save' }} --}}
                        </button>
                {{-- @endif --}}
            </form>
        </div>
    </div>
</div>
