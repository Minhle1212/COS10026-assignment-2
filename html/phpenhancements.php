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
        <div class="enhancements_page">
            <h1>Enhancements</h1>
            <div class='enhancements'>
                <p>1. Store job descriptions in a database table and have the HTML dynamically created by PHP.<br>
                    <a href='jobs.php'>Link to jobs.php</a>
                </p>
                <figure>
                    <img src='../images/enhancement1.png'>
                    <figcaption>Jobs table</figcaption>
                </figure><br>
                <p>2. Create a log out page with a link from the manage web page. Ensure the manager's web site cannot be entered directly using a URL after logging out.<br>
                    <a href=manage.php>Link to manage.php</a>, will not work if you aren't logged in.
                </p>
            </div>
        </div>
        <?php
            include '../include/footer.inc'
        ?>  
    </body>    
</html>