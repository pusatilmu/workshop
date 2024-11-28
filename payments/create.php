<?php
include('../config/database.php');

// Handle form submission to add a payment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $repair_id = $_POST['repair_id'];
  $payment_date = $_POST['payment_date'];
  $amount = $_POST['amount'];
  $payment_method = $_POST['payment_method'];
  $status = $_POST['status'];

  $sql = "INSERT INTO payments (repair_id, payment_date, amount, payment_method, status) 
          VALUES ('$repair_id', '$payment_date', '$amount', '$payment_method', '$status')";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect back to payments list after successful insert
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
  <title>Add New Payment</title>
</head>

<body>
  <h1>Add New Payment</h1>

  <form action="create.php" method="POST">
    <input type="number" name="repair_id" placeholder="Repair ID" required>
    <input type="datetime-local" name="payment_date" required>
    <input type="number" name="amount" placeholder="Amount" step="0.01" required>
    <select name="payment_method">
      <option value="Cash">Cash</option>
      <option value="Credit">Credit</option>
      <option value="Bank Transfer">Bank Transfer</option>
    </select>
    <select name="status">
      <option value="Paid">Paid</option>
      <option value="Pending">Pending</option>
    </select>
    <button type="submit">Add Payment</button>
  </form>

  <br>
  <a href="index.php">Back to Payment List</a>
</body>

</html>

<?php
$conn->close();
?>