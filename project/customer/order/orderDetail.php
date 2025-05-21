<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
</head>
<body>
    <table border="1px" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th>STT sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá bán</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        <?php
            //Lấy id của đơn hàng
            $orderId = $_GET['id'];
            //Mở kết nối
            include_once "../../admin/connection/open.php";
            //Viết sql
            $sql = "SELECT products.PRD_ID, products.NAME, products.IMAGE, order_detail.PRICE, order_detail.QUANTITY 
                    FROM order_detail
                    INNER JOIN products ON order_detail.PRD_ID = products.PRD_ID
                    WHERE order_detail.ORDER_ID = '$orderId'";
            //Chạy sql
            $orderDetails = mysqli_query($connection, $sql);
            // Lấy trạng thái đơn hàng
            $sqlStatus = "SELECT ORDER_STATUS FROM orders WHERE ORDER_ID = '$orderId'";
            $resultStatus = mysqli_query($connection, $sqlStatus);
            $rowStatus = mysqli_fetch_assoc($resultStatus);
            $statusText = "Không xác định";
            switch ($rowStatus['ORDER_STATUS']) {
                case 0: $statusText = "Đang chờ xử lý"; break;
                case 1: $statusText = "Đã xử lý"; break;
                case 2: $statusText = "Đang giao hàng"; break;
                case 3: $statusText = "Đã giao hàng"; break;
                case 4: $statusText = "Đã hủy"; break;
            }
            //Đóng kết nối
            include_once "../../admin/connection/close.php";
            //Hiển thị
            foreach ($orderDetails as $orderDetail){
                $tongTien = 0;
                $thanhTien = $orderDetail['PRICE'] * $orderDetail['QUANTITY'];
                $tongTien += $thanhTien;
        ?>
            <tr>
                <td>
                    <?php echo $orderDetail['PRD_ID']; ?>
                </td>
                <td>
                    <?php echo $orderDetail['NAME']; ?>
                </td>
                <td>
                    <img src="../../admin/image/<?php echo $orderDetail['IMAGE']; ?>" alt="<?php echo $orderDetail['NAME']; ?>" style="width: 72px; height: 72px;">
                </td>
                <td>
                    <?php echo number_format($orderDetail['PRICE'], 0, ',', '.'); ?> đ
                </td>
                <td>
                    <?php echo $orderDetail['QUANTITY']; ?>
                </td>
                <td>
                    <?php echo number_format($thanhTien, 0, ',', '.'); ?> đ
                </td>
            </tr>
        <?php
            }
        ?>
    </table>
    <p><strong>Trạng thái đơn hàng:</strong> <?php echo $statusText; ?></p>
    <?php
        if ($rowStatus['ORDER_STATUS'] == 0){
            echo '<a href="cancelOrder.php?id=' . $orderId . '">Hủy đơn hàng</a>';
        }
    ?>
    <p><a href="orderList.php">Quay lại danh sách đơn hàng</a></p>
</body>
</html>