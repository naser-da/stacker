<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-[#e8eaed]">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('products.update', $product) }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Name')" class="dark:text-[#9aa0a6]"/>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" :value="old('name', $product->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" class="dark:text-[#9aa0a6]"/>
                            <x-textarea-input id="description" name="description" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" rows="3">{{ old('description', $product->description) }}</x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="image" :value="__('Product Image')" class="dark:text-[#9aa0a6]"/>
                            @if($product->image)
                                <div class="mt-2 mb-4">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-lg">
                                </div>
                            @endif
                            <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-gray-50 file:text-gray-700
                                hover:file:bg-gray-100" />
                            <p class="mt-1 text-sm text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div>
                            <x-input-label for="cost" :value="__('Cost')" class="dark:text-[#9aa0a6]"/>
                            <x-text-input id="cost" name="cost" type="number" step="0.01" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" :value="old('cost', $product->cost)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('cost')" />
                        </div>

                        <div>
                            <x-input-label for="profit" :value="__('Profit')" class="dark:text-[#9aa0a6]"/>
                            <x-text-input id="profit" name="profit" type="number" step="0.01" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" :value="old('profit', $product->profit)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('profit')" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Price')" class="dark:text-[#9aa0a6]"/>
                            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" :value="old('price', $product->price)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <div>
                            <x-input-label for="stock" :value="__('Stock')" class="dark:text-[#9aa0a6]"/>
                            <x-text-input id="stock" name="stock" type="number" min="0" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" :value="old('stock', $product->stock)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                        </div>

                        <div>
                            <x-input-label for="category_id" :value="__('Category')" class="dark:text-[#9aa0a6]"/>
                            <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 