<?php
include('../config/database.php');

// Check if the employee ID is passed in the URL
if (isset($_GET['id'])) {
  $employee_id = $_GET['id'];

  // Retrieve employee data from the database
  $sql = "SELECT * FROM employees WHERE id = '$employee_id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Fetch the employee data
    $employee = $result->fetch_assoc();
  } else {
    echo "Employee not found!";
    exit;
  }
}

// Handle form submission to update employee
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $role = $_POST['role'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];

  // Update the employee data in the database
  $sql = "UPDATE employees SET 
                first_name = '$first_name', 
                last_name = '$last_name', 
                role = '$role', 
                phone = '$phone', 
                email = '$email', 
                updated_at = NOW() 
            WHERE id = '$employee_id'";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect back to employee list after successful update
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
      <input type="text" name="role" id