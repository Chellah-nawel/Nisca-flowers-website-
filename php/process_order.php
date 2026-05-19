<?php
header('Content-Type: application/json');
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

// lire les données JSON du panier
$input = json_decode(file_get_contents('php://input'), true);

$userId     = $_SESSION['user_id'];
if(isset($input['customer']['name'])) {
    $name = trim($input['customer']['name']);
} else {
    $name = '';
}

if(isset($input['customer']['email'])) {
    $email = trim($input['customer']['email']);
} else {
    $email = '';
}

if(isset($input['customer']['phone'])) {
    $phone = trim($input['customer']['phone']);
} else {
    $phone = '';
}

if(isset($input['customer']['address'])) {
    $address = trim($input['customer']['address']);
} else {
    $address = '';
}

if(isset($input['cart_id'])) {
    $cartId = (int)$input['cart_id'];
} else {
    $cartId = 0;
}

if(isset($input['summary']['grandTotal'])) {
    $grandTotal = (float)$input['summary']['grandTotal'];
} else {
    $grandTotal = 0;
}

if (!$name || !$email || !$phone || !$address || !$cartId) {
    echo json_encode(['success' => false, 'message' => 'Missing information']);
    exit();
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("INSERT INTO orders (id_user, total_price) VALUES (?, ?)");
    $stmt->execute([$userId, $grandTotal]);
    $orderId = $pdo->lastInsertId();

    $stmt = $pdo->prepare("SELECT * FROM cart_items WHERE id_cart = ?");
    $stmt->execute([$cartId]);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($cartItems as $item) {
        if ($item['id_flower']) {
            $s = $pdo->prepare("SELECT price FROM flowers WHERE id_flower = ?");
            $s->execute([$item['id_flower']]);
            $flower = $s->fetch(PDO::FETCH_ASSOC);
            $price  = $flower ? $flower['price'] : 0;

            $s = $pdo->prepare("INSERT INTO order_items (id_order, id_flower, quantity, price) VALUES (?, ?, ?, ?)");
            $s->execute([$orderId, $item['id_flower'], $item['quantity'], $price]);

        } elseif ($item['id_custom']) {
            $s = $pdo->prepare("SELECT total_price FROM custom_bouquets WHERE id_custom = ?");
            $s->execute([$item['id_custom']]);
            $custom = $s->fetch(PDO::FETCH_ASSOC);
            $price  = $custom ? $custom['total_price'] : 0;

            $s = $pdo->prepare("INSERT INTO order_items (id_order, id_custom, quantity, price) VALUES (?, ?, ?, ?)");
            $s->execute([$orderId, $item['id_custom'], $item['quantity'], $price]);
        }
    }

    $stmt = $pdo->prepare("
        INSERT INTO order_info (id_order, id_user, phone, wilaya, communes, address, customer_name)
        VALUES (?, ?, ?, '-', '-', ?, ?)
    ");
    $stmt->execute([$orderId, $userId, $phone, $address, $name]);


    $stmt = $pdo->prepare("DELETE FROM cart_items WHERE id_cart = ?");
    $stmt->execute([$cartId]);
    $pdo->commit();
    echo json_encode(['success' => true, 'order_id' => $orderId]);

} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
