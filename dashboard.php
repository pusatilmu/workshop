<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php"); // Redirect ke halaman login jika belum login
  exit();
}

// Tampilkan halaman dashboard
echo "Selamat datang, " . $_SESSION['username'];
?>

<!-- Tombol Logout -->
<a href="logout.php">Logout</a>