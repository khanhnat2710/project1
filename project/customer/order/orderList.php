<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
</head>
<body>
    <table border="1px" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th>STT</th>
            <th>Tên Khách hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Địa chỉ giao hàng</th>
            <th>Trạng thái đơn hàng</th>
            <th>Chi tiết đơn hàng</th>
        </tr>
        <?php
            //Lấy id của người đang đặt hàng
            $customerID = $_SESSION['CUS_ID'];
            //Mở kết nối
            include_once "../../admin/connection/open.php";
            //Viết sql
            $sql = "SELECT orders.*, customers.NAME FROM orders
                    INNER JOIN customers ON customers.CUS_ID = orders.CUS_ID
                    WHERE orders.CUS_ID = '$customerID'";
            //Chạy sql
            $orders = mysqli_query($connection, $sql);
            //Đóng kết nối
            include_once "../../admin/connection/close.php";
            //Hiển thị
            foreach ($orders as $order){
        ?>
            <tr>
                <td>
                    <?php echo $order['ORDER_ID']; ?>
                </td>
                <td>
                    <?php echo $order['NAME']; ?>
                </td>
                <td>
                    <?php echo $order['ORDER_DATE']; ?>
                </td>
                </td>
                <td>
                    <?php echo $order['DELIVERY_LOCATION']; ?>
                </td>
                <td>
                    <?php
                        if($order['ORDER_STATUS'] == 0){
                            echo 'Đang chờ sử lý';
                        } else if($order['ORDER_STATUS'] == 1){
                            echo 'Đã sủ ký';
                        } else if($order['ORDER_STATUS'] == 2){
                            echo 'Đang giao hàng';
                        } else if($order['ORDER_STATUS'] == 3){
                            echo 'Đã giao hàng';
                        } else if($order['ORDER_STATUS'] == 4){
                            echo 'Đã hủy hàng';
                        }
                    ?>
                </td>
                <td>
                    <a href="orderDetail.php?id=<?php echo $order['ORDER_ID']; ?>">Chi tiết</a>
                </td>
            </tr>
        <?php
            }
        ?>
    </table>
    <a href="../menu.php">Quay về trang chủ</a>
</body>
</html>