<?php 
    session_start();
    session_unset();
    header("Location: ../menu.php");
?>