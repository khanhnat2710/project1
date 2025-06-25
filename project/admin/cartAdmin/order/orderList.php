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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body class="bg-light">

    <!-- menu riêng cho trang đơn hàng -->
    <button id="menuToggle" class="menu-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
        aria-controls="sidebarMenu">
        ☰
    </button>

    <!-- Menu Sidebar -->
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="../../brands/index.php">🏷️ Nhãn hàng</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../../types/index.php">📱 Kiểu máy</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../../payment methods/index.php">💳 Phương
                        thức thanh toán</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../../products/index.php">🛒 Sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="../../customers/index.php">👤 Khách hàng</a>
                </li>
                <li class="nav-item"><a class="nav-link text-white" href="../../admins/index.php">🛡️ Admin</a></li>
            </ul>
        </div>
    </div>

    <div class="container my-5">
        <h2 class="text-center mb-4 text-primary">Danh sách đơn hàng</h2>

        <!-- Form tìm kiếm -->
        <form method="get" action="" class="mb-4">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên khách hàng..."
                    value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </form>

        <table class="table table-bordered table-hover shadow-sm bg-white">
            <thead class="table-dark">
                <tr>
                    <th scope="col">STT</th>
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
                // Mở kết nối
                include_once "../../connection/open.php";

                // Xử lý tìm kiếm
                $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

                // Số bản ghi mỗi trang
                $recordsPerPage = 5;

                // Lấy tổng số bản ghi
                $sqlCount = "SELECT COUNT(*) AS total FROM orders 
                         INNER JOIN customers ON customers.CUS_ID = orders.CUS_ID
                         WHERE customers.NAME LIKE '%$keyword%'";
                $resultCount = mysqli_query($connection, $sqlCount);
                $rowCount = mysqli_fetch_assoc($resultCount);
                $totalRecords = $rowCount['total'];

                // Tổng số trang
                $totalPages = ceil($totalRecords / $recordsPerPage);

                // Trang hiện tại
                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Vị trí bắt đầu
                $start = ($page - 1) * $recordsPerPage;

                // Câu lệnh truy vấn dữ liệu
                $sql = "SELECT orders.*, payment_methods.NAME AS pay_name,customers.NAME FROM orders
                    INNER JOIN customers ON customers.CUS_ID = orders.CUS_ID
                    INNER JOIN payment_methods ON payment_methods.PAY_ID = orders.PAY_ID
                    WHERE customers.NAME LIKE '%$keyword%'
                    ORDER BY 
                        FIELD(orders.ORDER_STATUS, 0, 1, 2, 3, 4),
                        orders.ORDER_DATE DESC
                    LIMIT $start, $recordsPerPage";

                $orders = mysqli_query($connection, $sql);

                // Đóng kết nối
                include_once "../../connection/close.php";

                // Hiển thị
                foreach ($orders as $order) {
                    ?>
                    <tr>
                        <td><?php echo $order['ORDER_ID']; ?></td>
                        <td><?php echo $order['NAME']; ?></td>
                        <td><?php echo $order['ORDER_DATE']; ?></td>
                        <td><?php echo $order['DELIVERY_LOCATION']; ?></td>
                        <td><?php echo $order['pay_name']; ?></td>
                        <td>
                            <?php
                            if ($order['ORDER_STATUS'] == 0) {
                                echo 'Đang chờ xử lý';
                            } else if ($order['ORDER_STATUS'] == 1) {
                                echo 'Đã xử lý';
                            } else if ($order['ORDER_STATUS'] == 2) {
                                echo 'Đang giao hàng';
                            } else if ($order['ORDER_STATUS'] == 3) {
                                echo 'Đã giao hàng';
                            } else if ($order['ORDER_STATUS'] == 4) {
                                echo 'Đã hủy hàng';
                            }
                            ?>
                        </td>
                        <td>
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

        <!-- Phân trang -->
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    $isActive = ($i == $page) ? 'active' : '';
                    $url = "?page=$i" . ($keyword ? "&keyword=$keyword" : '');
                    echo "<li class='page-item $isActive'><a class='page-link' href='$url'>$i</a></li>";
                }
                ?>
            </ul>
        </nav>

        <div class="text-center mt-4">
            <a href="../../products/index.php" class="btn btn-secondary">Quay về trang chủ</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>