<?php
include('../config/database.php');

// Handle form submission to create a repair assignment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $repair_id = $_POST['repair_id'];
  $employee_id = $_POST['employee_id'];

  $sql = "INSERT INTO repair_assignments (repair_id, employee_id) 
          VALUES ('$repair_id', '$employee_id')";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to index page after successful insertion
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
  <title>Assign Repair to Employee</title>
</head>

<body>
  <h1>Assign Repair to Employee</h1>

  <form action="create.php" method="POST">
    <input type="number" name="repair_id" placeholder="Repair ID" required>
    <input type="number" name="employee_id" placeholder="Employee ID" required>
    <button type="submit">Assign Repair</button>
  </form>

  <br>
  <a href="index.php">Back to Repair Assignments List</a>
</body>

</html>

<?php
$conn->close();
?>