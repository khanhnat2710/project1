<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang thông tin khách hàng</title>
    <link rel="stylesheet" href="../../layouts/style.css">
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
        //mở kết nối
        include_once "../connection/open.php";
        //viết sql
        $sql = "SELECT * FROM customers";
        //chạy query
        $customers = mysqli_query($connection, $sql);
        //đóng kết nối
        include_once "../connection/close.php";
        //hiển thị dữ liệu
    ?>
    <a href="create.php">
        <button class="button-name" role="button">Thêm một khách hàng mới</button>
    </a>
    <table class="table table-striped table-hover">
        <tr>
            <th>STT</th>
            <th>Tên khách hàng</th>
            <th>email</th>
            <th>Giới tính</th>
            <th>SĐT</th>
            <th>Địa chỉ</th>
            <th>Thông tin khách hàng</th>
            <th></th>
            <th></th>
        </tr>
        <?php
            foreach ($customers as $customer) {
        ?>
            <tr>
                <td>
                    <?php echo $customer['CUS_ID']; ?>
                </td>
                <td>
                    <?php echo $customer['NAME']; ?>
                </td>
                <td>
                    <?php echo $customer['EMAIL']; ?>
                </td>
                <td>
                    <?php echo $customer['GENDER'];?>
                </td>
                <td>
                    <?php echo $customer['PHONE_NUMBER']; ?>
                </td>
                <td>
                    <?php echo $customer['ADDRESS']; ?>
                </td>
                <td>
                    <?php echo $customer['DESCRIPTION']; ?>
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $customer['CUS_ID']; ?>">
                        <button class="vista-button"><div>Chỉnh sửa</div></button>
                    </a>
                </td>
                <td>
                    <a href="delete.php?id=<?php echo $customer['CUS_ID']; ?>">
                        <button class="vista-button"><div>Xóa</div></button>
                    </a>
                </td>
            </tr>
        <?php
            }
        ?>
    </table>
    <!-- <?php
        include_once "../../layouts/footer.php";
    ?> -->
</body>
</html>