<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa thông tin nhân sự</title>
    <style>
        /* Định dạng chung cho body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        /* Định dạng cho form */
        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 450px;
            margin: 20px auto;
        }

        /* Định dạng cho tiêu đề */
        form h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 26px;
            font-weight: bold;
        }

        /* Định dạng cho các label */
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        /* Định dạng cho các input, textarea và select */
        form input[type="text"],
        form input[type="password"],
        form textarea,
        form select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        form input[type="text"]:focus,
        form input[type="password"]:focus,
        form textarea:focus,
        form select:focus {
            border-color: #5bc0de;
            outline: none;
        }

        /* Định dạng cho textarea */
        form textarea {
            resize: none;
            height: 100px;
        }

        /* Định dạng cho nút submit */
        form button {
            background-color: #5bc0de;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #31a2c2;
        }

        /* Định dạng cho placeholder */
        form input::placeholder,
        form textarea::placeholder {
            color: #aaa;
            font-style: italic;
        }

        /* Đảm bảo header chiếm toàn bộ chiều ngang */
        .header-container {
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Header nằm ở trên cùng -->
    <div class="header-container">
        <?php
            include_once "../../layouts/header.php";
        ?>
    </div>

    <?php
        // Lấy id
        $id = $_GET['id'];
        // Mở kết nối
        include_once "../connection/open.php";
        // Viết SQL
        $sql = "SELECT * FROM admins WHERE ADMIN_ID = '$id'";
        // Chạy SQL
        $admins = mysqli_query($connection, $sql);
        // Đóng kết nối
        include_once "../connection/close.php";
    ?>
    <form method="post" action="update.php">
        <h1>Chỉnh sửa thông tin nhân sự</h1>
        <?php
            foreach ($admins as $admin) {
        ?>
            <label for="id">STT:</label>
            <input type="text" name="id" id="id" readonly value="<?php echo $admin['ADMIN_ID']; ?>">

            <label for="name">Tên:</label>
            <input type="text" name="name" id="name" value="<?php echo $admin['NAME']; ?>">

            <label for="username">Tên đăng nhập:</label>
            <input type="text" name="username" id="username" value="<?php echo $admin['USERNAME']; ?>">

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $admin['EMAIL']; ?>">

            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" value="<?php echo $admin['PASSWORD']; ?>">

            <label for="address">Địa chỉ:</label>
            <textarea name="address" id="address"><?php echo $admin['ADDRESS']; ?></textarea>

            <label for="role">Vai trò:</label>
            <select name="role" id="role">
                <option value="0" <?php echo $admin['ROLE'] == 0 ? 'selected' : ''; ?>>Admin</option>
                <option value="1" <?php echo $admin['ROLE'] == 1 ? 'selected' : ''; ?>>Quản lý</option>
                <option value="2" <?php echo $admin['ROLE'] == 2 ? 'selected' : ''; ?>>Quản lý kho hàng</option>
            </select>
        <?php
            }
        ?>
        <button>Cập nhật</button>
    </form>
    <!-- Footer -->
    <!-- <?php
        // include_once "../../layouts/footer.php";
    ?> -->
</body>
</html>