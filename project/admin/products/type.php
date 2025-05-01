<?php
    //lấy dữ liệu tròn form
    $name = $_POST['name'];
    $image = $_POST['image'];
    $ram = $_POST['ram'];
    $chip = $_POST['chip'];
    $rom = $_POST['rom'];
    $screen_size = $_POST['screen_size'];
    $camera = $_POST['camera'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $brand_id = $_POST['brand_id'];
    $type_id = $_POST['type_id'];
    //mở kết nối
    include_once "../Connection/open.php";
    //vết sql
    $sql = "INSERT INTO products (NAME, IMAGE, RAM, CHIP, ROM, SCREEN_SIZE, CAMERA, COLOR, PRICE, QUANTITY, BRAND_ID, TYPE_ID) VALUES ('$name', '$image', '$ram', '$chip', '$rom', '$screen_size', '$camera', '$color', '$price', '$quantity', '$brand_id', '$type_id')";
    //chạy sql
    mysqli_query($connection, $sql);
    //đóng kêt nối
    include_once "../Connection/close.php";
    //quay về danh sách
    header("Location: index.php");
?>