<div class="brand-container pb-8 pt-24 lg:pt-8">
    <div class="brand-card p-6 sm:p-10">
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-2xl text-brand-teal brand-heading-playfair">
                {{ $isView ? 'View' : ($product ? 'Edit' : 'Create') }} Product
            </h2>
            <a wire:navigate href="{{ route('products') }}" class="px-5 py-2.5 text-base font-semibold text-white bg-brand-green rounded-lg hover:bg-opacity-90 transition-colors shadow-sm">
                Back
            </a>
        </div>

        <form wire:submit="saveProduct" class="grid sm:grid-cols-2 gap-4 text-brand-black">
            {{-- Name Input --}}
            <div>
                <label class="text-brand-black text-base font-medium mb-2 block">Name</label>
                <input {{ $isView ? 'disabled' : '' }} wire:model="name" type="text"
                    class="brand-form-input"
                    placeholder="Enter product name" />
                @include('livewire.includes.form-error', ['field' => 'name'])
            </div>

            {{-- Price Input --}}
            <div>
                <label class="text-brand-black text-base font-medium mb-2 block">Price</label>
                <input {{ $isView ? 'disabled' : '' }} wire:model="price" type="number"
                    class="brand-form-input"
                    placeholder="Enter price" />
                @include('livewire.includes.form-error', ['field' => 'price'])
            </div>

            {{-- Category Select --}}
            <div class="col-span-full">
                <label class="text-brand-black text-base font-medium mb-2 block">Category</label>
                <select {{ $isView ? 'disabled' : '' }} wire:model="category_id"
                    class="brand-form-input cursor-pointer">
                    <option hidden value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @include('livewire.includes.form-error', ['field' => 'category_id'])
            </div>

            {{-- Description --}}
            <div class="col-span-full">
                <label class="text-brand-black text-base font-medium mb-2 block">Description</label>
                <textarea {{ $isView ? 'disabled' : '' }} wire:model="description" rows="6"
                    class="brand-form-input pt-3"
                    placeholder="Enter product description"></textarea>
                @include('livewire.includes.form-error', ['field' => 'description'])
            </div>

            {{-- Existing Images --}}
            @if(!empty($existingImages))
                <div class="col-span-full">
                    <label class="text-brand-black text-base font-medium mb-2 block">Current Images</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($existingImages as $index => $image)
                            <div class="relative group">
                                <div class="aspect-[3/4] overflow-hidden rounded-md border border-gray-200">
                                    <img class="w-full h-full object-cover object-top" 
                                         src="{{ Storage::url($image) }}" alt="Product Image {{ $index + 1 }}">
                                </div>
                                @if(!$isView)
                                    <button type="button" wire:click="removeExistingImage({{ $index }})" class="absolute top-2 right-2 bg-brand-teal hover:bg-opacity-90 rounded-md p-1.5 transition-all">
                                        <svg wire:loading.remove wire:target="removeExistingImage({{ $index }})" xmlns="http://www.w3.org/2000/svg"
                                            class="w-3 cursor-pointer shrink-0 fill-white"
                                            viewBox="0 0 320.591 320.591">
                                            <path
                                                d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                                data-original="#000000"></path>
                                            <path
                                                d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                                data-original="#000000"></path>
                                        </svg>
                                        <span wire:loading wire:target="removeExistingImage({{ $index }})" class="text-xs font-sans text-white absolute top-2 right-2 bg-brand-teal rounded-md px-2 py-1">Removing...</span>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Upload Images --}}
            @if(!$isView)
                <div class="col-span-full">
                    <label class="text-brand-black text-base font-medium mb-2 block">Upload Images</label>
                    <input wire:model="images" type="file" multiple
                        class="brand-form-input file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-brand-green file:text-white hover:file:bg-opacity-90" />
                    <p class="mt-2 text-xs text-gray-500">JPG, JPEG, PNG, SVG, and WEBP supported.</p>

                    @if(!empty($images))
                        @php
                            $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'webp'];
                            $hasInvalidFiles = false;
                            foreach($images as $img) {
                                $ext = strtolower($img->getClientOriginalExtension());
                                if (!in_array($ext, $allowedExtensions)) {
                                    $hasInvalidFiles = true;
                                    break;
                                }
                            }
                        @endphp
                        
                        @if($hasInvalidFiles)
                            <div class="mt-4">
                                <p class="text-base font-medium text-brand-burgundy">Invalid file type. Please upload JPG, JPEG, PNG, SVG, or WEBP images only.</p>
                            </div>
                        @else
                            <div class="mt-4">
                                <p class="text-base font-medium text-brand-black mb-3">Image Preview</p>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach($images as $image)
                                        <div class="aspect-[3/4] overflow-hidden rounded-md border border-gray-200">
                                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover object-top">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif

                    @include('livewire.includes.form-error', ['field' => 'images'])
                    
                    @error('images.*')
                        <p class="mt-2 text-base font-medium text-brand-burgundy">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            @if(!$isView)
                <div class="col-span-full mt-4">
                        <button type="submit"
                        class="text-white bg-brand-green hover:bg-opacity-90 text-base rounded-md font-medium px-4 py-2.5 cursor-pointer w-full shadow-md hover:shadow-lg transition-all flex items-center justify-center">
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
