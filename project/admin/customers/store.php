<?php
    //lấy dữ lieu từ form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone"];
    $description = $_POST["description"];
    //mở kết nối
    include_once "../connection/open.php";
    //viết sql
    $sql = "INSERT INTO customers(name, email, password, gender, address, phone_number, description)
     VALUES ('$name', '$email', '$password', '$gender', '$address', '$phone_number', '$description')";
    //Chạy sql
    mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../connection/close.php";
    //Quay về danh sách
    header("Location: index.php");
?>