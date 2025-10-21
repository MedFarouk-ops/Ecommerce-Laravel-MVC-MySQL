@extends('Admin.layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('content')
<div x-data="categoryDelete()" x-cloak>
    <!-- Success Alert -->
    @if (session('success'))
        <div x-show="true" x-transition class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-6">
            <strong class="font-bold">Success! </strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold text-gray-800">Category List</h3>
        <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 inline-flex items-center">
            <i class="fa-solid fa-plus mr-2"></i> Add Category
        </a>
    </div>

         <!-- Search bar -->
    <div class="mb-6">
    <form action="{{ route('admin.categories.search') }}" method="GET" class="flex flex-col sm:flex-row gap-3 sm:gap-2">
        <input 
            type="text" 
            name="query" 
            value="{{ request('query') }}" 
            class="flex-1 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Search categories by name..."
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
                    <th class="px-6 py-3 border-b">#</th>
                    <th class="px-6 py-3 border-b">Name</th>
                    <th class="px-6 py-3 border-b">Description</th>
                    <th class="px-6 py-3 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($categories as $category)
                <tr class="hover:bg-gray-200/30 transition">
                    <td class="px-6 py-3 border-b">{{ $category->id }}</td>
                    <td class="px-6 py-3 border-b">{{ $category->name }}</td>
                    <td class="px-6 py-3 border-b">{{ $category->description }}</td>
                    <td class="px-6 py-3 border-b text-center flex justify-center gap-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                           class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
                           <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <button @click="openModal({{ $category->id }}, '{{ $category->name }}')"
                                class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-4">No category found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Single Delete Modal -->
    <div x-show="show" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div @click.away="show = false" class="bg-white rounded-md shadow-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Confirm Delete</h3>
            <p class="mb-4">Are you sure you want to delete <strong x-text="categoryName"></strong>?</p>
            <div class="flex justify-end gap-3">
                <button @click="show = false"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                    Cancel
                </button>
                <form :action="`/admin/categories/${categoryId}`" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="mt-4 flex justify-center">
        {{ $categories->links() }}
    </div>
</div>

<!-- Alpine.js -->
<script>
function categoryDelete() {
    return {
        show: false,
        categoryId: null,
        categoryName: '',
        openModal(id, name) {
            this.categoryId = id;
            this.categoryName = name;
            this.show = true;
        }
    }
}
</script>
@endsection
