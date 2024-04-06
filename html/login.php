<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style/index.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <script src="https://kit.fontawesome.com/142309adca.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Open+Sans:wght@600&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <title>Document</title>
    </head>

    <body>
        <?php
            include ("../include/header.inc");
        ?>
        <div class="login_page">
            <form action = "processLogin.php" method = "post">
                <h1>Management Login</h1>
                <?php if (isset($_GET['error'])) {
                    echo $_GET['error'] . "Wrong username or password<br>";
                }
                ?>
                <label>Username</label>
                <input type="text" name="name" placeholder="Username" required></br>
                <label>Password</label>
                <input type ="password" name="pwd" placeholder="Password" required></br>
                <button type ="submit">Login</button>
            </form>
        </div>
        <?php
            include '../include/footer.inc'
        ?>  
    </body>    
</html>