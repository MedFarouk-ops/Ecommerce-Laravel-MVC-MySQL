<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Farouk Electronics - Cart</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="{{ asset('css/client.css') }}" rel="stylesheet">
<style>
body {
    background-color: #f8f9fa;
}

.navbar {
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.table-card {
    background-color: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border-radius: 0.25rem;
}

.table-card thead {
    background-color: #e9ecef;
    font-weight: 600;
}

.cart-summary {
    background-color: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border-radius: 0.25rem;
    padding: 1.5rem;
}

.btn-checkout {
    background-color: #6c757d;
    color: #fff;
    font-weight: 600;
    border-radius: 0.25rem;
}
.btn-checkout:hover {
    background-color: #5a6268;
}

/* Mobile view adjustments */
@media (max-width: 767px) {
    .table-card thead {
        display: none;
    }
    .table-card tbody tr {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        padding: 1rem;
        margin-bottom: 1rem;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border-radius: 0.25rem;
    }
    .cart-left {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .cart-left i {
        font-size: 2rem;
        color: #6c757d;
    }
    .cart-right {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        justify-content: flex-end;
    }
    .quantity-input {
        width: 55px;
    }
}
</style>
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

    
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><a class="nav-link text-dark" href="{{ route('client.dashboard') }}">Products</a></li>
               <li class="nav-item"><a class="nav-link text-dark" href="{{ route('client.cart') }}">Cart</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="#">Login</a></li>
            </ul>
        </div>
    </nav>

<!-- Cart Section -->
<main class="container flex-grow-1 my-4">
    <h2 class="mb-4 fw-bold">Your Shopping Cart</h2>

    <div class="table-responsive">
        <table class="table table-card text-center align-middle">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Item 1 -->
                <tr>
                    <td class="d-none d-md-table-cell"><i class="bi bi-headphones fs-3 text-secondary"></i></td>
                    <td class="d-none d-md-table-cell fw-semibold">Wireless Headset</td>
                    <td class="d-none d-md-table-cell">20 DT</td>
                    <td class="d-none d-md-table-cell">
                        <input type="number" value="1" min="1" class="form-control form-control-sm quantity-input">
                    </td>
                    <td class="d-none d-md-table-cell fw-bold">20 DT</td>
                    <td class="d-none d-md-table-cell">
                        <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </td>

                    <!-- Mobile view -->
                    <td class="d-table-cell d-md-none">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="cart-left">
                                <i class="bi bi-headphones"></i>
                                <div>
                                    <div class="fw-semibold">Wireless Headset</div>
                                    <div class="text-muted small">20 DT</div>
                                </div>
                            </div>
                            <div class="cart-right">
                                <input type="number" value="1" min="1" class="form-control form-control-sm quantity-input">
                                <span class="fw-bold">20 DT</span>
                                <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Item 2 -->
                <tr>
                    <td class="d-none d-md-table-cell"><i class="bi bi-battery-charging fs-3 text-secondary"></i></td>
                    <td class="d-none d-md-table-cell fw-semibold">Smart Charger</td>
                    <td class="d-none d-md-table-cell">15 DT</td>
                    <td class="d-none d-md-table-cell">
                        <input type="number" value="2" min="1" class="form-control form-control-sm quantity-input">
                    </td>
                    <td class="d-none d-md-table-cell fw-bold">30 DT</td>
                    <td class="d-none d-md-table-cell">
                        <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </td>

                    <!-- Mobile view -->
                    <td class="d-table-cell d-md-none">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="cart-left">
                                <i class="bi bi-battery-charging"></i>
                                <div>
                                    <div class="fw-semibold">Smart Charger</div>
                                    <div class="text-muted small">15 DT</div>
                                </div>
                            </div>
                            <div class="cart-right">
                                <input type="number" value="2" min="1" class="form-control form-control-sm quantity-input">
                                <span class="fw-bold">30 DT</span>
                                <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Item 3 -->
                <tr>
                    <td class="d-none d-md-table-cell"><i class="bi bi-speaker-fill fs-3 text-secondary"></i></td>
                    <td class="d-none d-md-table-cell fw-semibold">Bluetooth Speaker</td>
                    <td class="d-none d-md-table-cell">35 DT</td>
                    <td class="d-none d-md-table-cell">
                        <input type="number" value="1" min="1" class="form-control form-control-sm quantity-input">
                    </td>
                    <td class="d-none d-md-table-cell fw-bold">35 DT</td>
                    <td class="d-none d-md-table-cell">
                        <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                    </td>

                    <!-- Mobile view -->
                    <td class="d-table-cell d-md-none">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="cart-left">
                                <i class="bi bi-speaker-fill"></i>
                                <div>
                                    <div class="fw-semibold">Bluetooth Speaker</div>
                                    <div class="text-muted small">35 DT</div>
                                </div>
                            </div>
                            <div class="cart-right">
                                <input type="number" value="1" min="1" class="form-control form-control-sm quantity-input">
                                <span class="fw-bold">35 DT</span>
                                <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Cart Summary -->
    <div class="d-flex flex-column flex-md-row justify-content-end mt-4 gap-3">
        <div class="cart-summary">
            <h5 class="fw-bold mb-3">Cart Summary</h5>
            <p class="mb-1">Subtotal: <span class="fw-bold">85 DT</span></p>
            <p class="mb-1">Shipping: <span class="fw-bold">5 DT</span></p>
            <hr>
            <p class="mb-3">Total: <span class="fw-bold">90 DT</span></p>
            <a href="#" class="btn btn-checkout w-100">Proceed to Checkout</a>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-white text-center py-4 shadow-sm mt-auto">
    &copy; {{ date('Y') }} Farouk Electronics. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
