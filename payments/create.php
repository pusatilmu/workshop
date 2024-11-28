<?php
include('../config/database.php');

// Handle form submission to add a payment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $repair_id = $_POST['repair_id'];
  $payment_date = $_POST['payment_date'];
  $amount = $_POST['amount'];
  $payment_method = $_POST['payment_method'];
  $status = $_POST['status'];

  // Insert the payment into the payments table
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

  <!-- Form to add a new payment -->
  <form action="create.php" method="POST">
    <div>
      <label for="repair_id">Repair</label>
      <select name="repair_id" id="repair_id" required>
        <option value="">Select Repair</option>
        <?php
        // Fetch existing repair IDs from the repairs table
        $sql = "SELECT id, description FROM repairs"; // Assuming you have a repairs table with an id and description
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Loop through the repair records and display them in the dropdown
          while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>"  . $row['description'] . "</option>";
          }
        } else {
          echo "<option value=''>No repairs available</option>";
        }
        ?>
      </select>
    </div>

    <div>
      <label for="payment_date">Payment Date</label>
      <input type="datetime-local" name="payment_date" id="payment_date" required>
    </div>

    <div>
      <label for="amount">Amount</label>
      <input type="number" name="amount" id="amount" placeholder="Amount" step="0.01" required>
    </div>

    <div>
      <label for="payment_method">Payment Method</label>
      <select name="payment_method" id="payment_method" required>
        <option value="Cash">Cash</option>
        <option value="Credit">Credit</option>
        <option value="Bank Transfer">Bank Transfer</option>
      </select>
    </div>

    <div>
      <label for="status">Status</label>
      <select name="status" id="status" required>
        <option value="Paid">Paid</option>
        <option value="Pending">Pending</option>
      </select>
    </div>

    <button type="submit">Add Payment</button>
  </form>

  <br>
  <a href="index.php">Back to Payment List</a>
</body>

</html>

<?php
$conn->close();
?>