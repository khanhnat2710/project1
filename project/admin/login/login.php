<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <style>
        /* Thiết lập cơ bản cho trang */
        body {
            font-family: Arial, sans-serif; /* Font chữ */
            background-color: #f0f2f5; /* Màu nền nhẹ nhàng */
            display: flex; /* Sử dụng Flexbox để căn giữa */
            justify-content: center; /* Căn giữa theo chiều ngang */
            align-items: center; /* Căn giữa theo chiều dọc */
            min-height: 100vh; /* Chiều cao tối thiểu bằng màn hình */
            margin: 0; /* Xóa margin mặc định */
        }

        /* Container chứa form */
        .login-container {
            background-color: #ffffff; /* Nền trắng */
            padding: 30px 40px; /* Khoảng đệm bên trong (trên dưới 30px, trái phải 40px) */
            border-radius: 8px; /* Bo tròn góc */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
            width: 100%; /* Chiếm toàn bộ chiều rộng nếu có thể */
            max-width: 400px; /* Chiều rộng tối đa */
            box-sizing: border-box; /* Đảm bảo padding không làm tăng kích thước tổng */
        }

        /* Tiêu đề form */
        .login-container h2 {
            text-align: center; /* Căn giữa chữ */
            margin-bottom: 25px; /* Khoảng cách dưới tiêu đề */
            color: #1c1e21; /* Màu chữ tối */
            font-size: 24px; /* Cỡ chữ */
        }

        /* Nhóm label và input */
        .form-group {
            margin-bottom: 15px; /* Khoảng cách giữa các nhóm */
        }

        /* Nhãn (label) */
        .form-group label {
            display: block; /* Hiển thị dạng block (chiếm 1 dòng) */
            margin-bottom: 5px; /* Khoảng cách dưới label */
            font-weight: bold; /* Chữ đậm */
            color: #4b4f56; /* Màu chữ */
            font-size: 14px; /* Cỡ chữ */
        }

        /* Ô nhập liệu */
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%; /* Chiếm toàn bộ chiều rộng của container cha */
            padding: 12px; /* Khoảng đệm bên trong ô input */
            border: 1px solid #ccd0d5; /* Viền xám nhạt */
            border-radius: 6px; /* Bo góc nhẹ */
            box-sizing: border-box; /* Đảm bảo padding không làm tăng kích thước */
            font-size: 16px; /* Cỡ chữ trong ô input */
        }

        /* Placeholder text style */
        .form-group input::placeholder {
            color: #8a8d91;
        }

        /* Nút đăng nhập */
        .login-button {
            width: 100%; /* Chiếm toàn bộ chiều rộng */
            padding: 12px; /* Khoảng đệm */
            background-color: #1877f2; /* Màu nền xanh dương (giống Facebook) */
            color: white; /* Màu chữ trắng */
            border: none; /* Bỏ viền */
            border-radius: 6px; /* Bo góc */
            font-size: 18px; /* Cỡ chữ */
            font-weight: bold; /* Chữ đậm */
            cursor: pointer; /* Con trỏ hình bàn tay khi di chuột vào */
            transition: background-color 0.3s ease; /* Hiệu ứng chuyển màu nền mượt mà */
            margin-top: 10px; /* Khoảng cách phía trên nút */
        }

        /* Hiệu ứng khi di chuột vào nút */
        .login-button:hover {
            background-color: #166fe5; /* Màu nền đậm hơn một chút */
        }

        /* Phần tùy chọn (Quên mật khẩu) */
        .options {
            text-align: center; /* Căn giữa */
            margin-top: 20px; /* Khoảng cách phía trên */
        }

        .options a {
            color: #1877f2; /* Màu chữ link */
            text-decoration: none; /* Bỏ gạch chân */
            font-size: 14px; /* Cỡ chữ */
        }

        .options a:hover {
            text-decoration: underline; /* Thêm gạch chân khi di chuột */
        }
    </style>
</head>
<body>
    <!-- <?php
        session_start();
        if(isset($_SESSION['USERNAME'])){
            header('Location: ../types/index.php');
        }
    ?> -->
    <form method="post" action="login-process.php">
    <div class="login-container">
        <h2>Đăng Nhập</h2>
        <form action="#" method="post"> <!-- Thay đổi action="#" nếu cần gửi dữ liệu đi đâu đó -->
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" required placeholder="Nhập tên đăng nhập">
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