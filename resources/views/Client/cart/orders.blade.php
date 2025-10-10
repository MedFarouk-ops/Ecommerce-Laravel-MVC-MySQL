<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farouk Electronics - Premium Electronics Store</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    @include('Client.components.navbar')
    <div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-box-seam me-2"></i>My Orders</h2>
        <div class="btn-group" role="group">
            <button class="btn btn-outline-primary active" data-filter="all">All</button>
            <button class="btn btn-outline-primary" data-filter="pending">Pending</button>
            <button class="btn btn-outline-primary" data-filter="processing">Processing</button>
            <button class="btn btn-outline-primary" data-filter="shipped">Shipped</button>
            <button class="btn btn-outline-primary" data-filter="delivered">Delivered</button>
        </div>
    </div>

    <!-- Orders Container -->
    <div class="row g-4" id="ordersContainer">

        @forelse($orders as $order)
        <div class="col-12 order-item" data-status="{{ $order->status }}">
            <div class="card order-card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted d-block">Order ID</small>
                        <strong class="order-id">#{{ $order->id }}</strong>
                    </div>
                    <div>
                        <small class="text-muted d-block">Date</small>
                        <strong>{{ $order->created_at->format('M d, Y') }}</strong>
                    </div>
                    <div>
                        <small class="text-muted d-block">Total</small>
                        <strong class="text-success">{{ $order->total_amount }} DT</strong>
                    </div>
                    <div>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning text-dark"><i class="bi bi-clock-history me-1"></i>Pending</span>
                        @elseif($order->status == 'processing')
                            <span class="badge bg-info text-white"><i class="bi bi-arrow-repeat me-1"></i>Processing</span>
                        @elseif($order->status == 'shipped')
                            <span class="badge bg-primary text-white"><i class="bi bi-truck me-1"></i>Shipped</span>
                        @elseif($order->status == 'delivered')
                            <span class="badge bg-success text-white"><i class="bi bi-check-circle me-1"></i>Delivered</span>
                        @elseif($order->status == 'cancelled')
                            <span class="badge bg-danger text-white"><i class="bi bi-x-circle me-1"></i>Cancelled</span>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <!-- Order Items -->
                    <div class="mb-3">
                        @foreach($order->items as $item)
                        <div class="d-flex align-items-center mb-2">
                            <div class="me-3" style="width:50px; height:50px;">
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
                            <div class="text-end">
                                <strong>{{ $item->quantity * $item->price }} DT</strong>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="d-flex justify-content-between mt-3 border-top pt-2">
                        <div>
                            <small>Shipping: {{ $order->shipping_cost ?? 0 }} DT</small>
                        </div>
                        <div>
                            <strong>Total: {{ $order->total_amount }} DT</strong>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a href="#" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-eye me-1"></i>View Details
                    </a>
                    @if($order->status == 'delivered')
                    <button class="btn btn-sm btn-outline-success" data-order-id="{{ $order->id }}">
                        <i class="bi bi-arrow-repeat me-1"></i>Reorder
                    </button>
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
    <div class="mt-4 flex justify-center">
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
