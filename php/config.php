<?php
// ============================================================
<<<<<<< HEAD
//  config.php — Connexion BDD, PHP 8.3 moderne
// ============================================================

$host   = 'localhost';
$dbname = 'flower_shop';   // nom de ta BDD dans le SQL
$user   = 'root';
$pass   = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    // En PHP 8 on peut laisser remonter ou rediriger proprement
    http_response_code(500);
    die('Erreur BDD : ' . $e->getMessage());
=======
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
>>>>>>> e11413b2154c2369a9907f879974908eb4403dff
}
