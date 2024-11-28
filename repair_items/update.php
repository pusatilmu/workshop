<?php
include('../config/database.php');

// Fetch the repair item to edit
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM repair_items WHERE id = $id";
  $result = $conn->query($sql);
  $item = $result->fetch_assoc();
}

// Handle form submission to update the repair item
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $repair_id = $_POST['repair_id'];
  $part_name = $_POST['part_name'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $total_price = $quantity * $price;

  $sql = "UPDATE repair_items SET repair_id = '$repair_id', part_name = '$part_name', 
          quantity = '$quantity', price = '$price', total_price = '$total_price' WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after successful update
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
  <title>Edit Repair Item</title>
</head>

<body>
  <h1>Edit Repair Item</h1>

  <form action="update.php?id=<?php echo $item['id']; ?>" method="POST">
    <input type="number" name="repair_id" value="<?php echo $item['repair_id']; ?>" placeholder="Repair ID" required>
    <input type="text" name="part_name" value="<?php echo $item['part_name']; ?>" placeholder="Part Name" required>
    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" placeholder="Quantity" required>
    <input type="number" name="price" value="<?php echo $item['price']; ?>" placeholder="Price" step="0.01" required>
    <button type="submit">Update Repair Item</button>
  </form>

  <br>
  <a href="index.php">Back to Repair Items List</a>
</body>

</html>

<?php
$conn->close();
?>