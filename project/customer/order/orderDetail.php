<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style2.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .order-image {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 6px;
        }
    </style>
</head>
<body>
<!-- Header -->
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
    <h2 class="text-center text-primary mb-4">Chi tiết đơn hàng</h2>

    <table class="table table-bordered table-hover shadow bg-white">
        <thead class="table-dark text-center">
            <tr>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá bán</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Lấy id của đơn hàng
            $orderId = $_GET['id'];

            // Mở kết nối
            include_once "../../admin/connection/open.php";

            // Lấy chi tiết sản phẩm
            $sql = "SELECT products.PRD_ID, products.NAME, products.IMAGE, order_detail.PRICE, order_detail.QUANTITY 
                    FROM order_detail
                    INNER JOIN products ON order_detail.PRD_ID = products.PRD_ID
                    WHERE order_detail.ORDER_ID = '$orderId'";
            $orderDetails = mysqli_query($connection, $sql);

            // Lấy trạng thái đơn hàng
            $sqlStatus = "SELECT ORDER_STATUS FROM orders WHERE ORDER_ID = '$orderId'";
            $resultStatus = mysqli_query($connection, $sqlStatus);
            $rowStatus = mysqli_fetch_assoc($resultStatus);

            // Xác định trạng thái
            $statusText = "Không xác định";
            switch ($rowStatus['ORDER_STATUS']) {
                case 0: $statusText = "Đang chờ xử lý"; break;
                case 1: $statusText = "Đã xử lý"; break;
                case 2: $statusText = "Đang giao hàng"; break;
                case 3: $statusText = "Đã giao hàng"; break;
                case 4: $statusText = "Đã hủy"; break;
            }

            // Đóng kết nối
            include_once "../../admin/connection/close.php";

            // Hiển thị danh sách sản phẩm
            $tongTien = 0;
            foreach ($orderDetails as $orderDetail) {
                $thanhTien = $orderDetail['PRICE'] * $orderDetail['QUANTITY'];
                $tongTien += $thanhTien;
        ?>
            <tr class="align-middle text-center">
                <td><?php echo $orderDetail['NAME']; ?></td>
                <td>
                    <img src="../../admin/image/<?php echo $orderDetail['IMAGE']; ?>" 
                         alt="<?php echo $orderDetail['NAME']; ?>" 
                         class="order-image">
                </td>
                <td><?php echo number_format($orderDetail['PRICE'], 0, ',', '.'); ?> đ</td>
                <td><?php echo $orderDetail['QUANTITY']; ?></td>
                <td><?php echo number_format($thanhTien, 0, ',', '.'); ?> đ</td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr class="table-secondary text-end">
                <td colspan="4"><strong>Tổng tiền:</strong></td>
                <td class="text-center"><strong><?php echo number_format($tongTien, 0, ',', '.'); ?> đ</strong></td>
            </tr>
        </tfoot>
    </table>

    <!-- Thông tin trạng thái và hành động -->
    <div class="mt-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between">
        <p class="mb-2 mb-md-0"><strong>Trạng thái đơn hàng:</strong> <?php echo $statusText; ?></p>
        <div>
            <!-- Nút quay lại -->
            <a href="orderList.php" class="btn btn-outline-secondary me-2">← Quay lại danh sách đơn hàng</a>

            <!-- Nút hủy nếu đơn hàng đang chờ xử lý -->
            <?php if ($rowStatus['ORDER_STATUS'] == 0): ?>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">
                    Hủy đơn hàng
                </button>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
        <div class="alert alert-warning text-center">
            Đơn hàng đã cập nhật, không thể hủy hàng!
        </div>
    <?php endif; ?>
</div>

<!-- Modal xác nhận hủy đơn hàng -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">Xác nhận hủy đơn hàng</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>
      <div class="modal-body">
        Bạn có chắc chắn muốn hủy đơn hàng này không?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
        <a href="cancelOrder.php?id=<?php echo $orderId; ?>" class="btn btn-danger">Có, hủy đơn hàng</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
