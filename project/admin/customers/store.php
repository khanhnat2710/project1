<?php
    //lấy dữ liệu từ form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone"];
    $description = $_POST["description"];
    //mở kết nối
    include_once "../connection/open.php";
    //Kiểm tra email đã tồn tại chưa
    $sqlCheck = "SELECT COUNT(*) AS count_email FROM customers WHERE email = '$email'";
    $result = mysqli_query($connection, $sqlCheck);
    $row = mysqli_fetch_assoc($result);
    if ($row['count_email'] > 0) {
        //Nếu email đã tồn tại thì quay về trang tạo và báo lỗi
        header("Location: create.php?error=email");
    } else {
        //Nếu chưa tồn tại thì thêm tài khoản
        $sql = "INSERT INTO customers(name, email, password, gender, address, phone_number, description)
                VALUES ('$name', '$email', '$password', '$gender', '$address', '$phone_number', '$description')";
        mysqli_query($connection, $sql);
        //Quay về danh sách
        header("Location: index.php");
    }
    //Đóng kết nối
    include_once "../connection/close.php";
?>