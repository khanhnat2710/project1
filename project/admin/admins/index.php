<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>admins</title>
    <link rel="stylesheet" href="../../layouts/style.css">
    <style>
        /* CSS cho cửa sổ nổi (modal) */
        .modal {
            display: none; /* Ẩn modal mặc định */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5); /* Màu nền mờ */
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            text-align: center;
            border-radius: 8px;
        }

        .modal-buttons {
            margin-top: 20px;
        }

        .modal-buttons button {
            margin: 0 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-buttons .confirm {
            background-color: #d9534f;
            color: white;
        }

        .modal-buttons .cancel {
            background-color: #5bc0de;
            color: white;
        }
    </style>
    <script>
        // Hàm hiển thị modal
        function showModal(deleteUrl) {
            const modal = document.getElementById('deleteModal');
            const confirmButton = document.getElementById('confirmDelete');

            // Hiển thị modal
            modal.style.display = 'block';

            // Gắn URL xóa vào nút xác nhận
            confirmButton.onclick = function () {
                window.location.href = deleteUrl;
            };
        }

        // Hàm đóng modal
        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.style.display = 'none';
        }
    </script>
</head>
<body>
    <?php
        session_start();
        if(empty($_SESSION['USERNAME'])){
            header('Location: ../login/login.php');
        }
        include_once "../../layouts/header.php";
    ?>
    <?php
        // Mở kết nối
        include_once "../connection/open.php";
        // Viết SQL
        $sql = "SELECT * FROM admins";
        // Chạy query
        $admins = mysqli_query($connection, $sql);
        // Đóng kết nối
        include_once "../connection/close.php";
        // Hiển thị dữ liệu
    ?>
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
                        <button class="vista-button"><div>Chỉnh sửa</div></button>
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