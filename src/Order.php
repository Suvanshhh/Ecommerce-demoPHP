<?php
class Order {
    public static function create($conn, $user_id, $product_id, $amount, $credit) {
        $conn->query("INSERT INTO orders (user_id, product_id, amount, credit) VALUES ($user_id, $product_id, $amount, $credit)");
    }
}
?>
