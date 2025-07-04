<?php
include '../config/db.php';
include '../templates/header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<p>Access denied.</p>";
    include '../templates/footer.php';
    exit;
}

if (!isset($_GET['id'])) {
    die("No product specified.");
}

$product_id = intval($_GET['id']);
$product = $conn->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
if (!$product) {
    die("Product not found.");
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $price = floatval($_POST['price']);
    if ($name && $price > 0) {
        $conn->query("UPDATE products SET name = '$name', price = $price WHERE id = $product_id");
        echo "<p class='success'>Product updated successfully!</p>";
        // Refresh product info
        $product = $conn->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
    } else {
        $error = "Please enter valid name and price.";
    }
}
?>

<h2>Edit Product</h2>
<form method="POST">
    <label>Name: <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required></label><br><br>
    <label>Price: <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required></label><br><br>
    <button type="submit">Update Product</button>
</form>
<p class="error"><?php echo $error; ?></p>

<?php include '../templates/footer.php'; ?>
