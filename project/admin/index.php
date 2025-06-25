<?php
session_start();
// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (empty($_SESSION['USERNAME'])) {
    header('Location: login/login.php');
}
// Header
include_once "../layouts/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào mừng đến với trang quản trị</title>
</head>

<body>
    <div style="display:block;text-align:center;margin-top: 250px;">
        <h1>
            Chào mừng 
            <span style="color:#d70018; font-weight:bold; font-size:2.5rem; text-shadow:1px 1px 8px #ffd6d6;">
                <?php
                include_once "connection/open.php";
                $fullname = $_SESSION['USERNAME']; 
                $sql = "SELECT NAME FROM admins WHERE USERNAME='$fullname'";
                $result = mysqli_query($connection, $sql);
                foreach ($result as $row) {
                    echo $row['NAME'];
                }
                include_once "connection/close.php";
                ?>
            </span>
            đến với trang quản trị
        </h1> <br>
        <p style="font-size:1.2rem; color:#555;">
            Chúc bạn một ngày làm việc hiệu quả và vui vẻ!
        </p>
    </div>
</body>
</html>