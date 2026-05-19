let cartId = null;

//charger panier
document.addEventListener('DOMContentLoaded', function() {
    loadCart();
    setupCheckoutModal();
});

//dans BD
async function loadCart() {
    try {
        const response = await fetch('php/get_cart.php');
        const data = await response.json();

        if (!data.success) {
            console.error('Cart Error:', data.message);
            return;
        }

        cartId = data.cart_id;
        renderProducts(data.products);
        renderPersonalized(data.personalized);
        updateSummary(data.products, data.personalized);

    } catch (err) {
        console.error('Network Error:', err);
    }
}


function renderProducts(products) {
    const tbody = document.getElementById('products-tbody');
    tbody.innerHTML = '';

    if (!products || products.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;padding:20px;color:#B84B7E;">No bouquets in cart</td></tr>';
        return;
    }

    products.forEach(function(product) {
        const row = document.createElement('tr');
        row.innerHTML =
            '<td><button class="remove-btn" onclick="removeItem(' + product.id_cart_item + ')">✕</button></td>' +
            '<td><img src="' + product.image_url + '" alt="' + product.name_flower + '" class="product-image" onerror="this.src=\'images/placeholder.png\'"></td>' +
            '<td>' + product.price + 'da</td>' +
            '<td>' +
                '<div class="quantity-control">' +
                    '<button class="qty-btn" onclick="updateQty(' + product.id_cart_item + ', ' + (parseInt(product.quantity) - 1) + ')">-</button>' +
                    '<input type="number" class="qty-input" value="' + product.quantity + '" readonly>' +
                    '<button class="qty-btn" onclick="updateQty(' + product.id_cart_item + ', ' + (parseInt(product.quantity) + 1) + ')">+</button>' +
                '</div>' +
            '</td>' +
            '<td>' + (product.price * product.quantity) + 'da</td>';
        tbody.appendChild(row);
    });
}

//afficher les bouquets personnalises
function renderPersonalized(personalized) {
    const tbody = document.getElementById('personalized-tbody');
    tbody.innerHTML = '';

    if (!personalized || personalized.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;padding:20px;color:#B84B7E;">No personalized bouquets</td></tr>';
        return;
    }

    personalized.forEach(function(item) {
        var imagesHtml = '';
        if (item.images && item.images.length > 0) {
            item.images.forEach(function(img) {
                imagesHtml += '<img src="' + img + '" alt="Bouquet" onerror="this.src=\'images/placeholder.png\'">';
            });
        } else {
            imagesHtml = '<span style="color:#B84B7E;">Personalized Bouquet</span>';
        }

        const row = document.createElement('tr');
        row.innerHTML =
            '<td><button class="remove-btn" onclick="removeItem(' + item.id_cart_item + ')">✕</button></td>' +
            '<td><div class="product-images">' + imagesHtml + '</div></td>' +
            '<td>' + item.total_price + 'da</td>' +
            '<td>' +
                '<div class="quantity-control">' +
                    '<button class="qty-btn" onclick="updateQty(' + item.id_cart_item + ', ' + (parseInt(item.quantity) - 1) + ')">-</button>' +
                    '<input type="number" class="qty-input" value="' + item.quantity + '" readonly>' +
                    '<button class="qty-btn" onclick="updateQty(' + item.id_cart_item + ', ' + (parseInt(item.quantity) + 1) + ')">+</button>' +
                '</div>' +
            '</td>' +
            '<td>' + (item.total_price * item.quantity) + 'da</td>';
        tbody.appendChild(row);
    });
}

//utilisation de AJAX pour mettre a jour la quantite
async function updateQty(cartItemId, newQty) {
    if (newQty < 1) return;

    const formData = new FormData();
    formData.append('cart_item_id', cartItemId);
    formData.append('quantity', newQty);

    await fetch('php/update_quantity.php', { method: 'POST', body: formData });
    loadCart(); //recharger
}

//suppression avec AJAX
async function removeItem(cartItemId) {
    const formData = new FormData();
    formData.append('cart_item_id', cartItemId);

    await fetch('php/remove_item.php', { method: 'POST', body: formData });
    loadCart();
}

//affichage finale
function updateSummary(products, personalized) {
    var bouquetsCount = 0, bouquetsTotal = 0;
    var personalizedCount = 0, personalizedTotal = 0;

    if (products) {
        products.forEach(function(p) {
            bouquetsCount += parseInt(p.quantity);
            bouquetsTotal += parseFloat(p.price) * parseInt(p.quantity);
        });
    }

    if (personalized) {
        personalized.forEach(function(p) {
            personalizedCount += parseInt(p.quantity);
            personalizedTotal += parseFloat(p.total_price) * parseInt(p.quantity);
        });
    }

    var grandTotal = bouquetsTotal + personalizedTotal;

    document.getElementById('bouquets-count').textContent     = bouquetsCount;
    document.getElementById('bouquets-total').textContent     = bouquetsTotal + 'da';
    document.getElementById('personalized-count').textContent = personalizedCount;
    document.getElementById('personalized-total').textContent = personalizedTotal + 'da';
    document.getElementById('grand-total').textContent        = grandTotal + 'da';

    window.cartSummary = {
        bouquetsCount:     bouquetsCount,
        bouquetsTotal:     bouquetsTotal,
        personalizedCount: personalizedCount,
        personalizedTotal: personalizedTotal,
        grandTotal:        grandTotal
    };
}

//le modal de checkout
function setupCheckoutModal() {
    var modal    = document.getElementById('checkoutModal');
    var closeBtn = document.querySelector('.close');
    var form     = document.getElementById('checkoutForm');

    closeBtn.onclick = function() { modal.style.display = 'none'; };

    window.onclick = function(event) {
        if (event.target === modal) modal.style.display = 'none';
    };

    form.onsubmit = function(e) {
        e.preventDefault();
        submitOrder();
    };
}

function checkout() {
    document.getElementById('checkoutModal').style.display = 'block';
}

async function submitOrder() {
    var name    = document.getElementById('checkout-name').value.trim();
    var email   = document.getElementById('checkout-email').value.trim();
    var phone   = document.getElementById('checkout-phone').value.trim();
    var address = document.getElementById('checkout-address').value.trim();

    if (!name || !email || !phone || !address) {
        alert('Please fill in all fields');
        return;
    }
    var orderData = {
        customer: { name: name, email: email, phone: phone, address: address },
        cart_id:  cartId,
        summary:  window.cartSummary
    };
    try {
        const response = await fetch('php/process_order.php', {
            method:  'POST',
            headers: { 'Content-Type': 'application/json' },
            body:    JSON.stringify(orderData)
        });
        const data = await response.json();

        if (data.success) {
            alert('Order confirmed! Thank you for your purchase.');
            document.getElementById('checkoutModal').style.display = 'none';
            document.getElementById('checkoutForm').reset();
            loadCart();
        } else {
            alert('Error : ' + data.message);
        }
    } catch (err) {
        console.error('Network Error:', err);
        alert('Error occurred while submitting the order');
    }
}
