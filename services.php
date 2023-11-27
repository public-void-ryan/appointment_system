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
      <ul class="services-list">
        <li>
          <h2>Dental Cleaning</h2>
          <p>Book an appointment for a dental cleaning and oral health checkup.</p>
        </li>
        <li>
          <h2>Dental Examination</h2>
          <p>Get a comprehensive dental examination to ensure healthy teeth and gums.</p>
        </li>
        <li>
          <h2>Tooth Whitening</h2>
          <p>Enhance your smile with our professional tooth whitening services.</p>
        </li>
        <li>
          <h2>Cavity Filling</h2>
          <p>Repair cavities and restore your tooth's integrity with our filling services.</p>
        </li>
      </ul>
    </section>
  </div>

  <script src="fullcalendar-6.1.9/dist/index.global.min.js"></script>
  <link href="styles.css" rel="stylesheet" />
</body>

</html>