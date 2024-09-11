<?php
// Database connection details
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "product_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get product ID from form submission
$productId = $_POST["product_id"];

// Delete product from database
$sql = "DELETE FROM products WHERE id = $productId";

if ($conn->query($sql) === TRUE) {
  echo "Product deleted successfully!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>