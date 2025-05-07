<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Sale') }}
            </h2>
            <a href="{{ route('sales.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                {{ __('Back to Sales') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sales.store') }}" id="saleForm" class="space-y-8">
                        @csrf

                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Customer Information</h3>
                            <div class="max-w-xl">
                                <x-input-label for="customer_id" :value="__('Customer')" />
                                <div class="relative">
                                    <select id="customer_id" name="customer_id" 
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm appearance-none bg-white" 
                                        required>
                                        <option value="">Select a customer</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </div>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('customer_id')" />
                            </div>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Sale Items</h3>
                                <x-primary-button type="button" onclick="addItem()" class="bg-indigo-600 hover:bg-indigo-700">
                                    <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Add Item
                                </x-primary-button>
                            </div>
                            <div id="items-container" class="space-y-4">
                                <!-- Items will be added here dynamically -->
                            </div>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex justify-between items-center">
                                <div class="text-lg font-medium text-gray-900">
                                    Total Amount: <span id="total-amount" class="text-indigo-600">$0.00</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('sales.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                                    <x-primary-button>{{ __('Create Sale') }}</x-primary-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let itemCount = 0;

        function addItem() {
            const container = document.getElementById('items-container');
            const itemDiv = document.createElement('div');
            itemDiv.className = 'bg-white p-4 rounded-lg border border-gray-200 shadow-sm';
            itemDiv.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-5">
                        <x-input-label for="product_id_${itemCount}" :value="__('Product')" />
                        <div class="relative">
                            <select id="product_id_${itemCount}" name="items[${itemCount}][product_id]" 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm appearance-none bg-white" 
                                required onchange="updateSubtotal(${itemCount})">
                                <option value="">Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                        {{ $product->name }} - ${{ number_format($product->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <x-input-label for="quantity_${itemCount}" :value="__('Quantity')" />
                        <x-text-input id="quantity_${itemCount}" 
                            name="items[${itemCount}][quantity]" 
                            type="number" 
                            min="1" 
                            value="1" 
                            class="mt-1 block w-full" 
                            required 
                            onchange="updateSubtotal(${itemCount})" />
                    </div>
                    <div class="md:col-span-3">
                        <x-input-label for="subtotal_${itemCount}" :value="__('Subtotal')" />
                        <x-text-input id="subtotal_${itemCount}" 
                            type="text" 
                            class="mt-1 block w-full bg-gray-50" 
                            readonly />
                    </div>
                    <div class="md:col-span-1 flex items-end">
                        <button type="button" 
                            class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50" 
                            onclick="removeItem(this)">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(itemDiv);
            itemCount++;
        }

        function removeItem(button) {
            button.closest('div.bg-white').remove();
            updateTotalAmount();
        }

        function updateSubtotal(index) {
            const productSelect = document.getElementById(`product_id_${index}`);
            const quantityInput = document.getElementById(`quantity_${index}`);
            const subtotalInput = document.getElementById(`subtotal_${index}`);
            
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = selectedOption.dataset.price || 0;
            const quantity = quantityInput.value || 0;
            
            const subtotal = price * quantity;
            subtotalInput.value = `$${subtotal.toFixed(2)}`;
            updateTotalAmount();
        }

        function updateTotalAmount() {
            const subtotalInputs = document.querySelectorAll('[id^="subtotal_"]');
            let total = 0;
            
            subtotalInputs.forEach(input => {
                const value = parseFloat(input.value.replace('$', '')) || 0;
                total += value;
            });
            
            document.getElementById('total-amount').textContent = `$${total.toFixed(2)}`;
        }

        // Add first item on page load
        document.addEventListener('DOMContentLoaded', function() {
            addItem();
        });
    </script>
</x-app-layout> 