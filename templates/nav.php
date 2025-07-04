<?php
session_start();
$wallet_balance = null;

// Show wallet balance only for customers
if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'customer') {
    include_once '../config/db.php'; // Ensure DB connection is available
    $user_id = $_SESSION['user_id'];
    $result = $conn->query("SELECT wallet FROM users WHERE id = $user_id");
    if ($row = $result->fetch_assoc()) {
        $wallet_balance = $row['wallet'];
    }
}
?>
<nav>
    <a href="index.php">Home</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <span>
            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo $_SESSION['role']; ?>)
            <?php if ($wallet_balance !== null): ?>
                | Credits Left: ₹<?php echo $wallet_balance; ?>
            <?php endif; ?>
        </span> |
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="manage_products.php">Manage Products</a> |
            <a href="manage_credits.php">Manage Credits</a> |
        <?php else: ?>
            <a href="orders.php">My Orders</a> |
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
    <?php endif; ?>
</nav>
