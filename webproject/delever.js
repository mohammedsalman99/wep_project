document.addEventListener('DOMContentLoaded', function () {
    const ordersList = document.querySelector('.orders-list');

    fetchOrders();

    async function fetchOrders() {
        const response = await fetch('delever.php');
        const ordersHTML = await response.text();
        ordersList.innerHTML = ordersHTML;

        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const orderId = button.getAttribute('data-orderid');
                deleteOrder(orderId);
            });
        });
    }

    async function deleteOrder(orderId) {
        const response = await fetch('deleteOrder.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `orderId=${orderId}`,
        });

        const result = await response.text();

        if (result === 'success') {
            fetchOrders();
        } else {
            alert('Error deleting order');
        }
    }
});