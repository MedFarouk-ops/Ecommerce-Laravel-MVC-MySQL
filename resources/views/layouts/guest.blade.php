<!DOCTYPE html>
<!--
    ------------------------------------------------------------------------------
    © 2025 Mohamed Farouk Khabir. All rights reserved.

    This template is licensed for **single-use only**. 
    The buyer is permitted to make **only one live version** of this template on the internet.

    Prohibited:
    - Reselling, redistributing, or sharing this template.
    - Making multiple live versions or using it for multiple projects.

    Unauthorized redistribution may result in legal action. 
    By using this template, you agree to comply with the license terms.
    ------------------------------------------------------------------------------
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

        @if (!empty($websiteInfo->logo))
            <link rel="icon" type="image/png" href="{{ asset('storage/' . $websiteInfo->logo) }}?v={{ time() }}">
        @endif
        <!-- Custom theme CSS -->
        @php
            // get stored value or fallback
            $themeFile = $websiteInfo->theme_fullname ?? 'client-base.css';

            // normalize slashes and keep only the basename (filename)
            $themeFile = str_replace('\\', '/', $themeFile);   // convert backslashes to forward
            $themeFile = ltrim($themeFile, '/');               // remove leading slash if any
            $themeFile = basename($themeFile);                 // keep only filename, e.g. client-theme-green.css
        @endphp

        <link href="{{ asset('css/client_themes/' . $themeFile) }}" rel="stylesheet">
    
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-pink-50 via-pink-100 to-pink-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen flex flex-col">

        <!-- Navbar -->
        @include('Client.components.navbar')

        <!-- Main Content Wrapper -->
        <div class="flex flex-col sm:justify-center items-center flex-1 w-full pt-6 sm:pt-12 px-4">
            <!-- Slot Card -->
            <div class="w-full sm:max-w-md bg-white dark:bg-gray-800 shadow-2xl rounded-2xl p-8 sm:p-10 transition-transform transform hover:scale-105 border border-pink-100 dark:border-gray-700">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        @include('Client.components.footer')

        <!-- JS Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/client.js') }}"></script>
        <script src="{{ asset('js/cart.js') }}"></script>
    </body>

</html>
