<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["name"])) {
	header("Location: index.php");
	exit;
}

// Display vendor dashboard
?>