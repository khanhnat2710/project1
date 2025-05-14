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
    <title>Trang danh sách nhãn hàng</title>
    <link rel="stylesheet" href="../../layouts/style.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <?php
        // Mở kết nối đến DB
        include_once "../Connection/open.php";
        //Lấy gia trị đang tìm kiếm
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
        } else {
            $keyword = '';
        }
        //Số bản ghi tỏng một trang
        $recordsPerPage = 3;
        //Query lấy được tổng số bản ghi
        $sqlCountRecords = "SELECT COUNT(*) AS total_records FROM brands
                            WHERE brands.NAME LIKE '%$keyword%'";
        //Chạy sql
        $countRecords = mysqli_query($connection, $sqlCountRecords);
        //lấy tổng số bản ghi
        foreach ($countRecords as $countRecord){
            $totalRecords = $countRecord['total_records'];
        }
        //Tính được tổng số trang
        $pages = ceil($totalRecords / $recordsPerPage);
        //Lấy trang hiện tại
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        //Vị trí bắt đầu của từng trang
        $start = ($page - 1) * $recordsPerPage;
        // Viết SQL lấy dữ liệu
        $sql = "SELECT * FROM brands
                WHERE brands.NAME LIKE '%$keyword%'
                LIMIT $start, $recordsPerPage";
        // Chạy query
        $brands = mysqli_query($connection, $sql);
        // Đóng kết nối đến DB
        include_once "../Connection/close.php";
        // Hiển thị dữ liệu
    ?>
    <div class="breadcrumb-container">
        <p class="breadcrumb">
            <a href="#" class="text-dark">Trang admin</a> > <a href="#" class="text-dark">Danh sách nhãn hàng</a>
        </p>
        <form method="get" action="" class="search-form">
            <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?php echo $keyword; ?>">
            <button>Tìm kiếm</button>
        </form>
    </div>
     <a href="create.php">
            <button class="button-name" role="button">Thêm nhãn hàng</button>
        </a>
    <table class="table table-striped table-hover">
        <tr>
            <th>STT</th>
            <th>Tên nhãn hàng</th>
            <td></td>
            <td></td>
        </tr>
        <?php
            foreach ($brands as $row) {
        ?>
            <tr>
                <td>
                    <?php echo $row['BRAND_ID']; ?>
                </td>
                <td>
                    <?php echo $row['NAME']; ?>
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $row['BRAND_ID']; ?>">
                        <button class="vista-button"><div>Chỉnh sửa</div></button>
                    </a>
                </td>
                <td>
                    <!-- Thêm sự kiện onclick để hiển thị modal -->
                    <button class="vista-button" onclick="showModal('destroy.php?id=<?php echo $row['BRAND_ID']; ?>')">
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
            for($page = 1; $page <= $pages; $page++){
                if ($keyword == ""){
        ?>
             <a href="?page=<?php echo $page ?>">
                <?php echo $page ?>
            </a>
        <?php
                } else {
        ?>
            <a href="?page=<?php echo $page ?>&&keyword=<?php echo $keyword ?>">
                <?php echo $page ?>
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