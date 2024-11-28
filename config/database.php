<?php
// Konfigurasi untuk koneksi database
$servername = "localhost";   // Nama server, jika menggunakan localhost, cukup "localhost"
$username = "root";          // Username MySQL (biasanya "root" untuk localhost)
$password = "";              // Password MySQL (biasanya kosong untuk localhost)
$dbname = "workshop";        // Nama database yang ingin Anda hubungkan (misalnya, "workshop")

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Jika berhasil, bisa menambahkan pesan ini (opsional)
echo "<a href=../index.php>Kembali</a>";

// Jangan lupa untuk menutup koneksi saat tidak digunakan
// $conn->close();
