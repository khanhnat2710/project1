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
            // Cộng lại số lượng vào kho cho từng sản phẩm trong đơn hàng
            $sqlDetail = "SELECT PRD_ID, QUANTITY FROM order_detail WHERE ORDER_ID = '$id'";
            $resultDetail = mysqli_query($connection, $sqlDetail);
            while ($row = mysqli_fetch_assoc($resultDetail)) {
                $product_id = $row['PRD_ID'];
                $quantity = $row['QUANTITY'];
                $sql_restore = "UPDATE products SET QUANTITY = QUANTITY + $quantity WHERE PRD_ID = $product_id";
                mysqli_query($connection, $sql_restore);
            }
            $canCancel = true;
        }
    }
    // Đóng kết nối
    include_once "../../admin/connection/close.php";
    // Quay lại trang chi tiết đơn hàng, nếu không thể hủy thì báo lỗi
    if ($canCancel) {
        header("Location: orderList.php");
    } else {
        header("Location: orderDetail.php?id=$id");
    }
?>