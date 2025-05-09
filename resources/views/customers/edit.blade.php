<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-[#e8eaed]">
                {{ __('Edit Customer') }}
            </h2>
            <a href="{{ route('customers.show', $customer) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Back to Customer
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#2d2e31] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-[#e8eaed]">
                    <form method="POST" action="{{ route('customers.update', $customer) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Name')" class="dark:text-[#9aa0a6]" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" :value="old('name', $customer->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="phone" :value="__('Phone')" class="dark:text-[#9aa0a6]" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" :value="old('phone', $customer->phone)" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div>
                            <x-input-label for="address" :value="__('Address')" class="dark:text-[#9aa0a6]" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" :value="old('address', $customer->address)" />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 