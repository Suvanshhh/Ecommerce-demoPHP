<?php
include '../config/db.php';
include '../templates/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<p>Access denied.</p>";
    include '../templates/footer.php';
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']);
    if ($name && $price > 0) {
        $conn->query("INSERT INTO products (name, price) VALUES ('$name', $price)");
        echo "<p class='success'>Product added successfully!</p>";
    } else {
        $error = "Please enter valid name and price.";
    }
}
?>

<h2>Add Product</h2>
<form method="POST">
    <label>Name: <input type="text" name="name" required></label><br><br>
    <label>Price: <input type="number" name="price" step="0.01" required></label><br><br>
    <button type="submit">Add Product</button>
</form>
<p class="error"><?php echo $error; ?></p>

<?php include '../templates/footer.php'; ?>
