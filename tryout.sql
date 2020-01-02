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

 Date: 02/01/2020 15:31:40
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
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_guru
-- ----------------------------
INSERT INTO `tbl_guru` VALUES (39, 'ferdian ', '1234567', 31, '0834567289', 'malang', 'guru1', 'fcea920f7412b5da7be0cf42b8c93759', '0');
INSERT INTO `tbl_guru` VALUES (40, 'guru 2', '903893', 34, '08839939', 'malang', 'admin', 'd6c4c94cf13ea69b036d3029b5f23a50', '0');

-- ----------------------------
-- Table structure for tbl_nomor_peserta
-- ----------------------------
DROP TABLE IF EXISTS `tbl_nomor_peserta`;
CREATE TABLE `tbl_nomor_peserta`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_peserta` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_nomor_peserta
-- ----------------------------
INSERT INTO `tbl_nomor_peserta` VALUES (1, '100');
INSERT INTO `tbl_nomor_peserta` VALUES (18, '101');
INSERT INTO `tbl_nomor_peserta` VALUES (19, '102');
INSERT INTO `tbl_nomor_peserta` VALUES (20, '103');
INSERT INTO `tbl_nomor_peserta` VALUES (21, '104');

-- ----------------------------
-- Table structure for tbl_ruang_ujian
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ruang_ujian`;
CREATE TABLE `tbl_ruang_ujian`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NULL DEFAULT NULL,
  `id_ruangan` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_sekolah
-- ----------------------------
INSERT INTO `tbl_sekolah` VALUES (31, 'Sekolah 1', '88267', 'Malang');
INSERT INTO `tbl_sekolah` VALUES (32, 'Sekolah 2', '88289', 'Malang');
INSERT INTO `tbl_sekolah` VALUES (33, 'Sekolah 3', '89739', 'Malang');
INSERT INTO `tbl_sekolah` VALUES (34, 'coba 1', '920390', 'malang');

-- ----------------------------
-- Table structure for tbl_siswa
-- ----------------------------
DROP TABLE IF EXISTS `tbl_siswa`;
CREATE TABLE `tbl_siswa`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nisn` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_tlp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `asal_sekolah` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_nomor_peserta` int(11) NULL DEFAULT NULL,
  `pembayaran` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `tgl_mendaftar` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_siswa_individu_to_tbl_nomor_peserta`(`id_nomor_peserta`) USING BTREE,
  CONSTRAINT `FK_siswa_individu_to_tbl_nomor_peserta` FOREIGN KEY (`id_nomor_peserta`) REFERENCES `tbl_nomor_peserta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_siswa
-- ----------------------------
INSERT INTO `tbl_siswa` VALUES (6, 'Akhmad Khasan Abdullah', '201910370311032', 'Laki-laki', '083852413038', 'Malang', 'SMKN 8 MALANG', 18, '0', '2020-01-01 12:03:26');
INSERT INTO `tbl_siswa` VALUES (8, 'Muhammad Sulthoni Muharrom', '201910370311049', 'Laki-laki', '08321182777308', 'malang', 'Sekolah 1', 19, '0', '2020-01-02 11:08:47');
INSERT INTO `tbl_siswa` VALUES (9, 'Kharisma Nabil Pradipta', '201910370311038', 'Laki-laki', '0838929038', 'malang', 'Sekolah 1', 20, '0', '2020-01-02 11:12:48');
INSERT INTO `tbl_siswa` VALUES (10, 'Hasan Waulat', '201910370311043', 'Laki-laki', '0834554366639', 'Malang', 'Sekolah 1', 21, '0', '2020-01-02 11:15:25');

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
