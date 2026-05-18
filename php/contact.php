<?php
// ============================================================
//  contact.php — PHP 8.3
//  Appelé par : <form method="POST" action="php/contact.php">
// ============================================================
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

require_once 'config.php';

$firstName  = trim($_POST['firstName']  ?? '');
$familyName = trim($_POST['familyName'] ?? '');
$email      = trim($_POST['email']      ?? '');
$message    = trim($_POST['message']    ?? '');

if ($firstName === '' || $familyName === '' || $email === '' || $message === '') {
    header('Location: ../home.php?contact_error=' . urlencode('Fill all fields.'));
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../home.php?contact_error=' . urlencode('Invalid email address.'));
    exit();
}

// ── Insertion dans la table messages ─────────────────────────
// Créer la table si elle n'existe pas :
// CREATE TABLE IF NOT EXISTS messages (
//   id INT AUTO_INCREMENT PRIMARY KEY,
//   first_name VARCHAR(100), family_name VARCHAR(100),
//   email VARCHAR(150), message TEXT,
//   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );
$stmt = $pdo->prepare(
    'INSERT INTO messages (first_name, family_name, email, message) VALUES (?, ?, ?, ?)'
);
$stmt->execute([$firstName, $familyName, $email, $message]);

header('Location: ../home.php?contact_success=' . urlencode('Message sent! We will get back to you soon.'));
exit();
