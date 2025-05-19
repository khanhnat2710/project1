<?php 
session_start();
//Lấy id của sản phẩm cần xóa
$id = $_GET['id'];
//xóa sản phẩm trên giỏ hàng
unset($_SESSION['cart_customer'][$id]);
//quay về trang giỏ hàng
header("Location: index.php");
?>