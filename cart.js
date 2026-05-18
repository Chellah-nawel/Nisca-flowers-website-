// Données des produits (exemple - adapter selon vos produits)
let productsData = [
    { id: 1, name: 'Bouquet 1', price: 1200, quantity: 1, image: 'product1.jpg', category: 'bouquets' },
    { id: 2, name: 'Bouquet 2', price: 1200, quantity: 1, image: 'product2.jpg', category: 'bouquets' },
    { id: 3, name: 'Bouquet 3', price: 1500, quantity: 1, image: 'product3.jpg', category: 'bouquets' },
    { id: 4, name: 'Bouquet 4', price: 2000, quantity: 2, image: 'product4.jpg', category: 'bouquets' }
];

let personalizedData = [
    { id: 5, name: 'Personalized 1', price: 2000, quantity: 2, images: ['p1.jpg', 'p2.jpg'], category: 'personalized' },
    { id: 6, name: 'Personalized 2', price: 2000, quantity: 2, images: ['p3.jpg', 'p4.jpg'], category: 'personalized' },
    { id: 7, name: 'Personalized 3', price: 2000, quantity: 2, images: ['p5.jpg', 'p6.jpg'], category: 'personalized' }
];

// Charger le panier depuis localStorage
let cart = JSON.parse(localStorage.getItem('cart')) || {
    products: productsData,
    personalized: personalizedData
};

// Initialiser le panier
document.addEventListener('DOMContentLoaded', function() {
    renderProducts();
    renderPersonalized();
    updateSummary();
    setupCheckoutModal();
});

// Afficher les produits réguliers
function renderProducts() {
    const tbody = document.getElementById('products-tbody');
    tbody.innerHTML = '';

    cart.products.forEach(product => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><button class="remove-btn" onclick="removeProduct(${product.id})">✕</button></td>
            <td>
                <img src="${product.image}" alt="${product.name}" class="product-image" onerror="this.src='placeholder.jpg'">
            </td>
            <td>${product.price}da</td>
            <td>
                <div class="quantity-control">
                    <button class="qty-btn" onclick="decrementQty(${product.id}, 'products')">-</button>
                    <input type="number" class="qty-input" value="${product.quantity}" readonly>
                    <button class="qty-btn" onclick="incrementQty(${product.id}, 'products')">+</button>
                </div>
            </td>
            <td>${product.price * product.quantity}da</td>
        `;
        tbody.appendChild(row);
    });
}

// Afficher les produits personnalisés
function renderPersonalized() {
    const tbody = document.getElementById('personalized-tbody');
    tbody.innerHTML = '';

    cart.personalized.forEach(product => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><button class="remove-btn" onclick="removeProduct(${product.id})">✕</button></td>
            <td>
                <div class="product-images">
                    ${product.images.map(img => `<img src="${img}" alt="Product" onerror="this.src='placeholder.jpg'">`).join('')}
                </div>
            </td>
            <td>${product.price}da</td>
            <td>
                <div class="quantity-control">
                    <button class="qty-btn" onclick="decrementQty(${product.id}, 'personalized')">-</button>
                    <input type="number" class="qty-input" value="${product.quantity}" readonly>
                    <button class="qty-btn" onclick="incrementQty(${product.id}, 'personalized')">+</button>
                </div>
            </td>
            <td>${product.price * product.quantity}da</td>
        `;
        tbody.appendChild(row);
    });
}

// Incrémenter la quantité
function incrementQty(productId, category) {
    const items = category === 'products' ? cart.products : cart.personalized;
    const product = items.find(p => p.id === productId);
    if (product) {
        product.quantity++;
        saveCart();
        renderByCategory(category);
        updateSummary();
    }
}

// Décrémenter la quantité
function decrementQty(productId, category) {
    const items = category === 'products' ? cart.products : cart.personalized;
    const product = items.find(p => p.id === productId);
    if (product && product.quantity > 1) {
        product.quantity--;
        saveCart();
        renderByCategory(category);
        updateSummary();
    }
}

// Supprimer un produit
function removeProduct(productId) {
    cart.products = cart.products.filter(p => p.id !== productId);
    cart.personalized = cart.personalized.filter(p => p.id !== productId);
    saveCart();
    renderProducts();
    renderPersonalized();
    updateSummary();
}

// Rafraîchir selon la catégorie
function renderByCategory(category) {
    if (category === 'products') {
        renderProducts();
    } else {
        renderPersonalized();
    }
}

// Sauvegarder le panier
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Mettre à jour le résumé
function updateSummary() {
    let bouquetsCount = 0;
    let bouquetsTotal = 0;
    let personalizedCount = 0;
    let personalizedTotal = 0;

    // Calculer les bouquets
    cart.products.forEach(p => {
        bouquetsCount += p.quantity;
        bouquetsTotal += p.price * p.quantity;
    });

    // Calculer les produits personnalisés
    cart.personalized.forEach(p => {
        personalizedCount += p.quantity;
        personalizedTotal += p.price * p.quantity;
    });

    const grandTotal = bouquetsTotal + personalizedTotal;

    // Mettre à jour l'affichage
    document.getElementById('bouquets-count').textContent = bouquetsCount;
    document.getElementById('bouquets-total').textContent = bouquetsTotal + 'da';
    document.getElementById('personalized-count').textContent = personalizedCount;
    document.getElementById('personalized-total').textContent = personalizedTotal + 'da';
    document.getElementById('grand-total').textContent = grandTotal + 'da';

    // Stocker pour le checkout
    window.cartSummary = {
        bouquetsCount,
        bouquetsTotal,
        personalizedCount,
        personalizedTotal,
        grandTotal
    };
}

// Setup Modal
function setupCheckoutModal() {
    const modal = document.getElementById('checkoutModal');
    const closeBtn = document.querySelector('.close');
    const form = document.getElementById('checkoutForm');

    closeBtn.onclick = function() {
        modal.style.display = 'none';
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

    form.onsubmit = function(e) {
        e.preventDefault();
        submitOrder();
    };
}

// Afficher le modal de checkout
function checkout() {
    document.getElementById('checkoutModal').style.display = 'block';
}

// Soumettre la commande
function submitOrder() {
    const form = document.getElementById('checkoutForm');
    const fullName = form.elements[0].value;
    const email = form.elements[1].value;
    const phone = form.elements[2].value;
    const address = form.elements[3].value;

    if (!fullName || !email || !phone || !address) {
        alert('Veuillez remplir tous les champs');
        return;
    }

    // Préparer les données de la commande
    const orderData = {
        customer: {
            name: fullName,
            email: email,
            phone: phone,
            address: address
        },
        items: [...cart.products, ...cart.personalized],
        summary: window.cartSummary,
        date: new Date().toISOString()
    };

    // Envoyer au serveur
    fetch('backend/process_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(orderData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Commande confirmée avec succès!');
            // Vider le panier
            cart.products = [];
            cart.personalized = [];
            saveCart();
            renderProducts();
            renderPersonalized();
            updateSummary();
            document.getElementById('checkoutModal').style.display = 'none';
            form.reset();
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de la soumission de la commande');
    });
}
