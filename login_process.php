<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Replace these with your actual username and password validation logic
    $validUsername = "your_username";
    $validPassword = "your_password";

    // Check if the entered username and password match the valid ones
    if ($username === $validUsername && $password === $validPassword) {
        // Redirect to a successful login page or perform other actions
        header("Location: success.html");
        exit();
    } else {
        // Redirect back to the login page with an error message
        header("Location: login.html?error=1");
        exit();
    }
} else {
    // If the form was not submitted, redirect to the login page
    header("Location: login.html");
    exit();
}
