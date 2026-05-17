const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container    = document.getElementById('container');

signUpButton.addEventListener('click', () => {
  container.classList.add('right-panel-active');
});

signInButton.addEventListener('click', () => {
  container.classList.remove('right-panel-active');
});

//validation
document.getElementById('signUpForm').addEventListener('submit', function (e) {
  const password = document.getElementById('signup-password').value;
  const confirm  = document.getElementById('signup-confirm').value;

  if (password !== confirm) {
    e.preventDefault();
    alert('passwords do not match.');
  }
});

// calcule de date
function cookieExpireDate() {
  var d = new Date();
  d.setTime(d.getTime() + 30 * 24 * 60 * 60 * 1000);
  return d.toUTCString();
}

//afficher la bar
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

//masquer les mssgs
setTimeout(function() {
  var msgs = document.querySelectorAll('.msg-box');
  for (var i = 0; i < msgs.length; i++) {
    msgs[i].parentNode.removeChild(msgs[i]);
  }
}, 4000);