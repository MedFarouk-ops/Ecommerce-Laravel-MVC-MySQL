<!DOCTYPE html>
<!--
    ------------------------------------------------------------------------------
    © 2025 Mohamed Farouk Khabir. All rights reserved.

    This template is licensed for **single-use only**. 
    The buyer is permitted to make **only one live version** of this template on the internet.

    Prohibited:
    - Reselling, redistributing, or sharing this template.
    - Making multiple live versions or using it for multiple projects.

    Unauthorized redistribution may result in legal action. 
    By using this template, you agree to comply with the license terms.
    ------------------------------------------------------------------------------
-->
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', ($product->name  ?? ''))</title> 

<!-- Bootstrap & Icons -->
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
                        <div class="stock-badge {{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}">
                            @if($product->stock > 0)
                                <i class="bi bi-check-circle-fill me-1"></i> In Stock
                            @else
                                <i class="bi bi-x-circle-fill me-1"></i> Out of Stock
                            @endif
                        </div>

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
                        <h1 class="product-title">{{ $product->name }}</h1>

                        <!-- <div class="product-rating mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-half text-warning"></i>
                            <span class="ms-2 text-muted">(4.5/5) - 128 reviews</span>
                        </div> -->

                        <div class="price-section">
                            <div class="current-price">{{ number_format($product->price, 2) }} {{$websiteInfo->currency ?? 'DT'}}</div>
                        </div>

                        <div class="stock-info">
                            <i class="bi bi-box-seam me-2"></i>
                            <span class="stock-label">Availability:</span>
                            <span class="stock-value {{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                                {{ $product->stock > 0 ? $product->stock . ' units in stock' : 'Out of Stock' }}
                            </span>
                        </div>

                        <hr class="my-4">

                        <div class="product-description">
                            <h5 class="section-title">Description</h5>
                            <p>{{ $product->description ?? 'High-quality electronic product designed for excellence.' }}</p>
                        </div>

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
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>

     <!-- Footer -->
    @include('Client.components.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Unified Cart JS -->
    <script src="{{ asset('js/client.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
</body>
</html>
