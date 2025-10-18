<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronics - Premium Electronics Store</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    @include('Client.components.navbar')

    <!-- Enhanced Hero Section -->
    <section class="hero text-center py-5 px-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-3 display-5">{{ $websiteInfo->hero_title ?? 'Quality Electronics, Delivered Fast' }}</h2>
                    <p class="lead mb-4">{{ $websiteInfo->hero_description ?? 'Reliable gadgets for home, work, and play. Explore the latest in electronics with secure checkout and fast shipping.' }}</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <span class="badge bg-white text-primary px-3 py-2 fs-6">
                            <i class="bi bi-truck me-2"></i>{{ $websiteInfo->shipping_info ?? 'Free Shipping' }}
                        </span>
                        <span class="badge bg-white text-primary px-3 py-2 fs-6">
                            <i class="bi bi-shield-check me-2"></i>{{ $websiteInfo->secure_payment_info ?? 'Secure Payment' }}
                        </span>
                        <span class="badge bg-white text-primary px-3 py-2 fs-6">
                            <i class="bi bi-arrow-clockwise me-2"></i>{{ $websiteInfo->easy_returns_info ?? 'Easy Returns' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!-- Promotions Banner Slider -->
    @if(isset($promotions) && $promotions->count() > 0)
    <section class="promotions-banner py-3">
        <div class="container-fluid px-0">
            <div id="promotionsSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    @foreach($promotions as $index => $promotion)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <a href="{{ $promotion->link ?? '#' }}" target="_blank" class="d-block text-center">
                            <img src="{{ asset('storage/' . $promotion->image) }}" 
                                class="promotion-image" 
                                alt="{{ $promotion->title ?? 'Promotion' }}">
                        </a>
                    </div>
                    @endforeach
                </div>

                <!-- Optional controls -->
                @if($promotions->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#promotionsSlider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#promotionsSlider" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
                @endif
            </div>
        </div>
    </section>
    @endif
    <!-- Main Content -->
    <div class="container-fluid flex-grow-1 py-4">
        <div class="row g-0">
        <!-- Enhanced Sidebar -->
        @include('Client.components.sidebar')

            <!-- Enhanced Products Section -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Search and Filter Bar -->
               <div class="row mb-4 align-items-center">
                <div class="col-md-8">
                    <!-- Desktop search bar -->
                    <div class="d-none d-md-block">
                        <form action="{{ route('client.search') }}" method="GET">
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" name="query" class="form-control border-start-0 ps-0" 
                                    placeholder="Search for products..." 
                                    value="{{ request('query') }}" 
                                    id="desktopSearch">
                                <button type="submit" class="btn btn-secondary">Search</button>
                            </div>
                        </form>
                    </div>
                    <!-- Mobile search bar -->
                    <div class="d-md-none" id="mobileSearchContainer">
                        <form action="{{ route('client.search') }}" method="GET">
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" name="query" class="form-control border-start-0 ps-0" 
                                    placeholder="Search products..." 
                                    value="{{ request('query') }}" 
                                    id="mobileSearch">
                                 <button type="submit" class="btn btn-secondary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 text-end d-none d-md-block">
                    <button class="btn btn-outline-secondary" data-bs-toggle="dropdown">
                        <i class="bi bi-sort-down me-2"></i>Sort By
                    </button>
                <ul class="dropdown-menu dropdown-menu-end" id="sortDropdown">
                        <li><a class="dropdown-item" href="#" data-sort="featured"><i class="bi bi-star me-2"></i>Featured</a></li>
                        <li><a class="dropdown-item" href="#" data-sort="price-asc"><i class="bi bi-arrow-up me-2"></i>Price: Low to High</a></li>
                        <li><a class="dropdown-item" href="#" data-sort="price-desc"><i class="bi bi-arrow-down me-2"></i>Price: High to Low</a></li>
                        <li><a class="dropdown-item" href="#" data-sort="newest"><i class="bi bi-calendar me-2"></i>Newest</a></li>
                    </ul>
                </div>
            </div>


                <!-- Products Counter -->
                <div class="mb-3">
                    <p class="text-muted mb-0">
                        <i class="bi bi-box-seam me-2"></i>
                        <span id="productCount">{{ count($products) }}</span> Products Available
                    </p>
                </div>

                <!-- Enhanced Product Grid -->
                <div class="row g-4" id="productGrid">
                    @foreach($products as $product)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 product-card" 
                         data-category="{{ $product->category_id }}" 
                         data-id="{{ $product->id }}">
                        <div class="card glass-card h-100 border-0">
                            <!-- Product Image -->
                           <div class="product-image-wrapper mb-2">
                            @if($product->photo1)
                                <img src="{{ asset('storage/' . $product->photo1) }}" 
                                    alt="{{ $product->name }}" 
                                    class="product-image img-fluid">
                            @else
                                <i class="bi bi-box display-1 text-primary"></i>
                            @endif
                      
                                <!-- Stock Badge -->
                                @if($product->stock > 0)
                                    <span class="badge bg-success position-absolute top-0 end-0 m-2">
                                        <i class="bi bi-check-circle me-1"></i>In Stock
                                    </span>
                                @else
                                    <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                                        <i class="bi bi-x-circle me-1"></i>Out of Stock
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Product Info -->
                            <div class="card-body d-flex flex-column p-3">
                                <h5 class="card-title mb-2">{{ $product->name }}</h5>
                                
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-success fw-bold fs-4">{{ $product->price }} {{ $websiteInfo->currency ?? 'DT'}}</span>
                                        <span class="text-muted small">
                                            <i class="bi bi-box me-1"></i>{{ $product->stock }}
                                        </span>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="d-grid gap-2">
                                        @if($product->stock > 0)
                                            <button class="btn btn-outline-primary btn-sm add-to-cart-btn" 
                                                    data-product-id="{{ $product->id }}">
                                                <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                            </button>
                                        @else
                                            <button class="btn btn-outline-secondary btn-sm" disabled>
                                                <i class="bi bi-x-circle me-2"></i>Out of Stock
                                            </button>
                                        @endif
                                        <a href="{{ route('client.product.show', $product->id) }}" 
                                           class="btn btn-primary btn-sm">
                                            <i class="bi bi-eye me-2"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Empty State (if no products) -->
                @if(count($products) == 0)
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                    <h3 class="text-muted">No products found</h3>
                    <p class="text-muted">Try adjusting your filters or search terms</p>
                </div>
                @endif
            </main>
        </div>

        

    </div>
    <div class="mt-6 flex justify-center">
            {{ $products->links() }}
    </div>
    <!-- Enhanced Footer -->
    @include('Client.components.footer')

    <!-- Mobile Filter Button (Fixed) -->
    <button id="sidebarToggle" class="btn btn-primary d-md-none position-fixed bottom-0 start-0 m-3 rounded-circle shadow-lg" 
        style="width: 56px; height: 56px; z-index: 1020;">
        <i class="bi bi-funnel fs-5"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/client.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>

</body>
</html>