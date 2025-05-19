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
</head>

<body>
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
                                <td colspan="3"></td>
                                <td colspan="2">
                                    <div style="display: flex; gap: 10px;">
                                        <a href="../menu.php" class="btn btn-default">
                                            <span class="glyphicon glyphicon-shopping-cart"></span> Tiếp tục mua sắm
                                        </a>
                                        <button type="submit" name="update" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-refresh"></span> Cập nhật giỏ hàng
                                        </button>
                                        <button type="submit" name="order" class="btn btn-success">
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
</body>

</html>