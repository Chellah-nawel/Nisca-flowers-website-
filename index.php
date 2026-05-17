<?php
// si user est deja connecte yrouh drct home.php
session_start();
if (isset($_SESSION['user_id'])) {
  header('Location: home.php');
  exit();
}

//mssg d'erreur et succes
$error   = isset($_GET['error'])   ? $_GET['error']   : '';
$success = isset($_GET['success']) ? $_GET['success'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nisca Auth</title>
  <link rel="stylesheet" href="style.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <?php if ($error): ?>
    <div class="msg-box msg-error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="msg-box msg-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <div class="container" id="container">
    <div class="form-container sign-up-container">
      <form class="form" id="signUpForm" method="POST" action="php/register.php">
        <label for="signup-name">Name :</label>
        <div class="input-wrapper">
          <input id="signup-name" name="name" type="text" placeholder="Name" required />
          <span class="input-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
              <circle cx="12" cy="7" r="4" />
            </svg>
          </span>
        </div>

        <label for="signup-email">Email :</label>
        <div class="input-wrapper">
          <input id="signup-email" name="email" type="email" placeholder="email" required />
          <span class="input-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="4" width="20" height="16" rx="2" />
              <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
            </svg>
          </span>
        </div>

        <label for="signup-password">Password:</label>
        <div class="input-wrapper">
          <input id="signup-password" name="password" type="password" placeholder="Password" required />
          <span class="input-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
              <path d="M7 11V7a5 5 0 0 1 10 0v4" />
              <circle cx="12" cy="16" r="1" />
            </svg>
          </span>
        </div>

        <label for="signup-confirm">Confirm Password :</label>
        <div class="input-wrapper">
          <input id="signup-confirm" name="confirm" type="password" placeholder="Confirm Password" required />
          <span class="input-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
              <path d="M7 11V7a5 5 0 0 1 10 0v4" />
              <circle cx="12" cy="16" r="1" />
            </svg>
          </span>
        </div>

        <button type="submit" class="btn-primary">Sign in</button>
      </form>
    </div>

    <div class="form-container sign-in-container">
      <form class="form" id="signInForm" method="POST" action="php/login.php">

        <label for="login-name">Name :</label>
        <div class="input-wrapper">
          <input id="login-name" name="name" type="text" placeholder="Name" required />
          <span class="input-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
              <circle cx="12" cy="7" r="4" />
            </svg>
          </span>
        </div>

        <label for="login-password">Password:</label>
        <div class="input-wrapper">
          <input id="login-password" name="password" type="password" placeholder="Password" required />
          <span class="input-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
              <path d="M7 11V7a5 5 0 0 1 10 0v4" />
              <circle cx="12" cy="16" r="1" />
            </svg>
          </span>
        </div>

        <button type="submit" class="btn-primary">Log In</button>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Welcome<br>Back !</h1>
          <p>Sign in and turn simple moments<br>into beautiful memories.</p>
          <button class="ghost" id="signIn">Log in</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Welcome<br>to Nisca</h1>
          <p>Log in to discover flowers made for<br>your special moments.</p>
          <button class="ghost" id="signUp">Sign in</button>
        </div>
      </div>
    </div>

  </div>

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

  <script src="script.js"></script>
</body>
</html>
