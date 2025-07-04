<?php
class User {
    public $id;
    public $name;
    public $wallet;

    public static function getById($conn, $id) {
        $result = $conn->query("SELECT * FROM users WHERE id = $id");
        return $result->fetch_assoc();
    }
}
?>
