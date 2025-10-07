document.addEventListener('DOMContentLoaded', () => {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    const cartCount = document.getElementById('cartCount');
    const cartItemsList = document.getElementById('cartItemsList');

    // ===== Toast Creation =====
    const toastContainer = document.createElement('div');
    toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
    toastContainer.style.zIndex = 1100;
    document.body.appendChild(toastContainer);

    const toastEl = document.createElement('div');
    toastEl.className = 'toast align-items-center text-white bg-primary border-0';
    toastEl.role = 'alert';
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');
    toastContainer.appendChild(toastEl);

    const toastInner = document.createElement('div');
    toastInner.className = 'd-flex';
    toastEl.appendChild(toastInner);

    const toastBody = document.createElement('div');
    toastBody.className = 'toast-body';
    toastInner.appendChild(toastBody);

    const closeBtn = document.createElement('button');
    closeBtn.type = 'button';
    closeBtn.className = 'btn-close btn-close-white me-2 m-auto';
    closeBtn.setAttribute('data-bs-dismiss', 'toast');
    closeBtn.setAttribute('aria-label', 'Close');
    toastInner.appendChild(closeBtn);

    const toast = new bootstrap.Toast(toastEl);

    function showToast(message) {
        toastBody.textContent = message;
        toast.show();
    }

    // ===== Update navbar cart =====
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
                    <span class="fw-bold">${item.qty}×${item.price} DT</span>
                </li>
            `).join('');
        }
    }

    updateNavbarCart();

    // ===== Add to Cart buttons =====
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const card = btn.closest('.product-card');
            const product = {
                id: card.dataset.id,
                name: card.querySelector('.card-title').textContent,
                price: parseFloat(card.querySelector('.text-success').textContent),
                stock: parseInt(card.querySelector('.text-muted').textContent.replace('Stock: ', '')),
                qty: 1
            };

            const existing = cart.find(p => p.id == product.id);
            if (existing) {
                if (existing.qty < product.stock) existing.qty++;
            } else {
                cart.push(product);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            updateNavbarCart();

            // Show toast
            showToast(`${product.name} added to cart!`);
        });
    });

    // Mobile search toggle
    const mobileBtn = document.getElementById('mobileSearchBtn');
    const mobileSearchContainer = document.getElementById('mobileSearchContainer');
    mobileBtn.addEventListener('click', () => {
        mobileSearchContainer.classList.toggle('d-none');
        mobileSearchContainer.querySelector('input').focus();
    });

    // Category filter
    const categoryButtons = document.querySelectorAll('#categoryList button');
    const productCards = document.querySelectorAll('.product-card');
    categoryButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            categoryButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const categoryId = btn.getAttribute('data-category');
            productCards.forEach(card => {
                card.style.display = (categoryId === 'all' || card.dataset.category === categoryId) ? 'block' : 'none';
            });
        });
    });
});
