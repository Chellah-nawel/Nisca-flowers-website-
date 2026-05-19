<?php
header('Content-Type: application/json');
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false]);
    exit();
}

if (isset($_POST['cart_item_id'])) {
    $cartItemId = (int)$_POST['cart_item_id'];
} else {
    $cartItemId = 0;
}

if (isset($_POST['quantity'])) {
    $quantity = (int)$_POST['quantity'];
} else {
    $quantity = 1;
}

if ($quantity < 1) $quantity = 1;
$stmt = $pdo->prepare("UPDATE cart_items SET quantity = ? WHERE id_cart_item = ?");
$stmt->execute([$quantity, $cartItemId]);
echo json_encode(['success' => true]);