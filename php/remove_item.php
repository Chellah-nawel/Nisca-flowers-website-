<?php
header('Content-Type: application/json');
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false]);
    exit();
}

$cartItemId = isset($_POST['cart_item_id']) ? (int)$_POST['cart_item_id'] : 0;

$stmt = $pdo->prepare("DELETE FROM cart_items WHERE id_cart_item = ?");
$stmt->execute([$cartItemId]);

echo json_encode(['success' => true]);
