<?php
// Include your database connection code here
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"]; // Assuming you have a way to determine the user ID
    $service_id = $_POST["service_id"]; // Assuming you have a way to determine the service ID
    $appointment_time = $_POST["appointment_time"];
    $status = "scheduled"; // You can set the default status as "scheduled"
    $notes = $_POST["notes"];

    // Validate the data if needed

    // Insert the data into the "appointments" table
    $sql = "INSERT INTO `appointments` (`user_id`, `service_id`, `appointment_time`, `status`, `notes`)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $user_id, $service_id, $appointment_time, $status, $notes);

    if ($stmt->execute()) {
        // Appointment created successfully
        header("Location: appointment_created.php"); // Redirect to a confirmation page
        exit();
    } else {
        // Error handling
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection when done
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... Your HTML head content ... -->
</head>

<body>
    <div class="container">
        <section id="main">
            <h1>Create an Appointment</h1>
            <form method="post" action="">
                <div class="form-group">
                    <label for="user_id">User ID:</label>
                    <input type="text" id="user_id" name="user_id" required />
                </div>
                <div class="form-group">
                    <label for="service_id">Service ID:</label>
                    <input type="text" id="service_id" name="service_id" required />
                </div>
                <div class="form-group">
                    <label for="appointment_time">Appointment Time:</label>
                    <input type="datetime-local" id="appointment_time" name="appointment_time" required />
                </div>
                <div class="form-group">
                    <label for="notes">Notes:</label>
                    <textarea id="notes" name="notes" rows="4" required></textarea>
                </div>
                <button type="submit">Create Appointment</button>
            </form>
        </section>
    </div>
</body>

</html>