<?php
session_start();
//Lấy id của sản phẩm được thêm vào giỏ hàng
$id = $_GET['id'];
//Kiểm tra giỏ hàng đã tồn tại hay chưa
if (isset($_SESSION['cart'])) {
    //Kiểm tra sản phẩm đã tồn tại trên giỏ hàng chưa
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
} else {
    $_SESSION['cart'] = array();
    $_SESSION['cart'][$id] = 1;
}
//Chuyển sang danh sách sản phẩm trong giỏ hàng
header("Location: ../cartAdmin/index.php");
?>