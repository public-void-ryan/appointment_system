<div class="container">
  <section id="main">
    <h1 style="text-align: center;">Our Dental Services</h1>
    <?php
    // Fetch services from the database
    include('db.php'); // Include your database connection code here
    
    $sql = "SELECT `service_id`, `service_name` FROM `services`";
    $result = $conn->query($sql);

    // Check if there are any services
    if ($result->num_rows > 0) {
      echo '<div class="centered-column">'; // Apply the centered-column class to center-align the content
      echo '<table>';
      echo '<tr><th>Service</th></tr>';

      // Loop through the fetched services to display in a table
      while ($row = $result->fetch_assoc()) {
        $serviceName = $row["service_name"];
        echo '<tr><td>' . $serviceName . '</td></tr>';
      }

      echo '</table>';
      echo '</div>'; // End of centered content
    } else {
      echo 'No services available.';
    }

    // Close the database connection
    $conn->close();
    ?>
  </section>
</div>