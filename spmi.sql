-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Mar 2022 pada 09.51
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spmi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_induk`
--

CREATE TABLE `data_induk` (
  `induk_id` int(11) NOT NULL,
  `kategori_id` varchar(10) NOT NULL,
  `nama_induk` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_induk`
--

INSERT INTO `data_induk` (`induk_id`, `kategori_id`, `nama_induk`, `created_at`, `updated_at`) VALUES
(1, 'PEN', 'Judul PKM', '2022-03-26 18:04:42', '2022-03-26 18:04:42'),
(1, 'PPM', 'Judul PKM', '2022-03-26 18:04:42', '2022-03-26 18:04:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `indikator`
--

CREATE TABLE `indikator` (
  `indikator_id` int(11) NOT NULL,
  `kategori_id` varchar(10) NOT NULL,
  `standar_id` varchar(5) NOT NULL,
  `nama_indikator` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `nilai_acuan` int(15) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `induk_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `indikator`
--

INSERT INTO `indikator` (`indikator_id`, `kategori_id`, `standar_id`, `nama_indikator`, `target`, `nilai_acuan`, `satuan`, `keterangan`, `induk_id`, `created_at`, `updated_at`) VALUES
(1, 'PEN', 'S1', 'Indikator 1', 'Target 1', 0, '', '', 1, '2022-03-26 18:05:35', '2022-03-26 18:05:35'),
(1, 'PPM', 'S1', '', '', 0, '', '', 1, '2022-03-27 07:38:44', '2022-03-27 07:38:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` varchar(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `nama_kategori`) VALUES
('PEN', 'Penelitian'),
('PPM', 'Pengabdian Masyarakat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `tahun` int(11) NOT NULL,
  `unit_id` varchar(20) NOT NULL,
  `kategori_id` varchar(10) NOT NULL,
  `standar_id` varchar(5) NOT NULL,
  `indikator_id` int(11) NOT NULL,
  `nilai_input` int(11) NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `hasil` int(11) NOT NULL,
  `nilai_akhir` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`tahun`, `unit_id`, `kategori_id`, `standar_id`, `indikator_id`, `nilai_input`, `dokumen`, `keterangan`, `catatan`, `status`, `hasil`, `nilai_akhir`, `created_at`, `updated_at`) VALUES
(2022, 'infor', 'PEN', 'S1', 1, 1, 'dokumen-1-S1-infor-PEN-2022pdf', 'ksdskjui', '', 'Dikirim', 100, 100, '2022-03-27 07:26:27', '2022-03-27 15:28:27'),
(2022, 'infor', 'PPM', 'S1', 1, 1, '', '', '', 'Dikirim', 1, 1, '2022-03-27 07:40:13', '2022-03-27 15:28:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `role`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'auditor'),
(4, 'pimpinan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `standar`
--

CREATE TABLE `standar` (
  `standar_id` varchar(5) NOT NULL,
  `kategori_id` varchar(20) NOT NULL,
  `nama_standar` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `standar`
--

INSERT INTO `standar` (`standar_id`, `kategori_id`, `nama_standar`, `created_at`, `updated_at`) VALUES
('S1', 'PEN', 'Standar Hasil', '2022-03-26 18:03:54', '2022-03-26 18:03:54'),
('S1', 'PPM', 'Standar Hasil', '2022-03-26 18:03:53', '2022-03-26 18:03:53'),
('S6', 'PEN', '', '2022-03-28 01:32:36', '2022-03-28 01:32:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supercode`
--

CREATE TABLE `supercode` (
  `id` int(11) NOT NULL,
  `supercode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supercode`
--

INSERT INTO `supercode` (`id`, `supercode`) VALUES
(1, '$2y$10$ufF4qOpdmH51RsZcmCrdouQrb8ByWjYAh2FmF4hWYpd3/2cq7Oo7m');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun`
--

CREATE TABLE `tahun` (
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tahun`
--

INSERT INTO `tahun` (`tahun`) VALUES
(2019),
(2020),
(2021),
(2022);

-- --------------------------------------------------------

--
-- Struktur dari tabel `units`
--

CREATE TABLE `units` (
  `unit_id` varchar(20) NOT NULL,
  `nama_unit` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `units`
--

INSERT INTO `units` (`unit_id`, `nama_unit`, `created_at`, `updated_at`) VALUES
('infor', 'S1 - Informatika', '2022-03-26 17:06:47', '2022-03-26 17:06:47'),
('lppm', 'LPPM', '2022-03-26 17:06:47', '2022-03-26 17:06:47'),
('mesin', 'S1 Teknik Mesin', '2022-03-27 23:36:54', '2022-03-27 23:36:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_induk_tahun`
--

CREATE TABLE `unit_induk_tahun` (
  `tahun` int(11) NOT NULL,
  `unit_id` varchar(20) NOT NULL,
  `induk_id` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `unit_induk_tahun`
--

INSERT INTO `unit_induk_tahun` (`tahun`, `unit_id`, `induk_id`, `nilai`, `created_at`, `updated_at`) VALUES
(2022, 'infor', 1, 90, '2022-03-27 06:49:21', '2022-03-27 07:25:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `email` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`email`, `nama`, `nip`, `telp`, `foto`, `password`, `created_at`, `updated_at`) VALUES
('email@gmail.com', 'orang', '', '', '', '$2y$10$onlYvVTD4vaRJScd4TMuo.UI9.r5YJXdeswxlqEmhIBUDJASEz5B6', '2022-03-27 16:20:22', '2022-03-27 16:20:22'),
('irul@gmail.com', 'Irul', '', '', '', '$2y$10$SlMNeWp/xB.gxiy94CQ/V.IW57mcOrTajXQHbrvGIatOvnCCzP8A6', '2022-03-27 16:04:02', '2022-03-27 16:04:02'),
('iwan.suryaningrat28@gmail.com', 'Iwan Suryaningrat', '24060119120027', '088802851811', 'foto-iwan.suryaningrat28@gmail.com.jpg', '$2y$10$RIEP4l5cJ/mxXFTM/IuWROc.TQV1Gk4yQI3dfFNy6B6Z01IO.SN5y', '2022-03-26 16:51:22', '2022-03-27 11:40:24'),
('iwan@gmail.com', 'iwan', '', '', '', '$2y$10$TzX.4wpax5LmfpMgzgUQ4OpJ6fqDEr2bYvW97LnySVVX6HpQ96aE6', '2022-03-27 16:18:45', '2022-03-27 16:18:45'),
('iwansuryaningrat@students.undip.ac.id', 'Iwan Suryaningrat', '', '', 'default.png', '$2y$10$wRjof3KUnWwBfB3XdELsYuPXtUZKXvMeUG0DturLnU30j2sVbY.jO', '2022-03-26 11:59:42', '2022-03-26 11:59:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role_unit`
--

CREATE TABLE `user_role_unit` (
  `email` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `unit_id` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role_unit`
--

INSERT INTO `user_role_unit` (`email`, `role_id`, `unit_id`, `tahun`, `created_at`, `updated_at`) VALUES
('email@gmail.com', 3, 'infor', 2019, '2022-03-27 18:29:54', '2022-03-27 18:29:54'),
('iwan.suryaningrat28@gmail.com', 1, 'infor', 2021, '2022-03-27 17:47:26', '2022-03-27 17:47:26'),
('iwan.suryaningrat28@gmail.com', 1, 'infor', 2022, '2022-03-26 17:08:18', '2022-03-26 17:08:18'),
('iwan.suryaningrat28@gmail.com', 1, 'lppm', 2022, '2022-03-26 17:08:18', '2022-03-26 17:08:18'),
('iwan.suryaningrat28@gmail.com', 3, 'lppm', 2022, '2022-03-26 21:01:07', '2022-03-26 21:01:07'),
('iwansuryaningrat@students.undip.ac.id', 2, 'lppm', 2022, '2022-03-26 11:59:42', '2022-03-26 11:59:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_unit`
--

CREATE TABLE `user_unit` (
  `email` varchar(100) NOT NULL,
  `unit_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_induk`
--
ALTER TABLE `data_induk`
  ADD PRIMARY KEY (`induk_id`,`kategori_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`indikator_id`,`kategori_id`,`standar_id`),
  ADD KEY `induk_fk` (`induk_id`),
  ADD KEY `standar_fk` (`standar_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`tahun`,`unit_id`,`kategori_id`,`standar_id`,`indikator_id`),
  ADD KEY `indikator_fk` (`indikator_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `standar_id` (`standar_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `standar`
--
ALTER TABLE `standar`
  ADD PRIMARY KEY (`standar_id`,`kategori_id`),
  ADD KEY `kategori_fk` (`kategori_id`);

--
-- Indeks untuk tabel `supercode`
--
ALTER TABLE `supercode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`tahun`);

--
-- Indeks untuk tabel `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indeks untuk tabel `unit_induk_tahun`
--
ALTER TABLE `unit_induk_tahun`
  ADD PRIMARY KEY (`tahun`,`unit_id`,`induk_id`),
  ADD KEY `induk_id` (`induk_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `user_role_unit`
--
ALTER TABLE `user_role_unit`
  ADD PRIMARY KEY (`email`,`role_id`,`unit_id`,`tahun`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `tahun` (`tahun`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indeks untuk tabel `user_unit`
--
ALTER TABLE `user_unit`
  ADD PRIMARY KEY (`email`,`unit_id`),
  ADD KEY `unit_fk` (`unit_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `supercode`
--
ALTER TABLE `supercode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tahun`
--
ALTER TABLE `tahun`
  MODIFY `tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2023;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_induk`
--
ALTER TABLE `data_induk`
  ADD CONSTRAINT `data_induk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`);

--
-- Ketidakleluasaan untuk tabel `indikator`
--
ALTER TABLE `indikator`
  ADD CONSTRAINT `indikator_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`),
  ADD CONSTRAINT `induk_fk` FOREIGN KEY (`induk_id`) REFERENCES `data_induk` (`induk_id`),
  ADD CONSTRAINT `standar_fk` FOREIGN KEY (`standar_id`) REFERENCES `standar` (`standar_id`);

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `indikator_fk` FOREIGN KEY (`indikator_id`) REFERENCES `indikator` (`indikator_id`),
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`),
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`tahun`) REFERENCES `tahun` (`tahun`),
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`),
  ADD CONSTRAINT `penilaian_ibfk_4` FOREIGN KEY (`standar_id`) REFERENCES `standar` (`standar_id`);

--
-- Ketidakleluasaan untuk tabel `standar`
--
ALTER TABLE `standar`
  ADD CONSTRAINT `kategori_fk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`);

--
-- Ketidakleluasaan untuk tabel `unit_induk_tahun`
--
ALTER TABLE `unit_induk_tahun`
  ADD CONSTRAINT `induk_id` FOREIGN KEY (`induk_id`) REFERENCES `data_induk` (`induk_id`),
  ADD CONSTRAINT `tahun_fk` FOREIGN KEY (`tahun`) REFERENCES `tahun` (`tahun`),
  ADD CONSTRAINT `unit_induk_tahun_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`);

--
-- Ketidakleluasaan untuk tabel `user_role_unit`
--
ALTER TABLE `user_role_unit`
  ADD CONSTRAINT `user_role_unit_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `user_role_unit_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `user_role_unit_ibfk_3` FOREIGN KEY (`tahun`) REFERENCES `tahun` (`tahun`),
  ADD CONSTRAINT `user_role_unit_ibfk_4` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`);

--
-- Ketidakleluasaan untuk tabel `user_unit`
--
ALTER TABLE `user_unit`
  ADD CONSTRAINT `unit_fk` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`),
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
