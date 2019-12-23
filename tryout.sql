/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : 127.0.0.1:3306
 Source Schema         : tryout

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 23/12/2019 07:54:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_guru
-- ----------------------------
DROP TABLE IF EXISTS `tbl_guru`;
CREATE TABLE `tbl_guru`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nik` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_sekolah` int(11) NULL DEFAULT NULL,
  `nomor_tlp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pembayaran` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_sekolah_guru`(`id_sekolah`) USING BTREE,
  CONSTRAINT `FK_sekolah_guru` FOREIGN KEY (`id_sekolah`) REFERENCES `tbl_sekolah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_guru
-- ----------------------------
INSERT INTO `tbl_guru` VALUES (34, 'Nama contoh guru 1', '123456789', 25, '08332673998381', 'Malang', 'contoh1', '25f9e794323b453885f5181f1b624d0b', '0');
INSERT INTO `tbl_guru` VALUES (35, 'Nama contoh guru 2', '12344537', 25, '083554783084', 'Malang', 'contoh2', 'c33565e9e715328fd304e38341a318e7', '0');
INSERT INTO `tbl_guru` VALUES (36, 'Nama contoh guru 3', '12344538', 25, '08667388983883', 'Malang', 'contoh3', '9d838cd91588303899f4e67e4e4d38b2', '0');
INSERT INTO `tbl_guru` VALUES (37, 'Nama contoh guru 4', '12344539', 25, '0846848088463', 'Malang', 'contoh4', '4914bb832e7af8c7305142d956c0f09d', '0');
INSERT INTO `tbl_guru` VALUES (38, 'Nama contoh guru 5', '123445310', 25, '0866478327478', 'Malang', 'contoh5', '1e149dd4f9056bdd74525175be8d133a', '0');

-- ----------------------------
-- Table structure for tbl_nomor_peserta
-- ----------------------------
DROP TABLE IF EXISTS `tbl_nomor_peserta`;
CREATE TABLE `tbl_nomor_peserta`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_peserta` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_nomor_peserta
-- ----------------------------
INSERT INTO `tbl_nomor_peserta` VALUES (1, '000');

-- ----------------------------
-- Table structure for tbl_ruangan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ruangan`;
CREATE TABLE `tbl_ruangan`  (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kapasitas` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_ruangan
-- ----------------------------
INSERT INTO `tbl_ruangan` VALUES (1, 'ruangan 1', 36);
INSERT INTO `tbl_ruangan` VALUES (3, 'ruangan 3', 32);
INSERT INTO `tbl_ruangan` VALUES (5, 'ruangan 2', 23);

-- ----------------------------
-- Table structure for tbl_sekolah
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sekolah`;
CREATE TABLE `tbl_sekolah`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `npsn` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_sekolah
-- ----------------------------
INSERT INTO `tbl_sekolah` VALUES (25, 'Sekolah 1', '88267', 'Malang');
INSERT INTO `tbl_sekolah` VALUES (26, 'Sekolah 2', '88289', 'Malang');
INSERT INTO `tbl_sekolah` VALUES (27, 'Sekolah 3', '89739', 'Malang');
INSERT INTO `tbl_sekolah` VALUES (28, 'coba sekolah', '012900993', 'surabaya');

-- ----------------------------
-- Table structure for tbl_siswa
-- ----------------------------
DROP TABLE IF EXISTS `tbl_siswa`;
CREATE TABLE `tbl_siswa`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nisn` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_tlp` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `id_asal_sekolah` int(11) NULL DEFAULT NULL,
  `id_nomor_peserta` int(11) NULL DEFAULT NULL,
  `pembayaran` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `tgl_mendaftar` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_asal_sekolah`(`id_asal_sekolah`) USING BTREE,
  INDEX `FK_siswa_nomor_peserta`(`id_nomor_peserta`) USING BTREE,
  CONSTRAINT `FK_asal_sekolah` FOREIGN KEY (`id_asal_sekolah`) REFERENCES `tbl_sekolah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_siswa_nomor_peserta` FOREIGN KEY (`id_nomor_peserta`) REFERENCES `tbl_nomor_peserta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_siswa_individu
-- ----------------------------
DROP TABLE IF EXISTS `tbl_siswa_individu`;
CREATE TABLE `tbl_siswa_individu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nisn` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_tlp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `asal_sekolah` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_nomor_peserta` int(11) NULL DEFAULT NULL,
  `pembayaran` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_mendaftar` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_siswa_individu_to_tbl_nomor_peserta`(`id_nomor_peserta`) USING BTREE,
  CONSTRAINT `FK_siswa_individu_to_tbl_nomor_peserta` FOREIGN KEY (`id_nomor_peserta`) REFERENCES `tbl_nomor_peserta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

SET FOREIGN_KEY_CHECKS = 1;
