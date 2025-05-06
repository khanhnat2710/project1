<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cập nhật thông tin khách hàng</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        include_once "../../layouts/header.php";
    ?>
    <?php
        //lấy id
        $id = $_GET['id'];
        //mở kết nối
        include_once "../connection/open.php";
        //viết sql
        $sql = "SELECT * FROM customers WHERE CUS_ID = '$id'";
        //chạy query
        $customers = mysqli_query($connection, $sql);
        //đóng kết nối
        include_once "../connection/close.php";
        //hiển thị dữ liệu
    ?>
    <form method="post" action="update.php">
        <?php
            foreach ($customers as $customer) {
        ?>
            <label for="id">STT: </label><input type="text" name="id" id="id" readonly value="<?php echo $customer['CUS_ID']; ?>"><br>
            <label for="name">Tên khách hàng: </label><input type="text" name="name" id="name" value="<?php echo $customer['NAME']; ?>"><br>
            <label for="phone">SĐT: </label><input type="text" name="phone" id="phone" value="<?php echo $customer['PHONE_NUMBER']; ?>"><br>
            <label for="email">Email: </label><input type="text" name="email" id="email" value="<?php echo $customer['EMAIL']; ?>"><br>
            <label for="gender">Giới tính: </label>
            <input type="radio" name="gender" id="gender_male" value="Nam" <?php echo ($customer['GENDER'] == 'Nam') ? 'checked' : ''; ?>> Nam 
            <input type="radio" name="gender" id="gender_female" value="Nữ" <?php echo ($customer['GENDER'] == 'Nữ') ? 'checked' : ''; ?>> Nữ<br>
            <label for="address">Địa chỉ: </label><textarea name="address" id="address"><?php echo $customer['ADDRESS']; ?></textarea><br>
            <label for="description">Thông tin khách hàng: </label><textarea name="description" id="description"><?php echo $customer['DESCRIPTION']; ?></textarea><br>
        <?php
            }
        ?>
        <button>Cập nhật</button>
    </form>
    <!-- <?php
        include_once "../../layouts/footer.php";
    ?> -->
</body>
</html>