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
                <li class="nav-item"><a class="nav-link text-dark" href="{{ route('client.dashboard') }}">Products</a></li>
               <li class="nav-item"><a class="nav-link text-dark" href="{{ route('client.cart') }}">Cart</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="#">Login</a></li>
            </ul>
        </div>
    </nav>

   <!-- Hero Section -->
    <section class="hero text-center py-3 px-3 rounded-0 bg-secondary text-light">
        <h2 class="fw-bold mb-2">Quality Electronics, Delivered Fast</h2>
        <p class="lead mb-0">Reliable gadgets for home, work, and play. Explore the latest in electronics with secure checkout and fast shipping.</p>
    </section>


    <!-- Main Content with Sidebar -->
    <div class="container-fluid flex-grow-1">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse offcanvas-md">
                <div class="offcanvas-header d-md-none">
                    <h5 class="offcanvas-title">Categories</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><button class="btn btn-outline-dark w-100 active">All</button></li>
                        <li class="nav-item mb-2"><button class="btn btn-outline-dark w-100">Headsets</button></li>
                        <li class="nav-item mb-2"><button class="btn btn-outline-dark w-100">Chargers</button></li>
                        <li class="nav-item mb-2"><button class="btn btn-outline-dark w-100">Speakers</button></li>
                        <li class="nav-item mb-2"><button class="btn btn-outline-dark w-100">Smart Watches</button></li>
                        <li class="nav-item mb-2"><button class="btn btn-outline-dark w-100">Accessories</button></li>
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

                <!-- Products Grid -->
                <div class="row g-4">
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card glass-card h-100 text-center p-3 shadow-hover">
                            <i class="bi bi-headphones display-1 mb-2 text-primary"></i>
                            <h5 class="card-title">Wireless Headset</h5>
                            <p class="text-success fw-bold">20 DT</p>
                            <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card glass-card h-100 text-center p-3 shadow-hover">
                            <i class="bi bi-battery-charging display-1 mb-2 text-warning"></i>
                            <h5 class="card-title">Smart Charger</h5>
                            <p class="text-success fw-bold">15 DT</p>
                            <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card glass-card h-100 text-center p-3 shadow-hover">
                            <i class="bi bi-speaker display-1 mb-2 text-danger"></i>
                            <h5 class="card-title">Bluetooth Speaker</h5>
                            <p class="text-success fw-bold">35 DT</p>
                            <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card glass-card h-100 text-center p-3 shadow-hover">
                            <i class="bi bi-watch display-1 mb-2 text-info"></i>
                            <h5 class="card-title">Smart Watch</h5>
                            <p class="text-success fw-bold">50 DT</p>
                            <button class="btn btn-outline-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-4 shadow-sm mt-auto">
        &copy; {{ date('Y') }} Farouk Electronics. All rights reserved.
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Mobile search toggle -->
    <script>
        const mobileBtn = document.getElementById('mobileSearchBtn');
        const mobileSearchContainer = document.getElementById('mobileSearchContainer');

        mobileBtn.addEventListener('click', () => {
            mobileSearchContainer.classList.toggle('d-none');
            mobileSearchContainer.querySelector('input').focus();
        });
    </script>
</body>


</html>
