<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>chỉnh sửa thông tin nhân sự</title>
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
        $sql = "SELECT * FROM admins WHERE ADMIN_ID = '$id'";
        //chạy sql
        $admins = mysqli_query($connection, $sql);
        //đóng kết nối
        include_once "../connection/close.php";
        //hiển thị dữ liệu lấy được
    ?>
    <form method="post" action="update.php">
        <?php
            foreach ($admins as $admin) {
        ?>
            <label for="id">STT: </label><input type="text" name="id" id="id" readonly value="<?php echo $admin['ADMIN_ID']; ?>"><br>
            <label for="name">Tên: </label><input type="text" name="name" id="name" value="<?php echo $admin['NAME']; ?>"><br>
            <label for="username">Tên đăng nhập: </label><input type="text" name="Tên đăng nhập" id="username" value="<?php echo $admin['USERNAME']; ?>"><br>
            <label for="email">email: </label><input type="text" name="email" id="email" value="<?php echo $admin['EMAIL']; ?>"><br>
            <label for="password">Mật khẩu: </label><input type="password" name="password" id="password" value="<?php echo $admin['PASSWORD']; ?>"><br>
            <label for="address">Địa chỉ: </label><textarea name="address" id="address"><?php echo $admin['ADDRESS']; ?></textarea><br>
            <label for="role">Vai trò: </label>
            <select name="role" id="role">
            <option value="0" <?php echo $admin['ROLE'] == 0 ? 'selected' : ''; ?>>admin</option>
            <option value="1" <?php echo $admin['ROLE'] == 1 ? 'selected' : ''; ?>>Quản lý</option>
            <option value="2" <?php echo $admin['ROLE'] == 2 ? 'selected' : ''; ?>>Quản lý kho hàng</option>
            </select><br>
        <?php
            }
        ?>
        <button>Cập nhật</button>
    <!-- </form><?php
        include_once "../../layouts/footer.php";
    ?> -->

</body>
</html>