<?php
// Start the session
session_start();

// Check if the user is logged in (i.e., the user_id session variable is set)
if (!isset($_SESSION["user_id"])) {
    // If the user is not logged in, you can handle this situation as needed
    // For example, redirect to the login page or display a message
    header("Location: login.php");
    exit();
}

// Include the database connection file (db.php)
require_once("db.php");

// Retrieve the user ID from the session
$user_id = $_SESSION["user_id"];

// Prepare and execute a query to fetch user appointments
$sql = "SELECT * FROM appointments WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>

    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* Center the delete button in the last column */
        td:last-child {
            text-align: center;
        }

        /* Style the delete button */
        .delete-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Online Appointment System</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="my-appointments.php">My Appointments</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>My Appointments</h1>
        <div style="margin-top: 20px;">
            <a href="create_appointment.php" class="create-appointment-button" style="text-decoration: none;">Create
                Appointment</a>
        </div>

        <?php
        // Check if there are appointments for the user
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr>';
            echo '<th>Appointment Time</th>';
            echo '<th>Service</th>';
            echo '<th>Status</th>';
            echo '<th>Notes</th>';
            echo '<th class="centered-column">Action</th>'; // New column for delete button, add centered-column class
            echo '</tr>';
            while ($row = $result->fetch_assoc()) {
                // Display appointment details in rows
                echo '<tr>';
                echo '<td>' . $row['appointment_time'] . '</td>';
                echo '<td>' . $row['service_name'] . '</td>';
                echo '<td>' . $row['status'] . '</td>';
                echo '<td>' . $row['notes'] . '</td>';
                echo '<td class="centered-column"><button class="delete-button" onclick="deleteAppointment(' . $row['appointment_id'] . ')">Delete</button></td>'; // Delete button with appointment_id
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>You have no appointments.</p>';
        }
        ?>




        <!-- JavaScript to handle appointment deletion -->
        <script>
            function deleteAppointment(appointmentId) {
                if (confirm("Are you sure you want to delete this appointment?")) {
                    // Send a request to delete the appointment using JavaScript fetch or AJAX
                    // You'll need to create a separate PHP script to handle the deletion
                    // Here's a sample fetch request:
                    fetch('delete_appointment.php?appointment_id=' + appointmentId, {
                        method: 'DELETE'
                    })
                        .then(response => {
                            if (response.ok) {
                                // Reload the page after successful deletion
                                location.reload();
                            } else {
                                console.error('Failed to delete appointment');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            }
        </script>

        <a href="index.php" class="create-appointment-button" style="text-decoration: none;">Back to Home</a>
    </div>
</body>

</html>