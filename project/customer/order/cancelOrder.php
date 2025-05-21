<?php
    //Lấy id
    $id = $_GET['id'];
    //Mở kết nối
    include_once "../../admin/connection/open.php";
    //Viết sql
    $sql = "UPDATE orders SET ORDER_STATUS = 4 WHERE ORDER_ID = '$id'";
    //Chạy sql
    $result = mysqli_query($connection, $sql);
    //Đòng kết nối
    include_once "../../admin/connection/close.php";
    //Quay lại trang chi tiết đơn hàng
    header ("Location: orderList.php");
?>