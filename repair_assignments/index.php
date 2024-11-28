<?php
include('../config/database.php');

// Fetch all repair assignments
$sql = "SELECT * FROM repair_assignments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Repair Assignments List</title>
</head>

<body>
  <h1>Repair Assignments List</h1>

  <a href="create.php">Assign Repair to Employee</a>

  <h2>Existing Repair Assignments</h2>
  <table border="1">
    <thead>
      <tr>
        <th>Repair ID</th>
        <th>Employee ID</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['repair_id']; ?></td>
          <td><?php echo $row['employee_id']; ?></td>
          <td>
            <a href="update.php?id=<?php echo $row['repair_id']; ?>&employee_id=<?php echo $row['employee_id']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $row['repair_id']; ?>&employee_id=<?php echo $row['employee_id']; ?>" onclick="return confirm('Are you sure you want to delete this assignment?');">Delete</a>
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