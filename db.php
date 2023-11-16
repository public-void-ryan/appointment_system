<?php
$db_host = "localhost";
$db_user = "scsu";
$db_password = "huskies"; 
$db_name = "appointment_app"; 

// Create a connection to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
