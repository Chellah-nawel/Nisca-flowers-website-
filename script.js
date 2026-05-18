// ============================================================
//  script.js — panel switch + cookie banner
//  HTML intact : method="POST" action="php/..." dans les forms
// ============================================================

document.addEventListener('DOMContentLoaded', function () {

    // ── Basculement panneau Login / Sign Up ──────────────────
    var signUpButton = document.getElementById('signUp');
    var signInButton = document.getElementById('signIn');
    var container    = document.getElementById('container');

    signUpButton.addEventListener('click', function () {
        container.classList.add('right-panel-active');
    });

    signInButton.addEventListener('click', function () {
        container.classList.remove('right-panel-active');
    });

    // ── Validation mot de passe côté client ─────────────────
    document.getElementById('signUpForm').addEventListener('submit', function (e) {
        var password = document.getElementById('signup-password').value;
        var confirm  = document.getElementById('signup-confirm').value;
        if (password !== confirm) {
            e.preventDefault();
            alert('Passwords do not match.');
        }
    });

    // ── Cookie banner ────────────────────────────────────────
    var banner = document.getElementById('cookie-banner');

    function getCookie(name) {
        var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? match[2] : null;
    }

    // Afficher seulement si aucun choix enregistré
    if (!localStorage.getItem('cookieConsent') && !getCookie('cookieConsent')) {
        banner.style.display = 'flex';
    }

    // ── Fonctions globales appelées par onclick="..." ────────
    window.acceptCookies = function () {
        var expires = new Date();
        expires.setTime(expires.getTime() + 30 * 24 * 60 * 60 * 1000);
        localStorage.setItem('cookieConsent', 'accepted');
        document.cookie = 'cookieConsent=accepted; expires=' + expires.toUTCString() + '; path=/';
        banner.style.display = 'none';
    };

    window.declineCookies = function () {
        var expires = new Date();
        expires.setTime(expires.getTime() + 30 * 24 * 60 * 60 * 1000);
        localStorage.setItem('cookieConsent', 'declined');
        document.cookie = 'cookieConsent=declined; expires=' + expires.toUTCString() + '; path=/';
        banner.style.display = 'none';
    };

    // ── Auto-masquer les messages erreur/succès après 4s ────
    setTimeout(function () {
        var msgs = document.querySelectorAll('.msg-box');
        for (var i = 0; i < msgs.length; i++) {
            msgs[i].parentNode.removeChild(msgs[i]);
        }
    }, 4000);

});
