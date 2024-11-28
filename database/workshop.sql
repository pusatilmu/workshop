-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Nov 2024 pada 07.36
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '081234567890', '123 Main Street, City', '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '082345678901', '456 Oak Avenue, City', '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(3, 'Chris', 'Johnson', 'chris.johnson@example.com', '083456789012', '789 Pine Road, City', '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(4, 'Emily', 'Williams', 'emily.williams@example.com', '084567890123', '321 Birch Street, City', '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(5, 'Michael', 'Brown', 'michael.brown@example.com', '085678901234', '654 Cedar Lane, City', '2024-11-28 06:18:30', '2024-11-28 06:18:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hire_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `role`, `phone`, `email`, `hire_date`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Doe', 'Technician', '081234567890', 'john.doe@example.com', '2024-11-28 06:18:30', '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(2, 'Jane', 'Smith', 'Manager', '082345678901', 'jane.smith@example.com', '2024-11-28 06:18:30', '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(3, 'Chris', 'Johnson', 'Mechanic', '083456789012', 'chris.johnson@example.com', '2024-11-28 06:18:30', '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(4, 'Emily', 'Williams', 'Technician', '084567890123', 'emily.williams@example.com', '2024-11-28 06:18:30', '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(5, 'Michael', 'Brown', 'Mechanic', '085678901234', 'michael.brown@example.com', '2024-11-28 06:18:30', '2024-11-28 06:18:30', '2024-11-28 06:18:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `repair_id` int(11) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`id`, `repair_id`, `payment_date`, `amount`, `payment_method`, `status`) VALUES
(1, 1, '2024-11-28 07:00:00', 500.00, 'Credit', 'Paid'),
(2, 2, '2024-11-29 03:30:00', 300.00, 'Cash', 'Paid'),
(3, 3, '2024-11-30 02:15:00', 200.00, 'Bank Transfer', 'Pending'),
(4, 4, '2024-12-01 06:00:00', 150.00, 'Cash', 'Paid'),
(5, 5, '2024-12-02 09:45:00', 400.00, 'Credit', 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `repairs`
--

CREATE TABLE `repairs` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `repair_type` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `repairs`
--

INSERT INTO `repairs` (`id`, `vehicle_id`, `repair_type`, `description`, `status`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'Engine Repair', 'Replace engine components', 'Pending', '2024-11-28', NULL, '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(2, 2, 'Transmission Repair', 'Fix transmission issues', 'In Progress', '2024-11-28', NULL, '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(3, 3, 'Suspension Repair', 'Replace suspension parts', 'Completed', '2024-11-28', NULL, '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(4, 4, 'Brake Repair', 'Replace brake pads and rotors', 'Pending', '2024-11-28', NULL, '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(5, 5, 'Electrical Repair', 'Fix electrical wiring issues', 'In Progress', '2024-11-28', NULL, '2024-11-28 06:18:30', '2024-11-28 06:18:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `repair_assignments`
--

CREATE TABLE `repair_assignments` (
  `repair_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `repair_assignments`
--

INSERT INTO `repair_assignments` (`repair_id`, `employee_id`) VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `repair_items`
--

CREATE TABLE `repair_items` (
  `id` int(11) NOT NULL,
  `repair_id` int(11) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `repair_items`
--

INSERT INTO `repair_items` (`id`, `repair_id`, `part_name`, `quantity`, `price`, `total_price`) VALUES
(1, 1, 'Engine Block', 1, 500.00, 500.00),
(2, 2, 'Transmission Gasket', 2, 50.00, 100.00),
(3, 3, 'Shock Absorber', 4, 120.00, 480.00),
(4, 4, 'Brake Pads', 2, 60.00, 120.00),
(5, 5, 'Wiring Harness', 1, 200.00, 200.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `license_plate` varchar(20) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `vehicles`
--

INSERT INTO `vehicles` (`id`, `customer_id`, `vehicle_type`, `brand`, `model`, `license_plate`, `year`, `created_at`, `updated_at`) VALUES
(1, 1, 'Car', 'Toyota', 'Corolla', 'AB123CD', 2020, '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(2, 2, 'Motorcycle', 'Honda', 'CBR500R', 'BC456EF', 2021, '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(3, 3, 'Car', 'BMW', 'X5', 'DE789GH', 2022, '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(4, 4, 'Truck', 'Ford', 'F-150', 'FG123HI', 2021, '2024-11-28 06:18:30', '2024-11-28 06:18:30'),
(5, 5, 'Car', 'Tesla', 'Model 3', 'JK456LM', 2023, '2024-11-28 06:18:30', '2024-11-28 06:18:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `repair_id` (`repair_id`);

--
-- Indeks untuk tabel `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indeks untuk tabel `repair_assignments`
--
ALTER TABLE `repair_assignments`
  ADD PRIMARY KEY (`repair_id`,`employee_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indeks untuk tabel `repair_items`
--
ALTER TABLE `repair_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `repair_id` (`repair_id`);

--
-- Indeks untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `repair_items`
--
ALTER TABLE `repair_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`repair_id`) REFERENCES `repairs` (`id`);

--
-- Ketidakleluasaan untuk tabel `repairs`
--
ALTER TABLE `repairs`
  ADD CONSTRAINT `repairs_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Ketidakleluasaan untuk tabel `repair_assignments`
--
ALTER TABLE `repair_assignments`
  ADD CONSTRAINT `repair_assignments_ibfk_1` FOREIGN KEY (`repair_id`) REFERENCES `repairs` (`id`),
  ADD CONSTRAINT `repair_assignments_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Ketidakleluasaan untuk tabel `repair_items`
--
ALTER TABLE `repair_items`
  ADD CONSTRAINT `repair_items_ibfk_1` FOREIGN KEY (`repair_id`) REFERENCES `repairs` (`id`);

--
-- Ketidakleluasaan untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
