<!DOCTYPE html>
<html lang="en">
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
	include("../include/nav-bar.inc");
	?>
	<h1 class='manage_head'>EOI Management</h1>
	<div class="manage">
		<h2>List All EOIs</h2>
		<form action="manage.php" method="GET"> 
			<input type="hidden" name="action" value="list_all"> 
			<input type="submit" value="List All">
		</form>
		<hr>
		<h2>List EOIs For A Particular Position</h2>
		<form action="manage.php" method="GET" class="position-form">
			<input type="hidden" name="action" value="list_by_position">
			<label for="Job_Reference">Job Reference:</label>
			<input type="text" name="Job_Reference" id="Job_Reference"><br>
			<input type="submit" value="SUBMIT">
		</form>
		<hr>
		<h2>List EOIs For A Particular Applicant</h2>
		<form action="manage.php" method="GET">
			<input type="hidden" name="action" value="list_by_applicant">
			<label for="First_Name">First Name:</label>
			<input type="text" name="First_Name" id="First_Name">
			<br>
			<label for="Last_Name">Last Name:</label>
			<input type="text" name="Last_Name" id="Last_Name">
			<br>
			<input type="submit" value="SUBMIT">
		</form>
		<hr>
		<h2>Delete EOIs With A Specified Job Reference Number</h2>
		<form action="manage.php" method="GET">
			<input type="hidden" name="action" value="delete_by_position">
			<label for="Job_Reference_delete">Job Reference:</label>
			<input type="text" name="Job_Reference" id="Job_Reference_delete"><br>
			<input type="submit" value="DELETE">
		</form>
		<hr>
		<h2>Change The Status Of An EOI</h2>
		<form action="manage.php" method="GET">
			<input type="hidden" name="action" value="change_status">
			<label for="eoi_number">EOI Number:</label>
			<input type="text" name="eoi_number" id="eoi_number">
			<br>
			<label for="status">Status:</label>
			<select name="status" id="status">
				<option value="New">New</option>
				<option value="Current">Current</option>
				<option value="Final">Final</option>
			</select>
			<br>
			<input type="submit" value="CHANGE">
		</form>
	</div>

	<?php
    // Database connection
    require_once("settings.php");
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    // Check if connection is successful
    if (!$conn) {
        // Display an error message
        echo "<p>Database connection failure</p>";
        exit();
    }
    function sanitizeInput($input) {
        $input = trim($input); // Remove leading/trailing whitespace
        $input = stripslashes($input); // Remove backslashes
        $input = htmlspecialchars($input); // Convert special characters to HTML entities
        return $input;
    }
    if (isset($_GET['action'])) { 
		$query = sanitizeInput($_GET['action']);
	if ($query == "list_all") {
		$sql = "SELECT * FROM EOI";
	} elseif ($query == "list_by_position") {
		if (isset($_GET["Job_Reference"])) {
			$jobReference = sanitizeInput($_GET["Job_Reference"]);
			$sql = "SELECT * FROM EOI WHERE Job_Reference = '$jobReference'";
		} else {
			echo"Can not find this position";
		}
	} elseif ($query == "list_by_applicant") {
		if (isset($_GET["First_Name"]) && isset($_GET["Last_Name"])) {
			$firstName = sanitizeInput($_GET["First_Name"]);
			$lastName = sanitizeInput($_GET["Last_Name"]);
			$sql = "SELECT * FROM EOI WHERE First_Name = '$firstName' AND Last_Name = '$lastName'";
		} else {
			// Redirect to an error page if the first name or last name is not provided
			echo"Can not find this position";
			exit();
		}
	} elseif ($query == "delete_by_position") {
		if (isset($_GET["Job_Reference"])) {
			$jobReference = sanitizeInput($_GET["Job_Reference"]);
			$sql = "DELETE FROM EOI WHERE Job_Reference = '$jobReference'";
			if (mysqli_query($conn, $sql)) {
				echo "EOIs with job reference '$jobReference' have been deleted successfully.";
			// Reset the EOInumber
			 $resetSql = "ALTER TABLE EOI AUTO_INCREMENT = 1";
			 mysqli_query($conn, $resetSql);
			} else {
				echo "Error: " . mysqli_error($conn);
			}
			exit();
		} else{
			echo"Can not find this position";
			exit();
		}
	} elseif ($query == "change_status") {
		if (isset($_GET["eoi_number"]) && isset($_GET["status"])) {
			$eoiID = sanitizeInput($_GET["eoi_number"]);
			$status = sanitizeInput($_GET["status"]);
			$sql = "UPDATE EOI SET Status = '$status' WHERE EOI_ID = $eoiID";
			// Perform the status change operation
			if (mysqli_query($conn, $sql)) {
				echo "<p class='eoiUpdate'>EOI with EOI number '$eoiID' has been updated successfully.</p>";
			} else {
				echo "Error: " . mysqli_error($conn);
			}
			exit();
		}
	}

	$sql = "SELECT * FROM EOI";
	// Execute the query
	$result = mysqli_query($conn, $sql);

	if ($result) {
		// Display the results in a table format
		echo "<table class='eoi_table'>
				<tr>
				<th>EOInumber</th>
				<th>Job Reference</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Date of Birth</th>
				<th>Gender</th>
				<th>Street Address</th>
				<th>Postcode</th>
				<th>Email Address</th>
				<th>Phone Number</th>
				<th>Skills</th>
				<th>Other skills</th>
				<th>Status</th>    
				</tr>";

		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>
			<td>" . $row["EOI_ID"] . "</td>
			<td>" . $row["Job_Reference"] . "</td>
			<td>" . $row["First_Name"] . "</td>
			<td>" . $row["Last_Name"] . "</td>
			<td>" . $row["dob"] . "</td>
			<td>" . $row["Gender"] . "</td>
			<td>" . $row["Street_Address"] . "</td>
			<td>" . $row["Postcode"] . "</td>
			<td>" . $row["Email_Address"] . "</td>
			<td>" . $row["Phone_Number"] . "</td>
			<td>" . $row["Skills"] . "</td>
			<td>" . $row["OtherSkills"] . "</td>	
			<td>" . $row["Status"] . "</td>
				</tr>";
		}

		echo "</table>";

		// Free the result set
		mysqli_free_result($result);
	} else {
		echo "Error: " . mysqli_error($conn);
	}
}
 

 // Close the database connection
 mysqli_close($conn);


?>

	<?php
	include_once("../include/footer.inc");
	?>
</body>
</html>