<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Farouk Electronics - {{ $product->name }}</title>

<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Existing CSS -->
<link href="{{ asset('css/client.css') }}" rel="stylesheet">

<!-- Enhanced Product CSS -->
<link href="{{ asset('css/product.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm px-4 py-3">
    <a class="navbar-brand text-dark fw-bold" href="#">
        <i class="bi bi-lightning-charge-fill me-2 text-primary"></i>Farouk Electronics
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="d-flex align-items-center ms-auto">
        <button class="btn btn-outline-secondary me-2 d-md-none" id="mobileSearchBtn">
            <i class="bi bi-search"></i>
        </button>
        <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#sidebar" aria-controls="sidebar"><i class="bi bi-list"></i></button>
    </div>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('client.dashboard') }}">Products</a>
            </li>

            <!-- Cart Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="cartDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-cart-fill me-1"></i> Cart
                    <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="cartDropdown" style="min-width: 300px;">
                    <li id="cartItemsList">Your cart is empty</li>
                    <li><hr class="dropdown-divider"></li>
                    <li class="text-center">
                        <a href="{{ route('client.cart') }}" class="btn btn-primary btn-sm w-100">Go to Cart</a>
                    </li>
                </ul>
            </li>

            <!-- Auth Links -->
            @guest
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('register') }}">Register</a></li>
            @endguest

            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Command History</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
            @endauth
        </ul>
    </div>
</nav>

<!-- Breadcrumb -->
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="{{ route('client.dashboard') }}"><i class="bi bi-house-door me-1"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('client.dashboard') }}">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>
</div>

<!-- Main Content -->
<main class="container flex-grow-1 mb-5">
    <div class="product-container">
        <div class="row g-0">
            
            <!-- Left: Image Gallery -->
            <div class="col-lg-6 product-gallery">
                <div class="gallery-wrapper">
                    <!-- Badge for Stock Status -->
                    <div class="stock-badge {{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}">
                        @if($product->stock > 0)
                            <i class="bi bi-check-circle-fill me-1"></i> In Stock
                        @else
                            <i class="bi bi-x-circle-fill me-1"></i> Out of Stock
                        @endif
                    </div>

                    <!-- Main Image Carousel -->
                    <div id="productCarousel" class="carousel slide main-image-wrapper" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @if($product->photo1)
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/' . $product->photo1) }}" class="d-block w-100 main-image" alt="{{ $product->name }}">
                            </div>
                            @endif
                            @if($product->photo2)
                            <div class="carousel-item {{ $product->photo1 ? '' : 'active' }}">
                                <img src="{{ asset('storage/' . $product->photo2) }}" class="d-block w-100 main-image" alt="{{ $product->name }}">
                            </div>
                            @endif
                            @if(!$product->photo1 && !$product->photo2)
                            <div class="carousel-item active">
                                <div class="placeholder-image">
                                    <i class="bi bi-image"></i>
                                    <p>No Image Available</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if($product->photo1 && $product->photo2)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right: Product Details -->
            <div class="col-lg-6 product-details">
                <div class="details-content">
                    
                    <!-- Product Title -->
                    <h1 class="product-title">{{ $product->name }}</h1>

                    <!-- Rating (Optional - can be added later) -->
                    <div class="product-rating mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                        <span class="ms-2 text-muted">(4.5/5) - 128 reviews</span>
                    </div>

                    <!-- Price -->
                    <div class="price-section">
                        <div class="current-price">{{ number_format($product->price, 2) }} DT</div>
                        <!-- Optional: Show original price if discounted -->
                        <!-- <div class="original-price">599.00 DT</div> -->
                    </div>

                    <!-- Stock Info -->
                    <div class="stock-info">
                        <i class="bi bi-box-seam me-2"></i>
                        <span class="stock-label">Availability:</span>
                        <span class="stock-value {{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $product->stock > 0 ? $product->stock . ' units in stock' : 'Out of Stock' }}
                        </span>
                    </div>

                    <hr class="my-4">

                    <!-- Description -->
                    <div class="product-description">
                        <h5 class="section-title">Description</h5>
                        <p>{{ $product->description ?? 'High-quality electronic product designed for excellence and reliability. Perfect for your everyday needs with modern features and exceptional performance.' }}</p>
                    </div>

                    <!-- Features List -->
                    <div class="product-features">
                        <h5 class="section-title">Key Features</h5>
                        <ul class="features-list">
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Premium Quality Materials</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Energy Efficient Design</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>1 Year Warranty Included</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Fast & Secure Delivery</li>
                        </ul>
                    </div>

                    <hr class="my-4">

                    <!-- Quantity Selector -->
                    <div class="quantity-section">
                        <label class="quantity-label">Quantity:</label>
                        <div class="quantity-controls">
                            <button class="qty-btn qty-minus" id="qtyMinus">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="number" class="qty-input" id="qtyInput" value="1" min="1" max="{{ $product->stock }}" readonly>
                            <button class="qty-btn qty-plus" id="qtyPlus">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button class="btn btn-add-cart add-to-cart-btn" data-id="{{ $product->id }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            <i class="bi bi-cart-plus me-2"></i>Add to Cart
                        </button>
                        <button class="btn btn-buy-now" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            <i class="bi bi-lightning-fill me-2"></i>Buy Now
                        </button>
                    </div>

                    <!-- Additional Info -->
                    <div class="additional-info">
                        <div class="info-item">
                            <i class="bi bi-truck"></i>
                            <div>
                                <strong>Free Delivery</strong>
                                <p>On orders over 100 DT</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-arrow-clockwise"></i>
                            <div>
                                <strong>Easy Returns</strong>
                                <p>30-day return policy</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-shield-check"></i>
                            <div>
                                <strong>Secure Payment</strong>
                                <p>100% secure transactions</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Toast Notification -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="cartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                Product added to cart successfully!
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Cart Management
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Quantity Controls
const qtyInput = document.getElementById('qtyInput');
const qtyMinus = document.getElementById('qtyMinus');
const qtyPlus = document.getElementById('qtyPlus');
const maxStock = parseInt('{{ $product->stock }}');

qtyMinus.addEventListener('click', () => {
    let currentQty = parseInt(qtyInput.value);
    if (currentQty > 1) {
        qtyInput.value = currentQty - 1;
    }
});

qtyPlus.addEventListener('click', () => {
    let currentQty = parseInt(qtyInput.value);
    if (currentQty < maxStock) {
        qtyInput.value = currentQty + 1;
    }
});

// Add to Cart
document.querySelector('.add-to-cart-btn').addEventListener('click', function() {
    const quantity = parseInt(qtyInput.value);
    
    const product = {
        id: '{{ $product->id }}',
        name: '{{ $product->name }}',
        price: parseFloat('{{ $product->price }}'),
        stock: maxStock,
        qty: quantity
    };

    const existing = cart.find(p => p.id == product.id);
    if (existing) {
        const newQty = existing.qty + quantity;
        if(newQty <= product.stock) {
            existing.qty = newQty;
        } else {
            existing.qty = product.stock;
        }
    } else {
        cart.push(product);
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Show toast notification
    const toastEl = document.getElementById('cartToast');
    const toast = new bootstrap.Toast(toastEl);
    toast.show();

    // Update cart count if exists
    updateCartCount();
    
    // Reset quantity
    qtyInput.value = 1;
});

// Update cart count
function updateCartCount() {
    const cartCountEl = document.getElementById('cartCount');
    if (cartCountEl) {
        const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
        cartCountEl.textContent = totalItems;
    }
}

// Initialize cart count on page load
updateCartCount();

// Thumbnail click handler
document.querySelectorAll('.thumb-wrapper').forEach((thumb, index) => {
    thumb.addEventListener('click', function() {
        document.querySelectorAll('.thumb-wrapper').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
    });
});

// Update active thumbnail on carousel slide
const carousel = document.getElementById('productCarousel');
if (carousel) {
    carousel.addEventListener('slid.bs.carousel', function(e) {
        const activeIndex = e.to;
        document.querySelectorAll('.thumb-wrapper').forEach((thumb, index) => {
            thumb.classList.toggle('active', index === activeIndex);
        });
    });
}
</script>

</body>
</html>