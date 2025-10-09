@extends('Admin.layouts.admin')

@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h3 class="text-xl font-semibold text-gray-800">Order List</h3>
</div>

<div class="overflow-x-auto bg-white rounded-md shadow-md">
    <table class="min-w-full text-left border-collapse">
        <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
            <tr>
                <th class="px-6 py-3 border-b">#</th>
                <th class="px-6 py-3 border-b">Customer</th>
                <th class="px-6 py-3 border-b">Products</th>
                <th class="px-6 py-3 border-b">Total (DT)</th>
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
                        {{ $order->user->name }}
                        <div class="text-sm text-gray-500">{{ $order->user->phone ?? $order->phone }}</div>
                    @else
                        Guest
                        <div class="text-sm text-gray-500">{{ $order->phone ?? '-' }}</div>
                    @endif
                </td>

                <td class="px-6 py-3 border-b">
                    @foreach($order->items as $item)
                        {{ $item->product->name ?? 'N/A' }} (x{{ $item->quantity }})@if(!$loop->last),@endif
                    @endforeach
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

                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Delete this order?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </form>
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

{{-- Pagination --}}
<div class="mt-4">
    {{ $orders->links('pagination::tailwind') }}
</div>
@endsection
