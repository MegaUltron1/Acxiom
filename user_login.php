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
	$email = $_POST["email"];
	$password = $_POST["password"];

	// Query to check if user exists
	$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		// Login successful, redirect to user dashboard
		header("Location: user_dashboard.php");
		exit;
	} else {
		// Login failed, display error message
		echo "<script>document.getElementById('error-message').innerHTML = 'Invalid email or password. Please try again or <a href=\"user_signup.php\">sign up now</a>';</script>";
	}
}

$conn->close();
?>