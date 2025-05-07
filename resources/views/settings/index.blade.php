<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @foreach($settings as $group => $groupSettings)
                            <div class="mb-8">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ ucfirst($group) }} Settings</h3>
                                <div class="space-y-4">
                                    @foreach($groupSettings as $setting)
                                        <div>
                                            <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700">
                                                {{ $setting->label }}
                                            </label>
                                            @if($setting->description)
                                                <p class="text-sm text-gray-500">{{ $setting->description }}</p>
                                            @endif

                                            @switch($setting->type)
                                                @case('textarea')
                                                    <textarea
                                                        name="{{ $setting->key }}"
                                                        id="{{ $setting->key }}"
                                                        rows="3"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                    >{{ old($setting->key, $setting->value) }}</textarea>
                                                    @break

                                                @case('file')
                                                    @if($setting->value)
                                                        <div class="mt-2">
                                                            <img src="{{ $setting->value }}" alt="{{ $setting->label }}" class="h-20 w-20 object-cover rounded-lg">
                                                        </div>
                                                    @endif
                                                    <input
                                                        type="file"
                                                        name="{{ $setting->key }}"
                                                        id="{{ $setting->key }}"
                                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                                    >
                                                    @break

                                                @default
                                                    <input
                                                        type="text"
                                                        name="{{ $setting->key }}"
                                                        id="{{ $setting->key }}"
                                                        value="{{ old($setting->key, $setting->value) }}"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                    >
                                            @endswitch

                                            @error($setting->key)
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <div class="flex justify-end">
                            <x-primary-button>
                                {{ __('Save Settings') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 