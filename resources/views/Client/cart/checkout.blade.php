<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farouk Electronics - Checkout</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Existing CSS -->
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">

    <!-- Checkout CSS -->
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    @include('Client.components.navbar')

    <!-- Breadcrumb -->
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('client.dashboard') }}"><i class="bi bi-house-door me-1"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('client.cart') }}">Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content -->
    <main class="container flex-grow-1 mb-5">
        <div class="checkout-container">
            <h1 class="checkout-title mb-4">
                <i class="bi bi-credit-card me-2"></i>Checkout
            </h1>

            <div class="row g-4">
                <!-- Left: Billing Information -->
                <div class="col-lg-7">
                    <div class="checkout-section">
                        <h4 class="section-header">
                            <i class="bi bi-person-circle me-2"></i>Billing Information
                        </h4>

                        <form id="checkoutForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="lastName" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="tel" class="form-control" id="phone" placeholder="+216 XX XXX XXX" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" placeholder="your@email.com">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Full Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="address" rows="3" placeholder="Street, Building, Floor, Apartment..." required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City <span class="text-danger">*</span></label>
                                    <select class="form-select" id="city" required>
                                        <option value="">Select City</option>
                                        <option value="Tunis">Tunis</option>
                                        <option value="Sfax">Sfax</option>
                                        <option value="Sousse">Sousse</option>
                                        <option value="Kairouan">Kairouan</option>
                                        <option value="Bizerte">Bizerte</option>
                                        <option value="Gabès">Gabès</option>
                                        <option value="Ariana">Ariana</option>
                                        <option value="Gafsa">Gafsa</option>
                                        <option value="Monastir">Monastir</option>
                                        <option value="Ben Arous">Ben Arous</option>
                                        <option value="Kasserine">Kasserine</option>
                                        <option value="Médenine">Médenine</option>
                                        <option value="Nabeul">Nabeul</option>
                                        <option value="Tataouine">Tataouine</option>
                                        <option value="Béja">Béja</option>
                                        <option value="Jendouba">Jendouba</option>
                                        <option value="Mahdia">Mahdia</option>
                                        <option value="Sidi Bouzid">Sidi Bouzid</option>
                                        <option value="Tozeur">Tozeur</option>
                                        <option value="Kébili">Kébili</option>
                                        <option value="Siliana">Siliana</option>
                                        <option value="Le Kef">Le Kef</option>
                                        <option value="Zaghouan">Zaghouan</option>
                                        <option value="Manouba">Manouba</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="postalCode" placeholder="1000">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Order Notes (Optional)</label>
                                    <textarea class="form-control" id="orderNotes" rows="2" placeholder="Special instructions for delivery..."></textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Method -->
                    <div class="checkout-section mt-4">
                        <h4 class="section-header">
                            <i class="bi bi-wallet2 me-2"></i>Payment Method
                        </h4>

                        <div class="payment-options">
                            <div class="payment-option active">
                                <input type="radio" name="payment" id="cashPayment" value="cash" checked>
                                <label for="cashPayment">
                                    <i class="bi bi-cash-coin"></i>
                                    <div>
                                        <strong>Cash on Delivery</strong>
                                        <small>Pay when you receive your order</small>
                                    </div>
                                    <span class="badge bg-success">Available</span>
                                </label>
                            </div>

                            <div class="payment-option disabled">
                                <input type="radio" name="payment" id="cardPayment" value="card" disabled>
                                <label for="cardPayment">
                                    <i class="bi bi-credit-card"></i>
                                    <div>
                                        <strong>Credit/Debit Card</strong>
                                        <small>Secure payment via card</small>
                                    </div>
                                    <span class="badge bg-warning text-dark">Coming Soon</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Order Summary -->
                <div class="col-lg-5">
                    <div class="checkout-section order-summary sticky-top" style="top: 20px;">
                        <h4 class="section-header">
                            <i class="bi bi-bag-check me-2"></i>Order Summary
                        </h4>

                        <div id="orderItems" class="order-items">
                            <!-- Items will be populated by JavaScript -->
                        </div>

                        <div class="order-calculations">
                            <div class="calc-row">
                                <span>Subtotal:</span>
                                <span id="orderSubtotal">0 DT</span>
                            </div>
                            <div class="calc-row">
                                <span>Shipping:</span>
                                <span id="orderShipping">7 DT</span>
                            </div>
                            <div class="calc-row total-row">
                                <span>Total:</span>
                                <span id="orderTotal">0 DT</span>
                            </div>
                        </div>

                        <div class="alert alert-info alert-sm mb-3">
                            <i class="bi bi-info-circle me-2"></i>
                            <small>Free shipping on orders over 200 DT</small>
                        </div>

                        <button type="submit" form="checkoutForm" class="btn btn-place-order w-100" id="placeOrderBtn">
                            <i class="bi bi-check-circle me-2"></i>Place Order
                        </button>

                        <div class="security-badges mt-3">
                            <div class="security-item">
                                <i class="bi bi-shield-check"></i>
                                <small>Secure Checkout</small>
                            </div>
                            <div class="security-item">
                                <i class="bi bi-truck"></i>
                                <small>Fast Delivery</small>
                            </div>
                            <div class="security-item">
                                <i class="bi bi-arrow-return-left"></i>
                                <small>Easy Returns</small>
                            </div>
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
    <!-- Checkout JS -->
    <script src="{{ asset('js/checkout.js') }}"></script>
</body>
</html>