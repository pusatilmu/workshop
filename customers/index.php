<?php
include('../config/database.php');

// Fetch all customers
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Customer List</title>
</head>

<body>
  <h1>Customer List</h1>

  <a href="create.php">Add New Customer</a>

  <h2>Existing Customers</h2>
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['first_name']; ?></td>
          <td><?php echo $row['last_name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['phone']; ?></td>
          <td><?php echo $row['address']; ?></td>
          <td><?php echo $row['created_at']; ?></td>
          <td>
            <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
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