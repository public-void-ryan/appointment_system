<?php
// Include the database connection file (db.php)
require_once("db.php");

// Check if the appointment_id parameter is provided
if (isset($_GET["appointment_id"])) {
    // Retrieve the appointment_id from the URL
    $appointment_id = $_GET["appointment_id"];

    // Prepare and execute a query to delete the appointment
    $sql = "DELETE FROM appointments WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);

    if ($stmt->execute()) {
        // Deletion successful
        header("Location: my-appointments.php"); // Redirect back to the My Appointments page
        exit();
    } else {
        // Error handling
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    // If appointment_id parameter is not provided, handle the error or redirect as needed
    echo "Invalid request.";
}

// Close the database connection when done
$conn->close();
?>