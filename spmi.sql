-- MySQL dump 10.13  Distrib 5.7.35, for Win64 (x86_64)
--
-- Host: localhost    Database: spmi
-- ------------------------------------------------------
-- Server version	5.7.35-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `data_induk`
--

DROP TABLE IF EXISTS `data_induk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_induk` (
  `induk_id` int(11) NOT NULL,
  `kategori_id` varchar(10) NOT NULL,
  `nama_induk` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`induk_id`,`kategori_id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `data_induk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_induk`
--

LOCK TABLES `data_induk` WRITE;
/*!40000 ALTER TABLE `data_induk` DISABLE KEYS */;
INSERT INTO `data_induk` VALUES (1,'PEN','Judul Penelitian','2022-03-26 18:04:42','2022-03-26 18:04:42'),(1,'PPM','Judul PPM','2022-03-26 18:04:42','2022-03-26 18:04:42'),(2,'PEN','Dokumen','2022-03-27 07:38:44','2022-03-27 07:38:44'),(2,'PPM','Dokumen','2022-03-27 07:38:44','2022-03-27 07:38:44');
/*!40000 ALTER TABLE `data_induk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indikator`
--

DROP TABLE IF EXISTS `indikator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`indikator_id`,`kategori_id`,`standar_id`),
  KEY `induk_fk` (`induk_id`),
  KEY `standar_fk` (`standar_id`),
  KEY `kategori_id` (`kategori_id`),
  CONSTRAINT `indikator_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`),
  CONSTRAINT `induk_fk` FOREIGN KEY (`induk_id`) REFERENCES `data_induk` (`induk_id`),
  CONSTRAINT `standar_fk` FOREIGN KEY (`standar_id`) REFERENCES `standar` (`standar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indikator`
--

LOCK TABLES `indikator` WRITE;
/*!40000 ALTER TABLE `indikator` DISABLE KEYS */;
INSERT INTO `indikator` VALUES (1,'PEN','S1','Tersedianya data Jumlah luaran Penelitian yang mendapat pengakuan HKI (Paten, Paten Sederhana)','Lebih dari nilai patokan luaran Penelitian yang mendapat pengakuan HKI (Paten, Paten Sederhana)',10,'Luaran','Judul HKI',1,'2022-03-26 18:05:35','2022-03-26 18:05:35'),(1,'PEN','S2','Kedalaman dan keluasan topik dan materi Penelitian kepada masyarakat bersumber dari hasil penelitian atau pengembangan ilmu pengetahuan dan teknologi yang sesuai dengan kebutuhan masyarakat','Adanya dokumen laporan penelitian kepada masyarakat bersumber dari hasil penelitian atau pengembangan ilmu pengetahuan dan teknologi yang sesuai dengan kebutuhan masyarakat',1,'Dokumen','Dokumen',2,'2022-03-27 07:38:44','2022-03-27 07:38:44'),(1,'PPM','S1','Tersedianya data Jumlah luaran PPM yang mendapat pengakuan HKI (Paten, Paten Sederhana)','Lebih dari nilai patokan luaran PPM yang mendapat pengakuan HKI (Paten, Paten Sederhana)',10,'Luaran','Judul HKI',1,'2022-03-27 07:38:44','2022-03-27 07:38:44'),(1,'PPM','S2','Kedalaman dan keluasan topik dan materi pengabdian kepada masyarakat bersumber dari hasil penelitian atau pengembangan ilmu pengetahuan dan teknologi yang sesuai dengan kebutuhan masyarakat','Adanya dokumen laporan pengabdian kepada masyarakat bersumber dari hasil penelitian atau pengembangan ilmu pengetahuan dan teknologi yang sesuai dengan kebutuhan masyarakat',1,'Dokumen','Dokumen',2,'2022-03-27 07:38:44','2022-03-27 07:38:44'),(2,'PEN','S1','Jumlah luaran PEN yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varietas Tanaman, Desain Tata Letak Sirkuit Terpadu, dll.)','Lebih dari nilai patokan luaran PEN yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varietas Tanaman, Desain Tata Letak Sirkuit Terpadu, dll.)',10,'Luaran','Judul',1,'2022-03-27 07:38:44','2022-03-27 07:38:44'),(2,'PPM','S1','Jumlah luaran PPM yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varietas Tanaman, Desain Tata Letak Sirkuit Terpadu, dll.)','Lebih dari nilai patokan luaran PPM yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varietas Tanaman, Desain Tata Letak Sirkuit Terpadu, dll.)',10,'Luaran','Judul',1,'2022-03-27 07:38:44','2022-03-27 07:38:44');
/*!40000 ALTER TABLE `indikator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `kategori_id` varchar(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES ('PEN','Penelitian'),('PPM','Pengabdian Masyarakat');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penilaian`
--

DROP TABLE IF EXISTS `penilaian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`tahun`,`unit_id`,`kategori_id`,`standar_id`,`indikator_id`),
  KEY `indikator_fk` (`indikator_id`),
  KEY `unit_id` (`unit_id`),
  KEY `kategori_id` (`kategori_id`),
  KEY `standar_id` (`standar_id`),
  CONSTRAINT `indikator_fk` FOREIGN KEY (`indikator_id`) REFERENCES `indikator` (`indikator_id`),
  CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`),
  CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`tahun`) REFERENCES `tahun` (`tahun`),
  CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`),
  CONSTRAINT `penilaian_ibfk_4` FOREIGN KEY (`standar_id`) REFERENCES `standar` (`standar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penilaian`
--

LOCK TABLES `penilaian` WRITE;
/*!40000 ALTER TABLE `penilaian` DISABLE KEYS */;
INSERT INTO `penilaian` VALUES (2022,'infor','PEN','S1',1,1,'dokumen-1-S1-infor-PEN-2022pdf','ksdskjui','','Dikirim',100,100,'2022-03-27 07:26:27','2022-03-27 15:28:27'),(2022,'infor','PPM','S1',1,1,'','','','Dikirim',1,1,'2022-03-27 07:40:13','2022-03-27 15:28:27'),(2022,'lppm','PEN','S1',1,1,' ',' ',' ',' ',0,0,'2022-03-27 07:40:13','2022-03-27 07:40:13'),(2022,'lppm','PEN','S1',2,1,' ',' ',' ',' ',0,0,'2022-03-27 07:40:13','2022-03-27 07:40:13'),(2022,'lppm','PEN','S2',1,1,' ',' ',' ',' ',0,0,'2022-03-27 07:40:13','2022-03-27 07:40:13'),(2022,'lppm','PPM','S1',1,1,' ',' ',' ',' ',0,0,'2022-03-27 07:40:13','2022-03-27 07:40:13'),(2022,'lppm','PPM','S1',2,1,' ',' ',' ',' ',0,0,'2022-03-27 07:40:13','2022-03-27 07:40:13'),(2022,'lppm','PPM','S2',1,1,' ',' ',' ',' ',0,0,'2022-03-27 07:40:13','2022-03-27 07:40:13');
/*!40000 ALTER TABLE `penilaian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'user'),(2,'admin'),(3,'auditor'),(4,'pimpinan');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `standar`
--

DROP TABLE IF EXISTS `standar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `standar` (
  `standar_id` varchar(5) NOT NULL,
  `kategori_id` varchar(20) NOT NULL,
  `nama_standar` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`standar_id`,`kategori_id`),
  KEY `kategori_fk` (`kategori_id`),
  CONSTRAINT `kategori_fk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `standar`
--

LOCK TABLES `standar` WRITE;
/*!40000 ALTER TABLE `standar` DISABLE KEYS */;
INSERT INTO `standar` VALUES ('S1','PEN','Standar Hasil Penelitian','2022-03-26 18:03:54','2022-03-26 18:03:54'),('S1','PPM','Standar Hasil PPM','2022-03-26 18:03:53','2022-03-26 18:03:53'),('S2','PEN','Standar Isi Penelitian','2022-03-28 01:32:36','2022-03-28 01:32:36'),('S2','PPM','Standar Isi PPM','2022-03-28 01:32:36','2022-03-28 01:32:36');
/*!40000 ALTER TABLE `standar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supercode`
--

DROP TABLE IF EXISTS `supercode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supercode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supercode` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supercode`
--

LOCK TABLES `supercode` WRITE;
/*!40000 ALTER TABLE `supercode` DISABLE KEYS */;
INSERT INTO `supercode` VALUES (1,'$2y$10$ufF4qOpdmH51RsZcmCrdouQrb8ByWjYAh2FmF4hWYpd3/2cq7Oo7m');
/*!40000 ALTER TABLE `supercode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tahun`
--

DROP TABLE IF EXISTS `tahun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tahun` (
  `tahun` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=2023 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tahun`
--

LOCK TABLES `tahun` WRITE;
/*!40000 ALTER TABLE `tahun` DISABLE KEYS */;
INSERT INTO `tahun` VALUES (2019),(2020),(2021),(2022);
/*!40000 ALTER TABLE `tahun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_induk_tahun`
--

DROP TABLE IF EXISTS `unit_induk_tahun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_induk_tahun` (
  `tahun` int(11) NOT NULL,
  `unit_id` varchar(20) NOT NULL,
  `induk_id` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`tahun`,`unit_id`,`induk_id`),
  KEY `induk_id` (`induk_id`),
  KEY `unit_id` (`unit_id`),
  CONSTRAINT `induk_id` FOREIGN KEY (`induk_id`) REFERENCES `data_induk` (`induk_id`),
  CONSTRAINT `tahun_fk` FOREIGN KEY (`tahun`) REFERENCES `tahun` (`tahun`),
  CONSTRAINT `unit_induk_tahun_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_induk_tahun`
--

LOCK TABLES `unit_induk_tahun` WRITE;
/*!40000 ALTER TABLE `unit_induk_tahun` DISABLE KEYS */;
INSERT INTO `unit_induk_tahun` VALUES (2022,'infor',1,90,'2022-03-27 06:49:21','2022-03-27 07:25:42'),(2022,'lppm',1,150,'2022-03-27 06:49:21','2022-03-27 06:49:21'),(2022,'lppm',2,1,'2022-03-27 06:49:21','2022-03-27 06:49:21');
/*!40000 ALTER TABLE `unit_induk_tahun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `unit_id` varchar(20) NOT NULL,
  `nama_unit` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES ('infor','S1 - Informatika','2022-03-26 17:06:47','2022-03-26 17:06:47'),('lppm','LPPM','2022-03-26 17:06:47','2022-03-26 17:06:47'),('mesin','S1 Teknik Mesin','2022-03-27 23:36:54','2022-03-27 23:36:54');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role_unit`
--

DROP TABLE IF EXISTS `user_role_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role_unit` (
  `email` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `unit_id` varchar(50) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`email`,`role_id`,`unit_id`,`tahun`),
  KEY `role_id` (`role_id`),
  KEY `tahun` (`tahun`),
  KEY `unit_id` (`unit_id`),
  CONSTRAINT `user_role_unit_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`),
  CONSTRAINT `user_role_unit_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  CONSTRAINT `user_role_unit_ibfk_3` FOREIGN KEY (`tahun`) REFERENCES `tahun` (`tahun`),
  CONSTRAINT `user_role_unit_ibfk_4` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role_unit`
--

LOCK TABLES `user_role_unit` WRITE;
/*!40000 ALTER TABLE `user_role_unit` DISABLE KEYS */;
INSERT INTO `user_role_unit` VALUES ('adminlppm@gmail.com',1,'lppm',2022,'2022-03-26 11:59:42','2022-03-26 11:59:42'),('email@gmail.com',3,'infor',2019,'2022-03-27 18:29:54','2022-03-27 18:29:54'),('iwan.suryaningrat28@gmail.com',1,'infor',2021,'2022-03-27 17:47:26','2022-03-27 17:47:26'),('iwan.suryaningrat28@gmail.com',1,'infor',2022,'2022-03-26 17:08:18','2022-03-26 17:08:18'),('iwan.suryaningrat28@gmail.com',1,'lppm',2022,'2022-03-26 17:08:18','2022-03-26 17:08:18'),('iwan.suryaningrat28@gmail.com',3,'lppm',2022,'2022-03-26 21:01:07','2022-03-26 21:01:07'),('iwansuryaningrat@students.undip.ac.id',2,'lppm',2022,'2022-03-26 11:59:42','2022-03-26 11:59:42');
/*!40000 ALTER TABLE `user_role_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_unit`
--

DROP TABLE IF EXISTS `user_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_unit` (
  `email` varchar(100) NOT NULL,
  `unit_id` varchar(20) NOT NULL,
  PRIMARY KEY (`email`,`unit_id`),
  KEY `unit_fk` (`unit_id`),
  CONSTRAINT `unit_fk` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`),
  CONSTRAINT `user_fk` FOREIGN KEY (`email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_unit`
--

LOCK TABLES `user_unit` WRITE;
/*!40000 ALTER TABLE `user_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `email` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('adminlppm@gmail.com','Admin LPPM',' ',' ',' ','$2y$10$9vDN2.Pe8BZJPJmAAsEg.ufJ7W2oEu4Sw3tyARH1v.LqIQzmRboi2','2022-03-26 11:59:42','2022-03-26 11:59:42'),('email@gmail.com','orang','','','','$2y$10$onlYvVTD4vaRJScd4TMuo.UI9.r5YJXdeswxlqEmhIBUDJASEz5B6','2022-03-27 16:20:22','2022-03-27 16:20:22'),('irul@gmail.com','Irul','','','','$2y$10$SlMNeWp/xB.gxiy94CQ/V.IW57mcOrTajXQHbrvGIatOvnCCzP8A6','2022-03-27 16:04:02','2022-03-27 16:04:02'),('iwan.suryaningrat28@gmail.com','Iwan Suryaningrat','24060119120027','088802851811','foto-iwan.suryaningrat28@gmail.com.jpg','$2y$10$RIEP4l5cJ/mxXFTM/IuWROc.TQV1Gk4yQI3dfFNy6B6Z01IO.SN5y','2022-03-26 16:51:22','2022-03-27 11:40:24'),('iwan@gmail.com','iwan','','','','$2y$10$TzX.4wpax5LmfpMgzgUQ4OpJ6fqDEr2bYvW97LnySVVX6HpQ96aE6','2022-03-27 16:18:45','2022-03-27 16:18:45'),('iwansuryaningrat@students.undip.ac.id','Iwan Suryaningrat','','','default.png','$2y$10$wRjof3KUnWwBfB3XdELsYuPXtUZKXvMeUG0DturLnU30j2sVbY.jO','2022-03-26 11:59:42','2022-03-26 11:59:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-29  8:24:32
