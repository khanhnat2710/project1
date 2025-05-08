<?php
    //lấy dữ liệu từ form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $role = $_POST["role"];
    //mở kết nối
    include_once "../connection/open.php";
    //viết sql
    $sql = "INSERT INTO admins(NAME, EMAIL, USERNAME, PASSWORD, ADDRESS, ROLE)
     VALUES ('$name', '$email', '$username', '$password', '$address', '$role')";
    //chạy sql
    mysqli_query($connection, $sql);
    //đóng kết nối
    include_once "../connection/close.php";
    //quay về danh sách
    header("Location: index.php");
?>