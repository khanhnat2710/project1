<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang danh sách nhãn hàng</title>
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
        // Mở kết nối đến DB
        include_once "../Connection/open.php";
        // Viết SQL lấy dữ liệu
        $sql = "SELECT * FROM brands";
        // Chạy query
        $brands = mysqli_query($connection, $sql);
        // Đóng kết nối đến DB
        include_once "../Connection/close.php";
        // Hiển thị dữ liệu
    ?>
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