<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        .sidebar { transition: transform 0.3s ease-in-out; }
        .btn-modern { transition: all 0.2s ease-in-out; display: inline-flex; align-items: center; justify-content: center; }
        .btn-modern:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .nav-item { transition: all 0.2s ease-in-out; display: flex; align-items: center; padding: 12px 16px; color: #6b7280; text-decoration: none; border-radius: 8px; margin-bottom: 4px; }
        .nav-item:hover { background-color: #f3f4f6; color: #374151; transform: translateX(4px); }
        .nav-item.active { background-color: #3b82f6; color: white; }
        .nav-item i { width: 20px; margin-right: 12px; }
    </style>
</head>
<body class="flex min-h-screen font-sans bg-gray-50">

    <!-- Sidebar -->
    @include('Admin.partials.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col md:ml-64">
        @include('Admin.partials.navbar')

        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden hidden"></div>

    @stack('scripts')

</body>
</html>
