document.addEventListener('DOMContentLoaded', () => {
      let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const cartCount = document.getElementById('cartCount');
    const cartItemsList = document.getElementById('cartItemsList');
    const tbody = document.getElementById('cartBody');
    const subtotalEl = document.getElementById('subtotal');
    const totalEl = document.getElementById('total');
    const shippingEl = document.getElementById('shipping');

    const freeShippingThreshold = parseFloat(WEBSITE_FREE_SHIPPING_THRESHOLD) || 0;

    // --- Get shipping fee and currency safely ---
    let shippingFee = 0;
    let currency = 'DT';
    if (shippingEl) {
        const match = shippingEl.textContent.match(/([\d.]+)/);
        if (match) shippingFee = parseFloat(match[0]) || 0;
        currency = shippingEl.textContent.replace(/[\d.,\s]/g, '') || 'DT';
    }

    // --- Navbar Cart Update ---
    function updateNavbarCart() {
        if (!cartCount || !cartItemsList) return;

        const totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
        cartCount.textContent = totalQty;

        if (cart.length === 0) {
            cartItemsList.innerHTML = '<li class="text-center text-muted">Your cart is empty</li>';
        } else {
            cartItemsList.innerHTML = cart.map(item => `
                <li class="d-flex justify-content-between align-items-center mb-1">
                    <span>${item.name}</span>
                    <span class="fw-bold">${item.qty}×${item.price} ${currency}</span>
                </li>
            `).join('');
        }
    }

    // --- Render Cart Page ---
    function renderCartPage() {
        if (!tbody) return;

        tbody.innerHTML = '';
        let subtotal = 0;

        if (cart.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="text-center text-muted">Your cart is empty</td></tr>`;
            if (subtotalEl) subtotalEl.textContent = '0 ' + currency;
            if (shippingEl) shippingEl.textContent = '0 ' + currency;
            if (totalEl) totalEl.textContent = '0 ' + currency;
            return;
        }

        cart.forEach((item, index) => {
            const totalPrice = (item.price * item.qty).toFixed(2);
            subtotal += item.price * item.qty;

            tbody.innerHTML += `
                <tr>
                    <td class="d-none d-md-table-cell"><i class="bi bi-box fs-3 text-secondary"></i></td>
                    <td class="d-none d-md-table-cell fw-semibold">${item.name}</td>
                    <td class="d-none d-md-table-cell">${item.price} ${currency}</td>
                    <td class="d-none d-md-table-cell">
                        <input type="number" value="${item.qty}" min="1" max="${item.stock}" class="form-control form-control-sm quantity-input" data-index="${index}">
                    </td>
                    <td class="d-none d-md-table-cell fw-bold">${totalPrice} ${currency}</td>
                    <td class="d-none d-md-table-cell">
                        <button class="btn btn-outline-danger btn-sm remove-btn" data-index="${index}"><i class="bi bi-trash"></i></button>
                    </td>
                    <td class="d-table-cell d-md-none">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="cart-left">
                                <i class="bi bi-box"></i>
                                <div>
                                    <div class="fw-semibold">${item.name}</div>
                                    <div class="text-muted small">${item.price} ${currency}</div>
                                </div>
                            </div>
                            <div class="cart-right">
                                <input type="number" value="${item.qty}" min="1" max="${item.stock}" class="form-control form-control-sm quantity-input" data-index="${index}">
                                <span class="fw-bold">${totalPrice} ${currency}</span>
                                <button class="btn btn-outline-danger btn-sm remove-btn" data-index="${index}"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
        });

        // Update subtotal
        if (subtotalEl) subtotalEl.textContent = subtotal.toFixed(2) + ' ' + currency;

        // Determine shipping
        let currentShippingFee = shippingFee;
        let shippingMessage = '';
        if (subtotal >= freeShippingThreshold) {
            currentShippingFee = 0;
            shippingMessage = `You got free shipping! 🎉`;
        } else {
            shippingMessage = `Add ${ (freeShippingThreshold - subtotal).toFixed(2) } ${currency} more for free shipping`;
        }

        if (shippingEl) shippingEl.textContent = currentShippingFee.toFixed(2) + ' ' + currency + ' - ' + shippingMessage;

        // Update total
        if (totalEl) totalEl.textContent = (subtotal + currentShippingFee).toFixed(2) + ' ' + currency;

        attachCartPageEvents();
    }


    // --- Cart Page Event Handlers ---
    function attachCartPageEvents() {
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', e => {
                const idx = e.target.dataset.index;
                let val = parseInt(e.target.value);
                const stock = cart[idx].stock;
                if (val < 1) val = 1;
                if (val > stock) {
                    val = stock;
                    showToast(`You cannot order more than available stock (${stock}).`);
                }
                cart[idx].qty = val;
                localStorage.setItem('cart', JSON.stringify(cart));
                updateNavbarCart();
                renderCartPage();
            });
        });

        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', e => {
                const idx = btn.dataset.index;
                cart.splice(idx, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                updateNavbarCart();
                renderCartPage();
            });
        });
    }

    // --- Add to Cart Buttons ---
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const card = btn.closest('.product-card') || document.querySelector('.product-container');
            const id = btn.dataset.id || card?.dataset.id;
            const name = card.querySelector('.product-title, .card-title')?.textContent;
            const priceText = card.querySelector('.current-price, .text-success')?.textContent.replace(' DT','').replace(/,/g,'');
            const price = parseFloat(priceText);
            const stockText = card.querySelector('.stock-value, .text-muted')?.textContent.replace(/\D/g,'') || '1';
            const stock = parseInt(stockText);

            let qty = 1;
            const qtyInput = document.getElementById('qtyInput');
            if (qtyInput) qty = parseInt(qtyInput.value);

            const existing = cart.find(p => p.id == id);
            if (existing) {
                if (existing.qty + qty > stock) {
                    existing.qty = stock;
                    showToast(`You cannot order more than available stock (${stock}).`);
                } else {
                    existing.qty += qty;
                }
            } else {
                if (qty > stock) {
                    qty = stock;
                    showToast(`You cannot order more than available stock (${stock}).`);
                }
                cart.push({ id, name, price, stock, qty });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            updateNavbarCart();
            showToast(`${name} added to cart!`);
        });
    });

    // --- Single Product Quantity Buttons ---
    const qtyInput = document.getElementById('qtyInput');
    const qtyPlus = document.getElementById('qtyPlus');
    const qtyMinus = document.getElementById('qtyMinus');

    if (qtyInput) {
        const maxStock = parseInt(qtyInput.max) || 1;
        if (qtyPlus) qtyPlus.addEventListener('click', () => {
            if (parseInt(qtyInput.value) < maxStock) qtyInput.value = parseInt(qtyInput.value) + 1;
        });
        if (qtyMinus) qtyMinus.addEventListener('click', () => {
            if (parseInt(qtyInput.value) > 1) qtyInput.value = parseInt(qtyInput.value) - 1;
        });
    }

    // --- Toast System ---
    const toastContainer = document.createElement('div');
    toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
    toastContainer.style.zIndex = 1100;
    document.body.appendChild(toastContainer);

    function showToast(msg) {
        const toastEl = document.createElement('div');
        toastEl.className = 'toast align-items-center text-white bg-primary border-0';
        toastEl.role = 'alert';
        toastEl.setAttribute('aria-live','assertive');
        toastEl.setAttribute('aria-atomic','true');
        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${msg}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        toastContainer.appendChild(toastEl);
        const toast = new bootstrap.Toast(toastEl, { delay: 2000 });
        toast.show();
        toastEl.addEventListener('hidden.bs.toast', ()=> toastEl.remove());
    }

    // --- Initial Render ---
    updateNavbarCart();
    renderCartPage();
});
