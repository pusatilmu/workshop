<?php
include('../config/database.php');

// Handle form submission to add customer
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  $sql = "INSERT INTO customers (first_name, last_name, email, phone, address, created_at, updated_at) 
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$address', NOW(), NOW())";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect back to index.php after successful insert
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
  <title>Add New Customer</title>
</head>

<body>
  <h1>Add New Customer</h1>

  <form action="create.php" method="POST">
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Phone" required>
    <textarea name="address" placeholder="Address" required></textarea>
    <button type="submit">Add Customer</button>
  </form>

  <br>
  <a href="index.php">Back to Customer List</a>
</body>

</html>

<?php
$conn->close();
?>