@extends('Admin.layouts.admin')

@section('title', 'Edit Website Information')
@section('page-title', 'Edit Website Information')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-md shadow-md">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Edit Website Information</h3>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 text-green-600 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.website-info.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Website Name --}}
        <div>
            <label for="name" class="block text-gray-700 font-medium">Website Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $info->name ?? '') }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                   placeholder="Enter website name" required>
        </div>

        {{-- Logo --}}
        <div>
            <label for="logo" class="block text-gray-700 font-medium">Website Logo</label>
            @if(isset($info) && $info->logo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $info->logo) }}" alt="Logo" class="w-32 h-32 object-cover rounded-md border">
                </div>
            @endif
            <input type="file" name="logo" id="logo" accept="image/*"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        {{-- Hero Section --}}
        <div>
            <label for="hero_title" class="block text-gray-700 font-medium">Hero Title</label>
            <input type="text" name="hero_title" id="hero_title" value="{{ old('hero_title', $info->hero_title ?? '') }}"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                   placeholder="Enter hero title">
        </div>

        <div>
            <label for="hero_description" class="block text-gray-700 font-medium">Hero Description</label>
            <textarea name="hero_description" id="hero_description" rows="3"
                      class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                      placeholder="Enter hero description">{{ old('hero_description', $info->hero_description ?? '') }}</textarea>
        </div>

        {{-- About / Footer --}}
        <div>
            <label for="about_description" class="block text-gray-700 font-medium">About / Footer Description</label>
            <textarea name="about_description" id="about_description" rows="3"
                      class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                      placeholder="Enter about/footer description">{{ old('about_description', $info->about_description ?? '') }}</textarea>
        </div>

        {{-- Contact Info --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="phone" class="block text-gray-700 font-medium">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $info->phone ?? '') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                       placeholder="Enter phone">
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $info->email ?? '') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                       placeholder="Enter email">
            </div>
            <div>
                <label for="address" class="block text-gray-700 font-medium">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $info->address ?? '') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                       placeholder="Enter address">
            </div>
        </div>

        {{-- Social Links --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="facebook" class="block text-gray-700 font-medium">Facebook</label>
                <input type="url" name="facebook" id="facebook" value="{{ old('facebook', $info->facebook ?? '') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                       placeholder="Enter Facebook URL">
            </div>
            <div>
                <label for="twitter" class="block text-gray-700 font-medium">Twitter</label>
                <input type="url" name="twitter" id="twitter" value="{{ old('twitter', $info->twitter ?? '') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                       placeholder="Enter Twitter URL">
            </div>
            <div>
                <label for="instagram" class="block text-gray-700 font-medium">Instagram</label>
                <input type="url" name="instagram" id="instagram" value="{{ old('instagram', $info->instagram ?? '') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                       placeholder="Enter Instagram URL">
            </div>
            <div>
                <label for="linkedin" class="block text-gray-700 font-medium">LinkedIn</label>
                <input type="url" name="linkedin" id="linkedin" value="{{ old('linkedin', $info->linkedin ?? '') }}"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                       placeholder="Enter LinkedIn URL">
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex justify-end gap-3 mt-4">
            <a href="{{ route('admin.dashboard') }}"
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
