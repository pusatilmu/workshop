<?php
include('../config/database.php');

// Fetch all repair items
$sql = "SELECT * FROM repair_items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Repair Items List</title>
</head>

<body>
  <h1>Repair Items List</h1>

  <a href="create.php">Add New Repair Item</a>

  <h2>Existing Repair Items</h2>
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Repair ID</th>
        <th>Part Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total Price</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['repair_id']; ?></td>
          <td><?php echo $row['part_name']; ?></td>
          <td><?php echo $row['quantity']; ?></td>
          <td><?php echo $row['price']; ?></td>
          <td><?php echo $row['total_price']; ?></td>
          <td>
            <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

</body>

</html>

<?php
$conn->close();
?>