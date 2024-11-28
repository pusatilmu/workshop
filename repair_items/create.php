<?php
include('../config/database.php');

// Handle form submission to create a new repair item
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $repair_id = $_POST['repair_id'];
  $part_name = $_POST['part_name'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $total_price = $quantity * $price;

  $sql = "INSERT INTO repair_items (repair_id, part_name, quantity, price, total_price) 
          VALUES ('$repair_id', '$part_name', '$quantity', '$price', '$total_price')";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after successful insertion
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
  <title>Add Repair Item</title>
</head>

<body>
  <h1>Add Repair Item</h1>

  <form action="create.php" method="POST">
    <input type="number" name="repair_id" placeholder="Repair ID" required>
    <input type="text" name="part_name" placeholder="Part Name" required>
    <input type="number" name="quantity" placeholder="Quantity" required>
    <input type="number" name="price" placeholder="Price" step="0.01" required>
    <button type="submit">Add Repair Item</button>
  </form>

  <br>
  <a href="index.php">Back to Repair Items List</a>
</body>

</html>

<?php
$conn->close();
?>