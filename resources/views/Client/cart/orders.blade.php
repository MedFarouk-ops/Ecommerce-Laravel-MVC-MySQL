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
    <title>@yield('title', ($websiteInfo->name ?? '')) - Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
    <!-- Custom CSS -->
    <link href="{{ asset('css/orders.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    @include('Client.components.navbar')
   <div class="container py-4">

    <!-- Orders Header & Filter -->
    <div class="mb-4">
        <h2 class="mb-3"><i class="bi bi-box-seam me-2"></i>My Orders</h2>
        <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-outline-primary active" data-filter="all">All</button>
            <button class="btn btn-outline-primary" data-filter="pending">Pending</button>
            <button class="btn btn-outline-primary" data-filter="processing">Processing</button>
            <button class="btn btn-outline-primary" data-filter="shipped">Shipped</button>
            <button class="btn btn-outline-primary" data-filter="delivered">Delivered</button>
            <button class="btn btn-outline-primary" data-filter="cancelled">Cancelled</button>
            <button class="btn btn-outline-primary" data-filter="completed">Completed</button>
        </div>
    </div>

    <!-- Orders List -->
    <div class="row g-4" id="ordersContainer">

        @forelse($orders as $order)

        <!-- Desktop / Tablet -->
        <div class="col-12 d-none d-md-block order-item" data-status="{{ $order->status }}">
            <div class="card shadow-sm border-0 order-card">

                <!-- Card Header -->
                <div class="card-header bg-white">
                    <div class="row row-cols-1 row-cols-md-4 g-2 align-items-center text-center text-md-start">
                        <div class="col">
                            <small class="text-muted d-block">Order ID</small>
                            <strong>#{{ $order->id }}</strong>
                        </div>
                        <div class="col">
                            <small class="text-muted d-block">Date</small>
                            <strong>{{ $order->created_at->format('M d, Y') }}</strong>
                        </div>
                        <div class="col">
                            <small class="text-muted d-block">Total</small>
                            <strong class="text-success">{{ $order->total_amount }} DT</strong>
                        </div>
                        <div class="col">
                            <span class="badge {{ $statusClass[$order->status] ?? 'bg-secondary text-white' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    @foreach($order->items as $item)
                    <div class="d-flex flex-wrap align-items-center mb-3 border-bottom pb-2">
                        <div class="me-3" style="width:50px; height:50px;">
                            @if($item->product->photo1)
                                <img src="{{ asset('storage/'.$item->product->photo1) }}" class="img-fluid rounded" alt="{{ $item->product->name }}">
                            @else
                                <i class="bi bi-box" style="font-size:2rem;"></i>
                            @endif
                        </div>
                        <div class="flex-grow-1 me-3">
                            <strong>{{ $item->product->name }}</strong>
                            <small class="d-block">Qty: {{ $item->quantity }} × {{ $item->price }} DT</small>
                        </div>
                        <div class="text-end" style="min-width:100px;">
                            <strong>{{ $item->quantity * $item->price }} DT</strong>
                        </div>
                    </div>
                    @endforeach

                    <div class="d-flex flex-wrap justify-content-between mt-3 border-top pt-2 text-center text-md-start">
                        <div>
                            <small>Shipping: {{ $order->shipping_cost ?? 0 }} DT</small>
                        </div>
                        <div>
                            <strong>Total: {{ $order->total_amount }} DT</strong>
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer d-flex justify-content-center justify-content-md-end flex-wrap gap-2">
                    @if($order->status == 'delivered')
                    <button class="btn btn-sm btn-outline-success" data-order-id="{{ $order->id }}">
                        <i class="bi bi-arrow-repeat me-1"></i>Reorder
                    </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Mobile -->
        <div class="col-12 d-md-none order-item" data-status="{{ $order->status }}">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <strong>#{{ $order->id }}</strong><br>
                            <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                        </div>
                        <span class="badge {{ $statusClass[$order->status] ?? 'bg-secondary text-white' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    @foreach($order->items as $item)
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2" style="width:50px; height:50px;">
                            @if($item->product->photo1)
                                <img src="{{ asset('storage/'.$item->product->photo1) }}" class="img-fluid rounded" alt="{{ $item->product->name }}">
                            @else
                                <i class="bi bi-box" style="font-size:2rem;"></i>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <strong>{{ $item->product->name }}</strong>
                            <small class="d-block">Qty: {{ $item->quantity }} × {{ $item->price }} DT</small>
                        </div>
                        <div class="text-end" style="min-width:60px;">
                            <strong>{{ $item->quantity * $item->price }} DT</strong>
                        </div>
                    </div>
                    @endforeach

                    <div class="d-flex justify-content-between mt-2 border-top pt-2">
                        <small>Shipping: {{ $order->shipping_cost ?? 0 }} DT</small>
                        <strong>Total: {{ $order->total_amount }} DT</strong>
                    </div>

                    @if($order->status == 'delivered')
                    <div class="mt-2 text-end">
                        <button class="btn btn-sm btn-outline-success">
                            <i class="bi bi-arrow-repeat me-1"></i>Reorder
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @empty
        <div class="text-center py-5" id="emptyState">
            <i class="bi bi-inbox display-1 text-muted mb-3"></i>
            <h3 class="text-muted">No Orders Yet</h3>
            <p class="text-muted">Start shopping to see your orders here</p>
            <a href="{{ route('client.home') }}" class="btn btn-primary"><i class="bi bi-shop me-1"></i>Start Shopping</a>
        </div>
        @endforelse

    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $orders->links() }}
    </div>

</div>


<!-- Footer -->
    @include('Client.components.footer')
  
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/orders.js') }}"></script>
    <script src="{{ asset('js/client.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
</body>
</html>
