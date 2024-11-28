<?php
include('../config/database.php');

// Fetch all repair items with JOIN to the repair table
$sql = "
    SELECT 
        repair_items.id, 
        repair_items.repair_id, 
        repair_items.part_name, 
        repair_items.quantity, 
        repair_items.price, 
        repair_items.total_price, 
        repairs.repair_type AS repair_name  -- Mengambil nama perbaikan dari tabel repair
    FROM 
        repair_items
    JOIN 
        repairs ON repair_items.repair_id = repairs.id
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Repair Items List</title>
</head>

<body>
  <div>
    <h1>Repair Items List</h1>
    <a href="create.php">Add New Repair Item</a>
  </div>
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Repair Name</th> <!-- Mengganti "Repair ID" dengan "Repair Name" -->
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
          <td><?php echo $row['repair_name']; ?></td> <!-- Menampilkan nama perbaikan -->
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