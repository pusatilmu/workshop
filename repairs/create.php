<?php
include('../config/database.php');

// Handle form submission to create a new repair record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $vehicle_id = $_POST['vehicle_id'];
  $repair_type = $_POST['repair_type'];
  $description = $_POST['description'];
  $status = $_POST['status'];

  $sql = "INSERT INTO repairs (vehicle_id, repair_type, description, status, start_date, created_at, updated_at) 
          VALUES ('$vehicle_id', '$repair_type', '$description', '$status', NOW(), NOW(), NOW())";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after successful insertion
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
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
    <input type="number" name="vehicle_id" placeholder="Vehicle ID" required>
    <input type="text" name="repair_type" placeholder="Repair Type" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <select name="status">
      <option value="Pending">Pending</option>
      <option value="In Progress">In Progress</option>
      <option value="Completed">Completed</option>
    </select>
    <button type="submit">Add Repair</button>
  </form>

  <br>
  <a href="index.php">Back to Repair List</a>
</body>

</html>

<?php
$conn->close();
?>