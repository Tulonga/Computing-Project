<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                <h1 class="text-2xl font-bold my-4">Shopping Cart</h1>
                <button id="checkoutBtn" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Checkout
                </button>
            </div>
            <div id="cartItems" class="mt-8">

            </div>
            <div class="flex justify-end items-center mt-8">
                <span class="text-gray-600 mr-4">Subtotal:</span>
                <span id="subtotal" class="text-xl font-bold">$0.00</span>
            </div>
        </div>

    <script>
        // Function to fetch and display cart items
    function fetchCartItems() {
        fetch('/api/cart')
            .then(response => response.json())
            .then(data => {
                const cartItemsContainer = document.getElementById('cartItems');
                cartItemsContainer.innerHTML = ''; // Clear existing cart items
                let subtotal = 0;
                data.forEach(item => {
                    const itemElement = document.createElement('div');
                    itemElement.classList.add('flex', 'flex-col', 'md:flex-row', 'border-b', 'border-gray-400', 'py-4');
                    itemElement.innerHTML = `
                        <div class="flex-shrink-0">
                            <img src="${item.product.image_url}" alt="Product image" class="w-32 h-32 object-cover">
                        </div>
                        <div class="mt-4 md:mt-0 md:ml-6">
                            <h2 class="text-lg font-bold">${item.product.name}</h2>
                            <p class="mt-2 text-gray-600">${item.product.description}</p>
                            <div class="mt-4 flex items-center">
                                <span class="mr-2 text-gray-600">Quantity:</span>
                                <div class="flex items-center">
                                    <button class="bg-gray-200 rounded-l-lg px-2 py-1 updateQuantityBtn" data-id="${item.id}" data-quantity="${item.quantity - 1}">-</button>
                                    <span class="mx-2 text-gray-600">${item.quantity}</span>
                                    <button class="bg-gray-200 rounded-r-lg px-2 py-1 updateQuantityBtn" data-id="${item.id}" data-quantity="${item.quantity + 1}">+</button>
                                </div>
                                <button class="ml-4 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded removeItemBtn" data-id="${item.id}">Remove</button>
                                <span class="ml-auto font-bold">$${(item.product.price * item.quantity).toFixed(2)}</span>
                            </div>
                        </div>
                    `;
                    cartItemsContainer.appendChild(itemElement);
                    subtotal += item.product.price * item.quantity;
                });
                document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;

                // Add event listeners for update and remove buttons
                document.querySelectorAll('.updateQuantityBtn').forEach(btn => {
                    btn.addEventListener('click', updateCartItemQuantity);
                });
                document.querySelectorAll('.removeItemBtn').forEach(btn => {
                    btn.addEventListener('click', removeCartItem);
                });
            })
            .catch(error => console.error('Error fetching cart items:', error));
    }

    // Function to update cart item quantity
function updateCartItemQuantity(event) {
    const cartItemId = event.target.dataset.id;
    const newQuantity = parseInt(event.target.dataset.quantity);

    fetch(`/api/cart/${cartItemId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ quantity: newQuantity })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
        // Update the quantity element in the DOM
        const quantityElement = document.querySelector(`[data-id="${cartItemId}"][data-quantity="${newQuantity}"]`);
        quantityElement.textContent = newQuantity;

        // Update the subtotal
        const subtotalElement = document.getElementById('subtotal');
        const currentSubtotal = parseFloat(subtotalElement.textContent);
        const updatedSubtotal = (data.product.price * newQuantity).toFixed(2);
        subtotalElement.textContent = `$${updatedSubtotal}`;

        // Refresh the cart items after updating the quantity
        fetchCartItems();
    })
    .catch(error => console.error('Error updating cart item quantity:', error));
}
    // Function to remove cart item
function removeCartItem(event) {
    const cartItemId = event.target.dataset.id;

    fetch(`/api/cart/${cartItemId}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.message);
        // Remove the cart item element from the DOM
        const cartItemElement = document.querySelector(`[data-id="${cartItemId}"]`);
        cartItemsContainer.removeChild(cartItemElement);

        // Update the subtotal
        const subtotalElement = document.getElementById('subtotal');
        const currentSubtotal = parseFloat(subtotalElement.textContent);
        const updatedSubtotal = currentSubtotal - (data.product.price * data.quantity);
        subtotalElement.textContent = `$${updatedSubtotal.toFixed(2)}`;

        // Refresh the cart items after removing the item
        fetchCartItems();
    })
    .catch(error => console.error('Error removing cart item:', error));
}
    </script>
    </body>
</html>
