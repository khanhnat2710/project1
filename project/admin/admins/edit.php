<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update an admin</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
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
            <label for="id">ID: </label><input type="text" name="id" id="id" readonly value="<?php echo $admin['ADMIN_ID']; ?>"><br>
            <label for="name">Name: </label><input type="text" name="name" id="name" value="<?php echo $admin['NAME']; ?>"><br>
            <label for="email">email: </label><input type="text" name="email" id="email" value="<?php echo $admin['EMAIL']; ?>"><br>
            <label for="address">address: </label><textarea name="address" id="address" value="<?php echo $admin['ADDRESS']; ?>"></textarea><br>
            <label for="role">Role: </label>
            <select name="role" id="role">
            <option value="0">admin</option>
            <option value="1">manager</option>
            <option value="2">storage manager</option>
            </select><br>
            <label for="username">username: </label><input type="text" name="username" id="username" value="<?php echo $admin['USERNAME']; ?>"><br>
        <?php
            }
        ?>
        <button>Update</button>
    </form>
</body>
</html>