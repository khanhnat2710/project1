<?php
    //Lấy dữ liệu từ form
    $id = $_POST["id"];
    $name = $_POST["name"];
    $image = $_FILES["image"]["name"];
    $ram = $_POST["ram"];
    $chip = $_POST["chip"];
    $rom = $_POST["rom"];
    $screen_size = $_POST["screen_size"];
    $camera = $_POST["camera"];
    $color = $_POST["color"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $brand_id = $_POST["brand_id"];
    $type_id = $_POST["type_id"];
    //Mở kết nối
    include_once "../Connection/open.php";
    //Viết sql
    if($image == null){
        $sql = "UPDATE products SET name='$name', ram='$ram', chip='$chip', rom='$rom', screen_size='$screen_size', camera='$camera', color='$color', price='$price', quantity='$quantity', brand_id='$brand_id', type_id='$type_id' WHERE PRD_ID='$id'";
    } else{
        $sql = "UPDATE products SET name='$name', image='$image', ram='$ram', chip='$chip', rom='$rom', screen_size='$screen_size', camera='$camera', color='$color', price='$price', quantity='$quantity', brand_id='$brand_id', type_id='$type_id' WHERE PRD_ID='$id'";
    }
    //Chạy sql
    mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../Connection/close.php";
    //Kiểm tra nếu ảnh chưa có trong thư mục image thì copy ảnh vào thư mục iamge
    if(!file_exists("../image/" . $image)){
        // lấy path của ảnh
        $path = $_FILES['image']['tmp_name'];
        //lưu ảnh vào thư mục image
        move_uploaded_file($path, "../image/" . $image);
    }
    //Quay về danh sách
    header("Location: index.php");
?>