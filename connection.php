<?php

// Secure database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinicms";

// Create connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


  
?>