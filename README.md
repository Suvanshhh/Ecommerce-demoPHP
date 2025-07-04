
# PHP E-commerce Demo

A simple e-commerce application built with PHP and MySQL, featuring:
- Customer and admin login
- Product management (add, edit, delete)
- Wallet credits management
- Product purchase with wallet logic (₹500 or 25% of price, whichever is **lower**)
- Product price filtering
- Order history for customers

## Features

- **Customer:** Browse and buy products, see wallet credits, view order history
- **Admin:** Manage products, manage customer wallet credits
- **Wallet System:** Use wallet credits for purchases
- **Product Filter:** Option to show only products under ₹1000
- **Role-based Navigation:** Menus change for admin/customer

## Getting Started

### Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop) installed

### Quick Start

1. **Clone this repository**
   ```sh
   git clone https://github.com/yourusername/php-ecommerce-demo.git
   cd php-ecommerce-demo
   ```

2. **Start with Docker**
   ```sh
   docker-compose up --build
   ```

3. **Access the app**
   - App: [http://localhost:8080/public/login.php](http://localhost:8080/public/login.php)
   - (Optional) phpMyAdmin: [http://localhost:8081](http://localhost:8081)

4. **Import the Database**
   - Use phpMyAdmin or MySQL CLI to import the provided schema (see below).

## Default Users

| Role    | Username | Password  |
|---------|----------|-----------|
| Customer| Alice    | test123  |
| Admin
| Bob      | test123    |

## Project Structure

```
/config
    db.php
/public
    index.php
    login.php
    logout.php
    buy.php
    manage_products.php
    add_product.php
    edit_product.php
    delete_product.php
    manage_credits.php
    orders.php
/templates
    header.php
    footer.php
    nav.php
Dockerfile
docker-compose.yml
README.md
```

## Database Schema

Paste this in phpMyAdmin or MySQL CLI to set up your database:

```sql
CREATE TABLE users (
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
('T-shirt', 800), ('Shoes', 950), ('Bag', 700);
```

## Configuration

- **Database connection:**  
  In `/config/db.php`, use:
  ```php
  $conn = new mysqli("db", "root", "root", "ecommerce");
  ```
  (Use `"localhost"` if running locally without Docker.)

## Useful URLs

- App: [http://localhost:8080/public/login.php](http://localhost:8080/public/login.php)
- phpMyAdmin: [http://localhost:8081](http://localhost:8081)
