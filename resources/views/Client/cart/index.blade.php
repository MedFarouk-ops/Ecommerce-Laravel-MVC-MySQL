<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Electronics - Cart</title>
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

        @include('Client.components.navbar')

        <main class="container flex-grow-1 my-4">
            <h2 class="mb-4 fw-bold">Your Shopping Cart</h2>

            <div class="table-responsive">
                <table class="table table-card text-center align-middle" id="cartTable">
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
                    <tbody id="cartBody">
                        <!-- Dynamic cart items will appear here -->
                    </tbody>
                </table>
            </div>

            <!-- Cart Summary -->
            <div class="d-flex flex-column flex-md-row justify-content-end mt-4 gap-3">
                <div class="cart-summary">
                    <h5 class="fw-bold mb-3">Cart Summary</h5>
                    <p class="mb-1">Subtotal: <span id="subtotal" class="fw-bold">0 DT</span></p>
                    <p class="mb-1">Shipping: <span id="shipping" class="fw-bold">5 DT</span></p>
                    <hr>
                    <p class="mb-3">Total: <span id="total" class="fw-bold">0 DT</span></p>
                    @auth
                        <a href="{{ route('client.checkout') }}" class="btn btn-checkout w-100">Proceed to Checkout</a>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-checkout w-100">Login to Checkout</a>
                    @endguest
                </div>
            </div>
        </main>
    
        <!-- Footer -->
    @include('Client.components.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/client.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>

</body>
</html>
