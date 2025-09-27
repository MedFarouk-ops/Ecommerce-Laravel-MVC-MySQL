@extends('Admin.layouts.admin')

@section('title', 'Products')
@section('page-title', 'Products')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <h3 class="text-xl font-semibold text-gray-800">Product List</h3>
    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Add Product
    </button>
</div>

<div class="overflow-x-auto bg-white rounded-md shadow-md">
    <table class="min-w-full text-left border-collapse">
        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
            <tr>
                <th class="px-4 py-3 border-b">#</th>
                <th class="px-4 py-3 border-b">Name</th>
                <th class="px-4 py-3 border-b">Category</th>
                <th class="px-4 py-3 border-b">Price (DT)</th>
                <th class="px-4 py-3 border-b">Stock</th>
                <th class="px-4 py-3 border-b text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @php
                $products = [
                    ['id' => 1, 'name' => 'Wireless Headset', 'category' => 'Headsets', 'price' => 20, 'stock' => 15],
                    ['id' => 2, 'name' => 'Smart Charger', 'category' => 'Chargers', 'price' => 15, 'stock' => 40],
                    ['id' => 3, 'name' => 'Bluetooth Speaker', 'category' => 'Speakers', 'price' => 35, 'stock' => 8],
                    ['id' => 4, 'name' => 'Smart Watch', 'category' => 'Smart Watches', 'price' => 50, 'stock' => 12],
                ];
            @endphp

            @foreach($products as $product)
            <tr class="hover:bg-gray-200/30 transition">
                <td class="px-4 py-2 border-b">{{ $product['id'] }}</td>
                <td class="px-4 py-2 border-b">{{ $product['name'] }}</td>
                <td class="px-4 py-2 border-b">{{ $product['category'] }}</td>
                <td class="px-4 py-2 border-b">{{ $product['price'] }}</td>
                <td class="px-4 py-2 border-b">{{ $product['stock'] }}</td>
                <td class="px-4 py-2 border-b text-center flex flex-col sm:flex-row justify-center gap-2">
                    <button class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600 flex items-center justify-center gap-1">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                    <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 flex items-center justify-center gap-1">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
