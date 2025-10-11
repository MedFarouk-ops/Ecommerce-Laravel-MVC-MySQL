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

    <!-- Professional note about filtering -->
    <p class="text-muted small mb-3">
        You can search products and reuse these filters. Filters only apply to the products currently listed on this page.
    </p>

    <ul class="nav flex-column" id="categoryList">
        <li class="nav-item mb-2">
            <button class="btn btn-outline-dark w-100 active" data-category="all">
                <i class="bi bi-grid me-2"></i>All Products
            </button>
        </li>
        @foreach($categories as $category)
        <li class="nav-item mb-2">
            <button class="btn btn-outline-dark w-100" data-category="{{ $category->id }}">
                <i class="bi bi-tag me-2"></i>{{ $category->name }}
            </button>
        </li>
        @endforeach
    </ul>
</div>

</nav>
