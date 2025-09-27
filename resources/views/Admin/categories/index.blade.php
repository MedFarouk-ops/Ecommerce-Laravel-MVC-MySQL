@extends('Admin.layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h3 class="text-xl font-semibold text-gray-800">Category List</h3>
    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
        <i class="fa-solid fa-plus mr-2"></i> Add Category
    </button>
</div>

<div class="overflow-x-auto bg-white rounded-md shadow-md">
    <table class="min-w-full text-left border-collapse">
        <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
            <tr>
                <th class="px-6 py-3 border-b">#</th>
                <th class="px-6 py-3 border-b">Name</th>
                <th class="px-6 py-3 border-b">Description</th>
                <th class="px-6 py-3 border-b text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @php
                $categories = [
                    ['id' => 1, 'name' => 'Headsets', 'description' => 'All kinds of headsets'],
                    ['id' => 2, 'name' => 'Chargers', 'description' => 'Phone chargers'],
                    ['id' => 3, 'name' => 'Speakers', 'description' => 'Bluetooth speakers'],
                    ['id' => 4, 'name' => 'Smart Watches', 'description' => 'Wearable smart devices'],
                ];
            @endphp

            @foreach($categories as $category)
            <tr class="hover:bg-gray-200/30 transition">
                <td class="px-6 py-3 border-b">{{ $category['id'] }}</td>
                <td class="px-6 py-3 border-b">{{ $category['name'] }}</td>
                <td class="px-6 py-3 border-b">{{ $category['description'] }}</td>
                <td class="px-6 py-3 border-b text-center flex justify-center gap-2">
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
