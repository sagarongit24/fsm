<?php
$servername = "localhost"; // Replace with your database server name or IP address
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "film_studio"; // Replace with your database name

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
