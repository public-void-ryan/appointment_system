<?php
// Start the session
session_start();

// Check if the user is logged in (i.e., the user_id session variable is set)
if (isset($_SESSION["user_id"])) {
    // Unset and destroy the session variables
    session_unset();
    session_destroy();

    // Redirect to the login page or any other appropriate page after logout
    header("Location: login.php");
    exit();
} else {
    // If the user is not logged in, you can handle this situation as needed
    // For example, redirect to the login page or display a message
    header("Location: login.php");
    exit();
}
?>