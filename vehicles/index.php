<?php
include('../config/database.php');

// Fetch all vehicles
$sql = "SELECT * FROM vehicles";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Vehicle List</title>
</head>

<body>
  <h1>Vehicle List</h1>

  <a href="create.php">Add New Vehicle</a>

  <h2>Existing Vehicles</h2>
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Customer ID</th>
        <th>Vehicle Type</th>
        <th>Brand</th>
        <th>Model</th>
        <th>License Plate</th>
        <th>Year</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['customer_id']; ?></td>
          <td><?php echo $row['vehicle_type']; ?></td>
          <td><?php echo $row['brand']; ?></td>
          <td><?php echo $row['model']; ?></td>
          <td><?php echo $row['license_plate']; ?></td>
          <td><?php echo $row['year']; ?></td>
          <td><?php echo $row['created_at']; ?></td>
          <td>
            <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this vehicle?');">Delete</a>
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