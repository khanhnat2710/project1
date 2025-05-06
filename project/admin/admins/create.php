<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new role</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        include_once "../../layouts/header.php";
    ?>
    <form action="store.php" method="post">
        <label for="name">name: </label><input type="text" name="name" id="name"><br>
        <label for="email">email: </label><input type="text" name="email" id="email"><br>
        <label for="username">username: </label><input type="text" name="username" id="username"><br>
        <label for="password">password: </label><input type="password" name="password" id="password"><br>
        <label for="address">address: </label><textarea name="address" id="address"></textarea><br>
        <label for="role">Role: </label>
        <select name="role" id="role">
            <option value="0">admin</option>
            <option value="1">manager</option>
            <option value="2">storage manager</option>
        </select><br>
        <button>Add</button>
    </form>
    <?php
        include_once "../../layouts/footer.php";
    ?>
</body>
</html>