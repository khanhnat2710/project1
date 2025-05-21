<?php
session_start();
//Lấy thông tin được update
$carts = $_POST['quantity'];
//Update giỏ hàng
foreach ($carts as $id => $quantity) {
    $_SESSION['cart'][$id] = $quantity;
}
//quay về trang giỏ hàng
header("Location: index.php");
?>