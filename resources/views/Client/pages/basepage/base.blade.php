<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
