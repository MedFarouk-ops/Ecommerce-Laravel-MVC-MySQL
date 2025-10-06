<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farouk Electronics</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">
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
            <button class="btn btn-outline-secondary me-2 d-md-none" id="mobileSearchBtn"><i
                    class="bi bi-search"></i></button>
            <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebar" aria-controls="sidebar"><i class="bi bi-list"></i></button>
        </div>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('client.dashboard') }}">Products</a>
                </li>

                <!-- Cart dropdown with icon + text -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle position-relative" href="#" id="cartDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-cart-fill me-1"></i> Cart
                        <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            0
                        </span>
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

    <!-- Hero Section -->
    <section class="hero text-center py-3 px-3 rounded-0 bg-secondary text-light">
        <h2 class="fw-bold mb-2">Quality Electronics, Delivered Fast</h2>
        <p class="lead mb-0">Reliable gadgets for home, work, and play. Explore the latest in electronics with secure checkout and fast shipping.</p>
    </section>

    <!-- Main Content -->
    <div class="container-fluid flex-grow-1">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse offcanvas-md">
                <div class="offcanvas-header d-md-none">
                    <h5 class="offcanvas-title">Categories</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column" id="categoryList">
                        <li class="nav-item mb-2">
                            <button class="btn btn-outline-dark w-100 active" data-category="all">All</button>
                        </li>
                        @foreach($categories as $category)
                        <li class="nav-item mb-2">
                            <button class="btn btn-outline-dark w-100" data-category="{{ $category->id }}">{{ $category->name }}</button>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>

            <!-- Products -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Desktop search bar -->
                <div class="d-none d-md-block my-3">
                    <input type="text" class="form-control w-75" placeholder="Search products..." id="desktopSearch">
                </div>
                <!-- Mobile search bar -->
                <div class="d-md-none my-3 d-none" id="mobileSearchContainer">
                    <input type="text" class="form-control" placeholder="Search products..." id="mobileSearch">
                </div>

                <div class="row g-4" id="productGrid">
                    @foreach($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3 product-card" data-category="{{ $product->category_id }}" data-id="{{ $product->id }}">
                    <div class="card glass-card h-100 text-center p-3 shadow-hover">
                      <div class="product-image-wrapper mb-2">
                            @if($product->photo1)
                                <img src="{{ asset('storage/' . $product->photo1) }}" 
                                    alt="{{ $product->name }}" 
                                    class="product-image img-fluid">
                            @else
                                <i class="bi bi-box display-1 text-primary"></i>
                            @endif
                      </div>
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-success fw-bold">{{ $product->price }} DT</p>
                        <p class="text-muted">Stock: {{ $product->stock }}</p>                
                    </div>

                    <div class="mt-auto d-grid gap-2">
                        <button class="btn btn-outline-primary btn-sm add-to-cart-btn w-100">Add to Cart</button>
                        <a href="{{ route('client.product.show', $product->id) }}" class="btn btn-primary btn-sm w-100">View Details</a>
                    </div>
                    
                </div>

                    @endforeach
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-4 shadow-sm mt-auto">
        &copy; {{ date('Y') }} Farouk Electronics. All rights reserved.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS -->
    <script>
    // Mobile search toggle
    const mobileBtn = document.getElementById('mobileSearchBtn');
    const mobileSearchContainer = document.getElementById('mobileSearchContainer');
    mobileBtn.addEventListener('click', () => {
        mobileSearchContainer.classList.toggle('d-none');
        mobileSearchContainer.querySelector('input').focus();
    });

    // Category filter
    const categoryButtons = document.querySelectorAll('#categoryList button');
    const productCards = document.querySelectorAll('.product-card');
    categoryButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            categoryButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const categoryId = btn.getAttribute('data-category');
            productCards.forEach(card => {
                card.style.display = (categoryId === 'all' || card.dataset.category === categoryId) ? 'block' : 'none';
            });
        });
    });

    // Cart logic
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

   // Update cart in localStorage and navbar
    function truncate(str, max = 15) {
        return str.length > max ? str.substring(0, max) + '…' : str;
    }

    function updateCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
        const cartCount = document.getElementById('cartCount');
        const cartItemsList = document.getElementById('cartItemsList');
        const cartTotal = document.getElementById('cartTotal');

        cartCount.textContent = cart.length;

        if(cart.length === 0){
            cartItemsList.innerHTML = '<li>Your cart is empty</li>';
            cartTotal.textContent = '';
        } else {
            cartItemsList.innerHTML = '';
            let total = 0;

            cart.forEach(p => {
                const li = document.createElement('li');
                li.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'mb-1');
                li.innerHTML = `
                    <span title="${p.name}">${truncate(p.name)}</span>
                    <span class="text-success fw-bold">${(p.price * p.qty).toFixed(2)} DT</span>
                `;
                cartItemsList.appendChild(li);
                total += p.price * p.qty;
            });

            cartTotal.textContent = `Total: ${total.toFixed(2)} DT`;
        }
    }

    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const card = btn.closest('.product-card');
            const product = {
                id: card.dataset.id,
                name: card.querySelector('.card-title').textContent,
                price: parseFloat(card.querySelector('.text-success').textContent),
                stock: parseInt(card.querySelector('.text-muted').textContent.replace('Stock: ', '')),
                qty: 1
            };

            const existing = cart.find(p => p.id == product.id);
            if (existing) {
                if(existing.qty < product.stock) existing.qty++;
            } else {
                cart.push(product);
            }

            updateCart();
            alert(`${product.name} added to cart!`);
        });
    });

    // Initial cart badge update
    updateCart();
    </script>

</body>
</html>
