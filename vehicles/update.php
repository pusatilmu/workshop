<?php
include('../config/database.php');

// Mengambil ID kendaraan dari URL
if (isset($_GET['id'])) {
  $vehicle_id = $_GET['id'];
} else {
  header("Location: index.php"); // Redirect jika ID kendaraan tidak ditemukan
  exit;
}

// Ambil data kendaraan berdasarkan ID
$sql = "SELECT * FROM vehicles WHERE id = '$vehicle_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $vehicle = $result->fetch_assoc();
  $current_customer_id = $vehicle['customer_id']; // Menyimpan customer_id yang ada
  $vehicle_type = $vehicle['vehicle_type'];
  $brand = $vehicle['brand'];
  $model = $vehicle['model'];
  $license_plate = $vehicle['license_plate'];
  $year = $vehicle['year'];
} else {
  echo "Vehicle not found.";
  exit;
}

// Handle form submission to update vehicle record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $customer_id = $_POST['customer_id'];
  $vehicle_type = $_POST['vehicle_type'];
  $brand = $_POST['brand'];
  $model = $_POST['model'];
  $license_plate = $_POST['license_plate'];
  $year = $_POST['year'];

  // Update query
  $update_sql = "UPDATE vehicles SET customer_id = '$customer_id', vehicle_type = '$vehicle_type', brand = '$brand', 
                 model = '$model', license_plate = '$license_plate', year = '$year', updated_at = NOW() 
                 WHERE id = '$vehicle_id'";

  if ($conn->query($update_sql) === TRUE) {
    header("Location: index.php"); // Redirect to vehicle list after successful update
    exit;
  } else {
    echo "Error: " . $conn->error; // Display error if query fails
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Update Vehicle</title>
</head>

<body>
  <h1>Update Vehicle</h1>

  <!-- Form for updating vehicle -->
  <form action="update.php?id=<?php echo $vehicle_id; ?>" method="POST">
    <div>
      <label for="customer_id">Customer</label>
      <select name="customer_id" id="customer_id" required>
        <option value="">Select Customer</option>
        <?php
        // Fetch customers to populate the dropdown
        $customer_sql = "SELECT id, first_name, last_name FROM customers";
        $customer_result = $conn->query($customer_sql);

        if ($customer_result->num_rows > 0) {
          while ($customer = $customer_result->fetch_assoc()) {
            // Set the selected option based on current_customer_id
            $selected = ($customer['id'] == $current_customer_id) ? 'selected' : '';
            echo "<option value='" . $customer['id'] . "' $selected>" . $customer['first_name'] . " " . $customer['last_name'] . "</option>";
          }
        } else {
          echo "<option value=''>No customers found</option>";
        }
        ?>
      </select>
    </div>

    <div>
      <label for="vehicle_type">Vehicle Type</label>
      <input type="text" name="vehicle_type" id="vehicle_type" value="<?php echo $vehicle_type; ?>" placeholder="Vehicle Type" required>
    </div>

    <div>
      <label for="brand">Brand</label>
      <input type="text" name="brand" id="brand" value="<?php echo $brand; ?>" placeholder="Brand" required>
    </div>

    <div>
      <label for="model">Model</label>
      <input type="text" name="model" id="model" value="<?php echo $model; ?>" placeholder="Model" required>
    </div>

    <div>
      <label for="license_plate">License Plate</label>
      <input type="text" name="license_plate" id="license_plate" value="<?php echo $license_plate; ?>" placeholder="License Plate" required>
    </div>

    <div>
      <label for="year">Year</label>
      <input type="number" name="year" id="year" value="<?php echo $year; ?>" placeholder="Year" required>
    </div>

    <button type="submit">Update Vehicle</button>
  </form>

  <br>
  <a href="index.php">Back to Vehicle List</a>
</body>

</html>

<?php
$conn->close();
?>