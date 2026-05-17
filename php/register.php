<?php
// ============================================================
//  php/register.php  —  Compatible PHP 5.5
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
    header('Location: ../index.php?error=' . urlencode('BDD error connetion' . $e->getMessage()));
    exit();
}

// ── Récupération des données POST ────────────────────────────
$name     = isset($_POST['name'])     ? trim($_POST['name'])  : '';
$email    = isset($_POST['email'])    ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password']    : '';
$confirm  = isset($_POST['confirm'])  ? $_POST['confirm']     : '';

// ── Validations ──────────────────────────────────────────────
if ($name === '' || $email === '' || $password === '' || $confirm === '') {
    header('Location: ../index.php?error=' . urlencode('Fill all fields.'));
    exit();
}

if ($password !== $confirm) {
    header('Location: ../index.php?error=' . urlencode('Passwords do not match.'));
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../index.php?error=' . urlencode('Invalid email address.'));
    exit();
}

// ── Vérifier que le nom n'existe pas déjà ────────────────────
$stmt = $pdo->prepare('SELECT id FROM users WHERE name = ?');
$stmt->execute(array($name));
if ($stmt->fetch()) {
    header('Location: ../index.php?error=' . urlencode('This name is already taken. Please choose another one.'));
    exit();
}

// ── Insertion ────────────────────────────────────────────────
// password_hash() est disponible depuis PHP 5.5 ✓
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
$stmt->execute(array($name, $email, $hash));

// ── Redirection ───────────────────────────────────────────────
header('Location: ../index.php?success=' . urlencode('Account created successfully. You can log in now.'));
exit();
