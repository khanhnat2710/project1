<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <!-- <?php
        session_start();
        if(isset($_SESSION['USERNAME'])){
            header('Location: ../types/index.php');
        }
    ?> -->
    <form method="post" action="login-process.php">
        <label for="username">Username: </label><input type="text" name="username" id="username"><br>
        <label for="password">Password: </label><input type="password" name="password" id="password"><br>
        <button>Login</button>
    </form>
</body>
</html>