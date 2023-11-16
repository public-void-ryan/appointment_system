<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Appointment System Page</title>
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
        <h1>Register</h1>
        <?php
        // Check if an error parameter is present in the URL
        if (isset($_GET["error"])) {
            $errorCode = $_GET["error"];
            if ($errorCode == 1) {
                echo '<p class="error-message">Registration failed. Please check your input and try again.</p>';
            } elseif ($errorCode == 2) {
                echo '<p class="error-message">Password must meet the following requirements:</p>';
                echo '<ul>';
                echo '<li>At least 8 characters long</li>';
                echo '<li>At least one uppercase letter (A-Z)</li>';
                echo '<li>At least one lowercase letter (a-z)</li>';
                echo '<li>At least one digit (0-9)</li>';
                echo '<li>At least one special character (@, $, !, %, *, ?, &amp;, etc.)</li>';
                echo '</ul>';
            } elseif ($errorCode == 3) {
                echo '<p class="error-message">Username is already taken. Please choose a different username.</p>';
            } elseif ($errorCode == 4) {
                echo '<p class="error-message">Email is already in use. Please choose a different email address.</p>';
            }
        }
        ?>
        <form action="register_process.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" required><br>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" required><br>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required><br>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>