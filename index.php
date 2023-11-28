<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BrightSmile Family Dentistry</title>
  <link href="styles.css" rel="stylesheet" />
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
          // Check if user is logged in
          session_start();
          if (isset($_SESSION["user_id"])) {
            // logged in, display "My Appointments" and "Logout"
            echo '<li><a href="my-appointments.php">My Appointments</a></li>';
            echo '<li><a href="logout.php">Logout</a></li>';
          } else {
            // Unot logged in, display "Login" and "Register"
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
      <h1>Welcome to BrightSmile Family Dentistry</h1>
    </section>
  </div>

  <div id="calendar"></div>

  <script src="fullcalendar-6.1.9/dist/index.global.min.js"></script>
  <link href="styles.css" rel="stylesheet" />

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        editable: true,
        selectable: true,
        businessHours: true,
        dayMaxEvents: true,
        events: [
          // Add more events as needed
        ],
      });

      calendar.render();
    });
  </script>
</body>

</html>