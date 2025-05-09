<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-[#e8eaed] leading-tight">
                {{ __('Edit Company Settings') }}
            </h2>
            <a href="{{ route('settings.show') }}" class="inline-flex items-center px-4 py-2 bg-[#1a73e8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1557b0] dark:bg-[#8ab4f8] dark:hover:bg-[#aecbfa] dark:text-[#202124]">
                Back to Settings
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 dark:bg-green-900/50 dark:border-green-500 dark:text-green-400 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-[#e8eaed] mb-4">Company Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-[#9aa0a6]">Company Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $settings['name'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-[#2d2e31] dark:border-[#3c4043] dark:text-[#e8eaed]">
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-[#9aa0a6]">Phone</label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-[#2d2e31] dark:border-[#3c4043] dark:text-[#e8eaed]">
                                </div>

                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-[#9aa0a6]">Address</label>
                                    <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-[#2d2e31] dark:border-[#3c4043] dark:text-[#e8eaed]">{{ old('address', $settings['address'] ?? '') }}</textarea>
                                </div>

                                <div>
                                    <label for="logo" class="block text-sm font-medium text-gray-700 dark:text-[#9aa0a6]">Company Logo</label>
                                    @if(!empty($settings['logo']))
                                        <div class="mt-2">
                                            <img src="{{ $settings['logo'] }}" alt="Company Logo" class="h-20 w-20 object-cover rounded-lg">
                                        </div>
                                    @endif
                                    <input type="file" name="logo" id="logo" class="mt-1 block w-full text-sm text-gray-500 dark:text-[#9aa0a6] file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-[#2d2e31] dark:file:text-[#e8eaed]">
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-[#e8eaed] mb-4">Invoice Settings</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="invoice_prefix" class="block text-sm font-medium text-gray-700 dark:text-[#9aa0a6]">Invoice Prefix</label>
                                    <input type="text" name="invoice_prefix" id="invoice_prefix" value="{{ old('invoice_prefix', $settings['invoice_prefix'] ?? 'INV-') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-[#2d2e31] dark:border-[#3c4043] dark:text-[#e8eaed]">
                                </div>

                                <div>
                                    <label for="invoice_notes" class="block text-sm font-medium text-gray-700 dark:text-[#9aa0a6]">Invoice Notes</label>
                                    <textarea name="invoice_notes" id="invoice_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-[#2d2e31] dark:border-[#3c4043] dark:text-[#e8eaed]">{{ old('invoice_notes', $settings['invoice_notes'] ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

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