// ===============================
// Orders Page JavaScript
// Farouk Electronics
// ===============================

document.addEventListener('DOMContentLoaded', function() {
    
    // ===============================
    // Filter Orders by Status
    // ===============================
    const filterButtons = document.querySelectorAll('[data-filter]');
    const orderItems = document.querySelectorAll('.order-item');
    const emptyState = document.getElementById('emptyState');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter orders
            let visibleCount = 0;
            
            orderItems.forEach(item => {
                const status = item.getAttribute('data-status');
                
                if (filter === 'all') {
                    item.style.display = 'block';
                    visibleCount++;
                    // Add animation
                    item.style.animation = 'none';
                    setTimeout(() => {
                        item.style.animation = 'fadeInUp 0.5s ease-out';
                    }, 10);
                } else if (status === filter) {
                    item.style.display = 'block';
                    visibleCount++;
                    // Add animation
                    item.style.animation = 'none';
                    setTimeout(() => {
                        item.style.animation = 'fadeInUp 0.5s ease-out';
                    }, 10);
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show/hide empty state
            if (emptyState) {
                if (visibleCount === 0) {
                    emptyState.style.display = 'block';
                } else {
                    emptyState.style.display = 'none';
                }
            }
        });
    });

    // ===============================
    // Reorder Functionality
    // ===============================
    const reorderButtons = document.querySelectorAll('[data-order-id]');
    
    reorderButtons.forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            
            // Show loading state
            const originalText = this.innerHTML;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Processing...';
            this.disabled = true;
            
            // Simulate reorder process (replace with actual AJAX call)
            setTimeout(() => {
                // Success notification
                showNotification('Items added to cart successfully!', 'success');
                
                // Reset button
                this.innerHTML = originalText;
                this.disabled = false;
                
                // Optional: Redirect to cart
                // window.location.href = '/cart';
            }, 1500);
        });
    });

    // ===============================
    // Cancel Order Modal
    // ===============================
    const cancelForms = document.querySelectorAll('.modal form');
    
    cancelForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Cancelling...';
            submitBtn.disabled = true;
        });
    });

    // ===============================
    // Track Order Animation
    // ===============================
    function animateProgressSteps() {
        const progressSteps = document.querySelectorAll('.progress-step.completed');
        
        progressSteps.forEach((step, index) => {
            setTimeout(() => {
                step.style.opacity = '0';
                step.style.transform = 'scale(0.8)';
                
                setTimeout(() => {
                    step.style.transition = 'all 0.5s ease';
                    step.style.opacity = '1';
                    step.style.transform = 'scale(1)';
                }, 50);
            }, index * 100);
        });
    }

    // Run animation on page load
    setTimeout(animateProgressSteps, 300);

    // ===============================
    // Notification System
    // ===============================
    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} notification-toast`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            animation: slideInRight 0.5s ease;
        `;
        
        notification.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2"></i>
                <span>${message}</span>
                <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.5s ease';
            setTimeout(() => notification.remove(), 500);
        }, 5000);
    }

    // Add animations to CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // ===============================
    // View Details Smooth Scroll
    // ===============================
    const viewDetailsButtons = document.querySelectorAll('[href*="order.details"]');
    
    viewDetailsButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add loading indicator
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Loading...';
        });
    });

    // ===============================
    // Order Search (Optional)
    // ===============================
    const searchInput = document.getElementById('orderSearch');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let visibleCount = 0;
            
            orderItems.forEach(item => {
                const orderId = item.querySelector('.order-id').textContent.toLowerCase();
                const orderContent = item.textContent.toLowerCase();
                
                if (orderId.includes(searchTerm) || orderContent.includes(searchTerm)) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show/hide empty state
            if (emptyState) {
                if (visibleCount === 0 && searchTerm !== '') {
                    emptyState.style.display = 'block';
                    emptyState.querySelector('h3').textContent = 'No orders found';
                    emptyState.querySelector('p').textContent = `No orders match "${searchTerm}"`;
                } else if (visibleCount === 0) {
                    emptyState.style.display = 'block';
                } else {
                    emptyState.style.display = 'none';
                }
            }
        });
    }

    // ===============================
    // Copy Tracking Number
    // ===============================
    const trackingNumbers = document.querySelectorAll('[data-tracking]');
    
    trackingNumbers.forEach(element => {
        element.style.cursor = 'pointer';
        element.title = 'Click to copy';
        
        element.addEventListener('click', function() {
            const trackingNumber = this.getAttribute('data-tracking');
            
            navigator.clipboard.writeText(trackingNumber).then(() => {
                showNotification('Tracking number copied to clipboard!', 'success');
            }).catch(err => {
                console.error('Failed to copy:', err);
            });
        });
    });

    // ===============================
    // Responsive Order Cards
    // ===============================
    function adjustCardLayout() {
        const orderCards = document.querySelectorAll('.order-card');
        
        orderCards.forEach(card => {
            if (window.innerWidth < 768) {
                card.classList.add('mobile-view');
            } else {
                card.classList.remove('mobile-view');
            }
        });
    }

    // Run on load and resize
    adjustCardLayout();
    window.addEventListener('resize', adjustCardLayout);

    // ===============================
    // Print Order
    // ===============================
    window.printOrder = function(orderId) {
        const orderCard = document.querySelector(`[data-id="${orderId}"]`);
        
        if (orderCard) {
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                <head>
                    <title>Order #${orderId}</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
                    <style>
                        body { padding: 20px; }
                        .no-print { display: none; }
                    </style>
                </head>
                <body>
                    ${orderCard.innerHTML}
                    <script>window.print(); window.onafterprint = function(){ window.close(); }<\/script>
                </body>
                </html>
            `);
            printWindow.document.close();
        }
    };

    // ===============================
    // Initialize Tooltips (Bootstrap)
    // ===============================
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // ===============================
    // Smooth Scroll for Mobile
    // ===============================
    if (window.innerWidth < 768) {
        document.querySelectorAll('.order-card').forEach(card => {
            card.style.scrollBehavior = 'smooth';
        });
    }

    console.log('Orders page initialized successfully!');
});