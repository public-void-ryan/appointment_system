<?php
// Include the database connection file (db.php)
require_once("db.php");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform additional server-side validation here
    // For example, query the database to validate the username and password
    $sql = "SELECT username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // User found in the database, fetch the hashed password
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        // Verify the entered password against the hashed password
        if (password_verify($password, $hashedPassword)) {
            // Passwords match, user is authenticated, you can proceed with login
            header("Location: login_success.html");
            exit();
        }
    }

    // If validation fails, redirect back to the login page with an error message
    header("Location: login.php?error=1");
    exit();
} else {
    // If the form was not submitted, redirect to the login page
    header("Location: login.php");
    exit();
}

$stmt->close();
$conn->close();
