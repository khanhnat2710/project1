<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin khách hàng</title>
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

        /* Định dạng cho các input, textarea và radio */
        form input[type="text"],
        form input[type="password"],
        form textarea {
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
        form textarea:focus {
            border-color: #5bc0de;
            outline: none;
        }

        form input[type="radio"] {
            margin-right: 5px;
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

        /* Đảm bảo header và footer chiếm toàn bộ chiều ngang */
        .header-container,
        .footer-container {
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
        $sql = "SELECT * FROM customers WHERE CUS_ID = '$id'";
        // Chạy query
        $customers = mysqli_query($connection, $sql);
        // Đóng kết nối
        include_once "../connection/close.php";
    ?>
    <form method="post" action="update.php">
        <h1>Cập nhật thông tin khách hàng</h1>
        <?php
            foreach ($customers as $customer) {
        ?>
            <label for="id">STT:</label>
            <input type="text" name="id" id="id" readonly value="<?php echo $customer['CUS_ID']; ?>">

            <label for="name">Tên khách hàng:</label>
            <input type="text" name="name" id="name" value="<?php echo $customer['NAME']; ?>">

            <label for="phone">SĐT:</label>
            <input type="text" name="phone" id="phone" value="<?php echo $customer['PHONE_NUMBER']; ?>">

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $customer['EMAIL']; ?>">

            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" value="<?php echo $customer['PASSWORD']; ?>">

            <label for="gender">Giới tính:</label>
            <input type="radio" name="gender" id="gender_male" value="Nam" <?php echo ($customer['GENDER'] == 'Nam') ? 'checked' : ''; ?>> Nam
            <input type="radio" name="gender" id="gender_female" value="Nữ" <?php echo ($customer['GENDER'] == 'Nữ') ? 'checked' : ''; ?>> Nữ

            <label for="address">Địa chỉ:</label>
            <textarea name="address" id="address"><?php echo $customer['ADDRESS']; ?></textarea>

            <label for="description">Thông tin khách hàng:</label>
            <textarea name="description" id="description"><?php echo $customer['DESCRIPTION']; ?></textarea>
        <?php
            }
        ?>
        <button>Cập nhật</button>
    </form>

    <!-- Footer nằm ở dưới cùng -->
    <div class="footer-container">
        <?php
            // include_once "../../layouts/footer.php";
        ?>
    </div>
</body>
</html>