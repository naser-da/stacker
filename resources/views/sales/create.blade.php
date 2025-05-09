<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-[#e8eaed] leading-tight">
                {{ __('Create Sale') }}
            </h2>
            <a href="{{ route('sales.index') }}" class="inline-flex items-center px-4 py-2 bg-[#1a73e8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1557b0] dark:bg-[#8ab4f8] dark:hover:bg-[#aecbfa] dark:text-[#202124]">
                Back to Sales
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="p-6">
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sales.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Customer Selection -->
                            <div>
                                <x-input-label for="customer_id" :value="__('Customer')" class="text-gray-700 dark:text-[#e8eaed]" />
                                <select id="customer_id" name="customer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-700 dark:bg-[#2d2e31] dark:border-[#3c4043] dark:text-[#e8eaed]" required>
                                    <option value="">Select a customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('customer_id')" />
                            </div>

                            <!-- Sale Date -->
                            <div>
                                <x-input-label for="sale_date" :value="__('Sale Date')" class="text-gray-700 dark:text-[#e8eaed]" />
                                <x-text-input id="sale_date" name="sale_date" type="date" class="mt-1 block w-full text-gray-700 dark:text-[#e8eaed]" :value="old('sale_date', now()->format('Y-m-d'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('sale_date')" />
                            </div>
                        </div>

                        <!-- Products Selection -->
                        <div>
                            <x-input-label :value="__('Products')" class="text-gray-700 dark:text-[#e8eaed]" />
                            <div class="mt-2 space-y-4">
                                <div id="products-container">
                                    <div class="product-row grid grid-cols-12 gap-4 items-end">
                                        <div class="col-span-5">
                                            <select name="products[0][product_id]" class="product-select block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-700 dark:bg-[#2d2e31] dark:border-[#3c4043] dark:text-[#e8eaed]" required>
                                                <option value="">Select a product</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">
                                                        {{ $product->name }} (Stock: {{ $product->stock }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-span-2">
                                            <x-input-label for="quantity" :value="__('Quantity')" class="text-gray-700 dark:text-[#e8eaed]" />
                                            <x-text-input type="number" name="products[0][quantity]" class="quantity-input mt-1 block w-full text-gray-700 dark:text-[#e8eaed]" min="1" value="1" required />
                                        </div>
                                        <div class="col-span-2">
                                            <x-input-label for="price" :value="__('Price')" class="text-gray-700 dark:text-[#e8eaed]" />
                                            <x-text-input type="number" name="products[0][price]" class="price-input mt-1 block w-full text-gray-700 dark:text-[#e8eaed]" step="0.01" required />
                                        </div>
                                        <div class="col-span-2">
                                            <x-input-label for="subtotal" :value="__('Subtotal')" class="text-gray-700 dark:text-[#e8eaed]" />
                                            <x-text-input type="number" class="subtotal-input mt-1 block w-full text-gray-700 dark:text-[#e8eaed]" readonly />
                                        </div>
                                        <div class="col-span-1">
                                            <button type="button" class="remove-product text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" id="add-product" class="inline-flex items-center px-4 py-2 bg-[#1a73e8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1557b0] dark:bg-[#8ab4f8] dark:hover:bg-[#aecbfa] dark:text-[#202124]">
                                    Add Product
                                </button>
                            </div>
                        </div>

                        <!-- Totals -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="total_amount" :value="__('Total Amount')" class="text-gray-700 dark:text-[#e8eaed]" />
                                <x-text-input id="total_amount" name="total_amount" type="number" class="mt-1 block w-full text-gray-700 dark:text-[#e8eaed]" step="0.01" readonly />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Create Sale') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productsContainer = document.getElementById('products-container');
            const addProductButton = document.getElementById('add-product');
            let productCount = 1;

            function updateSubtotal(row) {
                const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
                const price = parseFloat(row.querySelector('.price-input').value) || 0;
                const subtotal = quantity * price;
                row.querySelector('.subtotal-input').value = subtotal.toFixed(2);
                updateTotal();
            }

            function updateTotal() {
                const subtotals = Array.from(document.querySelectorAll('.subtotal-input'))
                    .map(input => parseFloat(input.value) || 0);
                const total = subtotals.reduce((sum, subtotal) => sum + subtotal, 0);
                document.getElementById('total_amount').value = total.toFixed(2);
            }

            function addProductRow() {
                const template = productsContainer.querySelector('.product-row').cloneNode(true);
                const newIndex = productCount++;

                // Update input names and IDs
                template.querySelectorAll('[name]').forEach(input => {
                    input.name = input.name.replace('[0]', `[${newIndex}]`);
                    input.value = '';
                });

                // Add event listeners
                template.querySelector('.product-select').addEventListener('change', function() {
                    const option = this.options[this.selectedIndex];
                    const price = option.dataset.price;
                    const stock = option.dataset.stock;
                    const row = this.closest('.product-row');
                    row.querySelector('.price-input').value = price;
                    row.querySelector('.quantity-input').max = stock;
                    updateSubtotal(row);
                });

                template.querySelector('.quantity-input').addEventListener('input', function() {
                    updateSubtotal(this.closest('.product-row'));
                });

                template.querySelector('.price-input').addEventListener('input', function() {
                    updateSubtotal(this.closest('.product-row'));
                });

                template.querySelector('.remove-product').addEventListener('click', function() {
                    if (productsContainer.querySelectorAll('.product-row').length > 1) {
                        this.closest('.product-row').remove();
                        updateTotal();
                    }
                });

                productsContainer.appendChild(template);
            }

            // Add event listeners to the first row
            const firstRow = productsContainer.querySelector('.product-row');
            firstRow.querySelector('.product-select').addEventListener('change', function() {
                const option = this.options[this.selectedIndex];
                const price = option.dataset.price;
                const stock = option.dataset.stock;
                const row = this.closest('.product-row');
                row.querySelector('.price-input').value = price;
                row.querySelector('.quantity-input').max = stock;
                updateSubtotal(row);
            });

            firstRow.querySelector('.quantity-input').addEventListener('input', function() {
                updateSubtotal(this.closest('.product-row'));
            });

            firstRow.querySelector('.price-input').addEventListener('input', function() {
                updateSubtotal(this.closest('.product-row'));
            });

            firstRow.querySelector('.remove-product').addEventListener('click', function() {
                if (productsContainer.querySelectorAll('.product-row').length > 1) {
                    this.closest('.product-row').remove();
                    updateTotal();
                }
            });

            addProductButton.addEventListener('click', addProductRow);
        });
    </script>
    @endpush
</x-app-layout> 