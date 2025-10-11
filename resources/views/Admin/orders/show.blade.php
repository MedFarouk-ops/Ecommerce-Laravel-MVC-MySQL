@extends('Admin.layouts.admin')

@section('title', 'View Order')
@section('page-title', 'Order #'.$order->id)

@section('content')
<div class="mb-6">
    <h3 class="text-xl font-semibold text-gray-800">Order #{{ $order->id ?? '-' }}</h3>
</div>

{{-- Customer Info --}}
<div class="mb-6 bg-white p-4 rounded-md shadow-md">
    <h4 class="text-lg font-semibold mb-3">Customer Info</h4>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold">Name</label>
            <p>{{ $order->user->name ?? ($order->first_name ?? '-') . ' ' . ($order->last_name ?? '-') }}</p>
        </div>
        <div>
            <label class="block font-semibold">Phone</label>
            <p>{{ $order->user->phone ?? $order->phone ?? '-' }}</p>
        </div>
        <div>
            <label class="block font-semibold">Email</label>
            <p>{{ $order->user->email ?? $order->email ?? '-' }}</p>
        </div>
        <div class="col-span-2">
            <label class="block font-semibold">Address</label>
            <p>{{ $order->address ?? '-' }}, {{ $order->city ?? '-' }}, {{ $order->postal_code ?? '-' }}</p>
        </div>
        @if(!empty($order->notes))
        <div class="col-span-2">
            <label class="block font-semibold">Notes</label>
            <p>{{ $order->notes }}</p>
        </div>
        @endif
        <div class="col-span-2">
            <label class="block font-semibold">Payment Method</label>
            <p>{{ ucfirst($order->payment_method ?? '-') }}</p>
        </div>
    </div>
</div>

{{-- Products --}}
<div class="mb-6 bg-white p-4 rounded-md shadow-md">
    <h4 class="text-lg font-semibold mb-3">Products</h4>
    <table class="min-w-full text-left border-collapse">
        <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
            <tr>
                <th class="px-4 py-2 border-b">Product</th>
                <th class="px-4 py-2 border-b">Photo</th>
                <th class="px-4 py-2 border-b">Quantity</th>
                <th class="px-4 py-2 border-b">Price (DT)</th>
                <th class="px-4 py-2 border-b">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($order->items as $item)
            <tr class="hover:bg-gray-100 transition">
                <td class="px-4 py-2 border-b">{{ $item->product->name ?? 'N/A' }}</td>
                <td class="px-4 py-2 border-b">
                    @if(!empty($item->product->photo1))
                        <img src="{{ asset('storage/'.$item->product->photo1) }}" class="w-12 h-12 object-cover rounded" alt="{{ $item->product->name ?? 'Product' }}">
                    @else
                        <span class="text-gray-400">No image</span>
                    @endif
                </td>
                <td class="px-4 py-2 border-b">{{ $item->quantity ?? 0 }}</td>
                <td class="px-4 py-2 border-b">{{ number_format($item->price ?? 0, 2) }}</td>
                <td class="px-4 py-2 border-b">{{ number_format(($item->quantity ?? 0) * ($item->price ?? 0), 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-gray-500">No products found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Order Summary --}}
<div class="mb-6 bg-white p-4 rounded-md shadow-md flex justify-between items-center">
    <div>
        <label class="block font-semibold">Status</label>
        <span class="px-3 py-1 rounded-full text-sm font-semibold 
            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
            @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
            @elseif($order->status == 'delivered') bg-green-100 text-green-800
            @elseif($order->status == 'cancelled') bg-red-100 text-red-800
            @elseif($order->status == 'completed') bg-green-100 text-green-800
            @else bg-gray-100 text-gray-800 @endif">
            {{ ucfirst($order->status ?? '-') }}
        </span>
    </div>

    <div class="text-right">
        <span class="font-semibold text-lg">Total: </span>
        <span class="text-lg">{{ number_format($order->total_amount ?? 0, 2) }} DT</span>
    </div>
</div>

{{-- Back Button --}}
<div class="text-right">
    <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        Back to Orders
    </a>
</div>
@endsection
