<?php
    session_start();
    //lấy email và password từ form
    $email = $_POST["email"];
    $password = $_POST["password"];
    //Mở kết nối
    include_once "../../admin/connection/open.php";
    //viết sql
    $sql = "SELECT *, COUNT(CUS_ID) AS count_id FROM customers WHERE EMAIL='$email' AND PASSWORD='$password'";
    //chạy sql
    $result = mysqli_query($connection, $sql);
    //đóng kết nối
    include_once "../../admin/connection/close.php";
    //kiểm tra email và password có đúng không
    foreach ($result as $row){
        if($row['count_id'] == 0 ){
            //quay về trang login
            header("Location: login.php");
        } else {
            //lưu account lên session
            $_SESSION['CUS_ID'] = $row['CUS_ID'];
            $_SESSION['EMAIL'] = $row['EMAIL'];
            $_SESSION['PASSWORD'] = $row['PASSWORD'];
            //quay về trang chủ
            header("location: ../menu.php");
        }
    }
?>