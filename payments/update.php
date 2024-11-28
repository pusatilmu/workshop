<?php
include('../config/database.php');

// Fetch existing payment data to pre-fill the form
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM payments WHERE id = $id";
  $result = $conn->query($sql);
  $payment = $result->fetch_assoc();
}

// Handle form submission to update payment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $repair_id = $_POST['repair_id'];
  $payment_date = $_POST['payment_date'];
  $amount = $_POST['amount'];
  $payment_method = $_POST['payment_method'];
  $status = $_POST['status'];

  $sql = "UPDATE payments SET repair_id = '$repair_id', payment_date = '$payment_date', amount = '$amount', 
          payment_method = '$payment_method', status = '$status' WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect back to payments list after successful update
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
  <title>Update Payment</title>
</head>

<body>
  <h1>Update Payment</h1>

  <form action="update.php?id=<?php echo $payment['id']; ?>" method="POST">
    <input type="number" name="repair_id" value="<?php echo $payment['repair_id']; ?>" placeholder="Repair ID" required>
    <input type="datetime-local" name="payment_date" value="<?php echo $payment['payment_date']; ?>" required>
    <input type="number" name="amount" value="<?php echo $payment['amount']; ?>" placeholder="Amount" step="0.01" required>
    <select name="payment_method">
      <option value="Cash" <?php if ($payment['payment_method'] == 'Cash') echo 'selected'; ?>>Cash</option>
      <option value="Credit" <?php if ($payment['payment_method'] == 'Credit') echo 'selected'; ?>>Credit</option>
      <option value="Bank Transfer" <?php if ($payment['payment_method'] == 'Bank Transfer') echo 'selected'; ?>>Bank Transfer</option>
    </select>
    <select name="status">
      <option value="Paid" <?php if ($payment['status'] == 'Paid') echo 'selected'; ?>>Paid</option>
      <option value="Pending" <?php if ($payment['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
    </select>
    <button type="submit">Update Payment</button>
  </form>

  <br>
  <a href="index.php">Back to Payment List</a>
</body>

</html>

<?php
$conn->close();
?>