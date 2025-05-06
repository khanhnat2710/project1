<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm phương thức thanh toán</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body><?php
        include_once "../../layouts/header.php";
    ?>

    <form method="post" action="type.php">
        <label for="name">Tên kiểu thanh toán: </label><input type="text" name="name" id="name"><br>
        <button>Thêm</button>
    </form>
    <!-- <?php
        include_once "../../layouts/footer.php";
    ?> -->
</body>
</html>