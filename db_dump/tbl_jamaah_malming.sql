/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MariaDB
 Source Server Version : 100420
 Source Host           : localhost:3306
 Source Schema         : umroh_api

 Target Server Type    : MariaDB
 Target Server Version : 100420
 File Encoding         : 65001

 Date: 16/12/2023 22:59:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_jamaah
-- ----------------------------
DROP TABLE IF EXISTS `tbl_jamaah`;
CREATE TABLE `tbl_jamaah`  (
  `id_jamaah` int(10) NOT NULL AUTO_INCREMENT,
  `nama_jamaah` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_lahir` datetime(0) NULL DEFAULT NULL,
  `tempat_lahir` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usia` int(20) NULL DEFAULT NULL,
  `no_paspor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_paspor_publish` datetime(0) NULL DEFAULT NULL,
  `masa_berlaku_paspor` datetime(0) NULL DEFAULT NULL,
  `tempat_paspor_publish` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_lengkap` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_telp_wa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_mahram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hub_mahram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rencana_umroh_or_haji` datetime(0) NULL DEFAULT NULL,
  `pernah_umroh_or_haji_thn` datetime(0) NULL DEFAULT NULL,
  `kursi_roda` enum('Y','T') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `embarkasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `paket_haji_id` int(255) NULL DEFAULT NULL,
  `paket_umroh_id` int(255) NULL DEFAULT NULL,
  `uang_pembayaran` bigint(255) NULL DEFAULT NULL,
  `tgl_berangkat` datetime(0) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `tgl_input` datetime(0) NULL DEFAULT NULL,
  `tgl_update` datetime(0) NULL DEFAULT NULL,
  `status` enum('dokumen_lengkap','dokumen_belum_lengkap') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_pembayaran` enum('bayar_dp_haji','bayar_lunas_haji','bayar_dp_umroh','bayar_lunas_umroh') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lamp_bukti_tf_jamaah` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `agen_id` int(11) NULL DEFAULT NULL,
  `agen_pemilik_id` int(11) NULL DEFAULT NULL,
  `baitullah_id` int(11) NULL DEFAULT NULL,
  `manajer_id` int(11) NULL DEFAULT NULL,
  `direktur_id` int(11) NULL DEFAULT NULL,
  `presdir_id` int(11) NULL DEFAULT NULL,
  `status_approval` enum('setuju','tidak_setuju','pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_jamaah`) USING BTREE,
  INDEX `provinsi_id`(`tgl_paspor_publish`) USING BTREE,
  INDEX `user_id`(`masa_berlaku_paspor`) USING BTREE,
  INDEX `tbl_jamaah_ibfk_1`(`paket_haji_id`) USING BTREE,
  INDEX `tbl_jamaah_ibfk_2`(`paket_umroh_id`) USING BTREE,
  INDEX `agen_id`(`agen_id`) USING BTREE,
  INDEX `tbl_jamaah_ibfk_3`(`user_id`) USING BTREE,
  INDEX `agen_pemilik_id`(`agen_pemilik_id`) USING BTREE,
  CONSTRAINT `tbl_jamaah_ibfk_1` FOREIGN KEY (`paket_haji_id`) REFERENCES `tbl_paket_haji` (`id_paket_haji`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `tbl_jamaah_ibfk_2` FOREIGN KEY (`paket_umroh_id`) REFERENCES `tbl_paket_umroh` (`id_paket_umroh`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `tbl_jamaah_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `tbl_agen` (`id_agen`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `tbl_jamaah_ibfk_4` FOREIGN KEY (`agen_id`) REFERENCES `tbl_agen` (`id_agen`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `tbl_jamaah_ibfk_5` FOREIGN KEY (`agen_pemilik_id`) REFERENCES `tbl_agen` (`id_agen`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 276 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_jamaah
-- ----------------------------
INSERT INTO `tbl_jamaah` VALUES (275, 'Totam mollit qui off', '2005-01-22 00:00:00', 'Vel et autem nemo do', 93, 'Cupiditate voluptatu', '2016-05-21 00:00:00', '1993-09-09 00:00:00', 'Minim rem voluptate ', 'Reiciendis dolor vel', 'P', '26', 'Ratione et laboris d', 'Esse cupiditate ips', 'Omnis molestiae aute', '2020-05-28 00:00:00', '2011-09-18 00:00:00', 'T', '79', 64, NULL, 90000000, '1977-02-01 00:00:00', 136, '2023-12-16 21:45:33', '2023-12-16 21:57:13', 'dokumen_belum_lengkap', 'bayar_lunas_haji', NULL, 136, 138, 138, 136, 133, 130, 'pending');

SET FOREIGN_KEY_CHECKS = 1;
