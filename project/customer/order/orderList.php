<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style2.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

<!-- Header -->
  <header class="main-header">
    <div class="container" style="display: flex; align-items: center;">
      <h1 class="logo" style="margin-left: 20px;">SalephoneS</h1>
      <nav class="main-nav" style="margin-left: 40px;">
        <ul>
          <li><a href="../menu.php" class="active">Trang chủ</a></li>
          <li><a href="../productList.php">Sản phẩm</a></li>
          <li><a href="../contact.php">Liên hệ</a></li>
        </ul>
      </nav>

      <div style="margin-left:auto; display:flex; align-items:center;">
        <?php if (isset($_SESSION['CUS_ID'])): ?>
          <!-- Dropdown menu icon user -->
          <div class="dropdown">
            <i class="fas fa-user-circle user-icon"></i>
            <div class="dropdown-content">
              <a href="../cartCustomer/index.php"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
              <a href="order/orderList.php"><i class="fa-solid fa-truck"></i> Đơn hàng của tôi</a>
              <a href="../login/logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </div>
          </div>
        <?php else: ?>
          <a href="../login/login.php" class="login-btn">Đăng nhập</a>
          <a href="../new customer/create.php" class="login-btn">Đăng ký</a>
        <?php endif; ?>
      </div>
    </div>
  </header>

<div class="container my-5">
    <h2 class="text-center mb-4 text-primary">Danh sách đơn hàng của bạn</h2>

    <table class="table table-bordered table-hover shadow-sm bg-white">
        <thead class="table-dark">
            <tr>
                <th scope="col">Tên Khách hàng</th>
                <th scope="col">Ngày đặt hàng</th>
                <th scope="col">Địa chỉ giao hàng</th>
                <th scope="col">Phương thức thanh toán</th>
                <th scope="col">Trạng thái đơn hàng</th>
                <th scope="col">Chi tiết đơn hàng</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Lấy id của người đang đặt hàng
            $customerID = $_SESSION['CUS_ID'];
            // Mở kết nối
            include_once "../../admin/connection/open.php";
            // Viết sql
            $sql = "SELECT orders.*, payment_methods.NAME AS pay_name, customers.NAME 
                    FROM orders
                    INNER JOIN customers ON customers.CUS_ID = orders.CUS_ID
                    INNER JOIN payment_methods ON payment_methods.PAY_ID = orders.PAY_ID
                    WHERE orders.CUS_ID = '$customerID'
                    ORDER BY 
                        FIELD(orders.ORDER_STATUS, 0, 1, 2, 3, 4),
                        orders.ORDER_DATE DESC";
            // Chạy sql
            $orders = mysqli_query($connection, $sql);
            // Đóng kết nối
            include_once "../../admin/connection/close.php";
            // Hiển thị
            foreach ($orders as $order){
        ?>
            <tr>
                <td><?php echo $order['NAME']; ?></td>
                <td><?php echo $order['ORDER_DATE']; ?></td>
                <td><?php echo $order['DELIVERY_LOCATION']; ?></td>
                <td><?php echo $order['pay_name']; ?></td>
                <td>
                    <?php
                        // Xử lý hiển thị trạng thái đơn hàng
                        if($order['ORDER_STATUS'] == 0){
                            echo 'Đang chờ xử lý';
                        } else if($order['ORDER_STATUS'] == 1){
                            echo 'Đã xử lý';
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
                    <!-- Link tới trang chi tiết đơn hàng -->
                    <a href="orderDetail.php?id=<?php echo $order['ORDER_ID']; ?>" class="btn btn-info btn-sm">
                        Xem chi tiết
                    </a>
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="../menu.php" class="btn btn-secondary">Quay về trang chủ</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
