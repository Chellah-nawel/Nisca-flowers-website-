<?php
// ============================================================
<<<<<<< HEAD
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

=======
//  Déconnexion
//  Détruit la session et supprime le cookie, puis redirige
// ============================================================

session_start();

// Vider toutes les variables de session
$_SESSION = [];

// Détruire la session côté serveur
session_destroy();

// Supprimer le cookie en mettant sa date d'expiration dans le passé
setcookie('nisca_user', '', time() - 3600, '/');

// Rediriger vers la page de connexion
>>>>>>> e11413b2154c2369a9907f879974908eb4403dff
header('Location: ../index.php');
exit();
