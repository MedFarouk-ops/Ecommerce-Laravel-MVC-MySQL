document.addEventListener('DOMContentLoaded', function() {

    const filterButtons = document.querySelectorAll('[data-filter]');
    const orderItems = document.querySelectorAll('.order-item');
    const emptyState = document.getElementById('emptyState');

    // Filter Orders
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.dataset.filter;
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            let visibleCount = 0;
            orderItems.forEach(item => {
                const status = item.dataset.status;
                if (filter === 'all' || status === filter) {
                    item.style.display = 'block';
                    visibleCount++;
                    item.style.animation = 'none';
                    setTimeout(() => item.style.animation = 'fadeInUp 0.5s ease-out', 10);
                } else {
                    item.style.display = 'none';
                }
            });

            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    });

    // Reorder Buttons
    const reorderButtons = document.querySelectorAll('[data-order-id]');
    reorderButtons.forEach(button => {
        button.addEventListener('click', function() {
            const originalText = this.innerHTML;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Processing...';
            this.disabled = true;

            setTimeout(() => {
                showNotification('Items added to cart successfully!', 'success');
                this.innerHTML = originalText;
                this.disabled = false;
            }, 1500);
        });
    });

    // Notifications
    function showNotification(msg, type = 'info') {
        const notif = document.createElement('div');
        notif.className = `alert alert-${type} notification-toast`;
        notif.style.cssText = `
            position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15); animation: slideInRight 0.5s ease;
        `;
        notif.innerHTML = `<div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill me-2"></i>
            <span>${msg}</span>
            <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
        </div>`;
        document.body.appendChild(notif);
        setTimeout(() => {
            notif.style.animation = 'slideOutRight 0.5s ease';
            setTimeout(() => notif.remove(), 500);
        }, 5000);
    }

    // Add animation CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight { from { transform: translateX(400px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes slideOutRight { from { transform: translateX(0); opacity: 1; } to { transform: translateX(400px); opacity: 0; } }
    `;
    document.head.appendChild(style);

    console.log('Client Orders page initialized successfully!');
});
