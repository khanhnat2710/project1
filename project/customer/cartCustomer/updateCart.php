<?php
    session_start();
    //Mở kết nối
    include_once "../../admin/connection/open.php";
    //Lấy thông tin được update
    $carts = $_POST['quantity'];
    //Update giỏ hàng
    foreach ($carts as $id => $quantity){
        $sql = "SELECT QUANTITY FROM products WHERE PRD_ID = '$id'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($quantity > $row['QUANTITY']) {
            header("Location: index.php?error=out_of_stock");
            exit;
        }
        $_SESSION['cart_customer'][$id] = $quantity;
    }
    //Đóng kết nối
    include_once "../../admin/connection/close.php";
    //quay về trang giỏ hàng
    header("Location: index.php");
?>