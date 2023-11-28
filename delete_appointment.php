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
        // Check if the user's email is confirmed
        $sql = "SELECT user_id FROM appointments WHERE appointment_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $appointment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointment = $result->fetch_assoc();
        $user_id = $appointment['user_id'];

        $sql = "SELECT email_confirmed, email, name FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user['email_confirmed']) {
            // Send email notification
            $mail = new PHPMailer();
            $mail->setFrom('your-email@example.com', 'BrightSmile Family Dentistry');
            $mail->addAddress($user['email'], $user['name']);
            $mail->Subject = 'Appointment Deleted';
            $mail->Body = 'Your appointment has been successfully deleted.';
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                header("Location: my-appointments.php"); // Redirect back to the My Appointments page
                exit();
            }
        }
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