<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workshop Project - README</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1, h2 {
            color: #333;
        }
        code {
            background-color: #f4f4f4;
            padding: 2px 4px;
            border-radius: 4px;
            font-family: monospace;
        }
        pre {
            background-color: #2c3e50;
            color: white;
            padding: 15px;
            border-radius: 4px;
            overflow-x: auto;
        }
        ul {
            list-style-type: square;
        }
        footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Workshop Project</h1>
    <p>Proyek ini adalah aplikasi untuk manajemen pelanggan, karyawan, perbaikan, dan kendaraan, dengan berbagai fitur untuk memudahkan pengelolaan data dan transaksi terkait. Aplikasi ini dirancang untuk memberikan fungsionalitas seperti pengelolaan pembayaran, perbaikan kendaraan, serta penugasan teknisi.</p>

    <h2>Fitur Utama</h2>

    <h3>1. Manajemen Pelanggan (<code>customers/</code>)</h3>
    <p><strong>Deskripsi:</strong> Fitur untuk menyimpan dan mengelola data pelanggan, termasuk informasi dasar seperti nama, alamat, nomor telepon, dan data terkait lainnya.</p>
    <p><strong>Fungsi:</strong> Menambah, mengedit, menghapus, dan menampilkan data pelanggan.</p>

    <h3>2. Manajemen Karyawan (<code>employees/</code>)</h3>
    <p><strong>Deskripsi:</strong> Fitur ini digunakan untuk mengelola data karyawan, termasuk nama, jabatan, gaji, serta tugas-tugas yang mereka jalankan.</p>
    <p><strong>Fungsi:</strong> Menambah, mengedit, menghapus, dan menampilkan data karyawan.</p>

    <h3>3. Manajemen Pembayaran (<code>payments/</code>)</h3>
    <p><strong>Deskripsi:</strong> Fitur untuk mengelola data pembayaran pelanggan, termasuk transaksi yang telah dilakukan untuk perbaikan atau layanan lainnya.</p>
    <p><strong>Fungsi:</strong> Memproses pembayaran, melacak transaksi, dan memberikan laporan pembayaran.</p>

    <h3>4. Manajemen Perbaikan (<code>repairs/</code>)</h3>
    <p><strong>Deskripsi:</strong> Fitur untuk mencatat dan mengelola perbaikan yang dilakukan pada kendaraan atau barang yang memerlukan perbaikan.</p>
    <p><strong>Fungsi:</strong> Menambah, mengedit, menghapus, dan menampilkan informasi perbaikan yang sedang berlangsung.</p>

    <h3>5. Penugasan Perbaikan (<code>repair_assignments/</code>)</h3>
    <p><strong>Deskripsi:</strong> Fitur untuk menugaskan teknisi atau staf yang akan menangani pekerjaan perbaikan.</p>
    <p><strong>Fungsi:</strong> Mengatur siapa yang akan menangani perbaikan tertentu dan status tugas tersebut.</p>

    <h3>6. Manajemen Barang Perbaikan (<code>repair_items/</code>)</h3>
    <p><strong>Deskripsi:</strong> Fitur untuk mengelola peralatan atau barang yang digunakan dalam perbaikan.</p>
    <p><strong>Fungsi:</strong> Melacak inventaris barang yang digunakan dalam setiap pekerjaan perbaikan.</p>

    <h3>7. Manajemen Kendaraan (<code>vehicles/</code>)</h3>
    <p><strong>Deskripsi:</strong> Fitur untuk mengelola data kendaraan, terutama kendaraan yang perlu perbaikan atau perawatan.</p>
    <p><strong>Fungsi:</strong> Menambah, mengedit, menghapus, dan menampilkan informasi kendaraan.</p>

    <h2>Skrip Automasi Git</h2>

    <h3>1. <code>branch.sh</code></h3>
    <p><strong>Deskripsi:</strong> Skrip shell untuk mengelola cabang (branch) di dalam sistem kontrol versi Git.</p>
    <p><strong>Fungsi:</strong> Membantu dalam pembuatan, penggabungan (merge), atau pengelolaan cabang dalam proyek secara otomatis.</p>

    <h3>2. <code>commit.sh</code></h3>
    <p><strong>Deskripsi:</strong> Skrip shell untuk melakukan commit otomatis ke repositori Git.</p>
    <p><strong>Fungsi:</strong> Mempermudah proses commit dengan menyederhanakan pembuatan pesan commit dan melakukan perubahan secara otomatis.</p>

    <h2>File Utama</h2>
    <h3><code>index.php</code></h3>
    <p><strong>Deskripsi:</strong> Ini adalah file utama aplikasi yang dijalankan saat pengguna mengakses aplikasi. Biasanya berfungsi untuk routing atau menampilkan halaman utama.</p>
    <p><strong>Fungsi:</strong> Menampilkan halaman depan aplikasi dan mengarahkan pengguna ke fitur lainnya.</p>

    <h2>Instalasi</h2>
    <h3>1. Persyaratan Sistem</h3>
    <ul>
        <li>Pastikan Anda sudah menginstal <a href="https://www.php.net/downloads" target="_blank">PHP</a> dan <a href="https://git-scm.com/downloads" target="_blank">Git</a> pada sistem Anda.</li>
        <li>Aplikasi ini memerlukan server lokal (misalnya, menggunakan PHP built-in server) untuk dijalankan.</li>
    </ul>

    <h3>2. Menyalin (Clone) Repositori</h3>
    <p>Clone repositori ini ke komputer lokal Anda dengan perintah berikut:</p>
    <pre><code>git clone https://github.com/pusatilmu/workshop.git</code></pre>

    <h3>3. Instalasi dan Menjalankan Aplikasi</h3>
    <ul>
        <li>Masuk ke direktori proyek:
            <pre><code>cd workshop</code></pre>
        </li>
        <li>Jalankan server PHP built-in:
            <pre><code>php -S localhost:8000</code></pre>
        </li>
        <li>Akses aplikasi melalui browser di URL: <a href="http://localhost:8000" target="_blank">http://localhost:8000</a>.</li>
    </ul>

    <h3>4. Pengaturan Tambahan</h3>
    <p>Jika aplikasi ini memerlukan database atau dependensi lainnya, pastikan untuk mengikuti instruksi tambahan yang terdapat di dalam file konfigurasi atau dokumentasi lebih lanjut.</p>

    <h2>Struktur Direktori</h2>
    <pre>
workshop/
├── config/                  # Konfigurasi sistem
├── customers/               # Manajemen data pelanggan
├── database/                # File SQL dan pengaturan database
├── employees/               # Manajemen data karyawan
├── payments/                # Pengelolaan pembayaran
├── repairs/                 # Pengelolaan perbaikan
├── repair_assignments/      # Penugasan teknisi perbaikan
├── repair_items/            # Barang-barang yang digunakan dalam perbaikan
├── vehicles/                # Manajemen data kendaraan
├── branch.sh                # Skrip untuk mengelola cabang Git
├── commit.sh                # Skrip untuk melakukan commit Git otomatis
└── index.php                # Halaman utama aplikasi
    </pre>

    <h2>Lisensi</h2>
    <p>Proyek ini dilisensikan di bawah <strong>MIT License</strong>. Lihat file <code>LICENSE</code> untuk detail lebih lanjut.</p>

    <footer>
        <p>Proyek ini dibuat oleh Tim Workshop. Untuk pertanyaan lebih lanjut, hubungi kami di <a href="mailto:support@pusatilmu.com">support@pusatilmu.com</a>.</p>
    </footer>
</body>
</html>
