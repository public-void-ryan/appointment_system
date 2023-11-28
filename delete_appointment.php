<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
// Start the session.
session_start();

require __DIR__ . '/vendor/autoload.php'; // Load Composer's autoloader
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$smtpHost = $_ENV['SMTP_HOST'];
$smtpPort = $_ENV['SMTP_PORT'];
$smtpUser = $_ENV['SMTP_USER'];
$smtpPass = $_ENV['SMTP_PASS'];

// Include your database connection code here.
include('db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Check if the appointment_id parameter is provided
if (isset($_GET["appointment_id"])) {
    // Retrieve the appointment_id from the URL
    $appointment_id = $_GET["appointment_id"];

    // Prepare and execute a query to delete the appointment
    $sql = "DELETE FROM appointments WHERE appointment_id = ?";
    $delstmt = $conn->prepare($sql);
    $delstmt->bind_param("i", $appointment_id);

}

if ($delstmt->execute()) {
    // Appointment deleted successfully.
    echo 'Your appointment has been successfully deleted. Thank you!';
}


// Retrieve the user ID from the session
$user_id = $_SESSION["user_id"];

// Retrieve user email from the database
$sql = "SELECT email FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Database error: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Send email notification
$mail = new PHPMailer(true);
try {
    // SMTP settings for Gmail
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUser;
    $mail->Password = $smtpPass;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $smtpPort;

    // Sender and recipient
    $mail->setFrom('brightsmilesdentistry23@gmail.com', 'BrightSmile Family Dentistry');
    $mail->addAddress($user['email']); // Use email retrieved from the database

    // Email content
    $mail->Subject = 'Appointment Deleted';
    $mail->Body = 'Your appointment has been successfully deleted. Thank you for choosing BrightSmile Family Dentistry.';

    $mail->send();
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}



$delstmt->close();

// Close the database connection when done
$conn->close();
?>