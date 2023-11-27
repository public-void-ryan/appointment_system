<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Services - Online Appointment System</title>
  <link href="styles.css" rel="stylesheet" />
</head>

<body>
  <header>
    <div class="container">
      <div id="branding">
        <h1>Online Appointment System</h1>
      </div>
      <nav>
        <ul>
          <li class="current"><a href="index.php">Home</a></li>
          <li><a href="services.php">Services</a></li>
          <?php
          // Check if the user is logged in
          session_start();
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

  <div class="container">
    <section id="main">
      <h1>Our Dental Services</h1>
      <?php
      // Fetch services from the database
      include('db.php'); // Include your database connection code here
      
      $sql = "SELECT `service_id`, `service_name` FROM `services`";
      $result = $conn->query($sql);

      // Check if there are any services
      if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Service ID</th><th>Service Name</th></tr>';

        // Loop through the fetched services to display in a table
        while ($row = $result->fetch_assoc()) {
          $serviceName = $row["service_name"];
          echo '</td><td>' . $serviceName . '</td></tr>';
        }

        echo '</table>';
      } else {
        echo 'No services available.';
      }

      // Close the database connection
      $conn->close();
      ?>
    </section>
  </div>

  <script src="fullcalendar-6.1.9/dist/index.global.min.js"></script>
  <link href="styles.css" rel="stylesheet" />
</body>

</html>