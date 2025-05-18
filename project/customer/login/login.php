<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- <?php
        // session_start();
        // if(isset($_SESSION['USERNAME'])){
        //     header('Location: ../types/index.php');
        // }
    ?> -->
    <form method="post" action="login-process.php">
    <div class="login-container">
        <h2>Đăng Nhập</h2>
        <form action="#" method="post"> <!-- Thay đổi action="#" nếu cần gửi dữ liệu đi đâu đó -->
            <div class="form-group">
                <label for="email">Tên đăng nhập:</label>
                <input type="text" id="email" name="email" required placeholder="Nhập tên đăng nhập">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">
            </div>
            <button type="submit" class="login-button">Đăng Nhập</button>
            <!-- <div class="options">
                <a href="#">Quên mật khẩu?</a>
            </div> -->
        </form>
    </div>
    </form>
</body>
</html>