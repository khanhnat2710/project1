<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm kiểu máy</title>
    <style>
        /* Định dạng chung cho body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
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

        /* Định dạng cho các input */
        form input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        form input[type="text"]:focus {
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
    </style>
</head>
<body>
    <?php
        // include_once "../../layouts/header.php";
    ?>
    <form method="post" action="type.php">
        <h1>Thêm Kiểu Máy</h1>
        <label for="name">Tên kiểu máy:</label>
        <input type="text" name="name" id="name" placeholder="Nhập tên kiểu máy">
        <button>Thêm</button>
    </form>
    <!-- <?php
        // include_once "../../layouts/footer.php";
    ?> -->
</body>
</html>