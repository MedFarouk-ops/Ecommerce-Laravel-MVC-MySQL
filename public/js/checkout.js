document.addEventListener('DOMContentLoaded', () => {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    const orderItemsContainer = document.getElementById('orderItems');
    const orderSubtotalEl = document.getElementById('orderSubtotal');
    const orderShippingEl = document.getElementById('orderShipping');
    const orderTotalEl = document.getElementById('orderTotal');
    const checkoutForm = document.getElementById('checkoutForm');
    const placeOrderBtn = document.getElementById('placeOrderBtn');
    
    const SHIPPING_COST = WEBSITE_SHIPPING_FEE;
    const FREE_SHIPPING_THRESHOLD = FREE_SHIPPING_THRESHOLD;

    // --- Render Order Summary ---
    function renderOrderSummary() {
        if (cart.length === 0) {
            orderItemsContainer.innerHTML = `
                <div class="empty-order">
                    <i class="bi bi-cart-x"></i>
                    <p>Your cart is empty</p>
                    <a href="{{ route('client.dashboard') }}" class="btn">Continue Shopping</a>
                </div>
            `;
            orderSubtotalEl.textContent = '0 DT';
            orderShippingEl.textContent = '0 DT';
            orderTotalEl.textContent = '0 DT';
            placeOrderBtn.disabled = true;
            return;
        }

        let subtotal = 0;
        
        orderItemsContainer.innerHTML = cart.map(item => {
            const itemTotal = item.price * item.qty;
            subtotal += itemTotal;
            
            return `
                <div class="order-item">
                    <div class="order-item-icon">
                        <i class="bi bi-box"></i>
                    </div>
                    <div class="order-item-details">
                        <div class="order-item-name">${item.name}</div>
                        <div class="order-item-info">Qty: ${item.qty} × ${item.price.toFixed(2)} DT</div>
                    </div>
                    <div class="order-item-price">${itemTotal.toFixed(2)} DT</div>
                </div>
            `;
        }).join('');

        const shippingCost = subtotal >= FREE_SHIPPING_THRESHOLD ? 0 : SHIPPING_COST;
        const total = subtotal + shippingCost;

        orderSubtotalEl.textContent = subtotal.toFixed(2) + ' DT';
        orderShippingEl.textContent = shippingCost === 0 ? 'FREE' : shippingCost.toFixed(2) + ' DT';
        orderTotalEl.textContent = total.toFixed(2) + ' DT';

        // Update shipping info alert
        const shippingAlert = document.querySelector('.alert-info');
        if (subtotal >= FREE_SHIPPING_THRESHOLD) {
            shippingAlert.innerHTML = `
                <i class="bi bi-check-circle me-2"></i>
                <small>You've qualified for FREE shipping!</small>
            `;
            shippingAlert.classList.remove('alert-info');
            shippingAlert.classList.add('alert-success');
        }
    }

    // --- Form Validation ---
    function validateForm() {
        const firstName = document.getElementById('firstName').value.trim();
        const lastName = document.getElementById('lastName').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const address = document.getElementById('address').value.trim();
        const city = document.getElementById('city').value;

        if (!firstName || !lastName || !phone || !address || !city) {
            showToast('Please fill in all required fields', 'danger');
            return false;
        }

        // Basic phone validation
        const phoneRegex = /^[\d\s\+\-\(\)]+$/;
        if (!phoneRegex.test(phone) || phone.length < 8) {
            showToast('Please enter a valid phone number', 'danger');
            return false;
        }

        return true;
    }

   // --- Handle Form Submission ---
    checkoutForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (cart.length === 0) {
            showToast('Your cart is empty', 'danger');
            return;
        }

        if (!validateForm()) return;

        // --- Calculate totals ---
        const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
        const shipping_cost = subtotal >= FREE_SHIPPING_THRESHOLD ? 0 : SHIPPING_COST;
        const total = subtotal + shipping_cost;

        // --- Prepare order payload ---
        const orderData = {
            customer: {
                firstName: document.getElementById('firstName').value.trim(),
                lastName: document.getElementById('lastName').value.trim(),
                phone: document.getElementById('phone').value.trim(),
                email: document.getElementById('email').value.trim(),
                address: document.getElementById('address').value.trim(),
                city: document.getElementById('city').value,
                postalCode: document.getElementById('postalCode').value.trim(),
                notes: document.getElementById('orderNotes').value.trim()
            },
            payment: document.querySelector('input[name="payment"]:checked').value,
            items: cart.map(item => ({
                id: parseInt(item.id),
                name: item.name,
                qty: item.qty,
                price: item.price
            })),
            subtotal,
            shipping_cost,
            total
        };

        console.log('Submitting order to /client/orders...');
        console.log('Order payload:', JSON.stringify(orderData, null, 2));

        placeOrderBtn.disabled = true;
        placeOrderBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

        try {
            const response = await fetch('/client/orders', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(orderData),
                redirect: 'manual' // prevents automatic redirects
            });

            console.log('Raw response:', response);

            // Read raw response text
            const resultText = await response.text();
            console.log('Response text:', resultText);

            let result;
            try {
                result = JSON.parse(resultText); // parse JSON
            } catch (err) {
                console.error('Failed to parse JSON:', err);
                showToast('Server did not return valid JSON.', 'danger');
                return;
            }

            // Handle response
            if (response.ok) {
                localStorage.removeItem('cart');
                showSuccessModal(orderData);
            } else {
                showToast(result.message || 'Failed to place order', 'danger');
            }

        } catch (error) {
            console.error('Error submitting order:', error);
            showToast('Something went wrong, please try again.', 'danger');
        } finally {
            placeOrderBtn.disabled = false;
            placeOrderBtn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Place Order';
        }
    });



    // --- Success Modal ---
    function showSuccessModal(orderData) {
        const modalHTML = `
            <div class="modal fade" id="successModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center p-5">
                            <div class="success-animation mb-4">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                            </div>
                            <h3 class="mb-3">Order Placed Successfully!</h3>
                            <p class="text-muted mb-4">
                                Thank you for your order, ${orderData.customer.firstName}!<br>
                                We'll contact you at <strong>${orderData.customer.phone}</strong> to confirm your order.
                            </p>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                <small>Expected delivery: 2-5 business days</small>
                            </div>
                            <a href="/client/dashboard" class="btn btn-primary btn-lg mt-3">
                                <i class="bi bi-house me-2"></i>Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHTML);
        const modal = new bootstrap.Modal(document.getElementById('successModal'));
        modal.show();

        // Remove modal from DOM when hidden
        document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
            this.remove();
            // Redirect to home after modal closes
            window.location.href = '{{ route("client.dashboard") }}';
        });
    }

    // --- Toast Notification System ---
    const toastContainer = document.createElement('div');
    toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
    toastContainer.style.zIndex = 1100;
    document.body.appendChild(toastContainer);

    function showToast(message, type = 'primary') {
        // Determine Bootstrap background classes
        let bgClass = 'bg-primary text-white';
        if (type === 'success') bgClass = 'bg-success text-white';
        else if (type === 'danger') bgClass = 'bg-danger text-white';
        else if (type === 'warning') bgClass = 'bg-warning text-dark';

        // Create toast element
        const toastEl = document.createElement('div');
        toastEl.className = `toast align-items-center border-0 ${bgClass}`;
        toastEl.role = 'alert';
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');
        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

        // Append to container
        toastContainer.appendChild(toastEl);

        // Initialize and show toast
        const bsToast = new bootstrap.Toast(toastEl, { delay: 2500 });
        bsToast.show();

        // Remove from DOM when hidden
        toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
    }
});

