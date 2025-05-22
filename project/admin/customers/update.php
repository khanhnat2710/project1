<?php
    //lấy dữ liệu
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone"];
    $description = $_POST["description"];
    //mở kết nối
    include_once "../connection/open.php";
    //Viết sql
    $sql = "UPDATE customers SET NAME = '$name', EMAIL = '$email', PASSWORD = '$password', GENDER = '$gender', ADDRESS = '$address', PHONE_NUMBER = '$phone_number', DESCRIPTION = '$description' WHERE CUS_ID = '$id'";
    //Chạy sql
    mysqli_query($connection, $sql);
    //Đóng kết nối
    include_once "../connection/close.php";
    //Quay về danh sách
    header("Location: index.php");
?>