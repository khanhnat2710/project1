<?php
    session_start();
    //Lấy giỏ hàng
    $carts = $_SESSION['cart_customer'];
    //Mở kết nối
    include_once "../../admin/connection/open.php";
    //Lấy ngày đặt hàng là ngày hôm nay
    $orderDate = date("Y-m-d");
    //order status mặc định 0 là đang chờ xử lý, 1 đã sử lý, 2 là đang giao hàng, 3 là đã giao hàng, 4 hủy hàng
    $orderStatus = 0;
    //Lấy id của người đặt hàng
    $customerID = $_SESSION['CUS_ID'];
    //Lấy phương thức thanh toán
    $payId = $_POST['pay_id'];
    //Viết sql lấy địa chỉ của người đặt hàng
    $sqlGetAddress = "SELECT ADDRESS FROM customers WHERE CUS_ID = '$customerID'";
    //Chạy sql
    $getAddresses = mysqli_query($connection, $sqlGetAddress);
    //Lấy địa chỉ người đặt hàng
    foreach ($getAddresses as $getAddress){
        $deliveryLocation = $getAddress['ADDRESS'];
    }

    //Kiểm tra tồn kho trước khi đặt hàng
    $out_of_stock = false;
    foreach ($carts as $productId => $quantity) {
        $sql_check = "SELECT QUANTITY FROM products WHERE PRD_ID = $productId";
        $result = mysqli_query($connection, $sql_check);
        $row = mysqli_fetch_assoc($result);
        if ($row['QUANTITY'] < $quantity) {
            $out_of_stock = true;
            break;
        }
    }
    if ($out_of_stock) {
        //Nếu có sản phẩm vượt quá số lượng kho thì quay lại giỏ hàng và báo lỗi
        include_once "../../admin/connection/close.php";
        header("Location: ../cartCustomer/index.php?error=out_of_stock");
        exit;
    }

    //Viết sql lưu bảng orders
    $sqlSaveOrder = "INSERT INTO orders(ORDER_DATE, ORDER_STATUS, CUS_ID, DELIVERY_LOCATION, PAY_ID)
                     VALUES ('$orderDate', '$orderStatus', '$customerID', '$deliveryLocation', '$payId')";
    //Chạy sql lưu orders
    mysqli_query($connection, $sqlSaveOrder);
    /* Lấy id của order vừa được tạo */
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
        // Trừ số lượng tồn kho cho từng sản phẩm
        $sql_update_qty = "UPDATE products SET QUANTITY = QUANTITY - $quantity WHERE PRD_ID = $productId";
        mysqli_query($connection, $sql_update_qty);
        //Viết sql lấy giá của sản phẩm
        $sqlGetPrice = "SELECT PRICE FROM products WHERE PRD_ID = '$productId'";
        $getPrices = mysqli_query($connection, $sqlGetPrice);
        foreach ($getPrices as $getPrice){
            $price = $getPrice['PRICE'];
        }
        //Viết sql lưu dữ liệu vào order_details
        $sqlSaveOrderDetails = "INSERT INTO order_detail(ORDER_ID, PRD_ID, QUANTITY, PRICE)
                                VALUES ('$orderId', '$productId', '$quantity', '$price')";
        mysqli_query($connection, $sqlSaveOrderDetails);
    }
    //Đóng kết nối
    include_once "../../admin/connection/close.php";
    //Xóa giỏ hàng
    unset($_SESSION['cart_customer']);
    //Quay về trang danh sách đơn hàng
    header("Location: orderList.php");
?>