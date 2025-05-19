<?php 
    session_start();
    unset($_SESSION['CUS_ID']);
    unset($_SESSION['EMAIL']);
    header("Location: ../menu.php");
?>