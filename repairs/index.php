<?php
include('../config/database.php');

// Menampilkan data payments dengan relasi ke repairs, vehicles, dan customers
$sql = "SELECT payments.id, payments.amount, payments.payment_date, 
                repairs.repair_type, repairs.status, 
                customers.first_name, customers.last_name, customers.email 
        FROM payments
        JOIN repairs ON payments.repair_id = repairs.id
        JOIN vehicles ON repairs.vehicle_id = vehicles.id
        JOIN customers ON vehicles.customer_id = customers.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Repairs List</title>
</head>

<body>
  <div>
    <h1>Repairs List</h1>

    <a href="create.php">Add New Repair</a><br><br>
  </div>
  <table border="1">
    <thead>
      <tr>
        <th>Repair Type</th>
        <th>Repair Status</th>
        <th>Amount</th>
        <th>Payment Date</th>
        <th>Customer Name</th>
        <th>Customer Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['repair_type']; ?></td>
          <td><?php echo $row['status']; ?></td>
          <td><?php echo $row['amount']; ?></td>
          <td><?php echo $row['payment_date']; ?></td>
          <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
          <td><?php echo $row['email']; ?></td>
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