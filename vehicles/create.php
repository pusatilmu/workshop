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
    <div>
      <label for="customer_id">Customer</label>
      <select name="customer_id" id="customer_id" required>
        <option value="">Select Customer</option>
        <?php
        // Fetch customers from the database to populate the dropdown
        $customer_sql = "SELECT id, first_name, last_name FROM customers";
        $customer_result = $conn->query($customer_sql);

        if ($customer_result->num_rows > 0) {
          while ($customer = $customer_result->fetch_assoc()) {
            echo "<option value='" . $customer['id'] . "'>" . $customer['first_name'] . " " . $customer['last_name'] . "</option>";
          }
        } else {
          echo "<option value=''>No customers found</option>";
        }
        ?>
      </select>
    </div>

    <div>
      <label for="vehicle_type">Vehicle Type</label>
      <input type="text" name="vehicle_type" id="vehicle_type" placeholder="Vehicle Type" required>
    </div>

    <div>
      <label for="brand">Brand</label>
      <input type="text" name="brand" id="brand" placeholder="Brand" required>
    </div>

    <div>
      <label for="model">Model</label>
      <input type="text" name="model" id="model" placeholder="Model" required>
    </div>

    <div>
      <label for="license_plate">License Plate</label>
      <input type="text" name="license_plate" id="license_plate" placeholder="License Plate" required>
    </div>

    <div>
      <label for="year">Year</label>
      <input type="number" name="year" id="year" placeholder="Year" required>
    </div>

    <button type="submit">Add Vehicle</button>
  </form>

  <br>
  <a href="index.php">Back to Vehicle List</a>
</body>

</html>

<?php
$conn->close();
?>