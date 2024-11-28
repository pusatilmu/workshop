<?php
include('../config/database.php');

// Fetch repairs data along with related vehicles and customers
$sql = "SELECT repairs.id, repairs.repair_type, repairs.description, repairs.status, repairs.start_date, repairs.end_date, 
                vehicles.id AS vehicle_id, vehicles.vehicle_type, vehicles.brand, vehicles.model, vehicles.license_plate, vehicles.year,
                customers.first_name, customers.last_name, customers.email 
        FROM repairs
        JOIN vehicles ON repairs.vehicle_id = vehicles.id
        JOIN customers ON vehicles.customer_id = customers.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Repairs List</title>
  <script>
    // Function to toggle the "Select All" checkbox
    function toggleSelectAll(source) {
      var checkboxes = document.querySelectorAll('.repair-checkbox');
      checkboxes.forEach(function(checkbox) {
        checkbox.checked = source.checked;
      });
    }
  </script>
</head>

<body>
  <div>
    <h1>Repairs List</h1>

    <a href="create.php">Add New Repair</a>
  </div>

  <table border="1">
    <thead>
      <tr>
        <th>Repair Type</th>
        <th>Description</th>
        <th>Status</th>
        <th>Vehicle</th>
        <th>Customer Name</th>
        <th>Customer Email</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><input type="checkbox" name="selected_repairs[]" value="<?php echo $row['id']; ?>" class="repair-checkbox"></td>
          <td><?php echo $row['repair_type']; ?></td>
          <td><?php echo $row['description']; ?></td>
          <td><?php echo $row['status']; ?></td>
          <td><?php echo $row['vehicle_type'] . ' ' . $row['brand'] . ' ' . $row['model'] . ' (' . $row['license_plate'] . ')'; ?></td>
          <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['start_date']; ?></td>
          <td><?php echo $row['end_date']; ?></td>
          <td>
            <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
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