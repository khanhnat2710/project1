<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit payment method</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        //Lấy id
        $id = $_GET['id'];
        //Kết nối db
        include_once "../Connection/open.php";
        //Viết sql
        $sql = "SELECT * FROM payment_methods WHERE PAY_ID = '$id'";
        //Chạy sql
        $payment_methods = mysqli_query($connection, $sql);
        //Đóng kết nối
        include_once "../Connection/close.php";
        //Hiển thị dữ liệu lấy được
    ?>
    <form method="post" action="update.php">
        <?php
            foreach ($payment_methods as $row){
        ?>
            <label for="id">ID: </label><input type="text" name="id" id="id" readonly value="<?php echo $row['PAY_ID']; ?>"><br>
            <label for="name">Name: </label><input type="text" name="name" id="name" value="<?php echo $row['NAME']; ?>"><br>
        <?php
            }
        ?>
        <button>Add</button>
    </form>
</body>
</html>