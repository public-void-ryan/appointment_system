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
                    <li><a href="index.html">Home</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li class="current"><a href="register.php">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>Register</h1>
        <form action="register_process.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" required><br>
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