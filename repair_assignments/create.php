<?php
include('../config/database.php');

// Handle form submission to create a repair assignment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $repair_id = $_POST['repair_id'];
  $employee_id = $_POST['employee_id'];

  // Insert the repair assignment into the database
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

  <!-- Form to assign a repair to an employee -->
  <form action="create.php" method="POST">

    <div>
      <label for="repair_id">Repair ID</label>
      <select name="repair_id" id="repair_id" required>
        <option value="">Select Repair ID</option>
        <?php
        // Fetch available repairs to display in the dropdown
        $sql = "SELECT id, description FROM repairs"; // Assuming you have a repairs table
        $result = $conn->query($sql);

        // Populate the dropdown with repairs from the database
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['id'] . " - " . $row['description'] . "</option>";
          }
        } else {
          echo "<option value=''>No repairs available</option>";
        }
        ?>
      </select>
    </div>

    <div>
      <label for="employee_id">Employee ID</label>
      <select name="employee_id" id="employee_id" required>
        <option value="">Select Employee ID</option>
        <?php
        // Fetch available employees to display in the dropdown
        $sql = "SELECT id, first_name, last_name FROM employees"; // Assuming you have an employees table
        $result = $conn->query($sql);

        // Populate the dropdown with employees from the database
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['id'] . " - " . $row['first_name'] . " " . $row['last_name'] . "</option>";
          }
        } else {
          echo "<option value=''>No employees available</option>";
        }
        ?>
      </select>
    </div>

    <button type="submit">Assign Repair</button>
  </form>

  <br>
  <a href="index.php">Back to Repair Assignments List</a>
</body>

</html>

<?php
$conn->close();
?>