<?php
// ============================================================
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
header('Location: ../index.php');
exit();
