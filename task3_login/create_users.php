<?php
include 'connect.php';

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
)";

if ($conn->query($sql) === TRUE) {
    echo "Users table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Insert default user
$sql2 = "INSERT INTO users (username, password)
VALUES ('admin', '1234')";

if ($conn->query($sql2) === TRUE) {
    echo "User added successfully";
} else {
    echo "User may already exist";
}
?>
