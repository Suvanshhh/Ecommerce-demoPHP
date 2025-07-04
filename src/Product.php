<?php
class Product {
    public $id;
    public $name;
    public $price;

    public static function getAll($conn, $max_price = null) {
        $sql = "SELECT * FROM products";
        if ($max_price !== null) {
            $sql .= " WHERE price < $max_price";
        }
        $sql .= " ORDER BY price ASC";
        return $conn->query($sql);
    }
}
?>
