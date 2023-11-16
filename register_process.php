<?php
// Include the database connection file (db.php)
require_once("db.php");

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $username = $_POST["username"];
    $email = $_POST["email"]; // Add email field
    $password = $_POST["password"];

    // Perform additional server-side validation here
    // For example, check if the username or email is already taken

    // Check if the username already exists
    $sql_check = "SELECT username FROM users WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();

    if ($stmt_check->fetch()) {
        // Username already exists, handle this case
        header("Location: register.php?error=3"); // You can define a custom error code for duplicate username
        exit();
    }

    // Check if the email already exists
    $sql_check_email = "SELECT email FROM users WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();

    if ($stmt_check_email->fetch()) {
        // Email already exists, handle this case
        header("Location: register.php?error=4"); // You can define a custom error code for duplicate email
        exit();
    }

    // Check password complexity
    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        // Password does not meet complexity requirements
        header("Location: register.php?error=2"); // You can define a custom error code for password complexity failure
        exit();
    }

    // If validation passes, continue with registration
    // ...

    // Prepare and execute the INSERT query to create the new user
    $sql_insert = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    $stmt_insert->bind_param("sss", $username, $email, $hashedPassword);
    $stmt_insert->execute();

    // Check for query errors
    if ($stmt_insert->errno) {
        echo "Query Error: " . $stmt_insert->error;
        exit();
    }

    // Close the statement and the database connection
    $stmt_check->close();
    $stmt_check_email->close(); // Close email check statement
    $stmt_insert->close();
    $conn->close();

    // Redirect to a success page or perform other actions
    header("Location: registration_success.php");
    exit();
} else {
    // If the form was not submitted, redirect to the registration page
    header("Location: register.php");
    exit();
}
