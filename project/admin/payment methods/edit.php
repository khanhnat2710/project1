<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa phương thức thanh toán</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
<?php
        include_once "../../layouts/header.php";
    ?>
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
            <label for="id">STT: </label><input type="text" name="id" id="id" readonly value="<?php echo $row['PAY_ID']; ?>"><br>
            <label for="name">Tên kiểu thanh toán: </label><input type="text" name="name" id="name" value="<?php echo $row['NAME']; ?>"><br>
        <?php
            }
        ?>
        <button>Thêm</button>
    </form>
    <!-- <?php
        include_once "../../layouts/footer.php";
    ?> -->
</body>
</html>