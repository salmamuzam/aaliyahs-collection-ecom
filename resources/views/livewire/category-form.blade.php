<div class="pt-16 m-4 lg:pt-0">
    <div class="w-full rounded-lg bg-gradient-to-r from-[#004D61] to-[#822659] h-36"></div>
    <div class="px-4 mb-6 -mt-20">
        <div class="relative max-w-6xl p-8 mx-auto bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between space-x-4">
                <h2 class="text-xl font-semibold text-slate-900">{{ $isView ? 'View' : ($category ? 'Edit' : 'Add')}}
                    category</h2>
                <a wire:navigate href="{{ route('categories') }}" type='button'
                    class="text-white font-medium w-max bg-[#004D61] hover:bg-[#3E5641] rounded-lg text-[15px] px-4 py-2.5 !mt-4 tracking-wide cursor-pointer">
                    Back
                </a>
            </div>
            <form wire:submit="saveCategory" class="grid gap-5 mt-8">
                <div>
                    <label class='block mb-2 text-sm font-medium text-[#1A1A1A]'>Name</label>
                    <input {{ $isView ? 'disabled' : 'enabled'}} wire:model="name" type='text' placeholder='Abaya'
                        class="w-full rounded-lg py-2.5 px-4 border border-slate-300 focus:border-[#822659] text-sm outline-none" />
                    {{-- Capture Error Messages --}}
                    @error('name')
                        <p class="mt-2 text-sm font-medium text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                {{-- view image --}}
                @if($category)
                    <div class="my-2">
                        <label class="block mb-2 text-sm font-medium text-[#1A1A1A]">Uploaded image</label>
                        <img class="h-auto rounded-lg shadow-lg w-200" src="{{ Storage::url($category->image) }}">
                    </div>
                @endif
                @if(!$isView)
                    <div>

                        <label class="block mb-2 text-sm font-medium text-[#1A1A1A]">Upload image</label>

                        <input wire:model="image" type="file"
                            class="w-full text-sm font-medium bg-white  border  border-slate-300  rounded-lg cursor-pointer text-slate-500 file:cursor-pointer file:border-0 file:py-2.5 file:px-4 file:mr-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-slate-500" />
                        <p class="mt-2 text-xs text-slate-500">JPG, JPEG, PNG, SVG, and WEBP are allowed.</p>
                        {{-- Preview Image --}}
                        @if($image)
                            <div class="my-2">
                                <img src="{{ $image->temporaryUrl() }}" class="h-auto rounded-lg shadow-lg w-200">
                            </div>
                        @endif
                        {{-- Capture Error Messages --}}
                        @error('image')
                            <p class="mt-2 text-sm font-medium text-rose-600"">{{ $message }}</p>
                        @enderror
                            </div>
                @endif
                  @if(!$isView)
                    <button type=" submit"
                        class="text-white font-medium w-max bg-[#3E5641] hover:bg-[#004D61] rounded-lg text-[15px] px-4 py-2.5 !mt-4 tracking-wide cursor-pointer">
                        {{ $category ? 'Update' : 'Save' }}
                        </button>
                @endif
            </form>
        </div>
    </div>
</div>
