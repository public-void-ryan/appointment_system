<?php
// Include the database connection file (db.php)
require_once("db.php");

// Start the session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform additional server-side validation here
    // For example, query the database to validate the username and password
    $sql = "SELECT user_id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // User found in the database, fetch the hashed password and user ID
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];
        $user_id = $row["user_id"];

        // Verify the entered password against the hashed password
        if (password_verify($password, $hashedPassword)) {
            // Passwords match, user is authenticated
            // Set the user ID in the session
            $_SESSION["user_id"] = $user_id;

            // Redirect to a success page or dashboard
            header("Location: login_success.php");
            exit();
        }
    }

    // If validation fails or user not found, redirect back to the login page with an error message
    header("Location: login.php?error=1");
    exit();
} else {
    // If the form was not submitted, redirect to the login page
    header("Location: login.php");
    exit();
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
?>