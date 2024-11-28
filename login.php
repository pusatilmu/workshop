<?php
session_start();
include('config/database.php');

// Variabel untuk menampung pesan error
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Mendapatkan input dari form login
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Mencegah SQL Injection
  $username = mysqli_real_escape_string($conn, $username);
  $password = mysqli_real_escape_string($conn, $password);

  // Query untuk mengecek apakah username ada
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Ambil data pengguna
    $row = $result->fetch_assoc();
    // Verifikasi password
    if (password_verify($password, $row['password'])) {
      // Set session jika berhasil login
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['username'] = $row['username'];
      header("Location: dashboard.php"); // Redirect ke halaman dashboard
      exit(); // Stop script agar tidak menampilkan form login lagi
    } else {
      $error_message = "Password salah!";
    }
  } else {
    $error_message = "Pengguna tidak ditemukan!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sistem</title>
</head>

<body>
  <div class="login-container">
    <h2>Login</h2>

    <?php if (!empty($error_message)): ?>
      <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required><br>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required><br>

      <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar</a></p>
  </div>

</body>

</html>