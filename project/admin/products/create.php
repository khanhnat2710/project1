<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm một sản phẩm mới</title>
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

        /* Định dạng cho các input và select */
        form input[type="text"],
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
        form select:focus {
            border-color: #5bc0de;
            outline: none;
        }

        /* Định dạng cho input file */
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        form input[type="file"]:focus {
            border-color: #5bc0de;
            outline: none;
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
        form input::placeholder {
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
        // Mở kết nối
        include_once "../Connection/open.php";
        // Viết SQL
        $sql_brands = "SELECT * FROM brands";
        $sql_types = "SELECT * FROM types";
        // Chạy SQL
        $brands = mysqli_query($connection, $sql_brands);
        $types = mysqli_query($connection, $sql_types);
        // Đóng kết nối
        include_once "../Connection/close.php";
    ?>
    <form method="post" action="type.php" enctype="multipart/form-data">
        <h1>Thêm Sản Phẩm</h1>
        <label for="name">Tên sản phẩm:</label>
        <input type="text" name="name" id="name" placeholder="Nhập tên sản phẩm">

        <label for="image">Ảnh sản phẩm:</label>
        <input type="file" name="image" id="image">

        <label for="ram">Ram:</label>
        <input type="text" name="ram" id="ram" placeholder="Nhập dung lượng RAM">

        <label for="chip">Chip:</label>
        <input type="text" name="chip" id="chip" placeholder="Nhập loại chip">

        <label for="rom">Rom:</label>
        <input type="text" name="rom" id="rom" placeholder="Nhập dung lượng ROM">

        <label for="screen_size">Kích cỡ màn hình:</label>
        <input type="text" name="screen_size" id="screen_size" placeholder="Nhập kích cỡ màn hình">

        <label for="camera">Camera:</label>
        <input type="text" name="camera" id="camera" placeholder="Nhập thông số camera">

        <label for="color">Màu sắc:</label>
        <input type="text" name="color" id="color" placeholder="Nhập màu sắc">

        <label for="price">Giá thành:</label>
        <input type="text" name="price" id="price" placeholder="Nhập giá thành">

        <label for="quantity">Số lượng:</label>
        <input type="text" name="quantity" id="quantity" placeholder="Nhập số lượng">

        <label for="brand_id">Nhãn hàng:</label>
        <select name="brand_id" id="brand_id">
            <?php foreach ($brands as $brand) { ?>
                <option value="<?php echo $brand['BRAND_ID']; ?>">
                    <?php echo $brand['NAME']; ?>
                </option>
            <?php } ?>
        </select>

        <label for="type_id">Kiểu máy:</label>
        <select name="type_id" id="type_id">
            <?php foreach ($types as $type) { ?>
                <option value="<?php echo $type['TYPE_ID']; ?>">
                    <?php echo $type['NAME']; ?>
                </option>
            <?php } ?>
        </select>

        <button>Thêm</button>
    </form>
    <!-- Footer -->
    <?php
        // include_once "../../layouts/footer.php";
    ?>
</body>
</html>