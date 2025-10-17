<nav id="sidebar" class="sidebar bg-white border-end shadow-sm col-md-3 col-lg-2 d-none d-md-block">
    <!-- Header (mobile only) -->
    <div class="sidebar-header d-flex justify-content-between align-items-center d-md-none p-3 border-bottom">
        <h5 class="fw-semibold mb-0">
            <i class="bi bi-funnel me-2 text-primary"></i>Categories
        </h5>
        <button type="button" class="btn-close" id="closeSidebar"></button>
    </div>

    <div class="sidebar-body position-sticky pt-3 px-3">
        <h6 class="text-uppercase text-muted mb-1 fw-bold d-none d-md-block">
            <i class="bi bi-funnel me-2"></i>Filter by Category
        </h6>

        <p class="text-muted small mb-3">
            You can search products and filter by category. Filters apply to all products in the store.
        </p>

        <ul class="nav flex-column" id="categoryList">
            <!-- All products -->
            <li class="nav-item mb-2">
                <a href="{{ route('client.products.byCategory', 'all') }}"
                   class="btn w-100 {{ request()->is('products/category/all') ? 'btn-dark active' : 'btn-outline-dark' }}">
                    <i class="bi bi-grid me-2"></i>All Products
                </a>
            </li>

            <!-- Categories -->
            @foreach($categories as $category)
                <li class="nav-item mb-2">
                    <a href="{{ route('client.products.byCategory', $category->id) }}"
                       class="btn w-100 {{ request()->is('products/category/'.$category->id) ? 'btn-dark active' : 'btn-outline-dark' }}">
                        <i class="bi bi-tag me-2"></i>{{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
