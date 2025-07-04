<?php
include '../config/db.php';
include '../templates/header.php';

$filter = isset($_GET['filter']) && $_GET['filter'] === 'under1000';

if ($filter) {
    $result = $conn->query("SELECT * FROM products WHERE price < 1000 ORDER BY price ASC");
    echo "<h2>Products (Price < ₹1000)</h2>";
} else {
    $result = $conn->query("SELECT * FROM products ORDER BY price ASC");
    echo "<h2>All Products</h2>";
}

// Filter button
echo '<form method="GET" style="margin-bottom:10px;">';
if ($filter) {
    echo '<button type="submit" name="filter" value="">Show All Products</button>';
} else {
    echo '<button type="submit" name="filter" value="under1000">Show Products Under ₹1000</button>';
}
echo '</form>';

// Product table
echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Price</th><th>Buy</th></tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".htmlspecialchars($row['name'])."</td>";
    echo "<td>₹".$row['price']."</td>";
    echo "<td><a href='buy.php?product_id=".$row['id']."'>Buy</a></td>";
    echo "</tr>";
}
echo "</table>";

include '../templates/footer.php';
?>
