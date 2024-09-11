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

// Handle form submission for adding a new product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $productName = $_POST["product_name"];
  $productPrice = $_POST["product_price"];
  $productImage = $_FILES["product_image"]["name"];

  // Upload product image
  $targetDir = "uploads/";
  $targetFile = $targetDir . basename($productImage);
  move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile);

  // Insert new product into database
  $sql = "INSERT INTO products (name, price, image) VALUES ('$productName', '$productPrice', '$productImage')";
  if ($conn->query($sql) === TRUE) {
    echo "New product added successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Retrieve products from database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Display product list in table
echo "<table>";
echo "<thead>";
echo "<tr>";
echo "<th>Product Image</th>";
echo "<th>Product Name</th>";
echo "<th>Product Price</th>";
echo "<th>Action</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td><img src='uploads/" . $row["image"] . "' alt='" . $row["name"] . "' width='100px'></td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["price"] . "</td>";
    echo "<td>";
    echo "<form action='delete.php' method='post'>";
    echo "<input type='hidden' name='product_id' value='" . $row["id"] . "'>";
    echo "<button type='submit' class='button'>Delete</button>";
    echo "</form>";
    echo "<button class='button'>Update</button>";
    echo "</td>";
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='4'>No products found.</td></tr>";
}

echo "</tbody>";
echo "</table>";

$conn->close();
?>