<?php
// ============================================================
<<<<<<< HEAD
//  login.php — PHP 8.3
//  Appelé par : <form method="POST" action="php/login.php">
// ============================================================
session_start();
require_once 'config.php';

$name     = trim($_POST['name']     ?? '');
$password =      $_POST['password'] ?? '';
=======
//  php/login.php  —  Compatible PHP 5.5
// ============================================================
session_start();

// ── Connexion BDD ────────────────────────────────────────────
$host   = 'localhost';
$db     = 'nisca_db';
$dbuser = 'root';
$dbpass = '';

$dsn = "mysql:host=$host;dbname=$db";

try {
    $pdo = new PDO($dsn, $dbuser, $dbpass, array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
} catch (PDOException $e) {
    header('Location: ../index.php?error=' . urlencode('BDD error connection ' . $e->getMessage()));
    exit();
}

// ── Récupération des données POST ────────────────────────────
$name     = isset($_POST['name'])     ? trim($_POST['name'])  : '';
$password = isset($_POST['password']) ? $_POST['password']    : '';
>>>>>>> e11413b2154c2369a9907f879974908eb4403dff

if ($name === '' || $password === '') {
    header('Location: ../index.php?error=' . urlencode('Fill all fields.'));
    exit();
}

<<<<<<< HEAD
// ── Le champ dans la BDD s'appelle "username" (voir WEB.sql) ──
$stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = ?');
$stmt->execute([$name]);
=======
// ── Vérification en BDD ──────────────────────────────────────
$stmt = $pdo->prepare('SELECT id, name, password FROM users WHERE name = ?');
$stmt->execute(array($name));
>>>>>>> e11413b2154c2369a9907f879974908eb4403dff
$userRow = $stmt->fetch();

if (!$userRow || !password_verify($password, $userRow['password'])) {
    header('Location: ../index.php?error=' . urlencode('Name or password incorrect.'));
    exit();
}

<<<<<<< HEAD
// ── Session ──────────────────────────────────────────────────
$_SESSION['user_id']   = $userRow['id'];
$_SESSION['user_name'] = $userRow['username'];

// ── Cookie remember_token — PHP 8.3 : syntaxe tableau OK ─────
$token = bin2hex(random_bytes(32));   // random_bytes() existe depuis PHP 7 ✓

setcookie('remember_token', $token, [
    'expires'  => time() + 30 * 24 * 3600,
    'path'     => '/',
    'httponly' => true,    // inaccessible au JavaScript
    'samesite' => 'Lax',
]);

=======
// ── Création de la session ───────────────────────────────────
$_SESSION['user_id']   = $userRow['id'];
$_SESSION['user_name'] = $userRow['name'];

// ── Cookie "se souvenir" — syntaxe PHP 5.5 compatible ────────
// random_bytes() n'existe pas en PHP 5.5, on utilise openssl_random_pseudo_bytes
$tokenBytes = openssl_random_pseudo_bytes(32);
$token      = bin2hex($tokenBytes);

// setcookie() avec tableau n'existe qu'en PHP 7.3+
// En PHP 5.5 on utilise la signature classique :
// setcookie(name, value, expire, path, domain, secure, httponly)
setcookie(
    'remember_token',           // nom du cookie
    $token,                     // valeur
    time() + 30 * 24 * 3600,   // expiration : 30 jours
    '/',                        // path
    '',                         // domain (vide = domaine actuel)
    false,                      // secure (true uniquement en HTTPS)
    true                        // httponly : inaccessible au JS
);

// ── Cookie de consentement (affiché côté JS, confirmé ici) ───
// On le lit mais ne le force pas — le JS gère l'affichage
// de la bannière via localStorage

// ── Redirection ───────────────────────────────────────────────
>>>>>>> e11413b2154c2369a9907f879974908eb4403dff
header('Location: ../home.php');
exit();
