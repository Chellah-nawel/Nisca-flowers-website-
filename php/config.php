<?php
// ============================================================
//  Connexion à la base de données
//  PDO : méthode moderne et sécurisée pour parler à MySQL
// ============================================================

$host   = 'localhost';   // adresse du serveur MySQL (WAMP = localhost)
$dbname = 'nisca_db';    // nom de ta base de données dans phpMyAdmin
$user   = 'root';        // utilisateur WAMP par défaut
$pass   = '';            // mot de passe WAMP par défaut = vide

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Si une erreur SQL arrive, PHP lancera une exception (plus facile à déboguer)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // On retourne une réponse JSON en cas d'échec de connexion
    http_response_code(500);
    die(json_encode([
        'success' => false,
        'message' => 'Erreur de connexion : ' . $e->getMessage()
    ]));
}
