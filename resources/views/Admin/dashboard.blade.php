    @extends('Admin.layouts.admin')

    @section('title', 'Dashboard')
    @section('page-title', 'Dashboard')

    @section('content')

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Sales -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Sales</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalSales ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalRevenue ?? 0, 2) }} TND</p>
                    </div>
                </div>
            </div>

            <!-- Orders -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center">
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <i class="fas fa-receipt text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Orders</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalOrders ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <i class="fas fa-box-open text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Products</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalProducts ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

       <!-- Revenue Insights -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">

    <!-- Today -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-600 mb-1">Today</p>
        <p class="text-xl font-bold text-black-700">{{ number_format($revenueToday ?? 0, 2) }} TND</p>
        <p class="text-sm text-gray-500">Net: {{ number_format($netrevenueToday ?? 0, 2) }} TND</p>
        @if(isset($growthTodayVsYesterday))
            <span class="text-sm font-medium
                {{ $growthTodayVsYesterday >= 0 ? 'text-green-600' : 'text-red-600' }}">
                ({{ $growthTodayVsYesterday >= 0 ? '+' : '' }}{{ number_format($growthTodayVsYesterday, 1) }}%)
            </span>
        @endif
    </div>

    <!-- Yesterday -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-600 mb-1">Yesterday</p>
        <p class="text-xl font-bold text-black-700">{{ number_format($revenueYesterday ?? 0, 2) }} TND</p>
        <p class="text-sm text-gray-500">Net: {{ number_format($netrevenueYesterday ?? 0, 2) }} TND</p>
    </div>

    <!-- Last 7 Days -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-600 mb-1">Last 7 Days</p>
        <p class="text-xl font-bold text-black-700">{{ number_format($revenueLast7Days ?? 0, 2) }} TND</p>
        <p class="text-sm text-gray-500">Net: {{ number_format($netrevenueLast7Days ?? 0, 2) }} TND</p>
    </div>

    <!-- Last 28 Days -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-600 mb-1">Last 28 Days</p>
        <p class="text-xl font-bold text-black-700">{{ number_format($revenueLast28Days ?? 0, 2) }} TND</p>
        <p class="text-sm text-gray-500">Net: {{ number_format($netrevenueLast28Days ?? 0, 2) }} TND</p>
    </div>

    <!-- This Month -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-600 mb-1">This Month</p>
        <p class="text-xl font-bold text-black-700">{{ number_format($revenueThisMonth ?? 0, 2) }} TND</p>
        <p class="text-sm text-gray-500">Net: {{ number_format($netrevenueThisMonth ?? 0, 2) }} TND</p>
        @if(isset($growthThisMonthVsLastMonth))
            <span class="text-sm font-medium
                {{ $growthThisMonthVsLastMonth >= 0 ? 'text-green-600' : 'text-red-600' }}">
                ({{ $growthThisMonthVsLastMonth >= 0 ? '+' : '' }}{{ number_format($growthThisMonthVsLastMonth, 1) }}%)
            </span>
        @endif
    </div>

    <!-- Last Month -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-600 mb-1">Last Month</p>
        <p class="text-xl font-bold text-black-700">{{ number_format($revenueLastMonth ?? 0, 2) }} TND</p>
        <p class="text-sm text-gray-500">Net: {{ number_format($netrevenueLastMonth ?? 0, 2) }} TND</p>
    </div>

</div>




    <!-- Recent Orders -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Orders</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3 border-b">Order ID#</th>
                        <th class="px-6 py-3 border-b">Customer</th>
                        <th class="px-6 py-3 border-b">Amount</th>
                        <th class="px-6 py-3 border-b">Status</th>
                        <th class="px-6 py-3 border-b">Date</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">

                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-200/30 transition">
                        <td class="px-6 py-3 border-b">{{ $order['id'] }}</td>
                        <td class="px-6 py-3 border-b">{{ $order['first_name'] }}</td>
                        <td class="px-6 py-3 border-b">{{ $order['total_amount'] }}</td>
                        <td class="px-6 py-3 border-b">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                {{ $order['status'] === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $order['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-3 border-b">{{ $order['updated_at'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-3 text-center text-gray-500">
                            There are no order yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-red-200 mt-6">
        <h2 class="text-lg font-semibold text-red-700 mb-4">Products Out of Stock</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left border-collapse">
                <thead class="bg-red-100 text-red-700 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 border-b">Image</th>
                        <th class="px-6 py-3 border-b">Product ID#</th>
                        <th class="px-6 py-3 border-b">Name</th>
                        <th class="px-6 py-3 border-b">Quantity</th>
                        <th class="px-6 py-3 border-b">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($outOfStock as $product)
                    <tr class="hover:bg-gray-200/30 transition">
                        <td class="px-4 py-3 border-b">
                            @if($product->photo1)
                                <img src="{{ asset('storage/' . $product->photo1) }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-12 h-12 object-cover rounded-md">
                            @else
                                <img src="{{ asset('images/placeholder.png') }}" 
                                    alt="No Image" 
                                    class="w-12 h-12 object-cover rounded-md">
                            @endif
                        </td>
                        <td class="px-6 py-3 border-b">{{ $product->id }}</td>
                        <td class="px-6 py-3 border-b">{{ $product->name }}</td>
                        <td class="px-6 py-3 border-b">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                            class="text-blue-600 hover:underline">
                                {{ $product->stock }}
                            </a>
                        </td>
                        <td class="px-6 py-3 border-b">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                            class="text-blue-600 hover:underline">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-3 text-center text-gray-500">
                            There are no out-of-stock products.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $outOfStock->links() }}
        </div>
    </div>


      <div class="bg-white p-6 rounded-xl shadow-sm border border-yellow-200 mt-6">
        <h2 class="text-lg font-semibold text-yellow-700 mb-4">Products Low in Stock (&lt;10)</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left border-collapse">
                <thead class="bg-yellow-100 text-yellow-700 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 border-b">Image</th>
                        <th class="px-6 py-3 border-b">Product ID#</th>
                        <th class="px-6 py-3 border-b">Name</th>
                        <th class="px-6 py-3 border-b">Quantity</th>
                        <th class="px-6 py-3 border-b">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($lowStock as $product)
                    <tr class="hover:bg-gray-200/30 transition">
                        <td class="px-4 py-3 border-b">
                            @if($product->photo1)
                                <img src="{{ asset('storage/' . $product->photo1) }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-12 h-12 object-cover rounded-md">
                            @else
                                <img src="{{ asset('images/placeholder.png') }}" 
                                    alt="No Image" 
                                    class="w-12 h-12 object-cover rounded-md">
                            @endif
                        </td>
                        <td class="px-6 py-3 border-b">{{ $product->id }}</td>
                        <td class="px-6 py-3 border-b">{{ $product->name }}</td>
                        <td class="px-6 py-3 border-b">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                            class="text-blue-600 hover:underline">
                                {{ $product->stock }}
                            </a>
                        </td>
                        <td class="px-6 py-3 border-b">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                            class="text-blue-600 hover:underline">
                                Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-3 text-center text-gray-500">
                            There are no low quantity products.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $lowStock->links() }}
        </div>
    </div>


    @endsection

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('monthlyRevenueChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            datasets: [{
                label: 'Revenue ($)',
                data: [1200, 1900, 3000, 2500, 4000, 4500, 5000, 4800, 5200],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.3,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
    </script>
    @endpush
