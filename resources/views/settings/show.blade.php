<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-[#e8eaed] leading-tight">
                {{ __('Company Settings') }}
            </h2>
            <a href="{{ route('settings.edit') }}" class="inline-flex items-center px-4 py-2 bg-[#1a73e8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1557b0] dark:bg-[#8ab4f8] dark:hover:bg-[#aecbfa] dark:text-[#202124]">
                Edit Settings
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

                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-[#e8eaed] mb-4">Company Information</h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Company Name</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">{{ $settings['name'] ?: 'Not set' }}</dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Phone</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">{{ $settings['phone'] ?: 'Not set' }}</dd>
                            </div>

                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Address</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">{{ $settings['address'] ?: 'Not set' }}</dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Logo</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">
                                    @if($settings['logo'])
                                        <img src="{{ $settings['logo'] }}" alt="Company Logo" class="h-20 w-20 object-cover rounded-lg">
                                    @else
                                        Not set
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-[#e8eaed] mb-4">Invoice Settings</h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Invoice Prefix</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">{{ $settings['invoice_prefix'] ?: 'Not set' }}</dd>
                            </div>

                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Invoice Notes</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">{{ $settings['invoice_notes'] ?: 'Not set' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 