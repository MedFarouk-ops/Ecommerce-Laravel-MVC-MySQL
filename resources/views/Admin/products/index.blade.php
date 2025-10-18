@extends('Admin.layouts.admin')

@section('title', 'Products')
@section('page-title', 'Products')

@section('content')
<div x-data="productDelete()" x-cloak>

    <!-- Success Alert -->
    @if (session('success'))
        <div x-show="true" x-transition class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-6">
            <strong class="font-bold">Success! </strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h3 class="text-xl font-semibold text-gray-800">Product List</h3>
        <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Add Product
        </a>
    </div>
    <!-- Search bar -->
    <div class="mb-6">
    <form action="{{ route('admin.products.search') }}" method="GET" class="flex flex-col sm:flex-row gap-3 sm:gap-2">
        <input 
            type="text" 
            name="query" 
            value="{{ request('query') }}" 
            class="flex-1 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Search products by name..."
            required>
        <button 
            type="submit" 
            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center justify-center gap-2">
            <i class="fa-solid fa-search"></i> Search
        </button>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-md shadow-md">
        <table class="min-w-full text-left border-collapse">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                <tr>
                    <th class="px-4 py-3 border-b">#</th>
                    <th class="px-4 py-3 border-b">Preview</th>
                    <th class="px-4 py-3 border-b">Name</th>
                    <th class="px-4 py-3 border-b">Category</th>
                    <th class="px-4 py-3 border-b">Price</th>
                    <th class="px-4 py-3 border-b">Stock</th>
                    <th class="px-4 py-3 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($products as $product)
                <tr class="hover:bg-gray-200/30 transition">
                    <td class="px-4 py-2 border-b">{{ $product->id }}</td>
                    <td class="px-4 py-2 border-b">
                        @if($product->photo1)
                            <img src="{{ asset('storage/' . $product->photo1) }}"
                                 alt="{{ $product->name }}"
                                 class="w-16 h-16 object-cover rounded-md border">
                        @else
                            <span class="text-gray-400">No Image</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border-b">{{ $product->name }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->category->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->price }}</td>
                    <td class="px-4 py-2 border-b">{{ $product->stock ?? 0 }}</td>
                    <td class="px-4 py-2 border-b text-center flex flex-col sm:flex-row justify-center gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600 flex items-center justify-center gap-1">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>

                        <!-- Delete Button -->
                        <button @click="openModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 flex items-center justify-center gap-1">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Single Delete Modal -->
    <div x-show="show" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div @click.away="show = false" class="bg-white rounded-md shadow-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Confirm Delete</h3>
            <p class="mb-4">Are you sure you want to delete <strong x-text="productName"></strong>?</p>
            <div class="flex justify-end gap-3">
                <button @click="show = false" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Cancel</button>
                <form :action="`/admin/products/${productId}`" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
                </form>
            </div>
        </div>
    </div>
        
    <!-- Pagination -->
        <div class="mt-4 flex justify-center">
            {{ $products->links() }}
        </div>
</div>

<script>
function productDelete() {
    return {
        show: false,
        productId: null,
        productName: '',
        openModal(id, name) {
            this.productId = id;
            this.productName = name;
            this.show = true;
        }
    }
}
</script>
@endsection
