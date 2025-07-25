-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: toko_sepatu
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

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
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  PRIMARY KEY (`id_customer`),
  KEY `fk_customer_users1_idx` (`id_users`),
  CONSTRAINT `fk_customer_users1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) DEFAULT NULL,
  `gender` enum('Pria','Wanita','Unisex') DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,'Kids','Unisex'),(2,'Runnig','Unisex'),(3,'Basket ball','Unisex'),(4,'Casual','Unisex');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;

--
-- Table structure for table `keranjang`
--

DROP TABLE IF EXISTS `keranjang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) NOT NULL,
  `id_variant` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_keranjang`),
  KEY `fk_keranjang_customer1_idx` (`id_customer`),
  KEY `fk_keranjang_variant1_idx` (`id_variant`),
  CONSTRAINT `fk_keranjang_customer1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_keranjang_variant1` FOREIGN KEY (`id_variant`) REFERENCES `variant` (`id_variant`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
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
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_customer` int(11) DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `kode_order` varchar(45) DEFAULT NULL,
  `tanggal_order` datetime DEFAULT NULL,
  `status` enum('Pending','Paid','Proses','Selesai','Batal') DEFAULT NULL,
  `total` double DEFAULT NULL,
  `alamat_pengirim` text DEFAULT NULL,
  PRIMARY KEY (`id_order`),
  KEY `fk_order_customer1_idx` (`id_customer`),
  KEY `fk_order_service_area1_idx` (`id_area`),
  CONSTRAINT `fk_order_customer1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_service_area1` FOREIGN KEY (`id_area`) REFERENCES `service_area` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_variant` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`id_item`),
  KEY `fk_order_item_order1_idx` (`id_order`),
  KEY `fk_order_item_variant1_idx` (`id_variant`),
  CONSTRAINT `fk_order_item_order1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_item_variant1` FOREIGN KEY (`id_variant`) REFERENCES `variant` (`id_variant`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `metode_bayar` enum('Transfer','COD') DEFAULT NULL,
  `status_bayar` enum('Pending','Confirmed','Failed') DEFAULT NULL,
  `tanggal_bayar` datetime DEFAULT NULL,
  `bukti_bayar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `fk_pembayaran_order1_idx` (`id_order`),
  CONSTRAINT `fk_pembayaran_order1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;

--
-- Table structure for table `pembelian`
--

DROP TABLE IF EXISTS `pembelian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_pembelian` date DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `id_variant` int(11) NOT NULL,
  `harga_beli` double DEFAULT NULL,
  PRIMARY KEY (`id_pembelian`),
  KEY `fk_pembelian_variant1_idx` (`id_variant`),
  CONSTRAINT `fk_pembelian_variant1` FOREIGN KEY (`id_variant`) REFERENCES `variant` (`id_variant`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembelian`
--

/*!40000 ALTER TABLE `pembelian` DISABLE KEYS */;
INSERT INTO `pembelian` VALUES (9,'2025-05-01',20,28,800000),(15,'2025-05-02',25,29,800000),(16,'2025-05-03',30,30,800000),(17,'2025-06-20',25,31,700000),(18,'2025-06-21',35,32,700000),(19,'2025-06-22',40,33,700000),(20,'2025-07-05',10,34,600000),(21,'2025-07-06',15,35,600000),(22,'2025-05-11',15,36,800000),(23,'2025-05-12',15,37,800000),(24,'2025-07-21',20,38,400000),(25,'2025-07-22',40,39,400000),(26,'2025-04-01',15,40,500000),(27,'2025-04-02',25,41,500000),(28,'2025-04-11',10,42,250000),(29,'2025-04-12',12,43,250000),(30,'2025-04-13',20,44,300000),(31,'2025-04-14',15,45,300000);
/*!40000 ALTER TABLE `pembelian` ENABLE KEYS */;

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(70) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `fk_produk_kategori1_idx` (`id_kategori`),
  CONSTRAINT `fk_produk_kategori1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produk`
--

/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
INSERT INTO `produk` VALUES (12,'Air Jordan',1000000,'<p>100% PREMIUM ORIGINAL MATERIAL GUARANTEE<br>100% REALPICT GUARANTEE<br>100% FULL REFUND jika barang yg diterima beda dengan foto realpict<br><br>Why us :<br>TOKO SNEAKERS TERBESAR<br>100% TERPERCAYA<br><br>REPUTASI TOKO SANGAT BAIK<br><br>Jika anda ragu, silahkan cek review &amp; rating toko kami. Review &amp; rating tidak mungkin bohong</p>',3),(13,'Nike',800000,'<p>(-) Setiap brand dan produk memiliki ukuran yang berbeda, mohon lihat info ukuran sebelum membeli dan sesuaikan dengan ukuran tubuh Anda.<br><br>(-) Warna hanya 90% sama dengan gambar. Perbedaan warna pada foto produk dengan produk real dapat disebabkan karena fotografi dan proses editing</p>',3),(14,'Adidas',700000,'<p>Note :&nbsp;<br><br>- Produk di SNEAKERS 100% original, jaminan uang kembali jika produk tidak original.<br><br>- Untuk Stok tersedia sesuai varian yang tersedia.<br><br>- Jika ragu ingin memilih size, dapat konsultasi ke admin mengenai detail size.<br><br>- Penukaran produk jika pengiriman TIDAK SESUAI DENGAN PESANAN.&nbsp;<br><br>- Untuk produk yang rusak, mohon sertakan video unboxing saat komplain.</p>',2),(15,'Pumma',800000,'<p>FITUR &amp; MANFAAT<br>Bagian atas sepatu dibuat dengan setidaknya 20% bahan daur ulang<br>NITROFOAM: Busa canggih yang mengandung nitrogen yang dirancang untuk memberikan respons dan bantalan superior dalam kemasan yang ringan<br>PWRPLATE: Pelat serat karbon dirancang untuk menstabilkan midsole sekaligus memaksimalkan perpindahan energi<br>RINCIAN<br>Cocok untuk segala usia</p>',2),(16,'Adidas Samba',500000,'<p>Brand New with Tag / Box<br>100% Original Authentic<br>100% Trusted since 2016<br><br>Semua produk yang dijual telah melalui tahap pengecekan keaslian dan kondisi fisik oleh staff ahli kami<br><br>Ketersediaan size sesuai dengan stok yang aktif<br><br>Penukaran produk diperbolehkan, selama sesuai dengan ketentuan retur produk</p>',4),(17,'New Balance',600000,'<p>Barang&nbsp;yang&nbsp;kita&nbsp;jual&nbsp;sudah&nbsp;terjamin&nbsp;kualitas&nbsp;nya&nbsp;<br>dan&nbsp;selalu&nbsp;kita&nbsp;cek&nbsp;sebelum&nbsp;di&nbsp;kirim&nbsp;agar&nbsp;kalian&nbsp;<br>mendapatkan yang terbaik. Setelah&nbsp;order&nbsp;harap&nbsp;bersabar&nbsp;pesanan&nbsp;kalian&nbsp;pasti&nbsp;<br>akan&nbsp;kita&nbsp;proses.&nbsp;pemesanan&nbsp;sebelum&nbsp;jam&nbsp;16.00&nbsp;<br>akan ikut pengiriman di hari yang sama</p>',4),(18,'Pumma',300000,'<p>Sepatu anak ini terbuat dari bahan kulit polyurethane<br>Apa itu kulit polyurethane ?<br>kulit polyurethane ialah bahan kulit buatan yang paling populer belakangan ini di<br>dunia fashion.<br><br>Kulit ini memperoleh sejumlah sifat yang berguna, yang memberikan keunggulan yang tak terbantahkan dibandingkan kulit asli, seperti:<br>- Sol pada bagian bawah anti slip sehingga aman dan nyaman untuk digunakan si kecil<br>- Ketahanan aus yang tinggi<br>- Bebas dari bahan tambahan berbahaya, kulit PU - ramah lingkungan<br>- Memiliki sifat sentuhan yang lebih lembut dibanding kulit lainnya<br>- Bahan yang cukup awet dan tahan lama<br>- Kulit PU tidak meregang atau retak<br>- Tahan terhadap suhu rendah dan tinggi<br>- Bahan PU leather dengan mudah bisa dicuci dan tidak rusak<br>- Bahan PU leather relatif tidak mudah terlihat kusam<br>- Tahan terhadap goresan<br>- Meskipun terkena ciaran kimia ringan atau terpapar sinar matahari terlalu lama PU leather tidak akan gampang<br>berubah warna.</p>',1),(19,'Nike',400000,'<p>Sepatu Anak Unisex (bisa di pakai Anak Laki-Laki &amp; Perempuan )<br>- 100% sesuai gambar<br>- Bahan : PU (Poliurethane), Bahan kuat, awet, nyaman dipakai, sepatu anak sporty yang cocok buat aktifitas sang buah hati<br>anda sehari-hari.<br>- Sepatu anak ini sangat ringan nyaman dipakai dan dijamin tidak licin dilantai<br>- Desain kekinian, cocok untuk koleksi sepatu anak anda.</p>',1);
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rating` tinyint(4) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `id_produk` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_review_produk1_idx` (`id_produk`),
  KEY `fk_review_users1_idx` (`id_users`),
  CONSTRAINT `fk_review_produk1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_review_users1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

/*!40000 ALTER TABLE `review` DISABLE KEYS */;
/*!40000 ALTER TABLE `review` ENABLE KEYS */;

--
-- Table structure for table `service_area`
--

DROP TABLE IF EXISTS `service_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_area` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `nama_area` varchar(45) DEFAULT NULL,
  `harga_kirim` double DEFAULT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_area`
--

/*!40000 ALTER TABLE `service_area` DISABLE KEYS */;
INSERT INTO `service_area` VALUES (2,'dok 5',20000),(3,'Kotaraja',10000),(4,'Sentani',25000);
/*!40000 ALTER TABLE `service_area` ENABLE KEYS */;

--
-- Table structure for table `toko`
--

DROP TABLE IF EXISTS `toko`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(45) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `bank` varchar(45) DEFAULT NULL,
  `rekening` varchar(50) DEFAULT NULL,
  `nama_rekening` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `toko`
--

/*!40000 ALTER TABLE `toko` DISABLE KEYS */;
INSERT INTO `toko` VALUES (1,'Sneakers Jayapura','Jl. kotaraja perumahan pemda vim','081111111111','682aed8fe7e85.jpeg','Bank Rakyat Indonesia (BRI)','654635377776622','umi fitiria');
/*!40000 ALTER TABLE `toko` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','kasir','customer') DEFAULT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','$2y$10$u86aeOHSQaP45Asjxt18muHXkbP/5wP7eum870EivPN91iClQx5ZK','admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Table structure for table `variant`
--

DROP TABLE IF EXISTS `variant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `variant` (
  `id_variant` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `ukuran` double DEFAULT NULL,
  `warna` varchar(45) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_variant`),
  KEY `fk_variant_produk_idx` (`id_produk`),
  CONSTRAINT `fk_variant_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variant`
--

/*!40000 ALTER TABLE `variant` DISABLE KEYS */;
INSERT INTO `variant` VALUES (28,12,39,'Putih',20,'687889f926bb7.avif'),(29,12,40,'Hitam abu abu',25,'68788a2a82a59.jpeg'),(30,12,41,'Biru',30,'68788a534d744.jpeg'),(31,13,39,'Hitam putih',25,'687890d140689.jpeg'),(32,13,38,'Tosca',35,'6878913004ade.jpeg'),(33,13,40,'Cream',40,'6878917f5db64.jpeg'),(34,14,30,'Abu',10,'6879894bf38a8.jpeg'),(35,14,31,'Putih',15,'687989760827e.jpeg'),(36,15,37,'Navy',15,'687989cd383c9.jpeg'),(37,15,39,'Putih',15,'687989e4dac35.jpeg'),(38,16,37,'Cream',20,'68798c500f05c.jpeg'),(39,16,39,'Coksu',40,'68798c85ed8f2.jpeg'),(40,17,38,'Putih Pink',15,'68798e1eb6e28.jpeg'),(41,17,40,'Abu',25,'68798e4a62806.jpeg'),(42,18,23,'Hitam',10,'6879950b4b9e5.jpeg'),(43,18,26,'Navy',12,'68799565cdb68.jpeg'),(44,19,23,'Putih hitam',20,'6879a0e62628e.jpeg'),(45,19,25,'Putih',15,'6879a1078add4.jpeg');
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

-- Dump completed on 2025-07-20 15:47:09
