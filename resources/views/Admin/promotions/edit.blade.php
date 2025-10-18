@extends('Admin.layouts.admin')

@section('title', 'Edit Promotion')
@section('page-title', 'Edit Promotion')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-md shadow-md">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Edit Promotion</h3>

    {{-- ❌ Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-600 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✏️ Edit Form --}}
    <form action="{{ route('admin.promotions.update', $promotion->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- 🏷️ Title --}}
        <div>
            <label for="title" class="block text-gray-700 font-medium">Promotion Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $promotion->title) }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                   placeholder="Enter promotion title" required>
        </div>

        {{-- 📝 Description --}}
        <div>
            <label for="description" class="block text-gray-700 font-medium">Description</label>
            <textarea name="description" id="description" rows="3"
                      class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                      placeholder="Optional">{{ old('description', $promotion->description) }}</textarea>
        </div>

        {{-- 🔗 Link --}}
        <div>
            <label for="link" class="block text-gray-700 font-medium">Promotion Link</label>
            <input type="url" name="link" id="link" value="{{ old('link', $promotion->link) }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                   placeholder="https://example.com" required>
        </div>

        {{-- 🖼️ Current Image Preview --}}
        <div>
            <label for="image" class="block text-gray-700 font-medium">Current Image</label>
            @if ($promotion->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $promotion->image) }}"
                         alt="Promotion Image"
                         class="w-32 h-32 object-cover rounded-md border">
                </div>
            @else
                <p class="text-gray-400 italic mb-2">No image uploaded</p>
            @endif

            <label class="block text-gray-700 font-medium mt-2">Replace Image (optional)</label>
            <input type="file" name="image" id="image" accept="image/*"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        {{-- ✅ Active Toggle --}}
        <div class="flex items-center gap-2">
       <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                class="w-4 h-4 text-blue-500 border-gray-300 rounded focus:ring-blue-400"
                {{ old('is_active', $promotion->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="text-gray-700 font-medium">Active</label>
        </div>

        {{-- 🔘 Actions --}}
        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('admin.promotions.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                Cancel
            </a>
            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                <i class="fa-solid fa-save mr-1"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
