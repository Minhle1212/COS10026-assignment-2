<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/manage.css">

</head>
<body>
	
	<div class="manage">
		<h1>EOI Management</h1>
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
			<input type="text" name="Job_Reference" id="Job_Reference">
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
			<input type="text" name="Job_Reference" id="Job_Reference_delete">
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
			<input type="text" name="status" id="status">
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
		if (isset($_GET["EOI_ID"]) && isset($_GET["Status"])) {
			$eoiNumber = sanitizeInput($_GET["EOI_ID"]);
			$status = sanitizeInput($_GET["Status"]);
			$sql = "UPDATE EOI SET Status = '$status' WHERE EOInumber = $eoiNumber";
			// Perform the status change operation
			if (mysqli_query($conn, $sql)) {
				echo "EOI with EOInumber '$eoiNumber' has been updated successfully.";
			} else {
				echo "Error: " . mysqli_error($conn);
			}
			exit();
		}
	}
<<<<<<< HEAD
	
=======

	$sql = "SELECT * FROM EOI";
>>>>>>> 44937c8cc9ab26e28d99572a103faf325641d5c6
	// Execute the query
	$result = mysqli_query($conn, $sql);

	if ($result) {
		// Display the results in a table format
		echo "<table>
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