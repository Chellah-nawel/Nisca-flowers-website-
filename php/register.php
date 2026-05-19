<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit();
}

if(isset($_POST['name'])) {
    $username = trim($_POST['name']);
} else {
    $username = '';
}

if(isset($_POST['email'])) {
    $email = trim($_POST['email']);
} else {
    $email = '';
}

if(isset($_POST['password'])) {
    $password = $_POST['password'];
} else {
    $password = '';
}

if (!$username || !$email || !$password) {
    header('Location: ../index.php?error=All+fields+are+required');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../index.php?error=Invalid+email');
    exit();
}

//verifier doublons
$stmt = $pdo->prepare("SELECT id FROM users WHERE name = ? OR email = ?");
$stmt->execute([$username, $email]);
if ($stmt->fetch()) {
    header('Location: ../index.php?error=This+name+or+this+email+is+already+used');
    exit();
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $hashed]);

header('Location: ../index.php?success=Account+created+!+Please+login');
exit();
