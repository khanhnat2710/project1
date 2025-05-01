<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new product</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        include_once "../../layouts/header.php";
    ?>
    <?php
        //Mở kết nối
        include_once "../Connection/open.php";
        //Viết sql
        $sql_brands = "SELECT * FROM brands";
        $sql_types = "SELECT * FROM types";
        //Chạy sql
        $brands = mysqli_query($connection, $sql_brands);
        $types = mysqli_query($connection, $sql_types);
        //Đóng kết nối
        include_once "../Connection/close.php";
    ?>
    <form method="post" action="type.php">
        <label for="name">Name: </label><input type="text" name="name" id="name"><br>
        <label for="image">Image: </label><input type="file" name="image" id="image"><br>
        <label for="ram">Ram: </label><input type="text" name="ram" id="ram"><br>
        <label for="chip">Chip: </label><input type="text" name="chip" id="chip"><br>
        <label for="rom">Rom: </label><input type="text" name="rom" id="rom"><br>
        <label for="screen_size">Screen size: </label><input type="text" name="screen_size" id="screen_size"><br>
        <label for="camera">Camera: </label><input type="text" name="camera" id="camera"><br>
        <label for="color">Color: </label><input type="text" name="color" id="color"><br>
        <label for="price">Price: </label><input type="text" name="price" id="price"><br>
        <label for="quantity">Quantity: </label><input type="text" name="quantity" id="quantity"><br>
        <label for="brand_id">Brand: </label>
        <select name="brand_id" id="brand_id">
            <?php
                foreach ($brands as $brand){
            ?>
                <option value="<?php echo $brand['BRAND_ID']; ?>">
                    <?php    echo $brand['NAME']; ?>
                </option>
            <?php
                }
            ?>
        </select><br>
        <label for="type_id">Type: </label>
        <select name="type_id" id="type_id">
            <?php
                foreach ($types as $type){
            ?>
                <option value="<?php echo $type['TYPE_ID'] ?>">
                    <?php    echo $type['NAME']; ?>
                </option>
            <?php
                }
            ?>
        </select><br>
        <button>Add</button>
    </form>
    <?php
        include_once "../../layouts/footer.php";
    ?>
</body>
</html>