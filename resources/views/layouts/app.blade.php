<!DOCTYPE html>
<!--
    ------------------------------------------------------------------------------
    © 2025 Mohamed Farouk Khabir. All rights reserved.

    Licensed under the MIT License with attribution required.
    
    You are free to use, modify, and distribute this software, provided that
    proper attribution to the original author is maintained.
    ------------------------------------------------------------------------------
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Electronics - Profile</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
         <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('Client.components.navbar')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <!-- Enhanced Footer -->
        @include('Client.components.footer')
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/client.js') }}"></script>
        <script src="{{ asset('js/cart.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>
