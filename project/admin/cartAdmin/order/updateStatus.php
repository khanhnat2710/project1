<?php
    //Lấy id của đơn hàng
    $orderId = $_GET['id'];
    //Mở kết nối
    include_once "../../connection/open.php";
    //Lấy trạng thái hiện tại của đơn hàng
    $sql = "SELECT ORDER_STATUS FROM orders WHERE ORDER_ID = '$orderId'";
    //Chạy sql
    $statuses = mysqli_query($connection, $sql);
    //Lấy trạng thái hiện tại
    foreach ($statuses as $status) {
        $currentStatus = $status['ORDER_STATUS'];
    }
    //xử lý trạng thái
    if ($currentStatus !== null && $currentStatus < 3){
        $newStatus = $currentStatus + 1;
        //Viết sql
        $sqlUpdate = "UPDATE orders SET ORDER_STATUS = '$newStatus' WHERE ORDER_ID = '$orderId'";
        //Chạy sql
        mysqli_query($connection, $sqlUpdate);
    }
    //Đóng kết nối
    include_once "../../connection/close.php";
    //Quay về trang danh sách đơn hàng
    header("Location: orderList.php");
?>