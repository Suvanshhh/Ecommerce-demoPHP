<?php
include '../config/db.php';
include '../templates/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<p>Access denied. Please <a href='login.php'>login as admin</a>.</p>";
    include '../templates/footer.php';
    exit;
}

$result = $conn->query("SELECT * FROM products ORDER BY id DESC");

echo "<h2>Manage Products</h2>";
echo "<a href='add_products.php'>Add New Product</a><br><br>";
echo "<table><tr><th>ID</th><th>Name</th><th>Price</th><th>Actions</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
    echo "<td>₹" . $row['price'] . "</td>";
    echo "<td>
            <a href='edit_products.php?id=" . $row['id'] . "'>Edit</a> |
            <a href='delete_products.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure?')\">Delete</a>
          </td>";
    echo "</tr>";
}
echo "</table>";

include '../templates/footer.php';
