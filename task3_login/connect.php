<?php
$servername = "localhost";
$username = "root";
$password = "TejaGowd@0120";
$database = "studentdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional test
// echo "Connected successfully!";
?>
