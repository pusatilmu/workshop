<?php
include('../config/database.php');

// Fetch the repair item to edit
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Fetch the item data based on the ID
  $sql = "SELECT * FROM repair_items WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $item = $result->fetch_assoc(); // Get item data
  } else {
    echo "Item not found.";
    exit; // Stop execution if the item doesn't exist
  }
}

// Handle form submission to update the repair item
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get data from the form
  $repair_id = $_POST['repair_id'];
  $part_name = $_POST['part_name'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $total_price = $quantity * $price;

  // Update the item in the database
  $sql = "UPDATE repair_items SET repair_id = '$repair_id', part_name = '$part_name', 
          quantity = '$quantity', price = '$price', total_price = '$total_price' 
          WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after successful update
    exit;
  } else {
    echo "Error: " . $conn->error; // Display error if query fails
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
    <div>
      <label for="repair_id">Repair ID</label>
      <input type="number" name="repair_id" id="repair_id" value="<?php echo $item['repair_id']; ?>" placeholder="Repair ID" required>
    </div>

    <div>
      <label for="part_name">Part Name</label>
      <input type="text" name="part_name" id="part_name" value="<?php echo $item['part_name']; ?>" placeholder="Part Name" required>
    </div>

    <div>
      <label for="quantity">Quantity</label>
      <input type="number" name="quantity" id="quantity" value="<?php echo $item['quantity']; ?>" placeholder="Quantity" required>
    </div>

    <div>
      <label for="price">Price</label>
      <input type="number" name="price" id="price" value="<?php echo $item['price']; ?>" placeholder="Price" step="0.01" required>
    </div>

    <button type="submit">Update Repair Item</button>
  </form>

  <br>
  <a href="index.php">Back to Repair Items List</a>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>