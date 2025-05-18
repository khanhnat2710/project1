<?php
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone"];
    $description = $_POST["description"];
    include_once "../connection/open.php";
    $sql = "UPDATE customers SET NAME = '$name', EMAIL = '$email', PASSWORD = '$password', GENDER = '$gender', ADDRESS = '$address', PHONE_NUMBER = '$phone_number', DESCRIPTION = '$description' WHERE CUS_ID = '$id'";
    mysqli_query($connection, $sql);
    include_once "../connection/close.php";
    header("Location: index.php");
?>