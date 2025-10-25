@extends('Admin.layouts.admin')

@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')
<div x-data="orderDelete()" x-cloak>
    <!-- Success Alert -->
    @if (session('success'))
        <div x-show="true" x-transition class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-6">
            <strong class="font-bold">Success! </strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold text-gray-800">Order List</h3>
    </div>

     <!-- Search bar -->
    <div class="mb-6">
    <form action="{{ route('admin.orders.search') }}" method="GET" class="flex flex-col sm:flex-row gap-3 sm:gap-2">
        <input 
            type="text" 
            name="query" 
            value="{{ request('query') }}" 
            class="flex-1 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Search orders by name..."
            required>
        <button 
            type="submit" 
            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center justify-center gap-2">
            <i class="fa-solid fa-search"></i> Search
        </button>
    </form>

    <div class="overflow-x-auto bg-white rounded-md shadow-md">
        <table class="min-w-full text-left border-collapse">
            <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3 border-b">#</th>
                    <th class="px-6 py-3 border-b">Customer</th>
                    <th class="px-6 py-3 border-b">Products</th>
                    <th class="px-6 py-3 border-b">Total ({{$websiteInfo->currency ?? DT}})</th>
                    <th class="px-6 py-3 border-b">Status</th>
                    <th class="px-6 py-3 border-b">Date</th>
                    <th class="px-6 py-3 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'processing' => 'bg-blue-100 text-blue-800',
                        'shipped' => 'bg-purple-100 text-purple-800',
                        'delivered' => 'bg-green-100 text-green-800',
                        'cancelled' => 'bg-red-100 text-red-800',
                        'completed' => 'bg-green-100 text-green-800',
                    ];
                @endphp

                @forelse($orders as $order)
                <tr class="hover:bg-gray-100 transition">
                    <td class="px-6 py-3 border-b">{{ $order->id }}</td>

                    {{-- Get the client name via relationship --}}
                    <td class="px-6 py-3 border-b">
                        @if($order->user)
                            {{ $order->first_name }} {{ $order->last_name }}
                            <div class="text-sm text-gray-500">{{ $order->user->phone ?? $order->phone }}</div>
                        @else
                            Guest
                            <div class="text-sm text-gray-500">{{ $order->phone ?? '-' }}</div>
                        @endif
                    </td>

                    <td class="px-6 py-3 border-b">
                        @forelse($order->items as $item)
                            {{ $item->product->name ?? 'N/A' }} (x{{ $item->quantity }})@if(!$loop->last),@endif
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">No order found.</td>
                        </tr>
                        @endforelse
                    </td>

                    <td class="px-6 py-3 border-b">{{ number_format($order->total_amount, 2) }}</td>

                    <td class="px-6 py-3 border-b">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>

                    <td class="px-6 py-3 border-b">{{ $order->created_at->format('Y-m-d') }}</td>

                    <td class="px-6 py-3 border-b text-center flex justify-center gap-2">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">
                            <i class="fa-solid fa-eye"></i> View
                        </a>

                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>

                        
                        <!-- Delete Button -->
                        <button @click="openModal({{ $order->id }}, '{{ addslashes($order->user->name ?? 'Guest') }}')"
                                class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 flex items-center justify-center gap-1">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-500">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
   
    <!-- Delete Modal -->
    <div x-show="show" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div @click.away="show = false" class="bg-white rounded-md shadow-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Confirm Delete</h3>
            <p class="mb-4">Are you sure you want to delete the order of <strong x-text="orderName"></strong>?</p>
            <div class="flex justify-end gap-3">
                <button @click="show = false" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Cancel</button>
                <form :action="`/admin/orders/${orderId}`" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
                </form>
            </div>
        </div>
    </div>
    {{-- Pagination --}}
    <div class="mt-4">
        {{ $orders->links('pagination::tailwind') }}
    </div>
</div>

<script>
function orderDelete() {
    return {
        show: false,
        orderId: null,
        orderName: '',
        openModal(id, name) {
            this.orderId = id;
            this.orderName = name;
            this.show = true;
        }
    }
}
</script>
@endsection
