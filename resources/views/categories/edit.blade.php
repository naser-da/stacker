<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-[#e8eaed] leading-tight">
                {{ __('Edit Category') }}
            </h2>
            <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-[#1a73e8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1557b0] dark:bg-[#8ab4f8] dark:hover:bg-[#aecbfa] dark:text-[#202124]">
                Back to Categories
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="p-6">
                    <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Name')" class="text-gray-700 dark:text-[#9aa0a6]" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-white text-gray-700 dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" :value="old('name', $category->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" class="text-gray-700 dark:text-[#9aa0a6]" />
                            <x-textarea-input id="description" name="description" class="mt-1 block w-full bg-white text-gray-700 dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" rows="3">{{ old('description', $category->description) }}</x-textarea-input>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="icon" :value="__('Icon (optional)')" class="text-gray-700 dark:text-[#9aa0a6]" />
                            <x-text-input id="icon" name="icon" type="text" class="mt-1 block w-full bg-white text-gray-700 dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" :value="old('icon', $category->icon)" />
                            <x-input-error class="mt-2" :messages="$errors->get('icon')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Category') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 