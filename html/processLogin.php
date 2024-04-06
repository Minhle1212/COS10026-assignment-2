<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
     include ("settings.php");
     $conn = @mysqli_connect($host,$user, $pwd, $sql_db);
     $table = "Manager";
     if (!$conn) {
         echo "<p>Database connection failed</p>";
     }
     else {
         if ((isset($_POST["name"])) and (isset($_POST["pwd"]))) {
             function sanitizeInput($input) {
                 $input = trim($input);
                 $input = stripslashes($input);
                 $input = htmlspecialchars($input);
                 return $input;
                }
            }
        }

        $name = sanitizeInput($_POST["name"]);
        $pwd  = sanitizeInput($_POST["pwd"]);
        $sql = "SELECT * FROM $table WHERE name = '$name' AND pwd = '$pwd'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row["name"] === $name and $row["pwd"] === $pwd) {
                $_SESSION["id"] = $row["id"];
                $_SESSION["name"] = $row["name"];
                header("Location: manage.php");
                exit();
            }
            else {
                echo"Wrong password or username";
                exit();
            }

        }
    ?>
</body>
</html>