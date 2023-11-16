<?php
$db_host = "localhost"; // AMPPS default database host
$db_user = "scsu"; // Your MySQL username
$db_password = "huskies"; // Your MySQL password
$db_name = "appointment_app"; // The name of the database you created

// Create a connection to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
