<?php
    session_start();
    if(empty($_SESSION['USERNAME'])){
        header('Location: ../login/login.php');
    }
    include_once "../../layouts/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang danh sách sản phẩm</title>
    <link rel="stylesheet" href="../../layouts/style.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <?php
        // Mở kết nối đến DB
        include_once "../Connection/open.php";
        //Lấy giá trị đang tìm kiếm
        if(isset($_GET['keyword'])){
            $keyword = $_GET['keyword'];
        } else {
            $keyword = '';
        }
        //Số bản ghi trong một trang
        $recordsPerPage = 3;
        //Query lấy được tổng số bản ghi
        $sqlCountRecords = "SELECT COUNT(*) AS total_records FROM products
                            WHERE products.NAME LIKE '%$keyword%'";
        //chạy sql
        $countRecords = mysqli_query($connection, $sqlCountRecords);
        //Lấy tổng số bản ghi
        foreach ($countRecords as $countRecord){
            $totalRecords = $countRecord['total_records'];
        }
        //Tính tổng số trang
        $pages = ceil(num: $totalRecords / $recordsPerPage);
        //lấy trang hiện tại
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        //Vị trí bắt đầu của từng trang
        $start = ($page - 1) * $recordsPerPage;
        // Viết SQL lấy dữ liệu
        $sql = "SELECT products.*, brands.NAME AS brand_name, types.NAME AS type_name 
                FROM products INNER JOIN brands 
                ON brands.BRAND_ID = products.BRAND_ID INNER JOIN types 
                ON types.TYPE_ID = products.TYPE_ID
                WHERE products.NAME LIKE '%$keyword%'
                LIMIT $start, $recordsPerPage";
        // Chạy query
        $products = mysqli_query($connection, $sql);
        // Đóng kết nối đến DB
        include_once "../Connection/close.php";
        // Hiển thị dữ liệu
    ?>
    <div class="breadcrumb-container">
        <p class="breadcrumb">
            <a href="#" class="text-dark">Trang admin</a> > <a href="#" class="text-dark">Danh sách sản phẩm</a>
        </p>
        <form method="get" action="" class="search-form">
            <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?php echo $keyword; ?>">
            <button>Tìm Kiếm</button>
        </form>
    </div>
    <a href="create.php">
        <button class="button-name" role="button">Thêm một sản phẩm mới</button>
    </a>
    <table class="table table-striped table-hover">
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th>Ram</th>
            <th>Chip</th>
            <th>Rom</th>
            <th>Kích cỡ màn hình</th>
            <th>Camera</th>
            <th>Màu sắc</th>
            <th>Giá thành</th>
            <th>Số lượng</th>
            <th>Nhãn hàng</th>
            <th>Kiểu máy</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php
            foreach ($products as $product){
        ?>
            <tr>
                <td style="text-align: center;">
                    <?php echo $product['PRD_ID']; ?>
                </td>
                <td>
                    <?php echo $product['NAME']; ?>
                </td>
                <td>
                    <img src="../image/<?php echo $product['IMAGE']; ?>" alt="Ảnh sản phẩm" width="100px" height="100px">
                </td>
                <td style="text-align: center;">
                    <?php echo $product['RAM']; ?>
                </td>
                <td>
                    <?php echo $product['CHIP']; ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $product['ROM']; ?>
                </td>
                <td>
                    <?php echo $product['SCREEN_SIZE']; ?>
                </td>
                <td>
                    <?php echo $product['CAMERA']; ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $product['COLOR']; ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $product['PRICE']; ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $product['QUANTITY']; ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $product['brand_name']; ?>
                </td>
                <td style="text-align: center;">
                    <?php echo $product['type_name']; ?>
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $product["PRD_ID"]; ?>">
                        <button class="vista-button"><div>Chỉnh sửa</div></button>
                    </a>
                </td>
                <td>
                    <a href="../cartAdmin/addToCart.php?id=<?php echo $product["PRD_ID"]; ?>">
                        <button class="vista-button"><div>Thêm vào giỏ hàng</div></button>
                    </a>
                </td>
                <td>
                    <!-- Thêm sự kiện onclick để hiển thị modal -->
                    <button class="vista-button" onclick="showModal('destroy.php?id=<?php echo $product["PRD_ID"]; ?>')">
                        <div>Xóa</div>
                    </button>
                </td>
            </tr>
        <?php
            }
        ?>
    </table>
    <div class="pagination">
        <?php
            for ($page = 1; $page <= $pages; $page++){
                if ($keyword == ""){
        ?>
            <a href="?page=<?php echo $page; ?>">
                <?php echo $page; ?>
            </a>
        <?php
                } else {
        ?>
            <a href="?page=<?php echo $page; ?>&&keyword=<?php echo $keyword; ?>">
                <?php echo $page; ?>
            </a>
        <?php
                }
            }
        ?>
    </div>

    <!-- Modal xác nhận xóa -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>Bạn có chắc chắn muốn xóa không?</p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="confirm">Xóa</button>
                <button class="cancel" onclick="closeModal()">Hủy</button>
            </div>
        </div>
    </div>
</body>
</html>