<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product list</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        session_start();
        if(empty($_SESSION['USERNAME'])){
            header('Location: ../login/login.php');
        }
        include_once "../../layouts/header.php";
    ?>
    <?php
        //Mở kết nối đến DB
        include_once "../Connection/open.php";
        //Viết sql lấy dữ liệu
        $sql = "SELECT products.*, brands.NAME AS brand_name, types.NAME AS type_name FROM products INNER JOIN brands ON brands.BRAND_ID = products.BRAND_ID INNER JOIN types ON types.TYPE_ID = products.TYPE_ID";
        //Chạy query
        $products = mysqli_query($connection, $sql);
        //Đóng kết nối đến DB
        include_once "../Connection/close.php";
        //Hiển thị dữ liệu
    ?>
    <a href="create.php">
    <button class="button-name" role="button">Add new type</button>
    </a>
    <table class="table table-striped table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Ram</th>
            <th>Chip</th>
            <th>Rom</th>
            <th>Screen size</th>
            <th>Camera</th>
            <th>Color</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Brand</th>
            <th>Type</th>
            <th></th>
            <th></th>
        </tr>
        <?php
            foreach ($products as $product){
        ?>
            <tr>
                <td style = "text-align: center;">
                    <?php echo $product['PRD_ID']; ?>
                </td>
                <td>
                    <?php echo $product['NAME']; ?>
                </td>
                <td>
                    <img src="<?php echo $product['IMAGE']; ?>" alt="" width="100px" height="100px">
                </td>
                <td style = "text-align: center;">
                    <?php echo $product['RAM']; ?>
                </td>
                <td>
                    <?php echo $product['CHIP']; ?>
                </td>
                <td style = "text-align: center;">
                    <?php echo $product['ROM']; ?>
                </td>
                <td>
                    <?php echo $product['SCREEN_SIZE']; ?>
                </td>
                <td>
                    <?php echo $product['CAMERA']; ?>
                </td>
                <td style = "text-align: center;">
                    <?php echo $product['COLOR']; ?>
                </td>
                <td style = "text-align: center;">
                    <?php echo $product['PRICE']; ?>
                </td>
                <td style = "text-align: center;">
                    <?php echo $product['QUANTITY']; ?>
                </td>
                <td style = "text-align: center;">
                    <?php echo $product['brand_name']; ?>
                </td>
                <td style = "text-align: center;">
                    <?php echo $product['type_name']; ?>
                </td>
                <td>
                    <a href="edit.php?id=<?php echo $product["PRD_ID"]; ?>">
                        <button class="vista-button"><div>Edit</div></button>
                    </a>
                </td>
                <td>
                    <a href="destroy.php?id=<?php echo $product["PRD_ID"]; ?>">
                        <button class="vista-button"><div>Delete</div></button>
                    </a>
                </td>
            </tr>
        <?php
            }
        ?>
    </table>
    <?php
        include_once "../../layouts/footer.php";
    ?>
</body>
</html>