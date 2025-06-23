<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm khách hàng</title>
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

        /* Định dạng cho modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.3);
        }

        .modal-content {
            background: #fff;
            border-radius: 8px;
            max-width: 350px;
            margin: 120px auto;
            padding: 24px 20px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.18);
            text-align: center;
            position: relative;
        }

        .modal-content h4 {
            color: #d70018;
            margin-bottom: 12px;
        }

        .modal-content p {
            margin-bottom: 16px;
        }

        .modal-content button {
            margin-top: 16px;
            background: #5bc0de;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 18px;
            font-size: 15px;
            cursor: pointer;
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

    <form action="store.php" method="post">
        <h1>Thêm Khách Hàng</h1>
        <label for="name">Tên khách hàng:</label>
        <input type="text" name="name" id="name" placeholder="Nhập tên khách hàng">
        
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" placeholder="Nhập email">
        
        <label for="phone">SĐT:</label>
        <input type="text" name="phone" id="phone" placeholder="Nhập số điện thoại">
        
        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" id="password" placeholder="Nhập mật khẩu">
        
        <label for="address">Địa chỉ:</label>
        <textarea name="address" id="address" placeholder="Nhập địa chỉ"></textarea>
        
        <label for="gender">Giới tính:</label>
        <input type="radio" name="gender" id="gender" value="Nam"> Nam
        <input type="radio" name="gender" id="gender" value="Nữ"> Nữ
        
        <label for="description">Thông tin khách hàng:</label>
        <textarea name="description" id="description" placeholder="Nhập thông tin khách hàng"></textarea>
        
        <button>Thêm</button>
    </form>

    <!-- Modal cảnh báo trùng email -->
    <div id="emailErrorModal" class="modal" tabindex="-1" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3);">
      <div style="background:#fff; border-radius:8px; max-width:350px; margin:120px auto; padding:24px 20px; box-shadow:0 4px 16px rgba(0,0,0,0.18); text-align:center; position:relative;">
        <h4 style="color:#d70018; margin-bottom:12px;">Lỗi đăng ký</h4>
        <p>Email này đã được sử dụng. Vui lòng chọn email khác!</p>
        <button onclick="document.getElementById('emailErrorModal').style.display='none';" style="margin-top:16px; background:#5bc0de; color:#fff; border:none; border-radius:5px; padding:8px 18px; font-size:15px; cursor:pointer;">Đóng</button>
      </div>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'email'): ?>
    <script>
        window.onload = function() {
            document.getElementById('emailErrorModal').style.display = 'block';
        }
    </script>
    <?php endif; ?>

    <!-- Footer nằm ở dưới cùng -->
    <!-- <div class="footer-container">
        <?php
            // include_once "../../layouts/footer.php";
        ?>
    </div> -->
</body>
</html>