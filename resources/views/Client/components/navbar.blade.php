<!-- resources/views/components/navbar.blade.php -->
 <!-- Loader Spinner -->
    <div id="loader">
        <div class="spinner"></div>
    </div>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm px-4 py-3">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('client.dashboard') }}">
        @if(isset($websiteInfo) && $websiteInfo->logo)
            <img src="{{ asset('storage/' . $websiteInfo->logo) }}" alt="{{ $websiteInfo->name ?? 'Electronics' }}" class="me-2" style="height:32px; width:auto;">
        @else
            <i class="bi bi-lightning-charge-fill me-2 text-primary"></i>
        @endif
        {{ $websiteInfo->name ?? 'Electronics' }}
    </a>

    <div class="d-flex align-items-center ms-auto">
        <button class="btn btn-outline-secondary me-2 d-md-none" id="mobileSearchBtn">
            <i class="bi bi-search"></i>
        </button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('client.dashboard') }}">Products</a>
            </li>

            <!-- Cart dropdown -->
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
                <a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('client.orders.index') }}">Command History</a></li>
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
