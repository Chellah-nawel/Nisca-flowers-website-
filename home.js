const slides = [
    {
        title: "A Moment<br>of Love",
        text: "Sometimes, the most beautiful gifts begin with<br>a simple thought. A bouquet chosen with love<br> can say more than words ever could.",
        image: "./images/hero1.svg" },

    {
        title: " Special Flowers <br>For You",
        text: "Every bouquet tells a story full of emotions and beauty.",
        image: "./images/hero2.svg"
    },

    {
        title: "Special<br>Moments",
        text: "Celebrate your memories with elegant flowers.",
        image: "./images/hero3.svg"
    }
];

let current = 0;

const title = document.querySelector(".hero-title");
const text = document.querySelector(".hero-description");
const hero = document.getElementById("hero");
const button = document.querySelector(".next-btn");

button.addEventListener("click", () => {

    current++;

    if(current >= slides.length){
        current = 0;
    }

    title.innerHTML = slides[current].title;

    text.innerHTML = slides[current].text;

    hero.style.backgroundImage = `url(${slides[current].image})`;
});

//expires in 30 days
function cookieExpireDate() {
    var d = new Date();
    d.setTime(d.getTime() + 30 * 24 * 60 * 60 * 1000);
    return d.toUTCString();
}

//print the banner if no consent
if (!localStorage.getItem('cookieConsent')) {
    document.getElementById('cookie-banner').style.display = 'flex';
}

function acceptCookies() {
    localStorage.setItem('cookieConsent', 'accepted');
    document.cookie = "cookieConsent=accepted; expires=" + cookieExpireDate() + "; path=/";
    document.getElementById('cookie-banner').style.display = 'none';
}

function declineCookies() {
    localStorage.setItem('cookieConsent', 'declined');
    document.cookie = "cookieConsent=declined; expires=" + cookieExpireDate() + "; path=/";
    document.getElementById('cookie-banner').style.display = 'none';
}

//masquer apres 4s
setTimeout(function() {
    var msgs = document.querySelectorAll('.msg-box');
    for (var i = 0; i < msgs.length; i++) {
        msgs[i].parentNode.removeChild(msgs[i]);
    }
}, 4000);