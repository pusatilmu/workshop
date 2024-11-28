<?php
include('../config/database.php');

// Check if employee ID is provided in the URL
if (isset($_GET['id'])) {
  $employee_id = $_GET['id'];

  // Retrieve employee data based on the ID to display it for updating
  $sql = "SELECT * FROM employees WHERE id = '$employee_id'";
  $result = $conn->query($sql);

  // Check if the employee was found
  if ($result->num_rows > 0) {
    $employee = $result->fetch_assoc();
  } else {
    echo "Employee not found.";
    exit;
  }

  // Process the form submission for updating the employee data
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // SQL query to update the employee's data
    $sql = "UPDATE employees SET 
                first_name = '$first_name', 
                last_name = '$last_name', 
                role = '$role', 
                phone = '$phone', 
                email = '$email', 
                updated_at = NOW() 
                WHERE id = '$employee_id'";

    // Execute the update query
    if ($conn->query($sql) === TRUE) {
      header("Location: index.php"); // Redirect to the employee list page after successful update
      exit;
    } else {
      echo "Error: " . $conn->error;
    }
  }
} else {
  echo "No employee ID specified.";
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Update Employee</title>
</head>

<body>
  <h1>Update Employee</h1>

  <form action="update.php?id=<?php echo $employee_id; ?>" method="POST">
    <div>
      <label for="first_name">First Name</label>
      <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($employee['first_name']); ?>" required>
    </div>

    <div>
      <label for="last_name">Last Name</label>
      <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($employee['last_name']); ?>" required>
    </div>

    <div>
      <label for="role">Role</label>
      <input type="text" name="role" id="role" value="<?php echo htmlspecialchars($employee['role']); ?>" required>
    </div>

    <div>
      <label for="phone">Phone</label>
      <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($employee['phone']); ?>" required>
    </div>

    <div>
      <label for="email">Email</label>
      <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($employee['email']); ?>" required>
    </div>

    <button type="submit">Update Employee</button>
  </form>

  <br>
  <a href="index.php">Back to Employee List</a>
</body>

</html>

<?php
$conn->close();
?>