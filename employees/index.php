<?php
include('../config/database.php');

// Menampilkan data employees
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Employees List</title>
</head>

<body>
  <h1>Employees List</h1>
  <a href="create.php">Add New Employee</a>

  <table border="1">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Role</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['first_name']; ?></td>
          <td><?php echo $row['last_name']; ?></td>
          <td><?php echo $row['role']; ?></td>
          <td><?php echo $row['phone']; ?></td>
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