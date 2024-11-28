<?php
include('../config/database.php');

// Check if the ID is provided in the URL query string
if (isset($_GET['id'])) {
  $repair_id = $_GET['id'];

  // Fetch the repair record based on the ID
  $sql = "SELECT * FROM repairs WHERE id = '$repair_id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Fetch the record data
    $repair = $result->fetch_assoc();
  } else {
    echo "Repair record not found.";
    exit;
  }
} else {
  echo "Repair ID not provided.";
  exit;
}

// Handle form submission to update the repair record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form data
  $vehicle_id = $_POST['vehicle_id'];
  $repair_type = $_POST['repair_type'];
  $description = $_POST['description'];
  $status = $_POST['status'];
  $start_date = $_POST['start_date'];

  // Update the repair record in the database
  $update_sql = "UPDATE repairs 
                   SET vehicle_id = '$vehicle_id', repair_type = '$repair_type', description = '$description', 
                       status = '$status', start_date = '$start_date', updated_at = NOW() 
                   WHERE id = '$repair_id'";

  // Execute the update query
  if ($conn->query($update_sql) === TRUE) {
    header("Location: index.php"); // Redirect to the repair list after successful update
    exit;
  } else {
    echo "Error: " . $conn->error; // Display error if update fails
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Update Repair</title>
</head>

<body>
  <h1>Update Repair</h1>

  <form action="update.php?id=<?php echo $repair_id; ?>" method="POST">
    <div>
      <label for="vehicle_id">Vehicle ID</label>
      <select name="vehicle_id" id="vehicle_id" required>
        <option value="">Select Vehicle</option>
        <?php
        // Fetch all vehicles from the vehicles table
        $vehicle_sql = "SELECT id, name FROM vehicles"; // Assuming the 'vehicles' table has 'id' and 'name' columns
        $vehicle_result = $conn->query($vehicle_sql);

        // Loop through the vehicles and add them as options
        if ($vehicle_result->num_rows > 0) {
          while ($vehicle = $vehicle_result->fetch_assoc()) {
            // If the vehicle_id matches the existing record, set it as selected
            $selected = ($vehicle['id'] == $repair['vehicle_id']) ? 'selected' : '';
            echo "<option value='" . $vehicle['id'] . "' $selected>" . $vehicle['name'] . "</option>";
          }
        } else {
          echo "<option value=''>No vehicles found</option>";
        }
        ?>
      </select>
    </div>

    <div>
      <label for="repair_type">Repair Type</label>
      <input type="text" name="repair_type" id="repair_type" value="<?php echo $repair['repair_type']; ?>" placeholder="Repair Type" required>
    </div>

    <div>
      <label for="description">Description</label>
      <textarea name="description" id="description" placeholder="Description" required><?php echo $repair['description']; ?></textarea>
    </div>

    <div>
      <label for="status">Status</label>
      <select name="status" id="status" required>
        <option value="Pending" <?php echo ($repair['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
        <option value="In Progress" <?php echo ($repair['status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
        <option value="Completed" <?php echo ($repair['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
      </select>
    </div>

    <div>
      <label for="start_date">Start Date</label>
      <input type="date" name="start_date" id="start_date" value="<?php echo $repair['start_date']; ?>" required>
    </div>

    <button type="submit">Update Repair</button>
  </form>

  <br>
  <a href="index.php">Back to Repair List</a>
</body>

</html>

<?php
$conn->close();
?>