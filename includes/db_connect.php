<?php
// includes/db_connect.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hostelManagment";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
} else {
    echo "Database Connection successful!";
}
?>
