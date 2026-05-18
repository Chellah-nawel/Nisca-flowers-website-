<?php
//si il n'est pas connecte yrouh login (index.php)
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
$userName = $_SESSION['user_name'];

//confirm form submission
$contactSuccess = isset($_GET['contact_success']) ? $_GET['contact_success'] : '';
$contactError   = isset($_GET['contact_error'])   ? $_GET['contact_error']   : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nisca - A Moment of Love</title>
    <link rel="stylesheet" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Poppins:wght@300;400;500;600&family=Great+Vibes&display=swap" rel="stylesheet">
</head>
<body>

    <?php if ($contactSuccess): ?>
        <div class="msg-box msg-success"><?= htmlspecialchars($contactSuccess) ?></div>
    <?php endif; ?>

    <?php if ($contactError): ?>
        <div class="msg-box msg-error"><?= htmlspecialchars($contactError) ?></div>
    <?php endif; ?>

    <header class="header">
        <div class="header-container">
            <div class="logo">
                <img src="images/logo.svg" alt="Nisca logo">
            </div>
            <nav class="nav">
                <ul class="nav-links">
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#occasions-section">Catalogue</a></li>
                    <li><a href="#personalize-section">Personalize</a></li>
                    <li><a href="#story-section">About us</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <a href="#" class="cart-icon">
                    <img src="images/shopicon.svg" alt="Cart">
                </a>
                <a href="php/logout.php" class="btn-join">Logout</a>
            </div>
        </div>
    </header>

    <section id="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title">A Moment<br>of Love</h1>
                <p class="hero-description">
                    Sometimes, the most beautiful gifts begin with<br> 
                    a simple thought. A bouquet chosen with love<br> 
                    can say more than words ever could.
                </p>
                <a href="#" class="btn-shop"> Shop Now → </a>
            </div>
            <div>
                <img src="images/row.svg" alt="Flowers" class="next-btn">
            </div>
        </div>
    </section>

    <section id="story-section">
        <h2 class="script-title">Every Bloom Tells a Story</h2>
        <p class="story-description">
            At Nisca Flowers, we believe that every bouquet tells a story. Born from a passion for beauty and<br>
            emotion, our creations are carefully handcrafted to capture life's most meaningful moments.<br>
            From timeless arrangements to personalized designs, each bouquet is made with attention, care,<br>
            and a touch of artistry.<br>
            Because for us, flowers are more than a gift — they are a language of the heart.
        </p>
        <a href="#" class="btn-contact">Contact Us</a>
    </section>

    <section id="occasions-section">
        <div class="categories">
            <h2 class="script-title" style="color: #B13862;">Bring beauty to every special moment.</h2>
        </div>
        <div class="occasions-grid">
            <div class="group">
                <div class="occasion-card">
                    <h3 class="occasion-title">Graduation</h3>
                    <div class="occasion-image">
                        <img src="images/graduation.png" alt="Graduation flowers">
                    </div>
                    <p>Celebrate success with <br>elegant blooms.</p>
                    <a href="#" class="see-more">See more ›</a>
                </div>
                <div class="occasion-card">
                    <h3 class="occasion-title">Wedding</h3>
                    <div class="occasion-image">
                        <img src="images/wedding.png" alt="Wedding flowers">
                    </div>
                    <p>Romantic flowers for<br> unforgettable weddings.</p>
                    <a href="#" class="see-more">See more ›</a>
                </div>
                <div class="occasion-card">
                    <h3 class="occasion-title">Birthday</h3>
                    <div class="occasion-image">
                        <img src="images/birthday.svg" alt="Birthday flowers">
                    </div>
                    <p>Bright flowers for<br> joyful celebrations.</p>
                    <a href="#" class="see-more">See more ›</a>
                </div>
                <div class="occasion-card">
                    <h3 class="occasion-title">Romance</h3>
                    <div class="occasion-image">
                        <img src="images/romance.svg" alt="Romance flowers">
                    </div>
                    <p>A bouquet filled with love, tenderness, and unforgettable moments.</p>
                    <a href="#" class="see-more">See more ›</a>
                </div>
                <div class="occasion-card">
                    <h3 class="occasion-title">Sympathy</h3>
                    <div class="occasion-image">
                        <img src="images/sympathy.svg" alt="Sympathy flowers">
                    </div>
                    <p>Thoughtful arrangements to express care and support during difficult times.</p>
                    <a href="#" class="see-more">See more ›</a>
                </div>
            </div>

            <div aria-hidden class="group">
                <div class="occasion-card">
                    <h3 class="occasion-title">Graduation</h3>
                    <div class="occasion-image">
                        <img src="images/graduation.png" alt="Graduation flowers">
                    </div>
                    <p>Celebrate success with <br>elegant blooms.</p>
                    <a href="#" class="see-more">See more ›</a>
                </div>
                <div class="occasion-card">
                    <h3 class="occasion-title">Wedding</h3>
                    <div class="occasion-image">
                        <img src="images/wedding.png" alt="Wedding flowers">
                    </div>
                    <p>Romantic flowers for<br> unforgettable weddings.</p>
                    <a href="#" class="see-more">See more ›</a>
                </div>
                <div class="occasion-card">
                    <h3 class="occasion-title">Birthday</h3>
                    <div class="occasion-image">
                        <img src="images/birthday.svg" alt="Birthday flowers">
                    </div>
                    <p>Bright flowers for<br> joyful celebrations.</p>
                    <a href="#" class="see-more">See more ›</a>
                </div>
                <div class="occasion-card">
                    <h3 class="occasion-title">Romance</h3>
                    <div class="occasion-image">
                        <img src="images/romance.svg" alt="Romance flowers">
                    </div>
                    <p>A bouquet filled with love, tenderness, and unforgettable moments.</p>
                    <a href="#" class="see-more">See more ›</a>
                </div>
                <div class="occasion-card">
                    <h3 class="occasion-title">Sympathy</h3>
                    <div class="occasion-image">
                        <img src="images/sympathy.svg" alt="Sympathy flowers">
                    </div>
                    <p>Thoughtful arrangements to express care and support during difficult times.</p>
                    <a href="#" class="see-more">See more ›</a>
                </div>
            </div>
        </div>
    </section>

    <section class="features-bar">
        <div class="features-container">
            <div class="feature">
                <div class="feature-icon">
                    <img src="images/icon-quality.svg" alt="Quality">
                </div>
                <p class="feature-label">Best <br> <span class="feature-text">quality assured</span></p>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <img src="images/icon-delivery.svg" alt="Delivery">
                </div>
                <p class="feature-label">Fast <br> <span class="feature-text">delivery 7/24</span></p>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <img src="images/icon-fresh.svg" alt="Fresh">
                </div>
                <p class="feature-label">Always <br> <span class="feature-text">fresh flowers</span></p>
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <img src="images/icon-secure.svg" alt="Secure">
                </div>
                <p class="feature-label">Easy <br> <span class="feature-text">secure payment</span></p>
            </div>
        </div>
    </section>

    <section id="personalize-section">
        <h2 class="script-title" style="color: #B13862;">Create a bouquet as unique as your story</h2>
        <div class="bouquet-grid" id="grid1">
            <div class="small_pictures">
                <div class="bouquet-item"><img src="images/pic1.svg" alt="Bouquet"></div>
                <div class="bouquet-item"><img src="images/pic2.svg" alt="Bouquet"></div>
            </div>
            <div class="bouquet-item-large"><img src="images/pic3.svg" alt="Bouquet"></div>
        </div>
        <div class="bouquet-grid">
            <div class="bouquet-item-large" id="large-pic"><img src="images/pic4.svg" alt="Bouquet"></div>
            <div class="small_pictures2">
                <div class="bouquet-item"><img src="images/pic5.svg" alt="Bouquet"></div>
                <div class="bouquet-item"><img src="images/pic6.svg" alt="Bouquet"></div>
            </div>
        </div>
        <a href="#" class="btn-personalize">Personalize</a>
    </section>

    <section class="contact-section">
        <h2 class="script-title">We'd love to hear from you</h2>
        <div class="contact-container">
            <div class="contact-image">
                <img src="images/contact_pic.svg" alt="Flowers">
            </div>
            <form class="contact-form" id="contactForm" method="POST" action="php/contact.php">
                <div class="all_form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">First Name :</label>
                            <input type="text" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="familyName">Family Name :</label>
                            <input type="text" id="familyName" name="familyName" required>
                        </div>
                    </div>
                    <div class="form-mail">
                        <label class="lab-email" for="email">Email :</label>
                        <input class="inp-email" type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn-send">Send</button>
                </div>
            </form>
        </div>
    </section>

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

    <div id="cookie-banner" style="display:none;">
        <p>
            🍪 We use cookies to improve your experience on Nisca Flowers.
            By continuing, you accept our <a href="#https://commission.europa.eu/cookies-policy_en">cookie policy</a>.
        </p>
        <div>
            <button class="cookie-btn accept"  onclick="acceptCookies()">Accept</button>
            <button class="cookie-btn decline" onclick="declineCookies()">Decline</button>
        </div>
    </div>

    <script src="home.js"></script>
</body>
</html>
