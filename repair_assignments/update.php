<?php
include('../config/database.php');

// Fetch existing repair assignment data to pre-fill the form
if (isset($_GET['id']) && isset($_GET['employee_id'])) {
  $repair_id = $_GET['id'];
  $employee_id = $_GET['employee_id'];

  // Fetch current assignment details based on the provided repair_id and employee_id
  $sql = "SELECT * FROM repair_assignments WHERE repair_id = $repair_id AND employee_id = $employee_id";
  $result = $conn->query($sql);

  // Check if assignment exists
  if ($result->num_rows > 0) {
    $assignment = $result->fetch_assoc();
  } else {
    echo "Assignment not found!";
    exit;
  }
}

// Handle form submission to update repair assignment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $repair_id = $_POST['repair_id'];
  $employee_id = $_POST['employee_id'];

  // Update the assignment in the database
  $sql = "UPDATE repair_assignments 
          SET repair_id = '$repair_id', employee_id = '$employee_id' 
          WHERE repair_id = '$repair_id' AND employee_id = '$employee_id'";

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
  <title>Update Repair Assignment</title>
</head>

<body>
  <h1>Update Repair Assignment</h1>

  <!-- Form to update the repair assignment -->
  <form action="update.php?id=<?php echo $assignment['repair_id']; ?>&employee_id=<?php echo $assignment['employee_id']; ?>" method="POST">
    <div>
      <label for="repair_id">Repair ID</label>
      <input type="number" name="repair_id" id="repair_id" value="<?php echo $assignment['repair_id']; ?>" placeholder="Repair ID" required>
    </div>

    <div>
      <label for="employee_id">Employee ID</label>
      <input type="number" name="employee_id" id="employee_id" value="<?php echo $assignment['employee_id']; ?>" placeholder="Employee ID" required>
    </div>

    <button type="submit">Update Assignment</button>
  </form>

  <br>
  <a href="index.php">Back to Repair Assignments List</a>
</body>

</html>

<?php
$conn->close();
?>