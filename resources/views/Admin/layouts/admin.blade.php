<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        .sidebar { transition: transform 0.3s ease-in-out; }
        .btn-modern { 
            transition: all 0.2s ease-in-out; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
        }
        .btn-modern:hover { 
            transform: translateY(-1px); 
            box-shadow: 0 4px 12px rgba(0,0,0,0.15); 
        }
        .nav-item { 
            transition: all 0.2s ease-in-out; 
            display: flex; 
            align-items: center; 
            padding: 12px 16px; 
            color: #6b7280; 
            text-decoration: none; 
            border-radius: 8px; 
            margin-bottom: 4px; 
        }
        .nav-item:hover { 
            background-color: #f3f4f6; 
            color: #374151; 
            transform: translateX(4px); 
        }
        .nav-item.active { 
            background-color: #3b82f6; 
            color: white; 
        }
        .nav-item i { 
            width: 20px; 
            margin-right: 12px; 
        }
        
        /* Ensure proper spacing on mobile */
        @media (max-width: 767px) {
            .main-content {
                padding-top: 64px; /* Height of fixed navbar */
            }
        }
        
        /* Desktop layout */
        @media (min-width: 768px) {
            .main-content {
                margin-left: 256px; /* Width of sidebar */
            }
        }

         /* Spinner styles */
        #loader {
            position: fixed;
            inset: 0;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }
        #loader.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #e5e7eb;
            border-top-color: #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

    </style>
</head>
<body class="bg-gray-50">
    <!-- Loader Spinner -->
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <!-- Sidebar -->
    @include('Admin.partials.sidebar')

    <!-- Main Content Wrapper -->
    <div class="main-content min-h-screen flex flex-col">
        @include('Admin.partials.navbar')

        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>
    </div>

    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden"></div>

    @stack('scripts')
    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            loader.classList.add('fade-out');
            setTimeout(() => loader.style.display = 'none', 500);
        });
    </script>
</body>
</html>