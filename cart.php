<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?error=You+must+be+logged+in+to+access+the+shopping+cart');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&family=Great+Vibes&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <img src="images/logo.svg" alt="Nisca logo">
            </div>
            <nav class="nav">
                <ul class="nav-links">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="home.php#occasions-section">Catalogue</a></li>
                    <li><a href="home.php#personalize-section">Personalize</a></li>
                    <li><a href="home.php#story-section">About us</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <a href="cart.php" class="cart-icon">
                    <img src="images/shopicon.svg" alt="Cart">
                </a>
                <a href="php/logout.php" class="btn-join">Logout</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>SHOPPING CART</h1>
        </div>
    </section>

    <main class="container">
        <div class="cart-layout"> 
            <section class="products-section">
                <table class="products-table">
                    <thead>
                        <tr class="table-header">
                            <th></th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="products-tbody">
                        <tr><td colspan="5" style="text-align:center;padding:20px;">Chargement...</td></tr>
                    </tbody>
                </table>
            </section>

            <div class="cart-wrapper">
                <aside class="order-summary">
                    <h3>Order Summary</h3>
                    <div class="summary-content">
                        <div class="summary-row">
                            <span>Bouquets :</span>
                            <span id="bouquets-count">0</span>
                        </div>
                        <div class="summary-row">
                            <span>Total :</span>
                            <span id="bouquets-total">0da</span>
                        </div>
                        <div class="summary-row">
                            <span>Personalized :</span>
                            <span id="personalized-count">0</span>
                        </div>
                        <div class="summary-row">
                            <span>Total :</span>
                            <span id="personalized-total">0da</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-row total-row">
                            <span id="grand-total">0da</span>
                        </div>
                        <button class="buy-button" onclick="checkout()">Buy now</button>
                    </div>
                </aside>
            </div>
        </div>

        <section class="personalized-section">
            <table class="personalized-table">
                <thead>
                    <tr class="table-header">
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="personalized-tbody">
                    <tr><td colspan="5" style="text-align:center;padding:20px;">Chargement...</td></tr>
                </tbody>
            </table>
        </section>

    </main>

    <div id="checkoutModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Checkout</h2>
            <form id="checkoutForm">
                <input type="text"  id="checkout-name"    placeholder="Full Name"  required>
                <input type="email" id="checkout-email"   placeholder="Email"      required>
                <input type="tel"   id="checkout-phone"   placeholder="Phone"      required>
                <textarea           id="checkout-address" placeholder="Address"    required></textarea>
                <button type="submit" class="submit-button">Confirm Order</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <div class="footer-logo">
                    <img src="images/logo.svg" alt="Nisca">
                </div>
                <p class="footer-tagline">
                    Each flower is carefully chosen to create<br>
                    bouquets that feel as meaningful and<br>
                    beautiful as the moments you celebrate.
                </p>
            </div>
            <div class="footer-links">
                <h4>Quick links :</h4>
                <ul>
                    <li><a href="#"><img src="images/Facebook.svg" alt=""> Nisca_</a></li>
                    <li><a href="#"><img src="images/Instagram.svg" alt=""> nisca_29</a></li>
                    <li><a href="#"><img src="images/TikTok.svg" alt=""> Nisca_29</a></li>
                    <li><a href="#"><img src="images/X.svg" alt=""> nisca_29</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h4>Contact :</h4>
                <ul>
                    <li><img src="images/Phone.svg" alt=""> <a href="#">0550010558</a></li>
                    <li><img src="images/Mail.svg" alt=""> <a href="#">nisca_flowers@gmail.com</a></li>
                    <li><img src="images/Place Marker.svg" alt=""> <a href="#">cite Smail Yefsah Bab Ezzouare<br>Algiers Algeria</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Copyright © 2025 Nisca Studio. All Rights Reserved.</p>
            <p><a href="#">Our Terms & Conditions</a> | <a href="#">Privacy Policy</a></p>
        </div>
    </footer>

    <script src="cart.js"></script>
</body>
</html>
