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
    function sanitise_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset ($_POST["job_num"])) {
        $jobNum= $_POST["job_num"];
        $jobNum = sanitise_input($jobNum);
    }
    
    if (isset ($_POST["fname"])) {
        $fname = $_POST["fname"];
        $fname = sanitise_input($fname);
        $err_msg = "";
        if (!preg_match("/^[a-zA-Z ]+$/",$fname)) {
            $err_msg .= "<p>Error: Only letters and spaces allowed.</p>"
        }
        if ($err_msg == "") { // Proceed if nothing is wrong
            echo "<h1>Welcome $fname!</h1>";
            } else { // Display error message, if data validation fails
            echo $err_msg;
        } 
    }
    
    if (isset ($_POST["lname"])) {
        $lname = $_POST["lname"];
        $lname = sanitise_input($lname);
    }

    if (isset ($_POST["street"])) {
        $street = $_POST["street"];
        $street = sanitise_input($street);
    }

    if (isset ($_POST["street"])) {
        $street = $_POST["street"];
        $street = sanitise_input($street);
    }

    if (isset ($_POST["town"])) {
        $town = $_POST["town"];
        $town = sanitise_input($town);
    }

    if (isset ($_POST["tutor"])) {
        $state = $_POST["tutor"];
        $state = sanitise_input($state);
    }
    
    if (isset ($_POST["pcode"])) {
        $pcode = $_POST["pcode"];
        $pcode = sanitise_input($pcode);
    }

    if (isset ($_POST["mail"])) {
        $email = $_POST["mail"];
        $email = sanitise_input($email);
    }

    if (isset ($_POST["phone"])) {
        $phone = $_POST["phone"];
        $phone = sanitise_input($phone);
    }

    if (isset ($_POST["other_skills"])) {
        $otherskills = $_POST["other_skills"];
        $otherskills = sanitise_input($otherskills);
    }
    

<<<<<<< HEAD
    $jobNum = $_POST["job_num"];
    $jobNum = sanitise_input($jobNum);
    $fname = htmlspecialchars($_POST["fname"]);
    $lname = htmlspecialchars($_POST["lname"]);
    $street = htmlspecialchars($_POST["street"]);
    $town = htmlspecialchars($_POST["town"]);
    $state = htmlspecialchars($_POST["tutor"]);
    $pcode = htmlspecialchars($_POST["pcode"]);
    $email = htmlspecialchars($_POST["mail"]);
    $phone = htmlspecialchars($_POST["phone"]);
=======
>>>>>>> 17c446eedf2defa0e5a993e5667f227a68e90934
    $skills = implode(", ", $_POST["tech"]);
    $stat = 'New';

    require_once("settings.php");	
    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);	
    $sql_table = "eoi";	
<<<<<<< HEAD
    $query = "insert into $sql_table (jobNum, fname, lname, street, town,	state, pcode, email, phone,	skills, otherskills, stat)
=======
    $query = "insert into $sql_table (jobNum, fname, lname, street, town, state, pcode, email, phone,	skills, otherskills, stat) 
>>>>>>> 17c446eedf2defa0e5a993e5667f227a68e90934
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