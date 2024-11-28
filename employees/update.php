<?php
include('../config/database.php');

// Fetch existing employee data to pre-fill the form
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM employees WHERE id = $id";
  $result = $conn->query($sql);
  $employee = $result->fetch_assoc();
}

// Handle form submission to update employee
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $role = $_POST['role'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];

  $sql = "UPDATE employees SET first_name = '$first_name', last_name = '$last_name', role = '$role',
          phone = '$phone', email = '$email', updated_at = NOW() WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to employee list after successful update
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

  <form action="update.php?id=<?php echo $employee['id']; ?>" method="POST">
    <input type="text" name="first_name" value="<?php echo $employee['first_name']; ?>" required>
    <input type="text" name="last_name" value="<?php echo $employee['last_name']; ?>" required>
    <input type="text" name="role" value="<?php echo $employee['role']; ?>" required>
    <input type="text" name="phone" value="<?php echo $employee['phone']; ?>" required>
    <input type="email" name="email" value="<?php echo $employee['email']; ?>" required>
    <button type="submit">Update Employee</button>
  </form>

  <br>
  <a href="index.php">Back to Employee List</a>
</body>

</html>

<?php
$conn->close();
?>