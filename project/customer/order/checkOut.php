<?php
    session_start();
    //Lấy giỏ hàng
    $carts = $_SESSION['cart_customer'];
    //Mở kết nốt
    include_once "../../admin/connection/open.php";
    //Lấy ngày đặt hàng là ngày hôm nay
    $orderDate = date("Y-m-d");
    //order status mặc định 0 là đang chờ xử lý, 1 đã sử lý, 2 là đang giao hàng, 3 là đã giao hàng, 4 hủy hàng
    $orderStatus = 0;
    //Lấy id của người đặt hàng
    $customerID = $_SESSION['CUS_ID'];
    //Viết sql lấy địa chỉ của người đặt hàng
    $sqlGetAddress = "SELECT ADDRESS FROM customers WHERE CUS_ID = '$customerID'";
    //Chạy sql
    $getAddresses = mysqli_query($connection, $sqlGetAddress);
    //Lấy địa chỉ người đặt hàng
    foreach ($getAddresses as $getAddress){
        $deliveryLocation = $getAddress['ADDRESS'];
    }
    //Viết sql lưu bảng orders
    $sqlSaveOrder = "INSERT INTO orders(ORDER_DATE, ORDER_STATUS, CUS_ID, DELIVERY_LOCATION)
                     VALUES ('$orderDate', '$orderStatus', '$customerID', '$deliveryLocation')";
    //Chạy sql lưu orders
    mysqli_query($connection, $sqlSaveOrder);
    /*Lấy id của order vừa được tạo */
    //Viết sql
    $sqlGetOrderIds = "SELECT MAX(ORDER_ID) AS ORDER_ID FROM orders WHERE CUS_ID = '$customerID'";
    //Chạy sql
    $getOrderIds = mysqli_query($connection, $sqlGetOrderIds);
    //Lấy order id
    foreach ($getOrderIds as $getOrderId){
        $orderId = $getOrderId['ORDER_ID'];
    }
    /* Lấy thông tin sản phẩm để lưu vào order_details */
    foreach ($carts as $productId => $quantity){
        //Viết sql lấy giá của sản phẩm
        $sqlGetPrice = "SELECT PRICE FROM products WHERE PRD_ID = '$productId'";
        //Chạy sql
        $getPrices = mysqli_query($connection, $sqlGetPrice);
        //Lấy giá của sản phẩm
        foreach ($getPrices as $getPrice){
            $price = $getPrice['PRICE'];
        }
        //Viết sql lưu dữ liệu vào order_details
        $sqlSaveOrderDetails = "INSERT INTO order_detail(ORDER_ID, PRD_ID, QUANTITY, PRICE)
                                VALUES ('$orderId', '$productId', '$quantity', '$price')";
        //Chạy sql
        mysqli_query($connection, $sqlSaveOrderDetails);
    }
    //Đóng kết nối
    include_once "../../admin/connection/close.php";
    //Xóa giỏ hàng
    unset($_SESSION['cart_customer']);
    //QUay về trang danh sách đơn hàng
    header("Location: orderList.php");
?>