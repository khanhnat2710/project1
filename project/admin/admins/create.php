<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân sự</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        include_once "../../layouts/header.php";
    ?>
    <form action="store.php" method="post">
        <label for="name">Tên nhân viên: </label><input type="text" name="name" id="name"><br>
        <label for="email">email: </label><input type="text" name="email" id="email"><br>
        <label for="username">Tên đăng nhập: </label><input type="text" name="username" id="username"><br>
        <label for="password">Mật khẩu: </label><input type="password" name="password" id="password"><br>
        <label for="address">Địa chỉ: </label><textarea name="address" id="address"></textarea><br>
        <label for="role">Vai trò: </label>
        <select name="role" id="role">
            <option value="0">admin</option>
            <option value="1">Quản lý</option>
            <option value="2">Quản lý kho hàng</option>
        </select><br>
        <button>Thêm</button>
    </form>
    <!-- <?php
        include_once "../../layouts/footer.php";
    ?> -->
</body>
</html>