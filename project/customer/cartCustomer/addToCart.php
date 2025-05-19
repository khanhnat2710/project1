<?php
    session_start(); 
    //Lấy id của sản phẩm được thêm vào giỏ hàng
    $id = $_GET['id'];
    //Kiểm tra giỏ hàng đã tồn tại hay chưa
    if(isset($_SESSION['cart_customer'])){
        //Kiểm tra sản phẩm đã tồn tại trên giỏ hàng chưa
        if(isset($_SESSION['cart_customer'][$id])){
            $_SESSION['cart_customer'][$id]++;
        } else {
            $_SESSION['cart_customer'][$id] = 1;
        }
    } else {
        $_SESSION['cart_customer'] = array();
        $_SESSION['cart_customer'][$id] = 1;
    }
    //Chuyển sang danh sách sản phẩm trong giỏ hàng
    header("Location: ../cartCustomer/index.php");
?>