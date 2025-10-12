<aside id="sidebar" class="sidebar fixed inset-y-0 left-0 w-64 bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 overflow-y-auto">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="flex items-center justify-between h-16 bg-blue-600 text-white px-4 flex-shrink-0">
            <h1 class="text-lg sm:text-xl font-bold flex items-center">
                <i class="fas fa-shield-alt mr-2"></i> 
                <span>Admin Panel</span>
            </h1>
            <!-- Close button for mobile -->
            <button id="sidebarClose" class="md:hidden p-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-white">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 overflow-y-auto">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i> 
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                        <i class="fas fa-layer-group"></i> 
                        <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                        <i class="fas fa-box-open"></i> 
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.promotions.index') }}" class="nav-item {{ request()->routeIs('admin.promotions*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn"></i> 
                        <span>Promotions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                        <i class="fas fa-receipt"></i> 
                        <span>Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.website-info.edit') }}" class="nav-item {{ request()->routeIs('admin.website-info*') ? 'active' : '' }}">
                        <i class="fas fa-globe"></i> 
                        <span>Website Info</span>
                    </a>
                </li>                
            </ul>
        </nav>

        <!-- User Info -->
        <div class="p-4 border-t flex-shrink-0">
            <div class="flex items-center space-x-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=ffffff" 
                     class="w-10 h-10 rounded-full flex-shrink-0" alt="Admin">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
</aside>