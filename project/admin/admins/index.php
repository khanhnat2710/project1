<?php
session_start();
if (empty($_SESSION['USERNAME'])) {
    header('Location: ../login/login.php');
}
include_once "../../layouts/header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>admins</title>
    <link rel="stylesheet" href="../../layouts/style.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <?php
    // Mở kết nối
    include_once "../connection/open.php";
    //Lấy gia trị đang tìm kiếm
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
    } else {
        $keyword = '';
    }
    //Số bản ghi trong một trang
    $recordsPerPage = 3;
    //query lấy được tổng số bản ghi 
    $sqlCountRecords = "SELECT COUNT(*) AS total_records FROM admins
                        WHERE admins.NAME LIKE '%$keyword%'";
    //Chạy sql
    $countRecords = mysqli_query($connection, $sqlCountRecords);
    //Lấy tổng số bản ghi
    foreach ($countRecords as $countRecord) {
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
    // Viết SQL
    $sql = "SELECT * FROM admins
                WHERE admins.NAME LIKE '%$keyword%'
                LIMIT $start, $recordsPerPage";
    // Chạy query
    $admins = mysqli_query($connection, $sql);
    // Đóng kết nối
    include_once "../connection/close.php";
    // Hiển thị dữ liệu
    ?>
    <div class="breadcrumb-container">
        <p class="breadcrumb">
            <a href="#" class="text-dark">Trang admin</a> > <a href="#" class="text-dark">Danh sách Nhân sự</a>
        </p>
        <form method="get" action="" class="search-form">
            <input type="text" name="keyword" placeholder="Tìm kiếm..." value="<?php echo $keyword; ?>">
            <button>Tìm kiếm</button>
        </form>
    </div>
    <a href="create.php">
        <button class="button-name" role="button">Thêm nhân sự</button>
    </a>
    <table class="table table-striped table-hover">
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Tên đăng nhập</th>
            <th>Địa chỉ</th>
            <th>Vai trò</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        foreach ($admins as $admin) {
            ?>
            <tr>
                <td>
                    <?php echo $admin['ADMIN_ID']; ?>
                </td>
                <td>
                    <?php echo $admin['NAME']; ?>
                </td>
                <td>
                    <?php echo $admin['EMAIL']; ?>
                </td>
                <td>
                    <?php echo $admin['USERNAME']; ?>
                </td>
                <td>
                    <?php echo $admin['ADDRESS']; ?>
                </td>
                <td>
                    <?php
                    if ($admin['ROLE'] == 0) {
                        echo "Admin";
                    } else if ($admin['ROLE'] == 1) {
                        echo "Quản lý";
                    } else if ($admin['ROLE'] == 2) {
                        echo "Quản lý kho hàng";
                    } else {
                        echo "Unknown";
                    }
                    ?>
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $admin['ADMIN_ID']; ?>">
                        <button class="vista-button">
                            <div>Chỉnh sửa</div>
                        </button>
                    </a>
                </td>
                <td>
                    <!-- Thêm sự kiện onclick để hiển thị modal -->
                    <button class="vista-button" onclick="showModal('delete.php?id=<?php echo $admin['ADMIN_ID']; ?>')">
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
        for ($page = 1; $page <= $pages; $page++) {
            if ($keyword == "") {
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