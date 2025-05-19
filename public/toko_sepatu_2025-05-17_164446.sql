-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: toko_sepatu
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id_customer` int NOT NULL AUTO_INCREMENT,
  `id_users` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id_customer`),
  KEY `fk_customer_users1_idx` (`id_users`),
  CONSTRAINT `fk_customer_users1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (10,17,'Deni Malik','deni@mail.com','085354737856','Jl. Ardipura No. 24'),(11,18,'Bagus Joko Susilo','bagus@mail.com','085354737856','Jl. Ardipura No. 24');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

--
-- Table structure for table `keranjang`
--

DROP TABLE IF EXISTS `keranjang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keranjang` (
  `id_keranjang` int NOT NULL AUTO_INCREMENT,
  `id_customer` int NOT NULL,
  `id_variant` int NOT NULL,
  `qty` int DEFAULT NULL,
  PRIMARY KEY (`id_keranjang`),
  KEY `fk_keranjang_customer1_idx` (`id_customer`),
  KEY `fk_keranjang_variant1_idx` (`id_variant`),
  CONSTRAINT `fk_keranjang_customer1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  CONSTRAINT `fk_keranjang_variant1` FOREIGN KEY (`id_variant`) REFERENCES `variant` (`id_variant`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keranjang`
--

/*!40000 ALTER TABLE `keranjang` DISABLE KEYS */;
/*!40000 ALTER TABLE `keranjang` ENABLE KEYS */;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id_order` int NOT NULL AUTO_INCREMENT,
  `id_customer` int DEFAULT NULL,
  `id_area` int DEFAULT NULL,
  `kode_order` varchar(45) DEFAULT NULL,
  `tanggal_order` datetime DEFAULT NULL,
  `status` enum('Pending','Paid','Proses','Terkirim','Batal') DEFAULT NULL,
  `total` double DEFAULT NULL,
  `alamat_pengirim` text,
  PRIMARY KEY (`id_order`),
  KEY `fk_order_customer1_idx` (`id_customer`),
  KEY `fk_order_service_area1_idx` (`id_area`),
  CONSTRAINT `fk_order_customer1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  CONSTRAINT `fk_order_service_area1` FOREIGN KEY (`id_area`) REFERENCES `service_area` (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (7,NULL,NULL,'#608419','2025-05-17 05:38:44','Paid',2998000,NULL),(9,NULL,NULL,'#390175','2025-05-17 05:40:34','Paid',1399000,NULL),(10,10,5,'#6492805','2025-05-17 07:22:11','Pending',1499000,'Jl. Ardipura No. 24');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_item` (
  `id_item` int NOT NULL AUTO_INCREMENT,
  `id_order` int NOT NULL,
  `id_variant` int NOT NULL,
  `qty` int DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`id_item`),
  KEY `fk_order_item_order1_idx` (`id_order`),
  KEY `fk_order_item_variant1_idx` (`id_variant`),
  CONSTRAINT `fk_order_item_order1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`),
  CONSTRAINT `fk_order_item_variant1` FOREIGN KEY (`id_variant`) REFERENCES `variant` (`id_variant`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
INSERT INTO `order_item` VALUES (9,7,19,2,1499000),(10,9,22,1,1399000),(11,10,17,1,1499000);
/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL AUTO_INCREMENT,
  `id_order` int NOT NULL,
  `metode_bayar` enum('Transfer','COD') DEFAULT NULL,
  `status_bayar` enum('Pending','Confirmed','Failed') DEFAULT NULL,
  `tanggal_bayar` datetime DEFAULT NULL,
  `bukti_bayar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `fk_pembayaran_order1_idx` (`id_order`),
  CONSTRAINT `fk_pembayaran_order1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` VALUES (4,10,'Transfer',NULL,'2025-05-15 19:25:00','68283997699fe.jpeg');
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;

--
-- Table structure for table `pembelian`
--

DROP TABLE IF EXISTS `pembelian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembelian` (
  `id_pembelian` int NOT NULL AUTO_INCREMENT,
  `tanggal_pembelian` date DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `id_variant` int NOT NULL,
  `harga_beli` double DEFAULT NULL,
  PRIMARY KEY (`id_pembelian`),
  KEY `fk_pembelian_variant1_idx` (`id_variant`),
  CONSTRAINT `fk_pembelian_variant1` FOREIGN KEY (`id_variant`) REFERENCES `variant` (`id_variant`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembelian`
--

/*!40000 ALTER TABLE `pembelian` DISABLE KEYS */;
INSERT INTO `pembelian` VALUES (13,'2025-05-09',10,15,900000),(14,'2025-05-10',10,16,1000000),(15,'2025-05-10',10,25,900000),(16,'2025-05-10',10,17,1100000),(17,'2025-05-10',10,18,1100000),(18,'2025-05-10',10,19,1100000),(19,'2025-05-10',10,20,1000000),(20,'2025-05-10',10,21,1000000),(21,'2025-05-10',10,22,1000000),(22,'2025-05-10',10,23,1200000),(23,'2025-05-10',10,24,1200000);
/*!40000 ALTER TABLE `pembelian` ENABLE KEYS */;

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produk` (
  `id_produk` int NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(70) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produk`
--

/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
INSERT INTO `produk` VALUES (5,'Cavell Men\'s Sneakers',1099000,'<h3>Gambaran Umum Produk</h3>\n<div>\n<p>Skechers Cavell - Sparkman adalah sepatu waterproof yang stylish dan cocok untuk segala musim. Dengan desain smart-casual yang modern, sepatu ini memiliki upper faux leather yang halus, heel trim, dan insole Skechers Air-Cooled Memory Foam untuk kenyamanan maksimal. Outsole rubber memberikan grip yang kuat, cocok untuk pecinta kegiatan outdoor maupun aktivitas sehari-hari. Sepatu ini menggabungkan teknologi canggih dan desain fashionable untuk gaya hidup aktif.</p>\n</div>\n<p>&nbsp;</p>\n<h3>Fitur Utama dan Manfaat</h3>\n<div>\n<ul>\n<li><strong>Detail Desain:</strong>&nbsp;Sepatu ini memiliki upper faux leather yang halus dengan trim tumit yang stylish.</li>\n<li><strong>Fitur Utama:</strong>&nbsp;Desain waterproof yang menjaga kaki tetap kering di segala cuaca.</li>\n<li><strong>Material:</strong>&nbsp;Dibuat dengan bahan sintetis, outsole karet, dan insole tekstil untuk kenyamanan dan daya tahan.</li>\n<li><strong>Branding:</strong>&nbsp;Logo Skechers yang menonjol di sisi dan tumit.</li>\n<li><strong>Fitur Sekunder:</strong>&nbsp;Dilengkapi dengan Skechers Air-Cooled Memory Foam untuk bantalan yang nyaman.</li>\n<li><strong>Berat/Dimensi:</strong>&nbsp;Desain low-top dengan fit klasik, cocok untuk dipakai sepanjang tahun.</li>\n</ul>\n</div>\n<p>&nbsp;</p>\n<h3>Tips Gaya</h3>\n<div>\n<ul>\n<li>Padukan Skechers Cavell Men\'s Sneakers ini dengan jeans denim gelap dan kemeja kasual untuk tampilan santai namun rapi.</li>\n<li>Untuk gaya bisnis kasual, cocokkan dengan celana khaki dan kemeja putih bersih.</li>\n<li>Rasakan nuansa outdoor dengan memakainya bersama celana pendek cargo dan kaos yang breathable.</li>\n<li>Lapisi jaket ringan di atas kaos sederhana dan jeans untuk outfit transisi yang stylish.</li>\n<li>Koordinasikan dengan warna-warna alami seperti olive atau beige untuk palet warna yang harmonis.</li>\n</ul>\n</div>\n<p>&nbsp;</p>\n<h3>Panduan Ukuran</h3>\n<p>&nbsp;</p>\n<div>\n<ul>\n<li>Cara Mengukur Kaki Anda: Untuk mengukur kaki Anda, berdirilah di atas selembar kertas, jejakkan kaki Anda, dan ukur dari belakang tumit hingga ujung jari terpanjang Anda.</li>\n<li>Tips Ukuran: Jika Anda lebih suka ruang ekstra, pertimbangkan untuk menaikkan setengah ukuran.</li>\n<li>Catatan Ukuran Tambahan: Mohon melihat ke tabel ukuran untuk detail lebih lanjut.</li>\n</ul>\n</div>\n<p>&nbsp;</p>\n<h3>Label Perawatan</h3>\n<div>\n<p>Petunjuk Pembersihan: Cuci dengan tangan, hindari mesin cuci.Panduan Pengeringan: Jemur alami, hindari panas langsung.Perawatan Khusus Sesuai Bahan: Bersihkan bagian kulit dengan kain lembut.</p>\n</div>'),(6,'D\'Lux Trekker Men\'s Sneakers',1499000,'<h3>Gambaran Umum Produk</h3>\n<p>Siap menjelajah dengan&nbsp;<strong>Skechers Relaxed Fit&reg;: D\'Lux Trekker</strong>, sepatu yang dirancang untuk kenyamanan dan ketahanan. Terinspirasi oleh semangat petualangan, sneaker ini memiliki&nbsp;<strong>upper kulit, mesh, dan sintetis yang tahan air</strong>, menjaga kaki tetap kering. Insole&nbsp;<strong>Skechers Air-Cooled Memory Foam&reg;</strong>&nbsp;memberikan kenyamanan luar biasa, sementara&nbsp;<strong>Goodyear&reg; Performance Outsole</strong>&nbsp;menawarkan traksi dan stabilitas yang unggul. Dengan desain tali sporty dan tinggi tumit 2 inci, sepatu ini sempurna untuk berjalan di jalur dan penggunaan sehari-hari. Logo Skechers menambah sentuhan branding, menjadikannya pilihan stylish untuk segala kesempatan.</p>\n<h3>Fitur Utama dan Manfaat</h3>\n<ul>\n<li><strong>Detail Desain:</strong>&nbsp;Sepatu ini memiliki desain sporty dengan tali yang nyaman dan upper yang terbuat dari kulit, mesh, dan bahan sintetis.</li>\n<li><strong>Fitur Utama:</strong>&nbsp;Dilengkapi dengan Skechers Air-Cooled Memory Foam&reg; untuk kenyamanan maksimal dan Goodyear&reg; Performance Outsole yang memberikan traksi dan stabilitas.</li>\n<li><strong>Material:</strong>&nbsp;Upper terbuat dari kulit, mesh, dan bahan sintetis yang tahan air, serta midsole yang empuk dan mendukung.</li>\n<li><strong>Branding atau Identitas:</strong>&nbsp;Logo Skechers yang terlihat jelas pada bagian samping sepatu.</li>\n<li><strong>Fitur Sekunder:</strong>&nbsp;Anti-slip di bawah kondisi basah dan kering, serta tinggi tumit 2 inci.</li>\n</ul>\n<h3>Tips Gaya</h3>\n<ul>\n<li>Padukan sepatu ini dengan celana cargo dan kaos yang nyaman untuk petualangan luar ruangan yang santai.</li>\n<li>Untuk tampilan sporty, kenakan dengan celana olahraga dan atasan yang menyerap keringat.</li>\n<li>Kombinasikan dengan jeans denim dan kemeja kotak-kotak untuk suasana akhir pekan yang santai.</li>\n<li>Lapisi dengan jaket ringan dan celana jogger untuk hiking di cuaca dingin.</li>\n<li>Cocokkan dengan blazer kasual dan celana chino untuk acara santai yang cerdas.</li>\n</ul>\n<h3>Panduan Ukuran</h3>\n<ul>\n<li>Cara Mengukur Kaki Anda: Untuk mengukur kaki Anda, berdirilah di atas selembar kertas, jejakkan kaki Anda, dan ukur dari belakang tumit hingga ujung jari terpanjang Anda.</li>\n<li>Tips Ukuran: Jika Anda lebih suka ruang ekstra, pertimbangkan untuk menaikkan setengah ukuran.</li>\n<li>Catatan Ukuran Tambahan: Mohon melihat ke tabel ukuran untuk detail lebih lanjut.</li>\n</ul>\n<h3>Label Perawatan</h3>\n<ul>\n<li><strong>Petunjuk Pembersihan:</strong>&nbsp;Cuci dengan tangan, hindari mesin cuci.</li>\n<li><strong>Agen Pembersih yang Cocok:</strong>&nbsp;Gunakan deterjen ringan, hindari pemutih.</li>\n<li><strong>Panduan Pengeringan:</strong>&nbsp;Jemur alami, hindari panas langsung.</li>\n<li><strong>Rekomendasi Penyimpanan:</strong>&nbsp;Simpan di tempat sejuk dan kering.</li>\n<li><strong>Perawatan Khusus Sesuai Bahan:</strong> Kulit dan mesh, hindari air berlebih.</li>\n</ul>'),(8,'Skechers Slip-Ins Glide-Step',1399000,'<h3>Gambaran Umum Produk</h3>\n<div>\n<p>Sepatu Skechers Slip-Ins Glide-Step Pro adalah pilihan sempurna untuk pecinta kenyamanan dan gaya. Dengan desain modern yang sporty, sepatu ini dilengkapi teknologi eksklusif Heel Pillow&trade; yang memberikan support terbaik. Upper berbahan knit yang breathable dan stretch laces membuat sepatu ini mudah dipakai. Ditambah dengan insole Skechers Air-Cooled Memory Foam&reg; yang nyaman dan midsole Glide-Step&reg; yang memberikan momentum alami di setiap langkah. Cocok untuk lifestyle aktif dan santai!</p>\n</div>\n<p>&nbsp;</p>\n<h3>Fitur Utama dan Manfaat</h3>\n<div>\n<ul>\n<li><strong>Detail Desain:</strong>&nbsp;Memiliki knit yang dirancang dengan tali elastis untuk kenyamanan yang pas dan outsole fleksibel untuk grip yang lebih baik.</li>\n<li><strong>Fitur Utama:</strong>&nbsp;Exclusive Heel Pillow&trade; menjaga kaki tetap aman, memberikan pengalaman slip-in tanpa tangan.</li>\n<li><strong>Material:</strong>&nbsp;Dibuat dengan bahan 100% vegan, termasuk insole Skechers Air-Cooled Memory Foam&reg; untuk kenyamanan dan breathability.</li>\n<li><strong>Branding atau Identitas:</strong>&nbsp;Detail logo Skechers&reg; yang menonjol di sisi.</li>\n<li><strong>Fitur Sekunder:</strong>&nbsp;Glide-Step&reg; midsole geometris dirancang untuk memberikan momentum alami setiap langkah.</li>\n<li><strong>Berat/Dimensi:</strong>&nbsp;Tinggi tumit 1 1/2 inci.</li>\n<li><strong>Manfaat Tambahan:</strong>&nbsp;Dapat dicuci dengan mesin untuk perawatan yang mudah.</li>\n</ul>\n</div>\n<p>&nbsp;</p>\n<h3>Tips Gaya</h3>\n<div>\n<ul>\n<li>Padukan Skechers Slip-Ins hitam ini dengan jeans denim gelap dan kemeja putih untuk tampilan kasual yang rapi.</li>\n<li>Untuk gaya sporty, cocokkan dengan celana pendek olahraga favorit dan tank top yang breathable. Desain Glide-Step Pro memastikan kenyamanan selama berolahraga.</li>\n<li>Tingkatkan gaya jalananmu dengan memakai sepatu ini bersama jaket bomber dan jogger. Desain serba hitam cocok dengan palet warna apapun.</li>\n<li>Sepatu ini sempurna untuk perjalanan; kenakan dengan celana chino yang nyaman dan sweater ringan untuk penerbangan panjang.</li>\n<li>Untuk tampilan santai di akhir pekan, padukan dengan celana pendek cargo dan kaos grafis. Insole Air-Cooled Memory Foam akan membuatmu nyaman sepanjang hari.</li>\n</ul>\n</div>\n<p>&nbsp;</p>\n<h3>Panduan Ukuran</h3>\n<div>\n<ul>\n<li>Cara Mengukur Kaki Anda: Untuk mengukur kaki Anda, berdirilah di atas selembar kertas, jejakkan kaki Anda, dan ukur dari belakang tumit hingga ujung jari terpanjang Anda.</li>\n<li>Tips Ukuran: Jika Anda lebih suka ruang ekstra, pertimbangkan untuk menaikkan setengah ukuran.</li>\n<li>Catatan Ukuran Tambahan: Mohon melihat ke tabel ukuran untuk detail lebih lanjut.</li>\n</ul>\n</div>\n<p>&nbsp;</p>\n<h3>Label Perawatan</h3>\n<div>\n<p><strong>Petunjuk Pembersihan:</strong>&nbsp;Cuci dengan tangan menggunakan deterjen ringan, hindari pemutih.<strong>Penyimpanan:</strong>&nbsp;Simpan di tempat sejuk dan kering.<br><strong>Perawatan Khusus:</strong> Bahan vegan, hindari kontak dengan bahan kimia keras</p>\n</div>'),(9,'Slip-Ins Glide-Step Altus Men\'s',1599999,'<h3>Gambaran Umum Produk</h3>\n<div>\n<p>Rasakan gaya dan kenyamanan tanpa usaha dengan <strong>Skechers Slip-Ins Glide-Step Altus</strong>. Sepatu ini dilengkapi dengan&nbsp;<strong>Comfort Pillow</strong>&nbsp;unik di bagian tumit, upper mesh yang dirancang, dan insole Skechers Air-Cooled Memory Foam. Midsole&nbsp;<strong>Glide-Step</strong>&nbsp;yang empuk memberikan momentum alami di setiap langkah. Cocok untuk mereka yang mencari perpaduan gaya, inovasi, dan kenyamanan.</p>\n</div>\n<p>&nbsp;</p>\n<h3>Fitur Utama dan Manfaat</h3>\n<div>\n<ul>\n<li><strong>Desain Modern:</strong>&nbsp;Sepatu ini memiliki desain yang stylish dan modern, cocok untuk pecinta kegiatan outdoor.</li>\n<li><strong>Fitur Utama:</strong>&nbsp;Dilengkapi dengan teknologi Slip-ins dan Glide-Step untuk kenyamanan maksimal dan momentum alami setiap langkah.</li>\n<li><strong>Material:</strong>&nbsp;Upper terbuat dari mesh yang breathable dan insole menggunakan Air-Cooled Memory Foam untuk kenyamanan ekstra.</li>\n<li><strong>Branding:</strong>&nbsp;Logo Skechers yang mencolok pada bagian samping sepatu.</li>\n<li><strong>Fitur Sekunder:</strong>&nbsp;Outsole super fleksibel dan dapat dicuci dengan mesin.</li>\n</ul>\n</div>\n<p>&nbsp;</p>\n<h3>Tips Gaya</h3>\n<div>\n<ul>\n<li>Padukan sepatu ini dengan celana pendek olahraga dan kaos yang breathable untuk tampilan sporty.</li>\n<li>Untuk acara santai, kenakan dengan jeans dan kaos polo.</li>\n<li>Cocokkan dengan jogger dan hoodie untuk outfit perjalanan yang nyaman.</li>\n<li>Gabungkan dengan tracksuit untuk tampilan atletik yang serasi.</li>\n<li>Kenakan dengan chino dan blazer kasual untuk gaya smart-casual.</li>\n</ul>\n</div>\n<p>&nbsp;</p>\n<h3>Panduan Ukuran</h3>\n<div>\n<ul>\n<li>Cara Mengukur Kaki Anda: Untuk mengukur kaki Anda, berdirilah di atas selembar kertas, jejakkan kaki Anda, dan ukur dari belakang tumit hingga ujung jari terpanjang Anda.</li>\n<li>Tips Ukuran: Jika Anda lebih suka ruang ekstra, pertimbangkan untuk menaikkan setengah ukuran.</li>\n<li>Catatan Ukuran Tambahan: Mohon melihat ke tabel ukuran untuk detail lebih lanjut</li>\n</ul>\n</div>');
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;

--
-- Table structure for table `service_area`
--

DROP TABLE IF EXISTS `service_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_area` (
  `id_area` int NOT NULL AUTO_INCREMENT,
  `nama_area` varchar(45) DEFAULT NULL,
  `harga_kirim` double DEFAULT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_area`
--

/*!40000 ALTER TABLE `service_area` DISABLE KEYS */;
INSERT INTO `service_area` VALUES (1,'Jayapura',0),(2,'Abepura',5000),(4,'Entrop',5000),(5,'Sorong',25000),(6,'Biak',30000);
/*!40000 ALTER TABLE `service_area` ENABLE KEYS */;

--
-- Table structure for table `toko`
--

DROP TABLE IF EXISTS `toko`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `toko` (
  `id_toko` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` text,
  `telepon` varchar(45) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `bank` varchar(45) DEFAULT NULL,
  `rekening` varchar(50) DEFAULT NULL,
  `nama_rekening` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `toko`
--

/*!40000 ALTER TABLE `toko` DISABLE KEYS */;
INSERT INTO `toko` VALUES (1,'Snikers Jayapura','Jl. Ardipura II No. 24 D Kota Jayapura','0967 545215','6819f18f382c6.png','Bank Danamon','032145221254854','Deni Malik');
/*!40000 ALTER TABLE `toko` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_users` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (16,'Administrator','$2y$10$2oqejg66uIvvYRaNiAkaA.fD1NWPY1rSCUvnAzxA3nWNEtPLPmG1W','admin'),(17,'deni','$2y$10$RHQ0zjaGLymuuZJ/dxE78e/u2cYiXDMxKAwDQeKAPj9IF9n.97wSO','customer'),(18,'bagus','$2y$10$uEhgywPpPpg5/Egkj5OiLux8dlCqzfCQST/vt.cjp4JXuOreGcQVa','customer');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Table structure for table `variant`
--

DROP TABLE IF EXISTS `variant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `variant` (
  `id_variant` int NOT NULL AUTO_INCREMENT,
  `id_produk` int NOT NULL,
  `ukuran` double DEFAULT NULL,
  `warna` varchar(45) DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_variant`),
  KEY `fk_variant_produk_idx` (`id_produk`),
  CONSTRAINT `fk_variant_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variant`
--

/*!40000 ALTER TABLE `variant` DISABLE KEYS */;
INSERT INTO `variant` VALUES (15,5,29,'Putih',10,'68280e144f3b0.jpeg'),(16,5,29,'Hitam',10,'68280e5b5a1bf.jpeg'),(17,6,29,'Hitam',10,'68280ea82e84f.jpeg'),(18,6,29,'Putih',10,'68280eb2edfa5.jpeg'),(19,6,30,'Hitam',8,'68280ebc7bc92.jpeg'),(20,8,31,'Hitam',10,'68280ec743941.jpeg'),(21,8,31,'Putih',10,'68280ecf6500e.jpeg'),(22,8,32,'Hitan',9,'68280ed970d93.jpeg'),(23,9,29,'Putih',10,'68280ef9df490.jpeg'),(24,9,29,'Hitam',10,'68280f034805f.jpeg'),(25,5,29,'Coklat',10,'68280e94da220.jpeg');
/*!40000 ALTER TABLE `variant` ENABLE KEYS */;

--
-- Dumping routines for database 'toko_sepatu'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-17 16:45:01
