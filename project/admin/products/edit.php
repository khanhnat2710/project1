<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update a product</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        include_once "../../layouts/header.php";
    ?>
    <?php
        //Mở kết nối
        include_once "../Connection/open.php";
        //Viết sql lấy dữ liệu ở bảng brands
        $sqlBrand = "SELECT * FROM brands";
        $sqltype = "SELECT * FROM types";
        //Chạy sql
        $brands = mysqli_query($connection, $sqlBrand);
        $types = mysqli_query($connection, $sqltype);
        //Lấy id của bản ghi cần sửa
        $id = $_GET["id"];
        //Viết sql lấy dữ liệu của bản ghi cần sửa
        $sqlProduct = "SELECT * FROM products WHERE PRD_ID = '$id'";
        //Chạy sql
        $products = mysqli_query($connection, $sqlProduct);
        //Đóng kết nối
        include_once "../Connection/close.php";
    ?>
    <form method="post" action="update.php">
        <?php
            foreach ($products as $product){
        ?>
            <input type="hidden" name="id" value="<?php echo $product["PRD_ID"]; ?>" />
            <label for="name">Name: </label><input type="text" name="name" id="name" value="<?php echo $product['NAME']; ?>"><br>
            <label for="image">Image: </label><input type="file" name="image" id="image" value="<?php echo $product['IMAGE']; ?>"><br>
            <label for="ram">Ram: </label><input type="text" name="ram" id="ram" value="<?php echo $product['RAM']; ?>"><br>
            <label for="chip">Chip: </label><input type="text" name="chip" id="chip" value="<?php echo $product['CHIP']; ?>"><br>
            <label for="rom">Rom: </label><input type="text" name="rom" id="rom" value="<?php echo $product['ROM']; ?>"><br>
            <label for="screen_size">Screen size: </label><input type="text" name="screen_size" id="screen_size" value="<?php echo $product['SCREEN_SIZE']; ?>"><br>
            <label for="camera">Camera: </label><input type="text" name="camera" id="camera" value="<?php echo $product['CAMERA']; ?>"><br>
            <label for="color">Color: </label><input type="text" name="color" id="color" value="<?php echo $product['COLOR']; ?>"><br>
            <label for="price">Price: </label><input type="text" name="price" id="price" value="<?php echo $product['PRICE']; ?>"><br>
            <label for="quantity">Quantity: </label><input type="text" name="quantity" id="quantity" value="<?php echo $product['QUANTITY']; ?>"><br>
            <label for="brand_id">Brand: </label>
                <select name="brand_id" id="brand_id">
                    <?php
                        foreach($brands as $brand){
                    ?>
                        <option value="<?php echo $brand['BRAND_ID']; ?>"
                            <?php
                                if($brand['BRAND_ID'] == $product['BRAND_ID']){
                            ?>
                                selected='selected'
                            <?php
                                }
                            ?>
                        >
                            <?php echo $brand['NAME']; ?>
                        </option>
                    <?php
                        }
                    ?>
                </select><br>
            <label for="type_id">Type: </label>
            <select name="type_id" id="type_id">
                    <?php
                        foreach($types as $type){
                    ?>
                        <option value="<?php echo $type['TYPE_ID']; ?>"
                            <?php
                                if($type['TYPE_ID'] == $product['TYPE_ID']){
                            ?>
                                selected='selected'
                            <?php
                                }
                            ?>
                        >
                            <?php echo $type['NAME']; ?>
                        </option>
                    <?php
                        }
                    ?>
                </select><br>
        <?php
            }
        ?>
        <button>Add</button>
    </form>
    <?php
        include_once "../../layouts/footer.php";
    ?>
</body>
</html>