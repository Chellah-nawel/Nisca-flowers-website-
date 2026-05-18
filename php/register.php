<?php
// ============================================================
//  register.php — PHP 8.3
//  Appelé par : <form method="POST" action="php/register.php">
// ============================================================
session_start();
require_once 'config.php';   // $pdo est disponible ici

// Récupération POST — PHP 8 : on peut garder isset() ou utiliser ??
$name     = trim($_POST['name']     ?? '');
$email    = trim($_POST['email']    ?? '');
$password =      $_POST['password'] ?? '';
$confirm  =      $_POST['confirm']  ?? '';

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

// ── Le champ dans la BDD s'appelle "username" (voir WEB.sql) ──
$stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
$stmt->execute([$name]);
if ($stmt->fetch()) {
    header('Location: ../index.php?error=' . urlencode('This name is already taken.'));
    exit();
}

// ── Insertion ────────────────────────────────────────────────
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
$stmt->execute([$name, $email, $hash]);

header('Location: ../index.php?success=' . urlencode('Account created! You can log in now.'));
exit();
