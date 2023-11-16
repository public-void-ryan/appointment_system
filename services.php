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
      <h1>Our Appointment Services</h1>
      <ul class="services-list">
        <li>
          <h2>Medical Checkup</h2>
          <p>
            Schedule a routine medical checkup appointment with our healthcare
            professionals.
          </p>
        </li>
        <li>
          <h2>Dental Cleaning</h2>
          <p>
            Book an appointment for a dental cleaning and oral health checkup.
          </p>
        </li>
        <li>
          <h2>Legal Consultation</h2>
          <p>
            Consult with our legal experts to discuss your legal matters and
            get advice.
          </p>
        </li>
        <li>
          <h2>Haircut and Styling</h2>
          <p>
            Get a haircut and styling appointment with our experienced
            hairdressers.
          </p>
        </li>
        <li>
          <h2>Massage Therapy</h2>
          <p>Relax and unwind with a therapeutic massage appointment.</p>
        </li>
        <li>
          <h2>Financial Advisory</h2>
          <p>
            Schedule a financial advisory session to manage your finances
            effectively.
          </p>
        </li>
        <li>
          <h2>Fitness Training</h2>
          <p>
            Book a fitness training session with our certified trainers to
            achieve your fitness goals.
          </p>
        </li>
        <li>
          <h2>Therapist Session</h2>
          <p>
            Seek professional therapy and mental health support with our
            therapists.
          </p>
        </li>
        <li>
          <h2>IT Support</h2>
          <p>
            Get technical assistance and IT support by scheduling an
            appointment with our experts.
          </p>
        </li>
        <li>
          <h2>Home Repair Service</h2>
          <p>
            Arrange an appointment for home repair and maintenance services.
          </p>
        </li>
      </ul>
    </section>
  </div>

  <script src="fullcalendar-6.1.9/dist/index.global.min.js"></script>
  <link href="styles.css" rel="stylesheet" />
</body>

</html>