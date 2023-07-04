<?php
session_start();
require_once("config.php");

if(isset($_SESSION['user_id']) && isset($_GET['id'])) {
    $userId = $_SESSION['user_id'];
    $productId = $_GET['id'];
    $quantity = 1; // Jumlah produk dapat disesuaikan sesuai kebutuhan

    // Periksa apakah produk sudah ada dalam keranjang pengguna
    $query = "SELECT * FROM cart WHERE id_user = :user_id AND id_product = :product_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':product_id', $productId);
    $stmt->execute();
    $existingCartItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingCartItem) {
        // Jika produk sudah ada dalam keranjang, tambahkan jumlahnya
        $quantity += $existingCartItem['quantity'];
        $query = "UPDATE cart SET quantity = :quantity WHERE id_user = :user_id AND id_product = :product_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
    } else {
        // Jika produk belum ada dalam keranjang, tambahkan produk baru ke keranjang
        $query = "INSERT INTO cart (id_user, id_product, quantity) VALUES (:user_id, :product_id, :quantity)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();
    }

    header("Location: cart.php");
    exit();
} else {
    // Jika tidak ada pengguna yang masuk atau ID produk yang diberikan
    header("Location: index.php");
    exit();
}
?>
