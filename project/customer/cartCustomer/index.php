<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <!-- Thêm vào trong <head> hoặc file CSS của bạn -->
    <style>
        /* Nút menu 3 gạch */
        #openSidebar {
            background: #222;
            color: #fff;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            font-size: 1.7rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.18);
            border: none;
            transition: background 0.2s, box-shadow 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
        #openSidebar:hover {
            background: #444;
            color: #ffe082;
            box-shadow: 0 4px 16px rgba(0,0,0,0.28);
        }
        /* Sidebar */
        #sidebarMenu {
            background: linear-gradient(135deg, #1976d2 80%, #42a5f5 100%);
            box-shadow: 2px 0 16px rgba(25, 118, 210, 0.18);
            border-top-right-radius: 18px;
            border-bottom-right-radius: 18px;
        }
        #sidebarMenu h4 {
            font-size: 1.4rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 24px;
            letter-spacing: 1px;
        }
        #sidebarMenu ul.nav > li > a {
            color: #fff !important;
            font-size: 1.1rem;
            padding: 10px 0 10px 10px;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        #sidebarMenu ul.nav > li > a:hover {
            background: rgba(255,255,255,0.13);
            color: #ffe082 !important;
            text-decoration: none;
        }
        #closeSidebar {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
            margin-left: 5px;
            color: #fff;
            background: none;
            border: none;
            outline: none;
            transition: color 0.2s;
        }
        #closeSidebar:hover {
            color: #ffe082;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Nút menu 3 gạch -->
    <button type="button" class="btn btn-default" id="openSidebar" style="position:fixed;top:20px;left:20px;z-index:1051;">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Sidebar menu -->
    <div id="sidebarMenu" style="position:fixed;top:0;left:-250px;width:250px;height:100%;background:#222;color:#fff;z-index:1050;transition:left 0.3s;">
        <div style="padding:20px;">
            <button type="button" class="close" id="closeSidebar" style="color:#fff;opacity:1;">&times;</button>
            <h4>Menu</h4>
            <ul class="nav nav-pills nav-stacked">
                <li><a href="../menu.php"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
                <li><a href="../productList.php"><i class="glyphicon glyphicon-th-list"></i> Sản phẩm</a></li>
                <li><a href="../order/orderList.php"><i class="glyphicon glyphicon-list-alt"></i> Đơn hàng</a></li>
                <!-- Thêm các mục khác nếu muốn -->
            </ul>
        </div>
    </div>

    <?php
    //Mở kết nối đến DB
    include_once "../../admin/connection/open.php";
    //Lấy giỏ hàng hiện tại
    if (isset($_SESSION['cart_customer'])) {
        $carts = $_SESSION['cart_customer'];
        ?>
        <form action="updateCart.php" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-10 col-md-offset-1">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th class="text-center">Giá thành</th>
                                    <th class="text-center">Tổng</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $tongtien = 0;
                            foreach ($carts as $id => $quantity) {
                                //Viết sql lấy thông tin sản phẩm có trên giỏ hàng
                                $sql = "SELECT * FROM products WHERE PRD_ID = '$id'";
                                //Chạy sql
                                $products = mysqli_query($connection, $sql);
                                //Lấy giá ảnh của sản phâm
                                foreach ($products as $product) {
                                    $thanhtien = $product['PRICE'] * $quantity;
                                    $tongtien += $thanhtien;
                                    ?>
                                    <tr>
                                        <td class="col-sm-8 col-md-6">
                                            <div class="media">
                                                <a class="thumbnail pull-left">
                                                    <img class="media-object"
                                                        src="../../admin/image/<?php echo $product['IMAGE']; ?>"
                                                        style="width: 72px; height: 72px;">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><a><?php echo $product['NAME']; ?></a></h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1 col-md-1" style="text-align: center">
                                            <input type="number" class="form-control" name="quantity[<?php echo $id; ?>]"
                                                   value="<?php echo $quantity; ?>" min="1">
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center">
                                            <strong><?php echo number_format($product['PRICE'], 0, ',', '.'); ?></strong>
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center">
                                            <strong><?php echo number_format($thanhtien, 0, ',', '.'); ?></strong>
                                        </td>
                                        <td class="col-sm-1 col-md-1">
                                            <a href="deleteProduct.php?id=<?php echo $id; ?>" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-remove"></span> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="3" class="text-right"><h3>Tạm tính</h3></td>
                                <td class="text-right" colspan="2"><h3><strong><?php echo number_format($tongtien, 0, ',', '.'); ?> đ</strong></h3></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right" style="vertical-align: middle;">
                                    <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px;">
                                        <!-- Chọn phương thức thanh toán -->
                                        <select name="pay_id" class="form-control" style="width:220px; display:inline-block;" required>
                                            <option value="">-- Chọn phương thức thanh toán --</option>
                                            <?php 
                                                $sql = "SELECT * FROM payment_methods";
                                                $paymentMethods = mysqli_query($connection, $sql);
                                                foreach ($paymentMethods as $method): ?>
                                                <option value="<?php echo $method['PAY_ID']; ?>">
                                                    <?php echo $method['NAME']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <a href="../menu.php" class="btn btn-default">
                                            <span class="glyphicon glyphicon-shopping-cart"></span> Tiếp tục mua sắm
                                        </a>
                                        <button type="submit" name="update" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-refresh"></span> Cập nhật giỏ hàng
                                        </button>
                                        <button type="submit" formaction="../order/checkOut.php" class="btn btn-success">
                                            Đặt hàng <span class="glyphicon glyphicon-ok"></span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
    //Đóng kết nối
    include_once "../../admin/connection/close.php";
    ?>

    <script>
        document.getElementById('openSidebar').onclick = function() {
            document.getElementById('sidebarMenu').style.left = '0';
            document.getElementById('openSidebar').style.display = 'none'; // Ẩn nút 3 gạch
        };
        document.getElementById('closeSidebar').onclick = function() {
            document.getElementById('sidebarMenu').style.left = '-250px';
            document.getElementById('openSidebar').style.display = 'flex'; // Hiện lại nút 3 gạch
        };
        // Đóng sidebar khi click ra ngoài
        document.addEventListener('click', function(e) {
            var sidebar = document.getElementById('sidebarMenu');
            var button = document.getElementById('openSidebar');
            if (!sidebar.contains(e.target) && e.target !== button) {
                sidebar.style.left = '-250px';
                button.style.display = 'flex'; // Hiện lại nút 3 gạch
            }
        });
    </script>
</body>

</html>