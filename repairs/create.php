<?php
include('../config/database.php');

// Handle form submission to create a new repair record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form data
  $vehicle_id = $_POST['vehicle_id'];
  $repair_type = $_POST['repair_type'];
  $description = $_POST['description'];
  $status = $_POST['status'];
  $start_date = $_POST['start_date']; // New field for start_date

  // Ensure the vehicle_id exists in the vehicles table before inserting
  $check_vehicle_sql = "SELECT id FROM vehicles WHERE id = '$vehicle_id'";
  $vehicle_result = $conn->query($check_vehicle_sql);

  if ($vehicle_result->num_rows > 0) {
    // Simple SQL query to insert the data
    $sql = "INSERT INTO repairs (vehicle_id, repair_type, description, status, start_date, created_at, updated_at) 
                VALUES ('$vehicle_id', '$repair_type', '$description', '$status', '$start_date', NOW(), NOW())";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
      header("Location: index.php"); // Redirect to the list after successful insertion
      exit;
    } else {
      echo "Error: " . $conn->error; // Display error if query fails
    }
  } else {
    echo "Error: Vehicle ID not found.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add New Repair</title>
</head>

<body>
  <h1>Add New Repair</h1>

  <form action="create.php" method="POST">
    <div>
      <label for="vehicle_id">Vehicle</label>
      <select name="vehicle_id" id="vehicle_id" required>
        <option value="">Select Vehicle</option>
        <?php
        // Fetch all vehicles from the vehicles table
        $vehicle_sql = "SELECT id,model FROM vehicles"; // Assuming the 'vehicles' table has 'id' and 'name' columns
        $vehicle_result = $conn->query($vehicle_sql);

        // Loop through the vehicles and add them as options
        if ($vehicle_result->num_rows > 0) {
          while ($vehicle = $vehicle_result->fetch_assoc()) {
            echo "<option value='" . $vehicle['id'] . "'>" . $vehicle['model'] . "</option>";
          }
        } else {
          echo "<option value=''>No vehicles found</option>";
        }
        ?>
      </select>
    </div>

    <div>
      <label for="repair_type">Repair Type</label>
      <input type="text" name="repair_type" id="repair_type" placeholder="Repair Type" required>
    </div>

    <div>
      <label for="description">Description</label>
      <textarea name="description" id="description" placeholder="Description" required></textarea>
    </div>

    <div>
      <label for="status">Status</label>
      <select name="status" id="status" required>
        <option value="Pending">Pending</option>
        <option value="In Progress">In Progress</option>
        <option value="Completed">Completed</option>
      </select>
    </div>

    <div>
      <label for="start_date">Start Date</label>
      <input type="date" name="start_date" id="start_date" required>
    </div>

    <button type="submit">Add Repair</button>
  </form>

  <br>
  <a href="index.php">Back to Repair List</a>
</body>

</html>

<?php
$conn->close();
?>