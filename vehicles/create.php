<?php
include('../config/database.php');

// Handle form submission to create a new vehicle record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $customer_id = $_POST['customer_id'];
  $vehicle_type = $_POST['vehicle_type'];
  $brand = $_POST['brand'];
  $model = $_POST['model'];
  $license_plate = $_POST['license_plate'];
  $year = $_POST['year'];

  // Simple SQL query (no SQL injection protection in this version)
  $sql = "INSERT INTO vehicles (customer_id, vehicle_type, brand, model, license_plate, year, created_at, updated_at) 
          VALUES ('$customer_id', '$vehicle_type', '$brand', '$model', '$license_plate', '$year', NOW(), NOW())";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the list after successful insertion
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
  <title>Add New Vehicle</title>
</head>

<body>
  <h1>Add New Vehicle</h1>

  <!-- Form for adding a new vehicle -->
  <form action="create.php" method="POST">
    <input type="number" name="customer_id" placeholder="Customer ID" required>
    <input type="text" name="vehicle_type" placeholder="Vehicle Type" required>
    <input type="text" name="brand" placeholder="Brand" required>
    <input type="text" name="model" placeholder="Model" required>
    <input type="text" name="license_plate" placeholder="License Plate" required>
    <input type="number" name="year" placeholder="Year" required>
    <button type="submit">Add Vehicle</button>
  </form>

  <br>
  <a href="index.php">Back to Vehicle List</a>
</body>

</html>

<?php
$conn->close();
?>