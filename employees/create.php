<?php
include('../config/database.php');

// Handle form submission to add employee
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $role = $_POST['role'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];

  $sql = "INSERT INTO employees (first_name, last_name, role, phone, email, hire_date, created_at, updated_at) 
          VALUES ('$first_name', '$last_name', '$role', '$phone', '$email', NOW(), NOW(), NOW())";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect back to employee list after successful insert
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
  <title>Add New Employee</title>
</head>

<body>
  <h1>Add New Employee</h1>

  <form action="create.php" method="POST">
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="text" name="role" placeholder="Role" required>
    <input type="text" name="phone" placeholder="Phone" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Add Employee</button>
  </form>

  <br>
  <a href="index.php">Back to Employee List</a>
</body>

</html>

<?php
$conn->close();
?>