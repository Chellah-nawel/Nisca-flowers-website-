<?php
// ============================================================
//  logout.php — PHP 8.3
// ============================================================
session_start();

$_SESSION = [];
session_destroy();

// Supprimer le cookie remember_token
setcookie('remember_token', '', [
    'expires'  => time() - 3600,
    'path'     => '/',
    'httponly' => true,
    'samesite' => 'Lax',
]);

header('Location: ../index.php');
exit();
