<?php
include('../config/database.php');

// Fetch existing payment data to pre-fill the form
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM payments WHERE id = $id"; // Directly use $id in the query (make sure it's sanitized in a real app)
  $result = $conn->query($sql);
  $payment = $result->fetch_assoc();

  if (!$payment) {
    echo "Payment not found!";
    exit;
  }
}

// Handle form submission to update payment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $repair_id = $_POST['repair_id'];
  $payment_date = $_POST['payment_date'];
  $amount = $_POST['amount'];
  $payment_method = $_POST['payment_method'];
  $status = $_POST['status'];

  // Update the payment details in the database
  $sql = "UPDATE payments SET repair_id = '$repair_id', payment_date = '$payment_date', amount = '$amount', 
          payment_method = '$payment_method', status = '$status' WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the payments list after successful update
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
    <div>
      <label for="repair_id">Repair ID</label>
      <select name="repair_id" id="repair_id" required>
        <option value="">Select Repair ID</option>
        <?php
        // Fetch existing repair IDs from the repairs table
        $sql = "SELECT id, description FROM repairs"; // Assuming you have a repairs table
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            // If the current payment's repair_id matches the row's id, mark it as selected
            $selected = ($payment['repair_id'] == $row['id']) ? 'selected' : '';
            echo "<option value='" . $row['id'] . "' $selected>" . $row['id'] . " - " . $row['description'] . "</option>";
          }
        } else {
          echo "<option value=''>No repairs available</option>";
        }
        ?>
      </select>
    </div>

    <div>
      <label for="payment_date">Payment Date</label>
      <input type="datetime-local" name="payment_date" id="payment_date" value="<?php echo $payment['payment_date']; ?>" required>
    </div>

    <div>
      <label for="amount">Amount</label>
      <input type="number" name="amount" id="amount" value="<?php echo $payment['amount']; ?>" placeholder="Amount" step="0.01" required>
    </div>

    <div>
      <label for="payment_method">Payment Method</label>
      <select name="payment_method" id="payment_method" required>
        <option value="Cash" <?php if ($payment['payment_method'] == 'Cash') echo 'selected'; ?>>Cash</option>
        <option value="Credit" <?php if ($payment['payment_method'] == 'Credit') echo 'selected'; ?>>Credit</option>
        <option value="Bank Transfer" <?php if ($payment['payment_method'] == 'Bank Transfer') echo 'selected'; ?>>Bank Transfer</option>
      </select>
    </div>

    <div>
      <label for="status">Status</label>
      <select name="status" id="status" required>
        <option value="Paid" <?php if ($payment['status'] == 'Paid') echo 'selected'; ?>>Paid</option>
        <option value="Pending" <?php if ($payment['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
      </select>
    </div>

    <button type="submit">Update Payment</button>
  </form>

  <br>
  <a href="index.php">Back to Payment List</a>
</body>

</html>

<?php
$conn->close();
?>