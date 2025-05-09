<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-[#e8eaed]">
                {{ __('Product Details') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700">
                    {{ __('Edit Product') }}
                </a>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                    {{ __('Back to Products') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#2d2e31] overflow-hidden shadow-sm sm:rounded-lg card">
                <div class="p-6 text-gray-900 dark:text-[#e8eaed]">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-[#e8eaed] mb-4">Product Information</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">{{ $product->name }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Category</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">{{ $product->category->name }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Description</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">{{ $product->description ?: 'No description available' }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-[#e8eaed] mb-4">Financial Information</h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Cost</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">${{ number_format($product->cost, 2) }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Price</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">${{ number_format($product->price, 2) }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Profit</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">${{ number_format($product->profit, 2) }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-[#9aa0a6]">Profit Margin</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-[#e8eaed]">
                                        @if($product->price > 0)
                                            {{ number_format(($product->profit / $product->price) * 100, 2) }}%
                                        @else
                                            0%
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    @if($product->saleItems->count() > 0)
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Sales History</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50 dark:bg-[#2d2e31]">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-[#9aa0a6] uppercase tracking-wider">Sale Date</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-[#9aa0a6] uppercase tracking-wider">Quantity</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-[#9aa0a6] uppercase tracking-wider">Unit Price</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-[#9aa0a6] uppercase tracking-wider">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-[#2d2e31] divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($product->saleItems as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-[#e8eaed]">
                                                    {{ $item->sale->created_at->format('M d, Y H:i') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-[#e8eaed]">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-[#e8eaed]">
                                                    ${{ number_format($item->unit_price, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-[#e8eaed]">
                                                    ${{ number_format($item->quantity * $item->unit_price, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 