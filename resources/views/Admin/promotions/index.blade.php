@extends('Admin.layouts.admin')

@section('title', 'Promotions')
@section('page-title', 'Promotions')

@section('content')
<div x-data="promotionDelete()" x-cloak>

    <!-- ✅ Success Message -->
    @if (session('success'))
        <div x-show="true" x-transition
             class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-6">
            <strong class="font-bold">Success! </strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- 🧭 Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h3 class="text-xl font-semibold text-gray-800">Promotion List</h3>
        <a href="{{ route('admin.promotions.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Add Promotion
        </a>
    </div>

    <!-- 📋 Table -->
    <div class="overflow-x-auto bg-white rounded-md shadow-md">
        <table class="min-w-full text-left border-collapse">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                <tr>
                    <th class="px-4 py-3 border-b">#</th>
                    <th class="px-4 py-3 border-b">Title</th>
                    <th class="px-4 py-3 border-b">Image</th>
                    <th class="px-4 py-3 border-b">Link</th>
                    <th class="px-4 py-3 border-b">Active</th>
                    <th class="px-4 py-3 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($promotions as $promotion)
                <tr class="hover:bg-gray-200/30 transition">
                    <td class="px-4 py-2 border-b">{{ $promotion->id }}</td>
                    <td class="px-4 py-2 border-b">{{ $promotion->title }}</td>
                    <td class="px-4 py-2 border-b">
                        @if($promotion->image)
                            <img src="{{ asset('storage/' . $promotion->image) }}"
                                 alt="{{ $promotion->title }}"
                                 class="w-16 h-16 object-cover rounded-md border">
                        @else
                            <span class="text-gray-400 italic">No image</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border-b">
                        <a href="{{ $promotion->link }}" target="_blank" class="text-blue-500 hover:underline">
                            {{ Str::limit($promotion->link, 30) }}
                        </a>
                    </td>
                    <td class="px-4 py-2 border-b">
                        <span class="px-2 py-1 rounded-md text-sm font-medium
                            {{ $promotion->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                            {{ $promotion->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border-b text-center flex flex-col sm:flex-row justify-center gap-2">
                        <a href="{{ route('admin.promotions.edit', $promotion->id) }}"
                           class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600 flex items-center justify-center gap-1">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>

                        <button @click="openModal({{ $promotion->id }}, '{{ addslashes($promotion->title) }}')"
                                class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 flex items-center justify-center gap-1">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-4">No promotions found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- 🗑️ Delete Modal -->
    <div x-show="show" x-transition.opacity
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
         style="display: none;">
        <div @click.away="show = false" class="bg-white rounded-md shadow-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Confirm Delete</h3>
            <p class="mb-4">Are you sure you want to delete <strong x-text="promotionName"></strong>?</p>
            <div class="flex justify-end gap-3">
                <button @click="show = false" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                    Cancel
                </button>
                <form :action="`/admin/promotions/${promotionId}`" method="POST" class="inline">
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

    <!-- 📄 Pagination -->
    <div class="mt-4 flex justify-center">
        {{ $promotions->links() }}
    </div>
</div>

<script>
function promotionDelete() {
    return {
        show: false,
        promotionId: null,
        promotionName: '',
        openModal(id, name) {
            this.promotionId = id;
            this.promotionName = name;
            this.show = true;
        }
    }
}
</script>
@endsection
