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

if(isset($_POST['password'])) {
    $password = $_POST['password'];
} else {
    $password = '';
}

if (!$username || !$password) {
    header('Location: ../index.php?error=All+fields+are+required');
    exit();
}


$stmt = $pdo->prepare("SELECT * FROM users WHERE name = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password'])) {
    header('Location: ../index.php?error=Username+or+password+is+incorrect');
    exit();
}

// regenerer l'id de session
session_regenerate_id(true);

//stocker les infos en session
$_SESSION['user_id']   = $user['id'];
$_SESSION['user_name'] = $user['name'];

//cookies valide 30 jours
setcookie('nisca_user', $user['name'], [
    'expires'  => time() + 30 * 24 * 60 * 60,
    'path'     => '/',
    'httponly' => true,
    'samesite' => 'Lax',
]);

header('Location: ../home.php');
exit();
