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
                    <p class="text-2xl font-bold text-gray-900">0</p>
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
                    <p class="text-2xl font-bold text-gray-900">$0</p>
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
                    <p class="text-2xl font-bold text-gray-900">0</p>
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
                    <p class="text-2xl font-bold text-gray-900">0</p>
                </div>
            </div>
        </div>

    </div>


    <!-- Recent Orders -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Orders</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3 border-b">Order #</th>
                        <th class="px-6 py-3 border-b">Customer</th>
                        <th class="px-6 py-3 border-b">Amount</th>
                        <th class="px-6 py-3 border-b">Status</th>
                        <th class="px-6 py-3 border-b">Date</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @php
                        $orders = [
                            ['id' => 1234, 'customer' => 'John Doe', 'amount' => '$120', 'status' => 'Completed', 'date' => '2025-09-25'],
                            ['id' => 1235, 'customer' => 'Jane Smith', 'amount' => '$250', 'status' => 'Pending', 'date' => '2025-09-24'],
                            ['id' => 1236, 'customer' => 'Bob Johnson', 'amount' => '$75', 'status' => 'Completed', 'date' => '2025-09-23'],
                        ];
                    @endphp

                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-200/30 transition">
                        <td class="px-6 py-3 border-b">{{ $order['id'] }}</td>
                        <td class="px-6 py-3 border-b">{{ $order['customer'] }}</td>
                        <td class="px-6 py-3 border-b">{{ $order['amount'] }}</td>
                        <td class="px-6 py-3 border-b">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                {{ $order['status'] === 'Completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $order['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-3 border-b">{{ $order['date'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
