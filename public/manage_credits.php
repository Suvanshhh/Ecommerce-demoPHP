<?php
include '../config/db.php';
include '../templates/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<p>Access denied. Please <a href='login.php'>login as admin</a>.</p>";
    include '../templates/footer.php';
    exit;
}

// Handle credit update
if (isset($_POST['user_id']) && isset($_POST['new_wallet'])) {
    $user_id = intval($_POST['user_id']);
    $new_wallet = floatval($_POST['new_wallet']);
    $conn->query("UPDATE users SET wallet = $new_wallet WHERE id = $user_id");
    echo "<p class='success'>Wallet updated successfully!</p>";
}

// Fetch all customers
$result = $conn->query("SELECT * FROM users WHERE role = 'customer' ORDER BY id ASC");
echo "<h2>Manage Customer Wallet Credits</h2>";
echo "<table><tr><th>ID</th><th>Name</th><th>Wallet</th><th>Action</th></tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<form method='POST'>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".htmlspecialchars($row['name'])."</td>";
    echo "<td><input type='number' step='0.01' name='new_wallet' value='".$row['wallet']."'></td>";
    echo "<td>
            <input type='hidden' name='user_id' value='".$row['id']."'>
            <input type='submit' value='Update'>
          </td>";
    echo "</form>";
    echo "</tr>";
}
echo "</table>";

include '../templates/footer.php';
?>
