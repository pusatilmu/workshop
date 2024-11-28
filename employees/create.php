<?php
include('../config/database.php');

// Handle form submission to add employee
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $role = $_POST['role'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];

  // Insert employee data into the database
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
    <div>
      <label for="first_name">First Name</label>
      <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
    </div>

    <div>
      <label for="last_name">Last Name</label>
      <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
    </div>

    <div>
      <label for="role">Role</label>
      <input type="text" name="role" id="role" placeholder="Role" required>
    </div>

    <div>
      <label for="phone">Phone</label>
      <input type="text" name="phone" id="phone" placeholder="Phone" required>
    </div>

    <div>
      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="Email" required>
    </div>

    <button type="submit">Add Employee</button>
  </form>

  <br>
  <a href="index.php">Back to Employee List</a>
</body>

</html>

<?php
$conn->close();
?>