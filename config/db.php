<?php
$conn = new mysqli("localhost:3307", "root", "", "ecommerce");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!-- Database Schema -->
<!-- Run this in phpMyAdmin or MySQL CLI to create the tables: -->

<!-- CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','customer') NOT NULL DEFAULT 'customer',
    wallet DECIMAL(10,2) DEFAULT 0
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    credit DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Sample data
INSERT INTO users (name, password, role, wallet) VALUES
('admin', 'admin123', 'admin', 0),
('alice', 'alice123', 'customer', 600),
('bob', 'bob123', 'customer', 300);

INSERT INTO products (name, price) VALUES
('T-shirt', 800), ('Shoes', 950), ('Bag', 700); -->
