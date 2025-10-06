@extends('Admin.layouts.admin')

@section('title', 'Add Product')
@section('page-title', 'Add New Product')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-md shadow-md">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Create New Product</h3>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Added enctype for image uploads --}}
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-gray-700 font-medium">Product Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                   placeholder="Enter product name" required>
        </div>

        <div>
            <label for="description" class="block text-gray-700 font-medium">Description</label>
            <textarea name="description" id="description" rows="3"
                      class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                      placeholder="Optional">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="price" class="block text-gray-700 font-medium">Price</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                   placeholder="Enter price" required>
        </div>

        <div>
            <label for="stock" class="block text-gray-700 font-medium">Stock</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                   placeholder="Enter stock quantity" required>
        </div>

        <div>
            <label for="category_id" class="block text-gray-700 font-medium">Category</label>
            <select name="category_id" id="category_id"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- 🖼️ Photo 1 Upload --}}
        <div>
            <label for="photo1" class="block text-gray-700 font-medium">Photo 1</label>
            <input type="file" name="photo1" id="photo1" accept="image/*"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        {{-- 🖼️ Photo 2 Upload --}}
        <div>
            <label for="photo2" class="block text-gray-700 font-medium">Photo 2</label>
            <input type="file" name="photo2" id="photo2" accept="image/*"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.products.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
               Cancel
            </a>
            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                <i class="fa-solid fa-save mr-1"></i> Save
            </button>
        </div>
    </form>
</div>
@endsection
