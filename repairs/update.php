<?php
include('../config/database.php');

// Fetch the repair record to edit
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM repairs WHERE id = $id";
  $result = $conn->query($sql);
  $repair = $result->fetch_assoc();
}

// Handle form submission to update the repair record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $vehicle_id = $_POST['vehicle_id'];
  $repair_type = $_POST['repair_type'];
  $description = $_POST['description'];
  $status = $_POST['status'];

  $sql = "UPDATE repairs SET vehicle_id = '$vehicle_id', repair_type = '$repair_type', 
          description = '$description', status = '$status', updated_at = NOW() WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after successful update
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
  <title>Edit Repair</title>
</head>

<body>
  <h1>Edit Repair</h1>

  <form action="update.php?id=<?php echo $repair['id']; ?>" method="POST">
    <input type="number" name="vehicle_id" value="<?php echo $repair['vehicle_id']; ?>" placeholder="Vehicle ID" required>
    <input type="text" name="repair_type" value="<?php echo $repair['repair_type']; ?>" placeholder="Repair Type" required>
    <textarea name="description" placeholder="Description" required><?php echo $repair['description']; ?></textarea>
    <select name="status">
      <option value="Pending" <?php echo ($repair['status'] == 'Pending' ? 'selected' : ''); ?>>Pending</option>
      <option value="In Progress" <?php echo ($repair['status'] == 'In Progress' ? 'selected' : ''); ?>>In Progress</option>
      <option value="Completed" <?php echo ($repair['status'] == 'Completed' ? 'selected' : ''); ?>>Completed</option>
    </select>
    <button type="submit">Update Repair</button>
  </form>

  <br>
  <a href="index.php">Back to Repair List</a>
</body>

</html>

<?php
$conn->close();
?>