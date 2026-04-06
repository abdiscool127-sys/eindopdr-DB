<?php
// Database connection settings.
$host = "localhost";
$user = "root";
$password = "";
$database = "klanten_db";

// Create a mysqli connection object.
$conn = new mysqli($host, $user, $password, $database);

// Stop immediately if the database connection fails.
if ($conn->connect_error) {
    die("Error: Unable to connect to database: " . $conn->connect_error);
}
?>