<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Admin CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <!-- FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="flex min-h-screen font-sans bg-gray-100">

    <!-- Sidebar -->
    <aside class="sidebar flex flex-col gap-6 p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Admin Panel</h1>
        <a href="#" class="active"><i class="fa-solid fa-gauge mr-3"></i> Dashboard</a>
        <a href="#"><i class="fa-solid fa-layer-group mr-3"></i> Categories</a>
        <a href="#"><i class="fa-solid fa-box-open mr-3"></i> Products</a>
        <a href="#"><i class="fa-solid fa-receipt mr-3"></i> Orders</a>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">

        <!-- Top Navbar -->
        <div class="top-navbar mb-8 flex justify-between items-center">
            <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>
            <button class="btn-modern"><i class="fa-solid fa-right-from-bracket mr-2"></i> Logout</button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 grid-dashboard">
            <div class="card-stats card-orders relative">
                <div class="icon"><i class="fa-solid fa-cart-shopping"></i></div>
                <p class="text-gray-500 font-semibold">Total Orders</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">1,245</p>
                <p class="text-green-500 mt-1">+12% from last month</p>
            </div>

            <div class="card-stats card-revenue relative">
                <div class="icon"><i class="fa-solid fa-dollar-sign"></i></div>
                <p class="text-gray-500 font-semibold">Net Revenue</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">$32,400</p>
                <p class="text-green-500 mt-1">+8% from last month</p>
            </div>

            <div class="card-stats card-growth relative">
                <div class="icon"><i class="fa-solid fa-chart-line"></i></div>
                <p class="text-gray-500 font-semibold">Growth</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">18%</p>
                <p class="text-green-500 mt-1">Compared to last quarter</p>
            </div>
        </div>

        <!-- Recent Activity Table -->
        <div class="table-container">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h3>
            <table class="w-full table-auto text-left border-collapse">
                <thead class="text-gray-500 uppercase text-sm">
                    <tr>
                        <th class="pb-3">Activity</th>
                        <th class="pb-3">Date</th>
                        <th class="pb-3">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr class="hover:bg-gray-200/30 transition">
                        <td class="py-2">New order #1024</td>
                        <td>2 hours ago</td>
                        <td><span class="badge badge-success">Completed</span></td>
                    </tr>
                    <tr class="hover:bg-gray-200/30 transition">
                        <td class="py-2">Product "Laptop X" added</td>
                        <td>5 hours ago</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                    </tr>
                    <tr class="hover:bg-gray-200/30 transition">
                        <td class="py-2">Category "Accessories" updated</td>
                        <td>1 day ago</td>
                        <td><span class="badge badge-danger">Failed</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>

</body>
</html>
