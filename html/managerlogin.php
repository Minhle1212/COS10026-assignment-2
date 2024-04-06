<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
    <?php
    include_once("../include/header.inc");
    ?>
     <form action = "processLogin.php" method = "post">
        <h1>Manager login page</h1>
            <label for="name">Name</label>
            <input type = "text" name = "name" placeholder = "Username" required = "required"></br>

            <label for="pwd">Password</label>
            <input type = "password" name = "pwd" placeholder = "Password" required = "required"></br>

            <button type = "submit">Login</button>
    </form>

    <?php
    include_once("../include/footer.inc");
    ?>
</body>
</html>
