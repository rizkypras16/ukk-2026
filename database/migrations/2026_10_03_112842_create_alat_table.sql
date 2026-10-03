-- create_alat_table

CREATE TABLE IF NOT EXISTS `alat` (
  `id_alat` int NOT NULL AUTO_INCREMENT,
  `kode_alat` varchar(20) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jumlah` int DEFAULT '0',
  `kondisi` varchar(50) DEFAULT 'Baik',
  PRIMARY KEY (`id_alat`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
