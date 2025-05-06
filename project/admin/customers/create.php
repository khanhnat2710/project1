<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new customers</title>
    <link rel="stylesheet" href="../../layouts/style.css">
</head>
<body>
    <?php
        include_once "../../layouts/header.php";
    ?>
    <form action="store.php" method="post">
        <label for="name">name: </label><input type="text" name="name" id="name"><br>
        <label for="email">email: </label><input type="text" name="email" id="email"><br>
        <label for="phone">phone number: </label><input type="text" name="phone" id="phone"><br>
        <label for="address">address: </label><textarea name="address" id="address"></textarea><br>
        <label for="gender">gender: </label>
        <input type="radio" name="gender" id="gender" value="male"> Male 
        <input type="radio" name= "gender" id="gender" value="female">Female<br>
        <label for="description">information: </label><textarea name="description" id="description"></textarea><br>
        <button>Add</button>
    </form>
    <?php
        include_once "../../layouts/footer.php";
    ?>
</body>
</html>