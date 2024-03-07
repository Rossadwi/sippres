-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 03:59 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sippres`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `NIP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `id` int(50) NOT NULL,
  `tahun` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `infolomba`
--

CREATE TABLE `infolomba` (
  `id_infolomba` int(11) NOT NULL,
  `nama_lomba` varchar(255) NOT NULL,
  `penyelenggara` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `waktu` date NOT NULL,
  `createddate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `infolomba`
--

INSERT INTO `infolomba` (`id_infolomba`, `nama_lomba`, `penyelenggara`, `deskripsi`, `foto`, `waktu`, `createddate`) VALUES
(1, 'Festival Banjari', 'SKI SMKN 2 Surabaya', 'Dalam memperingati Maulid nabi muhammad', 'profile.png', '2024-05-31', '2023-12-31 04:19:16'),
(3, 'lomba baris berbaris', 'SMKN 10 Surabaya', 'Dalam rangka memperingati hari hut kemerdekaan indonesia', '240307100012.png', '2024-03-31', '2024-03-07 04:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `keaktifan`
--

CREATE TABLE `keaktifan` (
  `id_keaktifan` int(50) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `isverif` tinyint(1) DEFAULT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `waktu` date NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `penyelenggara` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keaktifan`
--

INSERT INTO `keaktifan` (`id_keaktifan`, `id_siswa`, `isverif`, `nama_kegiatan`, `waktu`, `foto`, `penyelenggara`, `note`) VALUES
(1, 6, 1, 'panitia fesban', '2024-02-27', '240305235644.jpg', 'SKI', ''),
(2, 6, 0, 'bootcamp', '2024-02-29', '240306001859.webp', 'IT Club', ''),
(3, NULL, 0, 'Lomba kemerdekaan indonesia', '2024-03-01', '240307104649.png', 'OSIS', '');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id_prestasi` int(50) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `isverif` tinyint(1) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `penyelenggara` varchar(255) NOT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `tingkat` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`id_prestasi`, `id_siswa`, `isverif`, `judul`, `penyelenggara`, `bukti`, `tingkat`, `tanggal`, `note`) VALUES
(1, 4, 2, 'juara 1 tidur', 'Rossa', '240307103024.jpg', 'prov', '2024-03-13', ''),
(2, 4, 0, 'juara', 'utm', '240305231831.jpeg', 'provinsi', '2024-03-22', ''),
(3, 3, 1, 'juara 3', 'HIMAPIF', '240305231700.jpeg', 'nasional Indonesia', '2024-03-04', ''),
(4, NULL, NULL, 'juara 1 lomba festival banjari', 'iqma surabaya', '240307102435.jpg', 'jawa timur', '2024-02-24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `NISN` int(50) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `angkatan` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `NISN`, `nama_siswa`, `jurusan`, `angkatan`, `alamat`, `telp`, `foto`) VALUES
(3, 23456678, 'Anisa', 'IPA', '2021', 'Jakarta', '081232905662', '240303230401.jpg'),
(4, 66553, 'sukma', 'IPA', '2021', 'Jakarta', '081232905662', '240303230339.jpg'),
(6, 123445, 'khamdi', 'IPA', '2021', 'Surabaya', '081232905662', '240303224352.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `remember_token` int(50) NOT NULL,
  `NISN` int(50) NOT NULL,
  `NIP` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$12$XE5anXNCYlsEdAcaHMUca.0D2nL.WhGEu3B6rZUs3seMHiyOj1SP.', NULL, NULL, NULL, 1),
(2, NULL, '23456678', 'oca@gmail.com', NULL, 'oca123', NULL, NULL, NULL, 0),
(3, NULL, '66553', 'rossa@gmail.com', NULL, '$2y$12$XE5anXNCYlsEdAcaHMUca.0D2nL.WhGEu3B6rZUs3seMHiyOj1SP.', NULL, NULL, NULL, 0),
(5, NULL, '123445', 'oke@gmail.com', NULL, '$2y$12$UV9wzmK9jlZ467d9ZObnveUep8FaHYHNyCoOpb3BAHw0muPb351Lq', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vkeaktifan`
-- (See below for the actual view)
--
CREATE TABLE `vkeaktifan` (
`id_keaktifan` int(50)
,`id_siswa` int(11)
,`nama_siswa` varchar(255)
,`isverif` tinyint(1)
,`nama_kegiatan` varchar(255)
,`waktu` date
,`foto` varchar(255)
,`penyelenggara` varchar(255)
,`note` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vprestasi`
-- (See below for the actual view)
--
CREATE TABLE `vprestasi` (
`id_prestasi` int(50)
,`id_siswa` int(11)
,`nama_siswa` varchar(255)
,`isverif` tinyint(1)
,`judul` varchar(255)
,`penyelenggara` varchar(255)
,`bukti` varchar(255)
,`tingkat` varchar(255)
,`tanggal` date
,`note` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `vkeaktifan`
--
DROP TABLE IF EXISTS `vkeaktifan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vkeaktifan`  AS SELECT `a`.`id_keaktifan` AS `id_keaktifan`, `a`.`id_siswa` AS `id_siswa`, `b`.`nama_siswa` AS `nama_siswa`, `a`.`isverif` AS `isverif`, `a`.`nama_kegiatan` AS `nama_kegiatan`, `a`.`waktu` AS `waktu`, `a`.`foto` AS `foto`, `a`.`penyelenggara` AS `penyelenggara`, `a`.`note` AS `note` FROM (`keaktifan` `a` left join `siswa` `b` on(`a`.`id_siswa` = `b`.`id_siswa`))  ;

-- --------------------------------------------------------

--
-- Structure for view `vprestasi`
--
DROP TABLE IF EXISTS `vprestasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vprestasi`  AS SELECT `a`.`id_prestasi` AS `id_prestasi`, `a`.`id_siswa` AS `id_siswa`, `b`.`nama_siswa` AS `nama_siswa`, `a`.`isverif` AS `isverif`, `a`.`judul` AS `judul`, `a`.`penyelenggara` AS `penyelenggara`, `a`.`bukti` AS `bukti`, `a`.`tingkat` AS `tingkat`, `a`.`tanggal` AS `tanggal`, `a`.`note` AS `note` FROM (`prestasi` `a` left join `siswa` `b` on(`a`.`id_siswa` = `b`.`id_siswa`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `infolomba`
--
ALTER TABLE `infolomba`
  ADD PRIMARY KEY (`id_infolomba`);

--
-- Indexes for table `keaktifan`
--
ALTER TABLE `keaktifan`
  ADD PRIMARY KEY (`id_keaktifan`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id_prestasi`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `infolomba`
--
ALTER TABLE `infolomba`
  MODIFY `id_infolomba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keaktifan`
--
ALTER TABLE `keaktifan`
  MODIFY `id_keaktifan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id_prestasi` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
