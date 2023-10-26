/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100427
 Source Host           : localhost:3306
 Source Schema         : rental_mobil

 Target Server Type    : MySQL
 Target Server Version : 100427
 File Encoding         : 65001

 Date: 26/10/2023 10:14:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_akun
-- ----------------------------
DROP TABLE IF EXISTS `tbl_akun`;
CREATE TABLE `tbl_akun`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_perusahaanref` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_akun
-- ----------------------------
INSERT INTO `tbl_akun` VALUES (4, 'Administrator', 'admin', '$2y$10$N44XtSWGKO4AA.1DLyH2EOWrwxbRwpwWINpfuv83WuD4Ro1r19nq2', 'administrator-1579273408.png', 1);
INSERT INTO `tbl_akun` VALUES (5, 'Fakhrul Fanani Nugroho', 'nugrohoff', '$2y$10$MzYgUN41HVHtmLixc40jxuBwXbstCYqeCxMTitlUsTcEIO8KdN.Su', 'fakhrul-fanani-nugroho-1579279638.jpg', 1);

-- ----------------------------
-- Table structure for tbl_jenis_bayar
-- ----------------------------
DROP TABLE IF EXISTS `tbl_jenis_bayar`;
CREATE TABLE `tbl_jenis_bayar`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenis_bayar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_jenis_bayar
-- ----------------------------
INSERT INTO `tbl_jenis_bayar` VALUES (3, 'Lepas Kunci');
INSERT INTO `tbl_jenis_bayar` VALUES (4, 'Mobil dan Supir');
INSERT INTO `tbl_jenis_bayar` VALUES (5, 'All In');

-- ----------------------------
-- Table structure for tbl_merk
-- ----------------------------
DROP TABLE IF EXISTS `tbl_merk`;
CREATE TABLE `tbl_merk`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `merk` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_perusahaanref` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_merk
-- ----------------------------
INSERT INTO `tbl_merk` VALUES (8, 'Toyota', 1);
INSERT INTO `tbl_merk` VALUES (9, 'Suzuki', 1);
INSERT INTO `tbl_merk` VALUES (12, 'Mitusbishix', 1);

-- ----------------------------
-- Table structure for tbl_mobil
-- ----------------------------
DROP TABLE IF EXISTS `tbl_mobil`;
CREATE TABLE `tbl_mobil`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `warna` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_polisi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jumlah_kursi` int NULL DEFAULT NULL,
  `tahun_beli` int NULL DEFAULT NULL,
  `gambar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_merk` int NULL DEFAULT NULL,
  `id_perusahaanref` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tbl_mobil_ibfk_2`(`id_merk`) USING BTREE,
  CONSTRAINT `tbl_mobil_ibfk_2` FOREIGN KEY (`id_merk`) REFERENCES `tbl_merk` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_mobil
-- ----------------------------
INSERT INTO `tbl_mobil` VALUES (13, 'Toyota Kijang LGX', 'Putih', 'R 6788 KM', 6, 2019, 'toyota-kijang-innova-1577631464.png', 8, 1);
INSERT INTO `tbl_mobil` VALUES (14, 'Toyota Kijang Innova', 'Abu Abu', 'R 1309 KN', 7, 2018, 'toyota-kijang-innova-1579004786.png', 8, 1);
INSERT INTO `tbl_mobil` VALUES (15, 'Suzuki All New Ertiga', 'Putih', 'R 1739 KN', 8, 2018, 'suzuki-all-new-ertiga-1579279546.png', 9, 1);

-- ----------------------------
-- Table structure for tbl_pemesan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pemesan`;
CREATE TABLE `tbl_pemesan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_perusahaanref` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pemesan
-- ----------------------------
INSERT INTO `tbl_pemesan` VALUES (6, 'Fakhrul', 'Sidareja', 'L', 'fakhrul-1579004931.jpg', 1);
INSERT INTO `tbl_pemesan` VALUES (7, 'Fanani', 'Sidareja', 'L', 'fanani-1579275545.png', 1);
INSERT INTO `tbl_pemesan` VALUES (8, 'Fanani', 'Sidareja', 'L', 'fanani-1579275545.png', 2);
INSERT INTO `tbl_pemesan` VALUES (10, 'wan', 'wawawwawaaw', 'P', NULL, 1);

-- ----------------------------
-- Table structure for tbl_perjalanan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_perjalanan`;
CREATE TABLE `tbl_perjalanan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `asal` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tujuan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jarak` int NULL DEFAULT NULL,
  `id_perusahaanref` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_perjalanan
-- ----------------------------
INSERT INTO `tbl_perjalanan` VALUES (1, 'pending', 'Jogjakarta', 300, 1);
INSERT INTO `tbl_perjalanan` VALUES (2, 'proses', 'Ciamis', 70, 1);
INSERT INTO `tbl_perjalanan` VALUES (3, 'done', 'aceh', 800, 1);

-- ----------------------------
-- Table structure for tbl_pesanan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pesanan`;
CREATE TABLE `tbl_pesanan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `harga` int NULL DEFAULT NULL,
  `tgl_pinjam` date NULL DEFAULT NULL,
  `tgl_kembali` date NULL DEFAULT NULL,
  `id_pemesan` int NULL DEFAULT NULL,
  `id_mobil` int NULL DEFAULT NULL,
  `id_perjalanan` int NULL DEFAULT NULL,
  `id_jenis_bayar` int NULL DEFAULT NULL,
  `id_perusahaanref` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pemesan`(`id_pemesan`) USING BTREE,
  INDEX `id_mobil`(`id_mobil`) USING BTREE,
  INDEX `id_perjalanan`(`id_perjalanan`) USING BTREE,
  INDEX `id_jenis_bayar`(`id_jenis_bayar`) USING BTREE,
  CONSTRAINT `tbl_pesanan_ibfk_1` FOREIGN KEY (`id_pemesan`) REFERENCES `tbl_pemesan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `tbl_pesanan_ibfk_2` FOREIGN KEY (`id_mobil`) REFERENCES `tbl_mobil` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `tbl_pesanan_ibfk_3` FOREIGN KEY (`id_perjalanan`) REFERENCES `tbl_perjalanan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `tbl_pesanan_ibfk_4` FOREIGN KEY (`id_jenis_bayar`) REFERENCES `tbl_jenis_bayar` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pesanan
-- ----------------------------
INSERT INTO `tbl_pesanan` VALUES (1, 1000000, '2020-01-01', '2020-01-04', 8, 13, 1, 3, 2);
INSERT INTO `tbl_pesanan` VALUES (6, 2000000, '2020-01-17', '2020-01-20', 6, 14, 1, 3, 1);
INSERT INTO `tbl_pesanan` VALUES (8, 1500000, '2020-01-18', '2020-01-21', 7, 15, 2, 3, 1);
INSERT INTO `tbl_pesanan` VALUES (10, 700000, '2023-10-15', '2023-10-17', 10, 15, 1, 3, 1);
INSERT INTO `tbl_pesanan` VALUES (11, 250000, '2023-10-16', '2023-10-17', 7, 14, 3, 3, 1);

-- ----------------------------
-- Table structure for tbl_pesanan2
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pesanan2`;
CREATE TABLE `tbl_pesanan2`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `booking_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga` int NULL DEFAULT NULL,
  `tgl_pinjam` date NULL DEFAULT NULL,
  `tgl_kembali` date NULL DEFAULT NULL,
  `id_pemesan` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_mobil` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_perjalanan` int NULL DEFAULT NULL,
  `id_jenis_bayar` int NULL DEFAULT NULL,
  `id_perusahaanref` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pesanan2
-- ----------------------------
INSERT INTO `tbl_pesanan2` VALUES (4, 'BOK23102601', 400000, '2023-10-26', '2023-10-27', 'wan', 'xpander', 2, 4, 1);
INSERT INTO `tbl_pesanan2` VALUES (10, 'BOK2310262OCP', 300000, '2023-10-26', '2023-10-27', 'Fakhrul', 'xpander', 1, 3, 1);

-- ----------------------------
-- Table structure for tperusahaan
-- ----------------------------
DROP TABLE IF EXISTS `tperusahaan`;
CREATE TABLE `tperusahaan`  (
  `id_perusahaan` int NULL DEFAULT NULL,
  `nama_perusahaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `telp` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `logo` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `dateupdate` datetime(0) NULL DEFAULT NULL,
  `userupdate` int NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tperusahaan
-- ----------------------------
INSERT INTO `tperusahaan` VALUES (1, 'PT.Berdikari', 'Jl.Sei bahorok Medan', '081361333457', 'email@email.com', '1-1697359751.png', '2023-10-15 19:18:56', 4);

-- ----------------------------
-- Table structure for ttuk
-- ----------------------------
DROP TABLE IF EXISTS `ttuk`;
CREATE TABLE `ttuk`  (
  `idtuk` int NOT NULL AUTO_INCREMENT,
  `nametuk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`idtuk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ttuk
-- ----------------------------
INSERT INTO `ttuk` VALUES (1, 'Service');
INSERT INTO `ttuk` VALUES (2, 'Gaji Driver');
INSERT INTO `ttuk` VALUES (3, 'Lain-lain');

-- ----------------------------
-- Table structure for tuangkeluar
-- ----------------------------
DROP TABLE IF EXISTS `tuangkeluar`;
CREATE TABLE `tuangkeluar`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `typeuk` int NULL DEFAULT NULL,
  `ketuk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rpuk` int NULL DEFAULT NULL,
  `tgluk` date NULL DEFAULT NULL,
  `userinput` int NULL DEFAULT NULL,
  `id_perusahaanref` int NULL DEFAULT NULL,
  `datecreated` datetime(0) NULL DEFAULT NULL,
  `userupdate` int NULL DEFAULT NULL,
  `dateupdate` datetime(0) NULL DEFAULT NULL,
  `booking_code` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pesanan_id` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fkttuk`(`typeuk`) USING BTREE,
  CONSTRAINT `fkttuk` FOREIGN KEY (`typeuk`) REFERENCES `ttuk` (`idtuk`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tuangkeluar
-- ----------------------------
INSERT INTO `tuangkeluar` VALUES (3, 1, 'serice rem mobil a', 250000, '2023-10-16', 4, 1, '2023-10-16 09:03:55', 4, '2023-10-16 19:12:12', NULL, NULL);
INSERT INTO `tuangkeluar` VALUES (4, 3, 'ada aaja', 51000, '2023-10-18', 4, 1, '2023-10-16 09:12:43', 4, '2023-10-16 19:12:33', NULL, NULL);
INSERT INTO `tuangkeluar` VALUES (5, 3, 'uang tempel ban', 1000, '2023-10-17', 4, 1, '2023-10-16 19:03:49', 4, '2023-10-16 19:05:18', NULL, NULL);
INSERT INTO `tuangkeluar` VALUES (6, 1, 'batang', 30000, '2023-10-26', 4, 1, '2023-10-26 10:08:51', NULL, NULL, 'BOK2310262OCP', 10);

-- ----------------------------
-- View structure for vrekap
-- ----------------------------
DROP VIEW IF EXISTS `vrekap`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `vrekap` AS select * from (
SELECT DATE_FORMAT(tgl_pinjam,'%d-%m-%Y') as tgl,sum(tbl_pesanan2.harga) as nominal ,'UM' as trans,tbl_pesanan2.id_perusahaanref,tgl_pinjam as tgltrans FROM `tbl_pesanan2`
group by DATE_FORMAT(tgl_pinjam,'%d-%m-%Y'),tbl_pesanan2.id_perusahaanref
union all
SELECT DATE_FORMAT(tuangkeluar.tgluk,'%d-%m-%Y') as tgl,sum(rpuk) as nominal,'UK' as trans,tuangkeluar.id_perusahaanref,tgluk as tgltrans FROM `tuangkeluar`
group by DATE_FORMAT(tuangkeluar.tgluk,'%d-%m-%Y'),tuangkeluar.id_perusahaanref
) a
order by tgltrans,trans ;

SET FOREIGN_KEY_CHECKS = 1;
