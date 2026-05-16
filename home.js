// Nisca Flowers Website JavaScript

document.addEventListener('DOMContentLoaded', function() {
    
    // Smooth scrolling for navigation links
    const navLinks = document.querySelectorAll('.nav-links a');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Add active class handling
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Hero Slider functionality
    const sliderBtn = document.querySelector('.slider-btn');
    if (sliderBtn) {
        sliderBtn.addEventListener('click', function() {
            // Slider functionality placeholder
            console.log('Next slide');
        });
    }

    // Contact Form submission
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const firstName = document.getElementById('firstName').value;
            const familyName = document.getElementById('familyName').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;

            // Validate form
            if (!firstName || !familyName || !email || !message) {
                alert('Please fill in all fields');
                return;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return;
            }

            // Form submission success
            alert('Thank you for your message! We will get back to you soon.');
            contactForm.reset();
        });
    }

    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animateElements = document.querySelectorAll('.occasion-card, .feature, .bouquet-item');
    animateElements.forEach(el => {
        observer.observe(el);
    });

    // Mobile menu toggle (placeholder for future implementation)
    function createMobileMenu() {
        const header = document.querySelector('.header-container');
        const nav = document.querySelector('.nav');
        
        // Create hamburger menu button
        const menuBtn = document.createElement('button');
        menuBtn.className = 'mobile-menu-btn';
        menuBtn.innerHTML = '☰';
        menuBtn.style.display = 'none';
        
        // Insert before header actions
        const headerActions = document.querySelector('.header-actions');
        header.insertBefore(menuBtn, headerActions);

        // Toggle menu on click
        menuBtn.addEventListener('click', function() {
            nav.classList.toggle('mobile-open');
        });

        // Show/hide based on screen size
        function checkScreenSize() {
            if (window.innerWidth <= 768) {
                menuBtn.style.display = 'block';
            } else {
                menuBtn.style.display = 'none';
                nav.classList.remove('mobile-open');
            }
        }

        window.addEventListener('resize', checkScreenSize);
        checkScreenSize();
    }

    createMobileMenu();

    // Button hover effects
    const buttons = document.querySelectorAll('.btn-shop, .btn-contact, .btn-personalize, .btn-send, .btn-join');
    buttons.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Image lazy loading
    const images = document.querySelectorAll('img');
    if ('loading' in HTMLImageElement.prototype) {
        images.forEach(img => {
            img.loading = 'lazy';
        });
    }

    // Bouquet grid hover effects
    const bouquetItems = document.querySelectorAll('.bouquet-item');
    bouquetItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
            this.style.transition = 'transform 0.3s ease';
        });
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

});
