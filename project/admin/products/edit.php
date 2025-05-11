<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
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

        /* Định dạng cho ảnh hiển thị */
        form img {
            display: block;
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
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
        // Viết SQL lấy dữ liệu
        $sqlBrand = "SELECT * FROM brands";
        $sqlType = "SELECT * FROM types";
        $id = $_GET["id"];
        $sqlProduct = "SELECT * FROM products WHERE PRD_ID = '$id'";
        // Chạy SQL
        $brands = mysqli_query($connection, $sqlBrand);
        $types = mysqli_query($connection, $sqlType);
        $products = mysqli_query($connection, $sqlProduct);
        // Đóng kết nối
        include_once "../Connection/close.php";
    ?>
    <form method="post" action="update.php" enctype="multipart/form-data">
        <h1>Chỉnh sửa sản phẩm</h1>
        <?php
            foreach ($products as $product) {
        ?>
            <input type="hidden" name="id" value="<?php echo $product["PRD_ID"]; ?>" />
            <label for="name">Tên sản phẩm:</label>
            <input type="text" name="name" id="name" value="<?php echo $product['NAME']; ?>">

            <label for="image">Ảnh sản phẩm:</label>
            <img src="../image/<?php echo $product['IMAGE']; ?>" alt="Ảnh sản phẩm">
            <input type="file" name="image" id="image" value="<?php echo $product['IMAGE']; ?>">

            <label for="ram">Ram:</label>
            <input type="text" name="ram" id="ram" value="<?php echo $product['RAM']; ?>">

            <label for="chip">Chip:</label>
            <input type="text" name="chip" id="chip" value="<?php echo $product['CHIP']; ?>">

            <label for="rom">Rom:</label>
            <input type="text" name="rom" id="rom" value="<?php echo $product['ROM']; ?>">

            <label for="screen_size">Kích cỡ màn hình:</label>
            <input type="text" name="screen_size" id="screen_size" value="<?php echo $product['SCREEN_SIZE']; ?>">

            <label for="camera">Camera:</label>
            <input type="text" name="camera" id="camera" value="<?php echo $product['CAMERA']; ?>">

            <label for="color">Màu sắc:</label>
            <input type="text" name="color" id="color" value="<?php echo $product['COLOR']; ?>">

            <label for="price">Giá thành:</label>
            <input type="text" name="price" id="price" value="<?php echo $product['PRICE']; ?>">

            <label for="quantity">Số lượng:</label>
            <input type="text" name="quantity" id="quantity" value="<?php echo $product['QUANTITY']; ?>">

            <label for="brand_id">Nhãn hàng:</label>
            <select name="brand_id" id="brand_id">
                <?php foreach ($brands as $brand) { ?>
                    <option value="<?php echo $brand['BRAND_ID']; ?>"
                        <?php echo ($brand['BRAND_ID'] == $product['BRAND_ID']) ? 'selected' : ''; ?>>
                        <?php echo $brand['NAME']; ?>
                    </option>
                <?php } ?>
            </select>

            <label for="type_id">Kiểu máy:</label>
            <select name="type_id" id="type_id">
                <?php foreach ($types as $type) { ?>
                    <option value="<?php echo $type['TYPE_ID']; ?>"
                        <?php echo ($type['TYPE_ID'] == $product['TYPE_ID']) ? 'selected' : ''; ?>>
                        <?php echo $type['NAME']; ?>
                    </option>
                <?php } ?>
            </select>
        <?php
            }
        ?>
        <button>Cập nhật</button>
    </form>
    <!-- Footer -->
    <?php
        // include_once "../../layouts/footer.php";
    ?>
</body>
</html>