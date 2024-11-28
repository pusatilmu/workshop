<?php
include('../config/database.php');

// Handle form submission to create a new repair item
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Mengambil data dari form
  $repair_id = $_POST['repair_id'];
  $part_name = $_POST['part_name'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $total_price = $quantity * $price;

  // Create SQL query to insert repair item
  $sql = "INSERT INTO repair_items (repair_id, part_name, quantity, price, total_price) 
          VALUES ('$repair_id', '$part_name', '$quantity', '$price', '$total_price')";

  // Execute the query and check for success
  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after successful insertion
    exit;
  } else {
    echo "Error: " . $conn->error; // Display error if query fails
  }
}

// Fetch available repair IDs from the repairs table
$repairQuery = "SELECT * FROM repairs";
$repairResult = $conn->query($repairQuery);
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
    <div>
      <label for="repair_id">Repair ID</label>
      <select name="repair_id" id="repair_id" required>
        <option value="">Select Repair ID</option>
        <?php
        if ($repairResult->num_rows > 0) {
          while ($row = $repairResult->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['repair_type'] . "</option>";
          }
        } else {
          echo "<option value=''>No repairs found</option>";
        }
        ?>
      </select>
    </div>

    <div>
      <label for="part_name">Part Name</label>
      <input type="text" name="part_name" id="part_name" placeholder="Part Name" required>
    </div>

    <div>
      <label for="quantity">Quantity</label>
      <input type="number" name="quantity" id="quantity" placeholder="Quantity" required>
    </div>

    <div>
      <label for="price">Price</label>
      <input type="number" name="price" id="price" placeholder="Price" step="0.01" required>
    </div>

    <button type="submit">Add Repair Item</button>
  </form>

  <br>
  <a href="index.php">Back to Repair Items List</a>
</body>

</html>

<?php
$conn->close();
?>