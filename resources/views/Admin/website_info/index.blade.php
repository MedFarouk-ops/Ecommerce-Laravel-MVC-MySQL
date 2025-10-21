@extends('Admin.layouts.admin')

@section('title', 'Edit Website Information')
@section('page-title', 'Edit Website Information')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-md shadow-md">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Edit Website Information</h3>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-600 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success Message --}}
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

        {{-- Website Currency --}}
        <div class="mt-4">
                <label for="currency" class="block text-gray-700 font-medium">Website Currency</label>
            <select name="currency" id="currency"
                class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400">
                @php
                    $currencies = [
                        // Global
                        'USD' => 'US Dollar (USD)',
                        'EUR' => 'Euro (EUR)',
                        'GBP' => 'British Pound (GBP)',
                        'JPY' => 'Japanese Yen (JPY)',
                        'AUD' => 'Australian Dollar (AUD)',
                        'CAD' => 'Canadian Dollar (CAD)',
                        'CHF' => 'Swiss Franc (CHF)',
                        'CNY' => 'Chinese Yuan (CNY)',
                        'HKD' => 'Hong Kong Dollar (HKD)',
                        'INR' => 'Indian Rupee (INR)',
                        'SGD' => 'Singapore Dollar (SGD)',
                        'NZD' => 'New Zealand Dollar (NZD)',

                        // African
                        'ZAR' => 'South African Rand (ZAR)',
                        'NGN' => 'Nigerian Naira (NGN)',
                        'KES' => 'Kenyan Shilling (KES)',
                        'GHS' => 'Ghanaian Cedi (GHS)',
                        'TZS' => 'Tanzanian Shilling (TZS)',

                        // Asian
                        'KRW' => 'South Korean Won (KRW)',
                        'THB' => 'Thai Baht (THB)',
                        'MYR' => 'Malaysian Ringgit (MYR)',
                        'PHP' => 'Philippine Peso (PHP)',
                        'VND' => 'Vietnamese Dong (VND)',
                        'IDR' => 'Indonesian Rupiah (IDR)',

                        // Arab countries
                        'AED' => 'UAE Dirham (AED)',
                        'SAR' => 'Saudi Riyal (SAR)',
                        'KWD' => 'Kuwaiti Dinar (KWD)',
                        'QAR' => 'Qatari Riyal (QAR)',
                        'BHD' => 'Bahraini Dinar (BHD)',
                        'OMR' => 'Omani Rial (OMR)',
                        'JOD' => 'Jordanian Dinar (JOD)',
                        'EGP' => 'Egyptian Pound (EGP)',
                        'MAD' => 'Moroccan Dirham (MAD)',
                        'DZD' => 'Algerian Dinar (DZD)',
                        'TND' => 'Tunisian Dinar (TND)',
                        'LYD' => 'Libyan Dinar (LYD)',
                        'IQD' => 'Iraqi Dinar (IQD)',
                        'SDG' => 'Sudanese Pound (SDG)',
                        'SYP' => 'Syrian Pound (SYP)',
                        'LBP' => 'Lebanese Pound (LBP)',
                        'MRU' => 'Mauritanian Ouguiya (MRU)',
                        'JOD' => 'Jordanian Dinar (JOD)',
                    ];
                @endphp

                @foreach($currencies as $code => $label)
                    <option value="{{ $code }}" {{ old('currency', $info->currency ?? '') === $code ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- Shipping fee --}}

        <div class="mt-4">
            <label for="shipping_fee" class="block text-gray-700 font-medium">Shipping Fee</label>
            <input type="number" name="shipping_fee" id="shipping_fee" min="0" step="1"
                value="{{ old('shipping_fee', $info->shipping_fee ?? 0) }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                placeholder="Enter shipping fee" required>
        </div>

        {{-- Free Shipping Threshhold --}}

        <div class="mt-4">
            <label for="free_shipping_threshhold" class="block text-gray-700 font-medium">Free Shipping threshhold</label>
            <input type="number" name="free_shipping_threshhold" id="free_shipping_threshhold" min="0" step="1"
                value="{{ old('free_shipping_threshhold', $info->free_shipping_threshhold ?? 0) }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                placeholder="Enter shipping fee" required>
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

        {{-- ============ NEW INFO SECTIONS ============ --}}

        <hr class="my-6 border-gray-300">

        <h4 class="text-lg font-semibold text-gray-800">Additional Information</h4>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="shipping_info" class="block text-gray-700 font-medium">Free Shipping Info</label>
                <textarea name="shipping_info" id="shipping_info" rows="2"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                    placeholder="Enter shipping info">{{ old('shipping_info', $info->shipping_info ?? '') }}</textarea>
            </div>
            <div>
                <label for="secure_payment_info" class="block text-gray-700 font-medium">Secure Payment Info</label>
                <textarea name="secure_payment_info" id="secure_payment_info" rows="2"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                    placeholder="Enter secure payment info">{{ old('secure_payment_info', $info->secure_payment_info ?? '') }}</textarea>
            </div>
            <div>
                <label for="easy_returns_info" class="block text-gray-700 font-medium">Easy Returns Info</label>
                <textarea name="easy_returns_info" id="easy_returns_info" rows="2"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                    placeholder="Enter easy returns info">{{ old('easy_returns_info', $info->easy_returns_info ?? '') }}</textarea>
            </div>
        </div>

        {{-- Website Pages --}}
        <hr class="my-6 border-gray-300">
        <h4 class="text-lg font-semibold text-gray-800">Website Pages Content</h4>

        @foreach ([
            'about_us' => 'About Us',
            'contact' => 'Contact',
            'faq' => 'FAQ',
            'privacy_policy' => 'Privacy Policy',
            'terms_service' => 'Terms of Service'
        ] as $key => $label)
            <div class="mt-4">
                <label class="block text-gray-700 font-medium">{{ $label }} Title</label>
                <input type="text" name="{{ $key }}_title" value="{{ old($key.'_title', $info->{$key.'_title'} ?? '') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                    placeholder="Enter {{ strtolower($label) }} title">

                <label class="block text-gray-700 font-medium mt-2">{{ $label }} Description</label>
                <textarea name="{{ $key }}_description" rows="3"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400"
                    placeholder="Enter {{ strtolower($label) }} description">{{ old($key.'_description', $info->{$key.'_description'} ?? '') }}</textarea>
            </div>
        @endforeach

        {{-- Theme Selection --}}
        <hr class="my-6 border-gray-300">

        <h4 class="text-lg font-semibold text-gray-800 mb-3">Select Website Theme</h4>

        <div class="flex flex-wrap gap-4">
            @php
                $themes = [
                    ['name' => 'Basic', 'file' => 'client-theme-basic.css', 'color' => '#e5e7eb'], // gray/white
                    ['name' => 'Sky Blue', 'file' => 'client-theme-bluesky.css', 'color' => '#87ceeb'],
                    ['name' => 'Green', 'file' => 'client-theme-green.css', 'color' => '#28a745'],
                    ['name' => 'Pink', 'file' => 'client-theme-pink.css', 'color' => '#ff69b4'],
                    ['name' => 'Yellow', 'file' => 'client-theme-yellow.css', 'color' => '#F2F527'],
                    ['name' => 'Gray-Red', 'file' => 'client-theme-redgray.css', 'color' => '#FF2800'],
                    ['name' => 'Gray-Brown', 'file' => 'client-theme-browngray.css', 'color' => '#4D2C2A'],
                ];
                $selectedTheme = old('theme_fullname', $info->theme_fullname ?? '');
            @endphp

            @foreach ($themes as $theme)
                <label class="cursor-pointer">
                    <input type="radio" name="theme_fullname" value="{{ $theme['file'] }}"
                        class="hidden peer"
                        {{ $selectedTheme === $theme['file'] ? 'checked' : '' }}>
                    <div class="w-24 h-20 rounded-lg border-2 border-gray-300 peer-checked:border-blue-500 flex flex-col items-center justify-center shadow-sm hover:shadow-md transition">
                        <div class="w-10 h-10 rounded-md mb-2" style="background-color: {{ $theme['color'] }}"></div>
                        <span class="text-sm font-medium text-gray-700">{{ $theme['name'] }}</span>
                    </div>
                </label>
            @endforeach
        </div>


        {{-- Submit --}}
        <div class="flex justify-end gap-3 mt-6">
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
