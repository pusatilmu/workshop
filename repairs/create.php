<?php
include('../config/database.php');

// Handle form submission to create a new repair record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form data
  $vehicle_id = $_POST['vehicle_id'];
  $repair_type = $_POST['repair_type'];
  $description = $_POST['description'];
  $status = $_POST['status'];

  // Simple SQL query to insert the data
  $sql = "INSERT INTO repairs (vehicle_id, repair_type, description, status, start_date, created_at, updated_at) 
          VALUES ('$vehicle_id', '$repair_type', '$description', '$status', NOW(), NOW(), NOW())";

  // Execute the query
  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after successful insertion
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error; // Display error if query fails
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
      <label for="vehicle_id">Vehicle ID</label>
      <input type="number" name="vehicle_id" id="vehicle_id" placeholder="Vehicle ID" required>
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

    <button type="submit">Add Repair</button>
  </form>

  <br>
  <a href="index.php">Back to Repair List</a>
</body>

</html>

<?php
$conn->close();
?>