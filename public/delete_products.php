<?php
include '../config/db.php';

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Access denied.");
}

if (!isset($_GET['id'])) {
    die("No product specified.");
}

$product_id = intval($_GET['id']);
$conn->query("DELETE FROM products WHERE id = $product_id");
header("Location: manage_products.php");
exit;
