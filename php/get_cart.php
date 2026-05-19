<?php
header('Content-Type: application/json');
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Non connecté']);
    exit();
}

$userId = $_SESSION['user_id'];

//recuperer panier
$stmt = $pdo->prepare("SELECT id_cart FROM cart WHERE id_user = ? AND is_active = 1 LIMIT 1");
$stmt->execute([$userId]);
$cartRow = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cartRow) {
    $stmt = $pdo->prepare("INSERT INTO cart (id_user, is_active) VALUES (?, 1)");
    $stmt->execute([$userId]);
    $cartId = $pdo->lastInsertId();
} else {
    $cartId = $cartRow['id_cart'];
}

//bouquets
$stmt = $pdo->prepare("
    SELECT ci.id_cart_item, ci.quantity,
           f.id_flower, f.name_flower, f.price, f.image_url
    FROM cart_items ci
    JOIN flowers f ON ci.id_flower = f.id_flower
    WHERE ci.id_cart = ? AND ci.id_flower IS NOT NULL
");
$stmt->execute([$cartId]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

//personalized
$stmt = $pdo->prepare("
    SELECT ci.id_cart_item, ci.quantity,
           cb.id_custom, cb.total_price,
           c.name_color AS wrapping_color
    FROM cart_items ci
    JOIN custom_bouquets cb ON ci.id_custom = cb.id_custom
    LEFT JOIN colors c ON cb.wrapping_color_id = c.id_color
    WHERE ci.id_cart = ? AND ci.id_custom IS NOT NULL
");
$stmt->execute([$cartId]);
$personalized = $stmt->fetchAll(PDO::FETCH_ASSOC);

//les images des bouquets personalized
foreach ($personalized as &$item) {
    $stmt = $pdo->prepare("
        SELECT ft.image_url
        FROM custom_bouquet_items cbi
        JOIN flower_types ft ON cbi.id_flower_type = ft.id_flower_type
        WHERE cbi.id_custom = ?
        LIMIT 2
    ");
    $stmt->execute([$item['id_custom']]);
    $item['images'] = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

echo json_encode([
    'success'     => true,
    'cart_id'     => $cartId,
    'products'    => $products,
    'personalized'=> $personalized
]);
