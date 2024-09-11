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

	// Query to check if user already exists
	$query = "SELECT * FROM users WHERE email = '$email'";
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		// User already exists, display error message
		echo "<script>document.getElementById('error-message').innerHTML = 'Email already exists. Please try again.'</script>";
	} else {
		// Insert user into database
		$query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
		$result = $conn->query($query);

		if ($result) {
			// Signup successful, redirect to user login page
			header("Location: user_login.php");
			exit;
		} else {
			// Signup failed, display error message
			echo "<script>document.getElementById('error-message').innerHTML = 'Signup failed. Please try again.'</script>";
		}
	}
}

$conn->close();
?>