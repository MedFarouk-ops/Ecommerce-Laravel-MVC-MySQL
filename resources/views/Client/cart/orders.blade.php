<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Farouk Electronics</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/client.css') }}" rel="stylesheet">
    <link href="{{ asset('css/orders.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    @include('Client.components.navbar')

    <!-- Page Header -->
    <section class="page-header py-4 mb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="mb-2">
                        <i class="bi bi-box-seam me-2"></i>My Orders
                    </h1>
                    <p class="text-muted mb-0">Track and manage your orders</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <div class="btn-group" role="group">
                        <button class="btn btn-outline-primary active" data-filter="all">
                            All Orders
                        </button>
                        <button class="btn btn-outline-primary" data-filter="pending">
                            Pending
                        </button>
                        <button class="btn btn-outline-primary" data-filter="delivered">
                            Delivered
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container flex-grow-1 mb-5">
        
        <!-- Orders List -->
        <div class="row g-4" id="ordersContainer">
            
            <!-- Order Card Example 1 - Delivered -->
            @foreach($orders ?? [] as $order)
            <div class="col-12 order-item" data-status="{{ $order->status }}">
                <div class="order-card card border-0 shadow-sm">
                    <!-- Order Header -->
                    <div class="card-header bg-white border-bottom">
                        <div class="row align-items-center">
                            <div class="col-md-3 mb-2 mb-md-0">
                                <small class="text-muted d-block">Order ID</small>
                                <strong class="order-id">#{{ $order->id }}</strong>
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0">
                                <small class="text-muted d-block">Date</small>
                                <strong>{{ $order->created_at->format('M d, Y') }}</strong>
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0">
                                <small class="text-muted d-block">Total</small>
                                <strong class="text-success">{{ $order->total_amount }} DT</strong>
                            </div>
                            <div class="col-md-3 text-md-end">
                                @if($order->status == 'pending')
                                    <span class="badge status-badge status-pending">
                                        <i class="bi bi-clock-history me-1"></i>Pending
                                    </span>
                                @elseif($order->status == 'processing')
                                    <span class="badge status-badge status-processing">
                                        <i class="bi bi-arrow-repeat me-1"></i>Processing
                                    </span>
                                @elseif($order->status == 'shipped')
                                    <span class="badge status-badge status-shipped">
                                        <i class="bi bi-truck me-1"></i>Shipped
                                    </span>
                                @elseif($order->status == 'delivered')
                                    <span class="badge status-badge status-delivered">
                                        <i class="bi bi-check-circle me-1"></i>Delivered
                                    </span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge status-badge status-cancelled">
                                        <i class="bi bi-x-circle me-1"></i>Cancelled
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Order Body -->
                    <div class="card-body">
                        <!-- Order Progress Tracker -->
                        <div class="order-progress mb-4">
                            <div class="progress-container">
                                <div class="progress-step {{ in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'completed' : '' }}">
                                    <div class="progress-icon">
                                        <i class="bi bi-receipt"></i>
                                    </div>
                                    <div class="progress-label">Order Placed</div>
                                </div>
                                <div class="progress-line {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'completed' : '' }}"></div>
                                
                                <div class="progress-step {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'completed' : '' }}">
                                    <div class="progress-icon">
                                        <i class="bi bi-gear"></i>
                                    </div>
                                    <div class="progress-label">Processing</div>
                                </div>
                                <div class="progress-line {{ in_array($order->status, ['shipped', 'delivered']) ? 'completed' : '' }}"></div>
                                
                                <div class="progress-step {{ in_array($order->status, ['shipped', 'delivered']) ? 'completed' : '' }}">
                                    <div class="progress-icon">
                                        <i class="bi bi-truck"></i>
                                    </div>
                                    <div class="progress-label">Shipped</div>
                                </div>
                                <div class="progress-line {{ $order->status == 'delivered' ? 'completed' : '' }}"></div>
                                
                                <div class="progress-step {{ $order->status == 'delivered' ? 'completed' : '' }}">
                                    <div class="progress-icon">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                    <div class="progress-label">Delivered</div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="order-items">
                            <h6 class="mb-3 fw-bold">
                                <i class="bi bi-bag me-2"></i>Order Items ({{ $order->items->count() }})
                            </h6>
                            
                            @foreach($order->items as $item)
                            <div class="order-item-row mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-2 col-3 mb-2 mb-md-0">
                                        <div class="item-image">
                                            @if($item->product->photo1)
                                                <img src="{{ asset('storage/' . $item->product->photo1) }}" 
                                                     alt="{{ $item->product->name }}" 
                                                     class="img-fluid rounded">
                                            @else
                                                <div class="placeholder-image">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-9 mb-2 mb-md-0">
                                        <h6 class="mb-1">{{ $item->product->name }}</h6>
                                        <small class="text-muted">Quantity: {{ $item->quantity }}</small>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <small class="text-muted d-block">Price</small>
                                        <strong>{{ $item->price }} DT</strong>
                                    </div>
                                    <div class="col-md-2 col-6 text-md-end">
                                        <small class="text-muted d-block">Subtotal</small>
                                        <strong class="text-success">{{ $item->price * $item->quantity }} DT</strong>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Order Summary -->
                        <div class="order-summary mt-4 pt-3 border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="fw-bold mb-2">
                                        <i class="bi bi-geo-alt me-2"></i>Shipping Address
                                    </h6>
                                    <p class="text-muted mb-0">
                                        {{ $order->shipping_address ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                    <div class="summary-row">
                                        <span>Subtotal:</span>
                                        <strong>{{ $order->subtotal ?? $order->total_amount }} DT</strong>
                                    </div>
                                    <div class="summary-row">
                                        <span>Shipping:</span>
                                        <strong>{{ $order->shipping_cost ?? '0.00' }} DT</strong>
                                    </div>
                                    <div class="summary-row total-row">
                                        <span>Total:</span>
                                        <strong class="text-success fs-5">{{ $order->total_amount }} DT</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Footer -->
                    <div class="card-footer bg-light border-top">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                @if($order->tracking_number)
                                <small class="text-muted">
                                    <i class="bi bi-qr-code me-1"></i>
                                    Tracking: <strong>{{ $order->tracking_number }}</strong>
                                </small>
                                @endif
                            </div>
                            <div class="btn-group" role="group">
                                <a href="{{ route('client.order.details', $order->id) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i>View Details
                                </a>
                                @if($order->status == 'delivered')
                                <button class="btn btn-sm btn-outline-success" data-order-id="{{ $order->id }}">
                                    <i class="bi bi-arrow-repeat me-1"></i>Reorder
                                </button>
                                @endif
                                @if($order->status == 'pending')
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $order->id }}">
                                    <i class="bi bi-x-circle me-1"></i>Cancel
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <!-- Empty State -->
        @if(count($orders ?? []) == 0)
        <div class="text-center py-5" id="emptyState">
            <div class="empty-state">
                <i class="bi bi-inbox display-1 text-muted mb-4"></i>
                <h3 class="text-muted mb-3">No Orders Yet</h3>
                <p class="text-muted mb-4">Start shopping to see your orders here</p>
                <a href="{{ route('client.home') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-shop me-2"></i>Start Shopping
                </a>
            </div>
        </div>
        @endif

    </div>

    <!-- Footer -->
    @include('Client.components.footer')

    <!-- Cancel Order Modal (Example) -->
    @foreach($orders ?? [] as $order)
    @if($order->status == 'pending')
    <div class="modal fade" id="cancelModal{{ $order->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Cancel Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel order <strong>#{{ $order->id }}</strong>?</p>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keep Order</button>
                    <form action="{{ route('client.order.cancel', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Cancel Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/orders.js') }}"></script>

</body>
</html>