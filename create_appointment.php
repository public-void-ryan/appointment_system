<?php
// Start the session.
session_start();
require 'vendor/autoload.php';

// Include your database connection code here.
include('db.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Check if the user is logged in (i.e., the user_id session variable is set)
if (!isset($_SESSION["user_id"])) {
    // If the user is not logged in, you can handle this situation as needed
    // For example, redirect to the login page or display a message
    header("Location: login.php");
    exit();
}

// Retrieve the user ID from the session
$user_id = $_SESSION["user_id"];

// Retrieve user email and name from the database
$sql = "SELECT email, name FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = $_POST["service_id"];
    $appointment_time = $_POST["appointment_time"];
    $status = "scheduled"; // default status "scheduled"
    $notes = $_POST["notes"];

    // Insert the data into the "appointments" table
    $insertSql = "INSERT INTO `appointments` (`user_id`, `service_id`, `appointment_time`, `status`, `notes`)
                  VALUES (?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    if (!$insertStmt) {
        die("Error: " . $conn->error); // Output the specific error message
    }
    $insertStmt->bind_param("iisss", $user_id, $service_id, $appointment_time, $status, $notes);

    if ($insertStmt->execute()) {
        // Appointment created successfully.
        echo 'Your appointment has been successfully created. Thank you!';

        // Send email notification
        $mail = new PHPMailer(true);
        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.google.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'BrightSmilesDentistry23';
            $mail->Password = 'wnho uimv uknm xtvj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Sender and recipient
            $mail->setFrom('BrightSmilesDentistry23@gmail.com', 'BrightSmile Family Dentistry');
            $mail->addAddress($user['email'], $user['name']); // Use email and name retrieved from the database

            // Email content
            $mail->Subject = 'Appointment Created';
            $mail->Body = 'Your appointment has been successfully created. Thank you for choosing BrightSmile Family Dentistry.';

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

        header("Location: appointment_created.php"); // Redirect to a confirmation page
        exit();
    } else {
        // Error handling
        echo "Error: " . $insertStmt->error;
    }

    $insertStmt->close();
}

// Close the database connection when done
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Created</title>
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>BrightSmile Family Dentistry</h1>
            </div>
            <nav>
                <ul>
                    <li class="current"><a href="index.php">Home</a></li>
                    <li><a href="services.php">Services</a></li>
                    <?php
                    if (isset($_SESSION["user_id"])) {
                        // User is logged in, display "My Appointments" and "Logout"
                        echo '<li><a href="my-appointments.php">My Appointments</a></li>';
                        echo '<li><a href="logout.php">Logout</a></li>';
                    } else {
                        // User is not logged in, display "Login" and "Register"
                        echo '<li><a href="login.php">Login</a></li>';
                        echo '<li><a href="register.php">Register</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>
    </head>

    <body>
        <div class="container">
            <h1>Create an Appointment</h1>
            <form method="post" action="">
                <!-- Add the user_id as a hidden input field -->
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                <div class="form-group">
                    <label for="service">Service:</label>
                    <select name="service_id" id="service_id">
                        <option value="1">Dental Cleaning</option>
                        <option value="2">Dental Examination</option>
                        <option value="3">Tooth Whitening</option>
                        <option value="4">Cavity Filling</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="appointment_time">Appointment Time:</label>
                    <input type="datetime-local" id="appointment_time" name="appointment_time" required />
                </div>
                <div class="form-group">
                    <label for="notes">Notes:</label>
                    <textarea id="notes" name="notes" rows="4" required></textarea>
                </div>
                <!-- Style the button using the "create-appointment-button" class -->
                <button type="submit" class="create-appointment-button">Create Appointment</button>
            </form>
        </div>
    </body>

</html>