<?php
include('../config/database.php');

// Mengambil ID yang akan diperbarui dari URL
if (isset($_GET['repair_id'])) {
  $repair_id = $_GET['repair_id'];
} else {
  header("Location: index.php"); // Redirect jika ID tidak ditemukan
  exit;
}

// Ambil data repair assignment yang akan diperbarui
$sql = "SELECT * FROM repair_assignments WHERE repair_id = '$repair_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  // Menyimpan data yang ada di database untuk ditampilkan di form
  $current_repair_id = $row['repair_id'];
  $current_employee_id = $row['employee_id'];  // Menambahkan ini untuk mengambil employee_id yang terkait
} else {
  echo "Repair Assignment not found.";
  exit;
}

// Handle form submission to update the repair assignment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $repair_id = $_POST['repair_id'];
  $employee_id = $_POST['employee_id']; // Menambahkan ini untuk mengambil employee_id dari form

  // Update repair assignment in the database
  $update_sql = "UPDATE repair_assignments SET repair_id = '$repair_id', employee_id = '$employee_id' WHERE repair_id = '$current_repair_id'";

  if ($conn->query($update_sql) === TRUE) {
    header("Location: index.php"); // Redirect to index page after successful update
    exit;
  } else {
    echo "Error: " . $conn->error; // Display error if query fails
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

  <!-- Form to update a repair assignment -->
  <form action="update.php?repair_id=<?php echo $repair_id; ?>" method="POST">

    <div>
      <label for="repair_id">Repair</label>
      <select name="repair_id" id="repair_id" required>
        <option value="">Select Repair</option>
        <?php
        // Fetch available repairs to display in the dropdown
        $sql = "SELECT id, repair_type FROM repairs"; // Assuming you have a repairs table
        $result = $conn->query($sql);
        var_dump($result);

        // Populate the dropdown with repairs from the database
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // Display each repair, and set the selected option based on the current_repair_id
            $selected = ($row['id'] == $current_repair_id) ? 'selected' : '';
            echo "<option value='" . $row['id'] . "' $selected>" . $row['repair_type'] . "</option>";
          }
        } else {
          echo "<option value=''>No repairs available</option>";
        }
        ?>
      </select>
    </div>

    <div>
      <label for="employee_id">Employee</label>
      <select name="employee_id" id="employee_id" required>
        <option value="">Select Employee</option>
        <?php
        // Fetch available employees to display in the dropdown
        $sql = "SELECT id, first_name, last_name FROM employees"; // Assuming you have an employees table
        $result = $conn->query($sql);

        // Populate the dropdown with employees from the database
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // Display each employee, and set the selected option based on the current_employee_id
            $selected = ($row['id'] == $current_employee_id) ? 'selected' : '';
            echo "<option value='" . $row['id'] . "' $selected>" . $row['first_name'] . " " . $row['last_name'] . "</option>";
          }
        } else {
          echo "<option value=''>No employees available</option>";
        }
        ?>
      </select>
    </div>

    <button type="submit">Update Repair Assignment</button>
  </form>

  <br>
  <a href="index.php">Back to Repair Assignments List</a>
</body>

</html>

<?php
$conn->close();
?>