<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
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
<body class="d-flex flex-column min-vh-100">
    @include('Client.components.navbar')

    @yield('content')

    @include('Client.components.footer')

    <button id="sidebarToggle" class="btn btn-primary d-md-none position-fixed bottom-0 start-0 m-3 rounded-circle shadow-lg" 
        style="width: 56px; height: 56px; z-index: 1020;">
        <i class="bi bi-funnel fs-5"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/client.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
</body>
</html>
