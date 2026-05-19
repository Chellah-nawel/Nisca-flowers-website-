<?php
//cnx DB
$host   = 'localhost';
$dbname = 'flower_shop';
$user   = 'root';
$pass   = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    die(json_encode(['success' => false, 'message' => 'DB Error : ' . $e->getMessage()]));
}
