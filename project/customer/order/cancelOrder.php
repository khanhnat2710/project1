<?php
    // Lấy id đơn hàng từ URL
    $id = $_GET['id'];
    // Mở kết nối
    include_once "../../admin/connection/open.php";
    //Viết sql để kiểm tra trạng thái đơn hàng
    $sqlCheck = "SELECT ORDER_STATUS FROM orders WHERE ORDER_ID = '$id'";
    // Chạy sql
    $orders = mysqli_query($connection, $sqlCheck);
    $canCancel = false;
    // Kiểm tra trạng thái đơn hàng trước khi hủy
    foreach ($orders as $order) {
        if ($order['ORDER_STATUS'] == 0) {
            // Nếu đơn hàng đang chờ xử lý thì mới cho phép hủy
            $sql = "UPDATE orders SET ORDER_STATUS = 4 WHERE ORDER_ID = '$id'";
            mysqli_query($connection, $sql);
            $canCancel = true;
        }
    }
    // Đóng kết nối
    include_once "../../admin/connection/close.php";
    // Quay lại trang chi tiết đơn hàng, nếu không thể hủy thì báo lỗi
    if ($canCancel) {
        header("Location: orderList.php");
    } else {
        header("Location: orderDetail.php?id=$id&error=Kh%C3%B4ng%20th%E1%BB%83%20h%E1%BB%8Dc%C3%B9ng%20v%C3%A0o%20%C4%91%C6%B0%E1%BB%9Dng%20d%E1%BA%A1ng%20n%C3%A0o%20%C4%91%C3%A2y!");
    }
?>