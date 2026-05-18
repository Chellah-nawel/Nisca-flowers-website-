<?php
// ============================================================
//  login.php — PHP 8.3
//  Appelé par : <form method="POST" action="php/login.php">
// ============================================================
session_start();
require_once 'config.php';

$name     = trim($_POST['name']     ?? '');
$password =      $_POST['password'] ?? '';

if ($name === '' || $password === '') {
    header('Location: ../index.php?error=' . urlencode('Fill all fields.'));
    exit();
}

// ── Le champ dans la BDD s'appelle "username" (voir WEB.sql) ──
$stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = ?');
$stmt->execute([$name]);
$userRow = $stmt->fetch();

if (!$userRow || !password_verify($password, $userRow['password'])) {
    header('Location: ../index.php?error=' . urlencode('Name or password incorrect.'));
    exit();
}

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

header('Location: ../home.php');
exit();
