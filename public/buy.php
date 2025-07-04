<?php
include '../config/db.php';
include '../templates/header.php';

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    echo "<p>Please <a href='login.php'>login as customer</a> to buy products.</p>";
    include '../templates/footer.php';
    exit;
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['product_id'])) {
    die("No product selected.");
}

$product_id = intval($_GET['product_id']);
$product = $conn->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
if (!$product) {
    die("Product not found.");
}

$user = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
if (!$user) {
    die("User not found.");
}

$product_price = $product['price'];
$wallet_balance = $user['wallet'];
$credit_option1 = 500;
$credit_option2 = 0.25 * $product_price;
$min_credit = min($credit_option1, $credit_option2); // Choose the lower amount
$credit_to_use = min($wallet_balance, $min_credit);  // But not more than what's in the wallet

$amount_to_pay = $product_price - $credit_to_use;


$conn->begin_transaction();
try {
    $conn->query("UPDATE users SET wallet = wallet - $credit_to_use WHERE id = $user_id");
    $conn->query("INSERT INTO orders (user_id, product_id, amount, credit) VALUES ($user_id, $product_id, $amount_to_pay, $credit_to_use)");
    $conn->commit();
    echo "<p class='success'>Order placed! Amount paid: ₹$amount_to_pay, Credit used: ₹$credit_to_use</p>";
} catch (Exception $e) {
    $conn->rollback();
    echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
}

include '../templates/footer.php';
?>
