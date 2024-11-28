<?php
include('../config/database.php');

// Check if the customer ID is passed in the URL
if (isset($_GET['id'])) {
  $customer_id = $_GET['id'];

  // Retrieve customer data from the database
  $sql = "SELECT * FROM customers WHERE id = '$customer_id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Fetch the customer data
    $customer = $result->fetch_assoc();
  } else {
    echo "Customer not found!";
    exit;
  }
}

// Handle form submission to update customer
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  // Update the customer details in the database
  $sql = "UPDATE customers SET 
                first_name = '$first_name', 
                last_name = '$last_name', 
                email = '$email', 
                phone = '$phone', 
                address = '$address', 
                updated_at = NOW() 
            WHERE id = '$customer_id'";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect back to index.php after successful update
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
  <title>Update Customer</title>
</head>

<body>
  <h1>Update Customer</h1>

  <form action="update.php?id=<?php echo $customer_id; ?>" method="POST">
    <div>
      <label for="first_name">First Name</label>
      <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($customer['first_name']); ?>" required>
    </div>

    <div>
      <label for="last_name">Last Name</label>
      <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($customer['last_name']); ?>" required>
    </div>

    <div>
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required>
    </div>

    <div>
      <label for="phone">Phone</label>
      <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($customer['phone']); ?>" required>
    </div>

    <div>
      <label for="address">Address</label>
      <textarea id="address" name="address" required><?php echo htmlspecialchars($customer['address']); ?></textarea>
    </div>

    <button type="submit">Update Customer</button>
  </form>

  <br>
  <a href="index.php">Back to Customer List</a>
</body>

</html>

<?php
$conn->close();
?>