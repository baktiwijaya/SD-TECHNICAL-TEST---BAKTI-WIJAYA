/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50637
 Source Host           : localhost:3306
 Source Schema         : technical_test

 Target Server Type    : MySQL
 Target Server Version : 50637
 File Encoding         : 65001

 Date: 31/05/2020 15:39:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for T_ANGGOTA
-- ----------------------------
DROP TABLE IF EXISTS `T_ANGGOTA`;
CREATE TABLE `T_ANGGOTA`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TIM` int(11) NULL DEFAULT NULL,
  `NAMA_ANGGOTA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TINGGI_BADAN` float(10, 2) NULL DEFAULT NULL,
  `BERAT_BADAN` float(10, 2) NULL DEFAULT NULL,
  `POSISI` int(11) NULL DEFAULT NULL,
  `NOMOR_PUNGGUNG` int(11) NULL DEFAULT NULL,
  `TGL_CREATE` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of T_ANGGOTA
-- ----------------------------
INSERT INTO `T_ANGGOTA` VALUES (2, 1, 'A Wijaya', 175.00, 50.00, 1, 10, '2020-05-31 12:48:11');
INSERT INTO `T_ANGGOTA` VALUES (3, 1, 'B Wijaya', 175.00, 50.00, 1, 11, '2020-05-31 12:49:38');
INSERT INTO `T_ANGGOTA` VALUES (4, 2, 'C Wijaya', 150.00, 40.00, 1, 11, '2020-05-31 15:21:54');
INSERT INTO `T_ANGGOTA` VALUES (5, 2, 'D Wijaya', 175.00, 40.00, 1, 10, '2020-05-31 15:22:20');

-- ----------------------------
-- Table structure for T_DETAIL_PERTANDINGAN
-- ----------------------------
DROP TABLE IF EXISTS `T_DETAIL_PERTANDINGAN`;
CREATE TABLE `T_DETAIL_PERTANDINGAN`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PERTANDINGAN` int(255) NULL DEFAULT NULL,
  `WAKTU` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ID_ANGGOTA` int(11) NULL DEFAULT NULL,
  `ID_TIM` int(11) NULL DEFAULT NULL,
  `TIPE` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of T_DETAIL_PERTANDINGAN
-- ----------------------------
INSERT INTO `T_DETAIL_PERTANDINGAN` VALUES (1, 1, '84', 3, 1, 1);
INSERT INTO `T_DETAIL_PERTANDINGAN` VALUES (2, 1, '84', 5, 2, 2);
INSERT INTO `T_DETAIL_PERTANDINGAN` VALUES (3, 1, '85', 2, 1, 3);
INSERT INTO `T_DETAIL_PERTANDINGAN` VALUES (4, 1, '94', 5, 2, 1);

-- ----------------------------
-- Table structure for T_PERTANDINGAN
-- ----------------------------
DROP TABLE IF EXISTS `T_PERTANDINGAN`;
CREATE TABLE `T_PERTANDINGAN`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TANGGAL_PERTANDINGAN` date NULL DEFAULT NULL,
  `JAM_PERTANDINGAN` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `TUAN_RUMAH` int(11) NULL DEFAULT NULL,
  `TAMU` int(11) NULL DEFAULT NULL,
  `TGL_CREATE` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of T_PERTANDINGAN
-- ----------------------------
INSERT INTO `T_PERTANDINGAN` VALUES (1, '2020-05-31', '14:00', 1, 2, '2020-05-31 13:19:37');

-- ----------------------------
-- Table structure for T_TIM
-- ----------------------------
DROP TABLE IF EXISTS `T_TIM`;
CREATE TABLE `T_TIM`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_TIM` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `LOGO_TIM` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TAHUN_BERDIRI` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ALAMAT` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `KOTA_MARKAS` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TGL_CREATE` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of T_TIM
-- ----------------------------
INSERT INTO `T_TIM` VALUES (1, 'Real Madrid', '1590905874_real_madrid.png', '2020', 'Jl. Mampang Prapatan', 'Bandung', '2020-05-31 12:25:07');
INSERT INTO `T_TIM` VALUES (2, 'Barcelona', '1590905686_barcelona.png', '2020', 'Jl. Spanyol', 'Spanyol', '2020-05-31 13:12:10');

-- ----------------------------
-- Table structure for USER
-- ----------------------------
DROP TABLE IF EXISTS `USER`;
CREATE TABLE `USER`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `image` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `level_unit` int(11) NULL DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `unit` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `telp` decimal(15, 0) NULL DEFAULT NULL,
  `createby` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_aktif` datetime(0) NULL DEFAULT NULL,
  `tgl_nonaktif` datetime(0) NULL DEFAULT NULL,
  `updateby` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tgl_update` datetime(0) NULL DEFAULT NULL,
  `is_ldap` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of USER
-- ----------------------------
INSERT INTO `USER` VALUES (1, 'Administrator', 'administrator@gmail.com', 'administrator', 'default.jpg', '$2y$10$ZoZLDxNIFHalm5JLe.EPQOtNitfaJztDG1lu2MfeLVpviIL58YIQW', 1, 1, 1, 1574836560, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1');

-- ----------------------------
-- Table structure for USER_ACCESS_MENU
-- ----------------------------
DROP TABLE IF EXISTS `USER_ACCESS_MENU`;
CREATE TABLE `USER_ACCESS_MENU`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of USER_ACCESS_MENU
-- ----------------------------
INSERT INTO `USER_ACCESS_MENU` VALUES (1, 1, 1);
INSERT INTO `USER_ACCESS_MENU` VALUES (7, 1, 3);
INSERT INTO `USER_ACCESS_MENU` VALUES (9, 1, 4);
INSERT INTO `USER_ACCESS_MENU` VALUES (10, 2, 1);
INSERT INTO `USER_ACCESS_MENU` VALUES (12, 2, 5);
INSERT INTO `USER_ACCESS_MENU` VALUES (13, 3, 1);
INSERT INTO `USER_ACCESS_MENU` VALUES (14, 1, 6);
INSERT INTO `USER_ACCESS_MENU` VALUES (15, 1, 7);
INSERT INTO `USER_ACCESS_MENU` VALUES (16, 1, 8);
INSERT INTO `USER_ACCESS_MENU` VALUES (17, 1, 5);

-- ----------------------------
-- Table structure for USER_MENU
-- ----------------------------
DROP TABLE IF EXISTS `USER_MENU`;
CREATE TABLE `USER_MENU`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of USER_MENU
-- ----------------------------
INSERT INTO `USER_MENU` VALUES (1, 'Admin');
INSERT INTO `USER_MENU` VALUES (2, 'User');
INSERT INTO `USER_MENU` VALUES (3, 'Menu');
INSERT INTO `USER_MENU` VALUES (4, 'User Management');
INSERT INTO `USER_MENU` VALUES (6, 'Master');
INSERT INTO `USER_MENU` VALUES (8, 'Dashboard');

-- ----------------------------
-- Table structure for USER_ROLE
-- ----------------------------
DROP TABLE IF EXISTS `USER_ROLE`;
CREATE TABLE `USER_ROLE`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of USER_ROLE
-- ----------------------------
INSERT INTO `USER_ROLE` VALUES (1, 'Administrator');
INSERT INTO `USER_ROLE` VALUES (2, 'User');

-- ----------------------------
-- Table structure for USER_SUB_MENU
-- ----------------------------
DROP TABLE IF EXISTS `USER_SUB_MENU`;
CREATE TABLE `USER_SUB_MENU`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `url` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `icon` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of USER_SUB_MENU
-- ----------------------------
INSERT INTO `USER_SUB_MENU` VALUES (1, 1, 'Dashboard', 'dashboard', 'fas fa-fw fa-tachometer-alt', 1);
INSERT INTO `USER_SUB_MENU` VALUES (2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1);
INSERT INTO `USER_SUB_MENU` VALUES (3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1);
INSERT INTO `USER_SUB_MENU` VALUES (4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1);
INSERT INTO `USER_SUB_MENU` VALUES (5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1);
INSERT INTO `USER_SUB_MENU` VALUES (7, 4, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1);
INSERT INTO `USER_SUB_MENU` VALUES (8, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1);
INSERT INTO `USER_SUB_MENU` VALUES (9, 6, 'Tim', 'tim', 'fas fa-fw fa-key', 1);
INSERT INTO `USER_SUB_MENU` VALUES (10, 6, 'Anggota Tim', 'anggota', 'fas fa-fw fa-key', 1);
INSERT INTO `USER_SUB_MENU` VALUES (11, 6, 'Pertandingan', 'pertandingan', 'fas fa-fw fa-key', 1);
INSERT INTO `USER_SUB_MENU` VALUES (12, 6, 'Detail Pertandingan', 'detail_pertandingan', 'fas fa-fw fa-key', 1);

-- ----------------------------
-- Procedure structure for collection_period
-- ----------------------------
DROP PROCEDURE IF EXISTS `collection_period`;
delimiter ;;
CREATE PROCEDURE `collection_period`(IN_TAHUN INT(4),
	IN_BULAN INT(2))
BEGIN
	DECLARE V_PIUTANG FLOAT(20,2) DEFAULT 0;
	DECLARE V_TOTAL_PENDAPATAN FLOAT(20,2) DEFAULT 0;
	DECLARE V_PIUTANG_BULANBERJALAN FLOAT(20,2) DEFAULT 0;
	DECLARE V_PIUTANG_AWAL FLOAT(20,2) DEFAULT 0;
	DECLARE V_PIUTANG_RATARATA FLOAT(20,2) DEFAULT 0;
	DECLARE V_PIUTANG_PENDAPATAN FLOAT(20,2) DEFAULT 0;
	DECLARE V_SELISIH_HARI INT(4) DEFAULT 0;
	DECLARE V_COP INT(4) DEFAULT 0;
	
	SELECT SUM(JUMLAH_PIUTANG) INTO V_PIUTANG FROM MASTER_PIUTANGAWAL WHERE TAHUN = IN_TAHUN;
	SELECT CASE WHEN SUM(REAL_REVSAP) IS NULL THEN 0 ELSE SUM(REAL_REVSAP) END INTO V_TOTAL_PENDAPATAN FROM TRX_SAP WHERE TAHUN = IN_TAHUN;
	SELECT SUM( TOTAL ) INTO V_PIUTANG_BULANBERJALAN FROM TRX_UPLOAD_PIUTANG 
	WHERE UPLOAD_KE = (SELECT MAX(UPLOAD_KE) FROM TRX_UPLOAD_PIUTANG) 
	AND MONTH ( TGL_CREATE ) = IN_BULAN 
	AND YEAR ( TGL_CREATE ) = IN_TAHUN;
	SELECT (V_PIUTANG_BULANBERJALAN / POWER(10,9)) INTO V_PIUTANG_AWAL FROM DUAL;
	SELECT (V_PIUTANG + V_PIUTANG_AWAL) / 2 INTO V_PIUTANG_RATARATA;
	SELECT V_PIUTANG_RATARATA / (V_TOTAL_PENDAPATAN / POWER(10,9)) INTO V_PIUTANG_PENDAPATAN;
	SELECT DATEDIFF(DATE_FORMAT(NOW(),'%Y-%m-%d'), DATE_FORMAT(CONCAT(IN_TAHUN,'01','01'),'%Y-%m-%d')) INTO V_SELISIH_HARI;
	SELECT V_PIUTANG_PENDAPATAN * V_SELISIH_HARI INTO V_COP;
	SELECT 
		CASE WHEN V_PIUTANG IS NULL THEN '-' ELSE V_PIUTANG END AS PIUTANG,
		CASE WHEN V_TOTAL_PENDAPATAN IS NULL THEN '-' ELSE V_TOTAL_PENDAPATAN END AS 	TOTAL_PENDAPATAN,
		CASE WHEN V_PIUTANG_BULANBERJALAN IS NULL THEN '-' ELSE V_PIUTANG_BULANBERJALAN END AS 	PIUTANG_BULANBERJALAN,
		CASE WHEN V_PIUTANG_AWAL IS NULL THEN '-' ELSE V_PIUTANG_AWAL END AS PIUTANG_AWAL,
		CASE WHEN V_PIUTANG_RATARATA IS NULL THEN '-' ELSE V_PIUTANG_RATARATA END AS PIUTANG_RATARATA,
		CASE WHEN V_PIUTANG_PENDAPATAN IS NULL THEN '-' ELSE V_PIUTANG_PENDAPATAN END AS PIUTANG_PENDAPATAN,
		CASE WHEN V_SELISIH_HARI IS NULL THEN '-' ELSE V_SELISIH_HARI END AS SELISIH_HARI,
		CASE WHEN V_COP IS NULL THEN '-' ELSE 	V_COP END AS COP 
	FROM DUAL;
	
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
