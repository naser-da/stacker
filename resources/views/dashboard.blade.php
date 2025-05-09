<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-[#e8eaed] leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Categories Card -->
                <div class="card">
                    <div class="p-6">
                        <div class="text-xl font-semibold mb-2">Categories</div>
                        <div class="text-[#5f6368] dark:text-[#9aa0a6]">{{ \App\Models\Category::count() }} Total</div>
                        <a href="{{ route('categories.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-[#1a73e8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1557b0] dark:bg-[#8ab4f8] dark:hover:bg-[#aecbfa] dark:text-[#202124]">
                            Add New Category
                        </a>
                    </div>
                </div>

                <!-- Products Card -->
                <div class="card">
                    <div class="p-6">
                        <div class="text-xl font-semibold mb-2">Products</div>
                        <div class="text-[#5f6368] dark:text-[#9aa0a6]">{{ \App\Models\Product::count() }} Total</div>
                        <a href="{{ route('products.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-[#1a73e8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1557b0] dark:bg-[#8ab4f8] dark:hover:bg-[#aecbfa] dark:text-[#202124]">
                            Add New Product
                        </a>
                    </div>
                </div>

                <!-- Customers Card -->
                <div class="card">
                    <div class="p-6">
                        <div class="text-xl font-semibold mb-2">Customers</div>
                        <div class="text-[#5f6368] dark:text-[#9aa0a6]">{{ \App\Models\Customer::count() }} Total</div>
                        <a href="{{ route('customers.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-[#1a73e8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1557b0] dark:bg-[#8ab4f8] dark:hover:bg-[#aecbfa] dark:text-[#202124]">
                            Add New Customer
                        </a>
                    </div>
                </div>

                <!-- Sales Card -->
                <div class="card">
                    <div class="p-6">
                        <div class="text-xl font-semibold mb-2">Sales</div>
                        <div class="text-[#5f6368] dark:text-[#9aa0a6]">{{ \App\Models\Sale::count() }} Total</div>
                        <a href="{{ route('sales.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-[#1a73e8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1557b0] dark:bg-[#8ab4f8] dark:hover:bg-[#aecbfa] dark:text-[#202124]">
                            New Sale
                        </a>
                    </div>
                </div>
            </div>

            <!-- Charts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Monthly Revenue Chart -->
                <div class="card">
                    <div class="p-4">
                        <h3 class="text-lg font-medium text-[#202124] dark:text-[#e8eaed] mb-2">Total Revenue</h3>
                        <div class="h-40">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Top Customers Chart -->
                <div class="card">
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-lg font-medium text-[#202124] dark:text-[#e8eaed] mb-4">Top Customers</h3>
                            <form method="GET" action="{{ route('dashboard') }}" class="flex items-center space-x-2">
                                <div class="flex items-center space-x-2">
                                    <input type="date" name="start_date" value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}" 
                                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm dark:bg-[#2d2e31] dark:border-[#3c4043] dark:text-[#e8eaed]">
                                    <span class="text-[#5f6368] dark:text-[#9aa0a6]">to</span>
                                    <input type="date" name="end_date" value="{{ request('end_date', now()->format('Y-m-d')) }}" 
                                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm dark:bg-[#2d2e31] dark:border-[#3c4043] dark:text-[#e8eaed]">
                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-[#1a73e8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#1557b0] dark:bg-[#8ab4f8] dark:hover:bg-[#aecbfa] dark:text-[#202124]">
                                        Apply
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="h-40">
                            <canvas id="customersChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Sales -->
            <div class="card">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-[#202124] dark:text-[#e8eaed] mb-4">Recent Sales</h3>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Sale::with('customer')->latest()->take(5)->get() as $sale)
                                    <tr>
                                        <td>{{ $sale->id }}</td>
                                        <td>{{ $sale->customer->name }}</td>
                                        <td>${{ number_format($sale->total_amount, 2) }}</td>
                                        <td>
                                            <span class="status-badge {{ $sale->status }}">
                                                {{ $sale->status }}
                                            </span>
                                        </td>
                                        <td>{{ $sale->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Revenue Chart
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Revenue ($)',
                    data: @json($amountData),
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Revenue ($)'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Revenue: $${context.raw.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Monthly Revenue for ' + new Date().getFullYear()
                    }
                }
            }
        });

        // Top Customers Chart
        const customerCtx = document.getElementById('customersChart').getContext('2d');
        new Chart(customerCtx, {
            type: 'pie',
            data: {
                labels: @json($customerLabels),
                datasets: [{
                    data: @json($customerData),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${context.label}: $${value.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})} (${percentage}%)`;
                            }
                        }
                    },
                    legend: {
                        position: 'right'
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout> 