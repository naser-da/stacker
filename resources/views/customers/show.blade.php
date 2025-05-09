<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-[#e8eaed]">
                {{ $customer->name }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Edit
                </a>
                <button type="button" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500" x-data x-on:click="$dispatch('open-modal', 'delete-customer-modal')">
                    Delete
                </button>
            </div>
        </div>
    </x-slot>

    <x-delete-modal id="delete-customer-modal" title="Delete Customer" message="Are you sure you want to delete this customer? This action cannot be undone.">
        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                Delete
            </button>
        </form>
    </x-delete-modal>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#2d2e31] overflow-hidden shadow-sm sm:rounded-lg card">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4 dark:text-[#9aa0a6]">Customer Information</h3>
                            <dl class="space-y-4 dark:text-[#e8eaed]">
                                @if($customer->phone)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Phone</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">{{ $customer->phone }}</dd>
                                </div>
                                @endif
                                @if($customer->address)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Address</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">{{ $customer->address }}</dd>
                                </div>
                                @endif
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Total Purchases</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">{{ $customer->sales_count }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Total Spent</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">${{ number_format($customer->getTotalPurchaseValue(), 2) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Last Purchase</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">{{ $customer->getLastPurchaseDate() ? $customer->getLastPurchaseDate()->format('M d, Y') : 'No purchases yet' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 dark:text-[#9aa0a6]">Purchase History</h3>
                        @if($customer->sales->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50 dark:bg-[#2d2e31]">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-[#9aa0a6] uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($customer->sales as $sale)
                                            <tr class="dark:bg-[#2d2e31]">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-[#e8eaed]">
                                                    {{ $sale->created_at->format('M d, Y') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-[#e8eaed]">
                                                    {{ $sale->items->count() }} items
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-[#e8eaed]">
                                                    ${{ number_format($sale->total_amount, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-[#e8eaed]">
                                                    <a href="{{ route('sales.show', $sale) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-[#e8eaed]">View Details</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">No purchase history available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 