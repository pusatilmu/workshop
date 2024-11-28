<?php
include('../config/database.php');

// Ambil id yang akan diperbarui dari URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  header("Location: index.php"); // Jika id tidak ada, redirect ke halaman daftar
  exit;
}

// Ambil data repair item dari database berdasarkan id
$sql = "SELECT * FROM repair_items WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  // Menyimpan data yang ada di database untuk ditampilkan di form
  $repair_id = $row['repair_id'];
  $part_name = $row['part_name'];
  $quantity = $row['quantity'];
  $price = $row['price'];
  $total_price = $row['total_price'];
} else {
  echo "Repair item not found.";
  exit;
}

// Handle form submission to update repair item
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Mengambil nilai dari form
  $repair_id = $_POST['repair_id'];
  $part_name = $_POST['part_name'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $total_price = $quantity * $price;

  // Pastikan repair_id yang dimasukkan valid, yaitu ada di tabel repairs
  $checkRepairSql = "SELECT * FROM repairs WHERE id = '$repair_id'";
  $checkRepairResult = $conn->query($checkRepairSql);

  // Jika repair_id tidak valid (tidak ditemukan di tabel repairs)
  if ($checkRepairResult->num_rows == 0) {
    echo "Invalid Repair ID.";
    exit; // Hentikan eksekusi lebih lanjut jika tidak valid
  }

  // Query untuk memperbarui data repair item
  $update_sql = "UPDATE repair_items 
                 SET repair_id = '$repair_id', part_name = '$part_name', quantity = '$quantity', price = '$price', total_price = '$total_price' 
                 WHERE id = $id";

  // Jalankan query update dan periksa keberhasilannya
  if ($conn->query($update_sql) === TRUE) {
    header("Location: index.php"); // Redirect ke daftar repair items setelah berhasil update
    exit;
  } else {
    echo "Error: " . $conn->error; // Jika terjadi error
  }
}

// Ambil data repair ID dari tabel repairs untuk ditampilkan di form
$repairQuery = "SELECT * FROM repairs";
$repairResult = $conn->query($repairQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Update Repair Item</title>
</head>

<body>
  <h1>Update Repair Item</h1>

  <form action="update.php?id=<?php echo $id; ?>" method="POST">
    <div>
      <label for="repair_id">Repair ID</label>
      <select name="repair_id" id="repair_id" required>
        <option value="">Select Repair ID</option>
        <?php
        if ($repairResult->num_rows > 0) {
          while ($repair = $repairResult->fetch_assoc()) {
            $selected = ($repair['id'] == $repair_id) ? 'selected' : '';
            echo "<option value='" . $repair['id'] . "' $selected>" . $repair['repair_type'] . "</option>";
          }
        } else {
          echo "<option value=''>No repairs found</option>";
        }
        ?>
      </select>
    </div>

    <div>
      <label for="part_name">Part Name</label>
      <input type="text" name="part_name" id="part_name" placeholder="Part Name" value="<?php echo $part_name; ?>" required>
    </div>

    <div>
      <label for="quantity">Quantity</label>
      <input type="number" name="quantity" id="quantity" placeholder="Quantity" value="<?php echo $quantity; ?>" required>
    </div>

    <div>
      <label for="price">Price</label>
      <input type="number" name="price" id="price" placeholder="Price" step="0.01" value="<?php echo $price; ?>" required>
    </div>

    <button type="submit">Update Repair Item</button>
  </form>

  <br>
  <a href="index.php">Back to Repair Items List</a>
</body>

</html>

<?php
$conn->close();
?>