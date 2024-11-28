<?php
include('../config/database.php');

// Fetch the vehicle record to edit
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM vehicles WHERE id = $id";
  $result = $conn->query($sql);
  $vehicle = $result->fetch_assoc();
}

// Handle form submission to update the vehicle record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $customer_id = $_POST['customer_id'];
  $vehicle_type = $_POST['vehicle_type'];
  $brand = $_POST['brand'];
  $model = $_POST['model'];
  $license_plate = $_POST['license_plate'];
  $year = $_POST['year'];

  $sql = "UPDATE vehicles SET customer_id = '$customer_id', vehicle_type = '$vehicle_type', 
          brand = '$brand', model = '$model', license_plate = '$license_plate', year = '$year', updated_at = NOW() WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after successful update
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Edit Vehicle</title>
</head>

<body>
  <h1>Edit Vehicle</h1>

  <form action="update.php?id=<?php echo $vehicle['id']; ?>" method="POST">
    <input type="number" name="customer_id" value="<?php echo $vehicle['customer_id']; ?>" placeholder="Customer ID" required>
    <input type="text" name="vehicle_type" value="<?php echo $vehicle['vehicle_type']; ?>" placeholder="Vehicle Type" required>
    <input type="text" name="brand" value="<?php echo $vehicle['brand']; ?>" placeholder="Brand" required>
    <input type="text" name="model" value="<?php echo $vehicle['model']; ?>" placeholder="Model" required>
    <input type="text" name="license_plate" value="<?php echo $vehicle['license_plate']; ?>" placeholder="License Plate" required>
    <input type="number" name="year" value="<?php echo $vehicle['year']; ?>" placeholder="Year" required>
    <button type="submit">Update Vehicle</button>
  </form>

  <br>
  <a href="index.php">Back to Vehicle List</a>
</body>

</html>

<?php
$conn->close();
?>