<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>processEOI</title>
</head>
<body>
    <?php
// Server-side validation and processing

// This function ensures all data should be sanitized to remove leading and trailing spaces, backslashes, and HTML control characters.
function sanitise_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// Connect to the database
require_once("settings.php");

$conn = @mysqli_connect(
    $host,
    $user,
    $pwd,
    $sql_db
);
// Check connection; if failed, display an error message
if (!$conn) {
    echo "<p>Database connection failure</p>";
}


// Validate and sanitize form inputs

$errMsg = ""; // Added variable to store error messages

if (isset($_POST["Job_Reference"])) {
    $Job_Reference = sanitise_input($_POST["Job_Reference"]);
} else {
    echo"Invalid Job reference number";
    exit;
}

if (isset($_POST["First_Name"])) {
    $First_Name = sanitise_input($_POST["First_Name"]);
} else {
    echo"Invalid pattern for First Name ";
    exit;
}

if (isset($_POST["Last_Name"])) {
    $Last_Name = sanitise_input($_POST["Last_Name"]);
} else {
    echo"Invalid Last Name";
    exit;
}

if (isset($_POST["dob"])) {
    $dob = sanitise_input($_POST["dob"]);
} else {
    echo"Invalid  date 0f birth";
    exit;
}

if (isset($_POST["Gender"])) {
    $Gender = sanitise_input($_POST["Gender"]);
} else {
    echo"Select gender";
    exit;
}

if (isset($_POST["Street_Address"])) {
    $Street_Address = sanitise_input($_POST["Street_Address"]);
} else {
    echo"Invalid Street Address";
    exit;
}
if (isset($_POST["Suburb_Town"])) {
    $Suburb_Town = sanitise_input($_POST["Suburb_Town"]);
} else {
    echo"Invalid Suburb_Town";
    exit;
}

if (isset($_POST["State"])) {
    $State = sanitise_input($_POST["State"]);
} else {
    echo"Invalid State";
    exit;
}

if (isset($_POST["Postcode"])) {
    $Postcode = sanitise_input($_POST["Postcode"]);
} else {
    echo"Invalid Postcode";
    exit;
}
if (isset($_POST["Email_Address"])) {
    $Email_Address = sanitise_input($_POST["Email_Address"]);
} else {
    echo"Invalid Email Address";
    exit;
}

if (isset($_POST["Phone_Number"])) {
    $Phone_Number = sanitise_input($_POST["Phone_Number"]);
} else {
    echo"Invalid Phone Number";
    exit;
}

if (isset($_POST["OtherSkills"])) {
    $OtherSkills = sanitise_input($_POST["OtherSkills"]);
} else {
    $OtherSkills = "";
}

$Job_Reference = sanitise_input($Job_Reference);
$First_Name = sanitise_input($First_Name);
$Last_Name = sanitise_input($Last_Name);
$dob = sanitise_input($dob);
$Gender = sanitise_input($Gender);
$Street_Address = sanitise_input($Street_Address);
$Suburb_Town = sanitise_input($Suburb_Town);
$State = sanitise_input($State);
$Postcode = sanitise_input($Postcode);
$Email_Address = sanitise_input($Email_Address);
$Phone_Number = sanitise_input($Phone_Number);
$OtherSkills = sanitise_input($OtherSkills);

// Makes sure all the required fields are filled; otherwise, display error message
if (empty($Job_Reference)) {
    $errMsg .= "<p>You must enter a job reference number.</p>";
} elseif (!preg_match("/^[a-zA-Z0-9]{5}$/", $Job_Reference)) {
    $errMsg .= "<p>Only five alphanumeric characters are allowed in the job reference number.</p>";
}
if (empty($First_Name)) {
    $errMsg .= "<p>You must enter your first name.</p>";
} elseif (!preg_match("/^[a-zA-Z]{1,20}$/", $First_Name)) {
    $errMsg .= "<p>Only 20 alphabetic letters are allowed in your first name.</p>";
}


if (empty($Last_Name)) {
    $errMsg .= "<p>You must enter your last name.</p>";
} elseif (!preg_match("/^[a-zA-Z]{1,20}$/", $Last_Name)) {
    $errMsg .= "<p>Only 20 alphabetic letters are allowed in your last name.</p>";
}


if (empty($dob)) {
    $errMsg .= "<p>You must enter your date of birth.</p>";
} else {
    $dobDateTime = DateTime::createFromFormat('Y-m-d', $dob);
    if (!$dobDateTime) {
        $errMsg .= "<p>You must enter the date of birth in the correct format: YYYY-MM-DD.</p>";
    } else {
        $now = new DateTime();
        $age = $now->diff($dobDateTime)->y;
        if ($age < 15 || $age > 80) {
            $errMsg .= "<p>Your age must be between 15 and 80 years.</p>";
        }
    }
}


if (empty($Gender)) {
    $errMsg .= "<p>Gender is required.</p>";
} else {
    //This ensures Radio input has a value, you can proceed with further processing
    $selectedGender = $_POST['Gender'];
}


if (empty($Street_Address)) {
    $errMsg .= "<p>You must enter your street address.</p>";
} elseif (!preg_match("/^[a-zA-Z]{1,40}$/", $Street_Address)) {
    $errMsg .= "<p>Only 40 alphabetic letters are allowed in your street address.</p>";
}
if (empty($Suburb_Town)) {
    $errMsg .= "<p>You must enter your suburb or town.</p>";
} elseif (!preg_match("/^[a-zA-Z]{1,40}$/", $Suburb_Town)) {
    $errMsg .= "<p>Only 40 alphabetic letters are allowed in your suburb or town.</p>";
}


if (empty($State)) {
    $errMsg .= "<p>You must select a state.</p>";
}


if (empty($Postcode)) {
    $errMsg .= "<p>You must enter your postcode.</p>";
} elseif (!preg_match("/^\d{4}$/", $Postcode)) {
    $errMsg .= "<p>Postcode must be exactly 4 digits long.</p>";
  
}

// Match postcode with state
$postcodeState = array(
  "3000" => "VIC",
  "2000" => "NSW",
  "4000" => "QLD",
  "0800" => "NT",
  "6000" => "WA",
  "5000" => "SA",
  "7000" => "TAS",
  "2600" => "ACT",
  
);
// Check if the entered postcode matches the selected state
if (isset($State) && isset($Postcode)) {
  $postcode = sanitise_input($Postcode);
  $postcode = str_pad($postcode, 4, "0", STR_PAD_LEFT); // this pads the postcode with leading zeros if necessary

  if (!isset($postcodeState[$postcode])) {
      $errMsg .= "<p>Invalid postcode.</p>";
  } elseif ($postcodeState[$postcode] !== $State) {
      $errMsg .= "<p>The selected state does not match the entered postcode.</p>";
  }
}
if (empty($Email_Address)) {
    $errMsg .= "<p>You must enter your email address.</p>";
} elseif (!filter_var($Email_Address, FILTER_VALIDATE_EMAIL)) {
    $errMsg .= "<p>You must enter a valid email address.</p>";
}


if (empty($Phone_Number)) {
    $errMsg .= "<p>You must enter your phone number.</p>";
} elseif (!preg_match("/^(\+?\d{1,4}[\s-]?)?(?!0+\s+,?$)\d{10}\s*,?$/", $Phone_Number)) {
    $errMsg .= "<p>You must enter a valid phone number (10 digits, no spaces or special characters).</p>";
}

if (isset($_POST["OtherSkills"])) {
    $OtherSkills = sanitise_input($_POST["OtherSkills"]);
    if (!preg_match("/^[a-zA-Z0-9\s]+$/", $OtherSkills)) {
        $errMsg .= "<p>Only alphanumeric characters and spaces are allowed in the Other Skills field.</p>";
    }
} else {
    $OtherSkills = "";
}

// Create the EOI table if it doesn't exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS EOI (
    `EOI_ID` INT AUTO_INCREMENT PRIMARY KEY,
    `Job_Reference` VARCHAR(20),
    `First_Name` VARCHAR(30),
    `Last_Name` VARCHAR(30),
    `dob` DATE,
    `Gender` VARCHAR(10),
    `Street_Address` VARCHAR(100),
    `Suburb_Town` VARCHAR(50),
    `State` VARCHAR(20),
    `Postcode` VARCHAR(10),
    `Email_Address` VARCHAR(50),
    `Phone_Number` VARCHAR(20),
    `OtherSkills` TEXT
)";

// Execute the table creation query
mysqli_query($conn, $createTableQuery);

// Prepare the insert statement
$insertQuery = "INSERT INTO EOI (
    Job_Reference,
    First_Name,
    Last_Name,
    dob,
    Gender,
    Street_Address,
    Suburb_Town,
    State,
    Postcode,
    Email_Address,
    Phone_Number,
    OtherSkills
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Create a prepared statement
$stmt = mysqli_stmt_init($conn);

// Check if the prepared statement could be initialized
if (!mysqli_stmt_prepare($stmt, $insertQuery)) {
    echo "<h2>Error</h2>";
    echo "<p>Failed to prepare statement.</p>";
    exit;
}

// Bind the parameters to the prepared statement
mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssss",
    $Job_Reference,
    $First_Name,
    $Last_Name,
    $dob,
    $Gender,
    $Street_Address,
    $Suburb_Town,
    $State,
    $Postcode,
    $Email_Address,
    $Phone_Number,
    $OtherSkills
);

// Execute the prepared statement
if (!mysqli_stmt_execute($stmt)) {
    echo "<h2>Error</h2>";
    echo "<p>Failed to insert record.</p>";
    echo "<p>Error message: " . mysqli_error($conn) . "</p>"; // Display the specific error message from MySQL
    exit;
}

// Store the auto-generated EOI number
 $EOI_ID = mysqli_insert_id($conn);

// Close the prepared statement
mysqli_stmt_close($stmt);

// Display success message
echo "<h2>Success</h2>";
echo "<p>EOI record has been submitted successfully.Your EOI id is $EOI_ID</p>";

// Close the database connection
mysqli_close($conn);
?>
</body>
</html>
