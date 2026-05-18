<?php
// ============================================================
<<<<<<< HEAD
//  contact.php — PHP 8.3
//  Appelé par : <form method="POST" action="php/contact.php">
=======
//  php/contact.php  —  Compatible PHP 5.5
>>>>>>> e11413b2154c2369a9907f879974908eb4403dff
// ============================================================
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

<<<<<<< HEAD
require_once 'config.php';

$firstName  = trim($_POST['firstName']  ?? '');
$familyName = trim($_POST['familyName'] ?? '');
$email      = trim($_POST['email']      ?? '');
$message    = trim($_POST['message']    ?? '');

=======
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
    header('Location: ../home.php?contact_error=' . urlencode('BDD connection error: '. $e->getMessage()));
    exit();
}

// ── Récupération des données POST ────────────────────────────
$firstName  = isset($_POST['firstName'])  ? trim($_POST['firstName'])  : '';
$familyName = isset($_POST['familyName']) ? trim($_POST['familyName']) : '';
$email      = isset($_POST['email'])      ? trim($_POST['email'])      : '';
$message    = isset($_POST['message'])    ? trim($_POST['message'])    : '';

// ── Validation ───────────────────────────────────────────────
>>>>>>> e11413b2154c2369a9907f879974908eb4403dff
if ($firstName === '' || $familyName === '' || $email === '' || $message === '') {
    header('Location: ../home.php?contact_error=' . urlencode('Fill all fields.'));
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../home.php?contact_error=' . urlencode('Invalid email address.'));
    exit();
}

<<<<<<< HEAD
// ── Insertion dans la table messages ─────────────────────────
// Créer la table si elle n'existe pas :
// CREATE TABLE IF NOT EXISTS messages (
//   id INT AUTO_INCREMENT PRIMARY KEY,
//   first_name VARCHAR(100), family_name VARCHAR(100),
//   email VARCHAR(150), message TEXT,
=======
// ── Insertion en BDD ─────────────────────────────────────────
// SQL pour créer la table si elle n'existe pas encore :
// CREATE TABLE IF NOT EXISTS messages (
//   id INT AUTO_INCREMENT PRIMARY KEY,
//   first_name VARCHAR(100),
//   family_name VARCHAR(100),
//   email VARCHAR(150),
//   message TEXT,
>>>>>>> e11413b2154c2369a9907f879974908eb4403dff
//   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );
$stmt = $pdo->prepare(
    'INSERT INTO messages (first_name, family_name, email, message) VALUES (?, ?, ?, ?)'
);
<<<<<<< HEAD
$stmt->execute([$firstName, $familyName, $email, $message]);

header('Location: ../home.php?contact_success=' . urlencode('Message sent! We will get back to you soon.'));
=======
$stmt->execute(array($firstName, $familyName, $email, $message));

// ── Redirection avec succès ───────────────────────────────────
header('Location: ../home.php?contact_success=' . urlencode('Message sent successfully. We will get back to you soon!'));
>>>>>>> e11413b2154c2369a9907f879974908eb4403dff
exit();
