<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="keywords" content="PHP, MySQL">
	<title>Retrieving records from HTML</title>
</head>

<body>
    <?php 

    $jobNum = htmlspecialchars($_POST["job_num"]);
    $fname = htmlspecialchars($_POST["fname"]);
    $lname = htmlspecialchars($_POST["lname"]);
    $street = htmlspecialchars($_POST["street"]);
    $town = htmlspecialchars($_POST["town"]);
    $state = htmlspecialchars($_POST["tutor"]);
    $pcode = htmlspecialchars($_POST["pcode"]);
    $email = htmlspecialchars($_POST["mail"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $skills = implode(", ", $_POST["tech"]);
    $otherskills = htmlspecialchars($_POST["other_skills"]);
    $stat = 'New';

    require_once("settings.php");	
    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);	
    $sql_table = "eoi";	
    $query = "insert into $sql_table (jobNum, fname, lname, street, town,	state, pcode, email, phone,	skills, otherskills, stat) 
                values ('$jobNum', '$fname', '$lname', '$street', '$town','$state', '$pcode','$email', '$phone', '$skills', '$otherskills', '$stat')";		//MySQL command
    $result = mysqli_query($conn, $query);	
    if (!$result){		
        echo "<p>Something is wrong with ", $query, "</p>";
    } else {		
        echo "<p\">Successfully added new Applicant record</p>";
    }
    mysqli_close($conn);	

    
    
    ?>

</body>
</html>