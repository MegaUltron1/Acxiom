<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'event_management_system';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$category = $_POST["category"];

	// Query to insert vendor into database
	$query = "INSERT INTO vendors (name, email, password, category) VALUES ('$name', '$email', '$password', '$category')";
	$result = $conn->query($query);

	if ($result) {
		// Signup successful, redirect to vendor login page
		header("Location: vendor_login.php");
		exit;
	} else {
		// Signup failed, display error message
		echo "<script>document.getElementById('error-message').innerHTML = 'Signup failed. Please try again.'</script>";
	}
}

$conn->close();
?>