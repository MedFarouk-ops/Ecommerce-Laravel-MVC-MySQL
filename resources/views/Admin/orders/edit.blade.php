@extends('Admin.layouts.admin')

@section('title', 'Edit Order')
@section('page-title', 'Edit Order #'.$order->id)

@section('content')
<div class="mb-6">
    <h3 class="text-xl font-semibold text-gray-800">Edit Order #{{ $order->id }}</h3>
</div>

<form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Customer Info --}}
    <div class="mb-6 bg-white p-4 rounded-md shadow-md">
        <h4 class="text-lg font-semibold mb-3">Customer Info</h4>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">Name</label>
                <input type="text" class="w-full border rounded px-2 py-1" value="{{ $order->user->name ?? 'Guest' }}" disabled>
            </div>
            <div>
                <label class="block font-semibold">Phone</label>
                <input type="text" class="w-full border rounded px-2 py-1" value="{{ $order->user->phone ?? $order->phone }}" disabled>
            </div>
            <div class="col-span-2">
                <label class="block font-semibold">Address</label>
                <textarea class="w-full border rounded px-2 py-1" disabled>{{ $order->address }}, {{ $order->city }}</textarea>
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
                    <th class="px-4 py-2 border-b">Quantity</th>
                    <th class="px-4 py-2 border-b">Price (DT)</th>
                    <th class="px-4 py-2 border-b">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr class="hover:bg-gray-100 transition">
                    <td class="px-4 py-2 border-b">{{ $item->product->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2 border-b">
                        <input type="number" name="items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}" min="1" class="w-20 border rounded px-1 py-1">
                    </td>
                    <td class="px-4 py-2 border-b">
                        <!-- Price is fixed and not editable -->
                        <span class="w-24 inline-block px-1 py-1">{{ number_format($item->price, 2) }}</span>
                    </td>
                    <td class="px-4 py-2 border-b">{{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- Total & Status --}}
    <div class="mb-6 bg-white p-4 rounded-md shadow-md flex items-center justify-between">
        <div>
            <label class="block font-semibold">Status</label>
            <select name="status" class="border rounded px-2 py-1">
                @foreach(['pending','processing','shipped','delivered','cancelled','completed'] as $status)
                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>

        <div class="text-right">
            <span class="font-semibold text-lg">Total: </span>
            <span class="text-lg">{{ number_format($order->total_amount, 2) }} DT</span>
        </div>
    </div>

    {{-- Submit --}}
    <div class="text-right">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Update Order
        </button>
    </div>
</form>
@endsection
