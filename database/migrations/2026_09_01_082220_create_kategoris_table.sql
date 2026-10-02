-- create_kategoris_table

CREATE TABLE IF NOT EXISTS `kategori` (
    id_kategori         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    keterangan          TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    kategori            VARCHAR(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;