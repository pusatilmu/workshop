<?php
include('../config/database.php');

// Query untuk mendapatkan data repair assignments dengan JOIN
$sql = "SELECT 
            ra.repair_id, 
            ra.employee_id, 
            r.repair_type, 
            CONCAT(e.first_name, ' ', e.last_name) AS employee_name
        FROM 
            repair_assignments ra
        JOIN 
            repairs r ON ra.repair_id = r.id
        JOIN 
            employees e ON ra.employee_id = e.id";

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
        <th>Repair Type</th>
        <th>Employee Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['repair_type']; ?></td>
          <td><?php echo $row['employee_name']; ?></td>
          <td>
            <a href="update.php?repair_id=<?php echo $row['repair_id']; ?>">Edit</a> |
            <a href="delete.php?repair_id=<?php echo $row['repair_id']; ?>" onclick="return confirm('Are you sure you want to delete this assignment?');">Delete</a>
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