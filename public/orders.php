<?php
include '../config/db.php';
include '../templates/header.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    echo "<p>Please <a href='login.php'>login as customer</a> to view your orders.</p>";
    include '../templates/footer.php';
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT o.id, p.name, o.amount, o.credit, o.created_at
        FROM orders o
        JOIN products p ON o.product_id = p.id
        WHERE o.user_id = $user_id
        ORDER BY o.created_at DESC";

$result = $conn->query($sql);

echo "<h2>My Orders</h2>";

if (!$result || $result->num_rows === 0) {
    echo "<p>No orders found.</p>";
} else {
    echo "<table><tr><th>Order ID</th><th>Product</th><th>Amount Paid</th><th>Credit Used</th><th>Date</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>₹" . htmlspecialchars($row['amount']) . "</td>";
        echo "<td>₹" . htmlspecialchars($row['credit']) . "</td>";
        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

include '../templates/footer.php';
?>
