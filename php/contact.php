<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../home.php');
    exit();
}

if (!isset($_POST['firstName'])){
    $firstName = '';
} else {
    $firstName = trim($_POST['firstName']);
}

if (!isset($_POST['familyName'])){
    $familyName = '';
} else {
    $familyName = trim($_POST['familyName']);
}

if (!isset($_POST['email'])){
    $email = '';
} else {
    $email = trim($_POST['email']);
}

if (!isset($_POST['message'])){
    $message = '';
} else {
    $message = trim($_POST['message']);
}

if (!$firstName || !$familyName || !$email || !$message) {
    header('Location: ../home.php?contact_error=Please+fill+in+all+fields');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../home.php?contact_error=Invalid+email+address');
    exit();
}

$stmt = $pdo->prepare(
    "INSERT INTO messages (first_name, family_name, email, message) VALUES (?, ?, ?, ?)"
);
$stmt->execute([$firstName, $familyName, $email, $message]);

header('Location: ../home.php?contact_success=Message+sent+successfully!');
exit();
