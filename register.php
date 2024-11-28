<?php
session_start();
include('config/database.php');

// Variabel untuk menampung pesan error
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mendapatkan input dari form registrasi
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Hash password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Mencegah SQL Injection
  $username = mysqli_real_escape_string($conn, $username);

  // Periksa apakah username sudah ada
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $error_message = "Username sudah ada!";
  } else {
    // Insert user baru ke database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
      $success_message = "Registrasi berhasil! Silakan <a href='login.php'>Login</a>";
    } else {
      $error_message = "Terjadi kesalahan: " . $conn->error;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi - Sistem</title>
  <!-- Optional: Add some CSS for styling -->
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="register-container">
    <h2>Registrasi</h2>

    <!-- Menampilkan pesan error atau sukses -->
    <?php if (!empty($error_message)): ?>
      <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
      <div class="success-message"><?php echo $success_message; ?></div>
    <?php endif; ?>

    <!-- Form Registrasi -->
    <form method="POST" action="register.php">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required><br>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required><br>

      <button type="submit">Register</button>
    </form>

    <p>Sudah punya akun? <a href="login.php">Login</a></p>
  </div>

  <!-- Optional: Add some JavaScript for validation or enhancements -->
</body>

</html>