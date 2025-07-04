<?php
$conn = new mysqli("localhost:3307", "root", "", "ecommerce");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
