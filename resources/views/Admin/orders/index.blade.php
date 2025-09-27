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
                $orders = [
                    [
                        'id' => 101,
                        'customer' => 'Mohamed Farouk',
                        'products' => 'Wireless Headset, Smart Charger',
                        'total' => 35,
                        'status' => 'Completed',
                        'date' => '2025-09-27'
                    ],
                    [
                        'id' => 102,
                        'customer' => 'Amina Ben Ali',
                        'products' => 'Bluetooth Speaker',
                        'total' => 35,
                        'status' => 'Pending',
                        'date' => '2025-09-26'
                    ],
                    [
                        'id' => 103,
                        'customer' => 'Sami Khelifi',
                        'products' => 'Smart Watch',
                        'total' => 50,
                        'status' => 'Cancelled',
                        'date' => '2025-09-25'
                    ],
                ];

                $statusColors = [
                    'Completed' => 'bg-green-100 text-green-800',
                    'Pending' => 'bg-yellow-100 text-yellow-800',
                    'Cancelled' => 'bg-red-100 text-red-800'
                ];
            @endphp

            @foreach($orders as $order)
            <tr class="hover:bg-gray-100 transition">
                <td class="px-6 py-3 border-b">{{ $order['id'] }}</td>
                <td class="px-6 py-3 border-b">{{ $order['customer'] }}</td>
                <td class="px-6 py-3 border-b">{{ $order['products'] }}</td>
                <td class="px-6 py-3 border-b">{{ $order['total'] }}</td>
                <td class="px-6 py-3 border-b">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$order['status']] }}">
                        {{ $order['status'] }}
                    </span>
                </td>
                <td class="px-6 py-3 border-b">{{ $order['date'] }}</td>
                <td class="px-6 py-3 border-b text-center flex justify-center gap-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">
                        <i class="fa-solid fa-eye"></i> View
                    </button>
                    <button class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                    <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
