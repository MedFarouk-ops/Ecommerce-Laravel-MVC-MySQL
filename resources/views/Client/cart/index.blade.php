<!DOCTYPE html>
<!--
    ------------------------------------------------------------------------------
    © 2025 Mohamed Farouk Khabir. All rights reserved.

    Licensed under the MIT License with attribution required.
    
    You are free to use, modify, and distribute this software, provided that
    proper attribution to the original author is maintained.
    ------------------------------------------------------------------------------
-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', ($websiteInfo->name ?? '')) - Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    @if (!empty($websiteInfo->logo))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $websiteInfo->logo) }}?v={{ time() }}">
    @endif
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
    <!-- Cart CSS -->
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
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
                    <p class="mb-1">Shipping: <span id="shipping" class="fw-bold">{{ $websiteInfo->shipping_fee ?? 0}} {{ $websiteInfo->currency ?? 'DT'}}</span></p>
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
