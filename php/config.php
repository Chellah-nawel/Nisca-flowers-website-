<?php
// ============================================================
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
}
