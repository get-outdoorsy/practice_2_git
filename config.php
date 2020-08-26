<?php 
	$serverName = "localhost";
	$userName = "root";
	$password = "";
	$dbName = "school";

	$conn = new mysqli($serverName, $userName, $password, $dbName) or die("Connection failed: ".mysqli_error($conn));
?>