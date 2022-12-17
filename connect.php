<?php 
// Define connection parameters
$host="localhost";
$username="root";
$password="";
$db_name="movieBooking";

// Create connection and verify
$conn = new mysqli($host, $username, $password,$db_name);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else{
	
}
?>