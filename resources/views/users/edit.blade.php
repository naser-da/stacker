<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-[#e8eaed] leading-tight">
                {{ __('Edit User') }}
            </h2>
            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-[#1a73e8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1557b0] dark:bg-[#8ab4f8] dark:hover:bg-[#aecbfa] dark:text-[#202124]">
                Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="p-6">
                    <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Name')" class="dark:text-[#9aa0a6]" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" class="dark:text-[#9aa0a6]" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('New Password (leave blank to keep current)')" class="dark:text-[#9aa0a6]" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" autocomplete="new-password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="dark:text-[#9aa0a6]" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full dark:text-[#e8eaed] dark:bg-[#2d2e31] dark:border-[#3c4043]" autocomplete="new-password" />
                            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update User') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 