# Workshop Project

Proyek ini adalah aplikasi sederhana yang dibuat menggunakan **PHP** dan **HTML** untuk manajemen pelanggan, karyawan, perbaikan, dan kendaraan. Aplikasi ini menyediakan berbagai fitur untuk memudahkan pengelolaan data, transaksi, dan tugas-tugas terkait dalam sebuah workshop atau bengkel.

## Fitur Utama

Berikut adalah fitur-fitur utama dari aplikasi ini:

### 1. **Manajemen Pelanggan (`customers/`)**
   - **Deskripsi**: Fitur untuk menyimpan dan mengelola data pelanggan, termasuk informasi dasar seperti nama, alamat, nomor telepon, dan data terkait lainnya.
   - **Fungsi**: Menambah, mengedit, menghapus, dan menampilkan data pelanggan.

### 2. **Manajemen Karyawan (`employees/`)**
   - **Deskripsi**: Fitur ini digunakan untuk mengelola data karyawan, termasuk nama, jabatan, gaji, serta tugas-tugas yang mereka jalankan.
   - **Fungsi**: Menambah, mengedit, menghapus, dan menampilkan data karyawan.

### 3. **Manajemen Pembayaran (`payments/`)**
   - **Deskripsi**: Fitur untuk mengelola data pembayaran pelanggan, termasuk transaksi yang telah dilakukan untuk perbaikan atau layanan lainnya.
   - **Fungsi**: Memproses pembayaran, melacak transaksi, dan memberikan laporan pembayaran.

### 4. **Manajemen Perbaikan (`repairs/`)**
   - **Deskripsi**: Fitur untuk mencatat dan mengelola perbaikan yang dilakukan pada kendaraan atau barang yang memerlukan perbaikan.
   - **Fungsi**: Menambah, mengedit, menghapus, dan menampilkan informasi perbaikan yang sedang berlangsung.

### 5. **Penugasan Perbaikan (`repair_assignments/`)**
   - **Deskripsi**: Fitur untuk menugaskan teknisi atau staf yang akan menangani pekerjaan perbaikan.
   - **Fungsi**: Mengatur siapa yang akan menangani perbaikan tertentu dan status tugas tersebut.

### 6. **Manajemen Barang Perbaikan (`repair_items/`)**
   - **Deskripsi**: Fitur untuk mengelola peralatan atau barang yang digunakan dalam perbaikan.
   - **Fungsi**: Melacak inventaris barang yang digunakan dalam setiap pekerjaan perbaikan.

### 7. **Manajemen Kendaraan (`vehicles/`)**
   - **Deskripsi**: Fitur untuk mengelola data kendaraan, terutama kendaraan yang perlu perbaikan atau perawatan.
   - **Fungsi**: Menambah, mengedit, menghapus, dan menampilkan informasi kendaraan.

## Skrip Automasi Git

### 1. **`branch.sh`**
   - **Deskripsi**: Skrip shell untuk mengelola cabang (branch) di dalam sistem kontrol versi Git.
   - **Fungsi**: Membantu dalam pembuatan, penggabungan (merge), atau pengelolaan cabang dalam proyek secara otomatis.

### 2. **`commit.sh`**
   - **Deskripsi**: Skrip shell untuk melakukan commit otomatis ke repositori Git.
   - **Fungsi**: Mempermudah proses commit dengan menyederhanakan pembuatan pesan commit dan melakukan perubahan secara otomatis.

## File Utama

### **`index.php`**
   - **Deskripsi**: Ini adalah file utama aplikasi yang dijalankan saat pengguna mengakses aplikasi. Biasanya berfungsi untuk routing atau menampilkan halaman utama.
   - **Fungsi**: Menampilkan halaman depan aplikasi dan mengarahkan pengguna ke fitur lainnya.

## Instalasi

### 1. **Persyaratan Sistem**
   - Pastikan Anda sudah menginstal [PHP](https://www.php.net/downloads) dan [Git](https://git-scm.com/downloads) pada sistem Anda.
   - Aplikasi ini memerlukan server lokal (misalnya, menggunakan PHP built-in server) untuk dijalankan.

### 2. **Menyalin (Clone) Repositori**

   Clone repositori ini ke komputer lokal Anda dengan perintah berikut:

   ```bash
   git clone https://github.com/pusatilmu/workshop.git
