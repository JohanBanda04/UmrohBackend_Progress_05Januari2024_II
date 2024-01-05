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

 Date: 16/12/2023 22:59:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_agen
-- ----------------------------
DROP TABLE IF EXISTS `tbl_agen`;
CREATE TABLE `tbl_agen`  (
  `id_agen` int(10) NOT NULL AUTO_INCREMENT,
  `nama_agen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_lahir` datetime(0) NULL DEFAULT NULL,
  `tempat_lahir` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lampiran_ttd` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_ktp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_lengkap` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `role_agen_id` int(11) NULL DEFAULT NULL,
  `jabatan` int(255) NULL DEFAULT NULL,
  `sponsor_atasan` int(255) NULL DEFAULT NULL,
  `cabang_id` int(11) NULL DEFAULT NULL,
  `kota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kecamatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kelurahan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `provinsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_pos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_hp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cabang_bank` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_rekening` int(255) NULL DEFAULT NULL,
  `pemilik_rekening` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_ahli_waris` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hub_dgn_ahli_waris` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_hp_ahli_waris` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lamp_ttd_agen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `tgl_input` datetime(0) NULL DEFAULT NULL,
  `tgl_update` datetime(0) NULL DEFAULT NULL,
  `bonus` bigint(255) NULL DEFAULT NULL,
  `bonus_haji` bigint(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id_agen`) USING BTREE,
  INDEX `tbl_agen_ibfk_3`(`sponsor_atasan`) USING BTREE,
  INDEX `tbl_agen_ibfk_4`(`user_id`) USING BTREE,
  INDEX `cabang_id`(`cabang_id`) USING BTREE,
  INDEX `tbl_agen_ibfk_1`(`role_agen_id`) USING BTREE,
  INDEX `tbl_agen_ibfk_2`(`jabatan`) USING BTREE,
  CONSTRAINT `tbl_agen_ibfk_1` FOREIGN KEY (`role_agen_id`) REFERENCES `tbl_role_agen` (`id_role_agen`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `tbl_agen_ibfk_2` FOREIGN KEY (`jabatan`) REFERENCES `tbl_role_agen` (`id_role_agen`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `tbl_agen_ibfk_3` FOREIGN KEY (`cabang_id`) REFERENCES `tbl_cabang` (`id_cabang`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 163 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_agen
-- ----------------------------
INSERT INTO `tbl_agen` VALUES (1, 'Administrator', 'administrator', 'saS3eimg8Mg1M', '1995-12-31 00:00:00', 'Nusa Tenggara Barat ', NULL, 'L', '527101291222', 'Lombok', 1, 95, 1, 71, 'Ampenan', 'Selaparang', 'Rembige', 'Nusa Tenggara Barat', '8312333', 'sulaeman@gmail.com', '0897', 'Mandiri', 'Mataram', 161002321, 'pemilikrekening', 'pewarisnya', 'keluarga kandung', '098765', '', 1, '1989-01-17 00:00:00', '2023-12-02 12:02:41', NULL, NULL);
INSERT INTO `tbl_agen` VALUES (129, 'Susilo Bambang Edit', 'susilo', 'saS3eimg8Mg1M', '1991-05-15 00:00:00', 'Ut nisi obcaecati du', NULL, 'L', '46', 'Vero error praesenti', 90, 90, 1, 72, 'Optio reiciendis ex', 'Amet perspiciatis ', 'Fugit facere esse v', 'Nostrud hic veniam ', '93', 'susilo@gmail.com', '2', 'Cupiditate sint eos ', 'Qui est quis modi i', 9, 'Quis veniam ullamco', 'Adipisicing alias ex', 'Tenetur non reprehen', 'Animi nulla adipisi', 'file/data_ttd_agen/ttd2.png', 1, '2023-12-08 09:38:31', '2023-12-14 15:18:40', NULL, NULL);
INSERT INTO `tbl_agen` VALUES (130, 'BJ Habibi', 'habibi', 'saEZ6MlWYV9nQ', '2011-10-17 00:00:00', 'Soluta in commodi as', NULL, 'L', '68', 'Incididunt pariatur', 90, 90, 1, 72, 'Repellendus Est nec', 'Sunt at exercitation', 'Molestiae error quia', 'Laboriosam ut ad la', '50', 'habibi@gmail.com', '4', 'Et id unde esse ull', 'Officia repudiandae ', 82, 'Voluptatem dolores d', 'Nostrum architecto a', 'Consectetur in saepe', 'Eius cum vel magnam ', 'file/data_ttd_agen/ttd21.png', 1, '2023-12-08 09:50:28', '2023-12-14 11:06:52', NULL, 250000);
INSERT INTO `tbl_agen` VALUES (131, 'Aini Nuraini', 'aini', 'saS3eimg8Mg1M', '2023-09-15 00:00:00', 'Fugit provident er', NULL, 'L', '57', 'Corrupti deserunt i', 91, 91, 129, 73, 'Est sed odio sunt ', 'Enim qui quo sed vol', 'Ut quis aut id aut e', 'Voluptatem pariatur', '4', 'aini@gmail.com', '100', 'Alias et officia ut ', 'Tempora voluptatibus', 25, 'Veritatis quidem iur', 'Et in iusto commodo ', 'Odio rerum soluta et', 'Quasi sint natus vel', 'file/data_ttd_agen/ttd22.png', 129, '2023-12-08 10:47:59', '2023-12-08 10:47:59', NULL, NULL);
INSERT INTO `tbl_agen` VALUES (133, 'Maman Danised', 'maman', 'saS3eimg8Mg1M', '1993-08-13 00:00:00', 'Et ut aspernatur vel', NULL, 'L', '52', 'Pariatur Nisi quisq', 91, 91, 130, 74, 'Rem sapiente delenit', 'Aliquip anim cillum ', 'Natus fuga Voluptat', 'Hic ut aut qui volup', '7', 'roma@mailinator.com', '98', 'Debitis voluptatem ', 'Veniam sed laborios', 38, 'Omnis non dicta unde', 'Officia culpa accusa', 'Omnis sed aperiam co', 'Molestias commodi ac', 'file/data_ttd_agen/WhatsApp_Image_2023-12-05_at_10.08.5317.jpeg', 1, '2023-12-08 11:53:27', '2023-12-15 09:46:36', NULL, 5000000);
INSERT INTO `tbl_agen` VALUES (135, 'Rama Waskita', 'rama', 'saS3eimg8Mg1M', '1973-10-22 00:00:00', 'Excepturi a error so', NULL, 'P', '73', 'Officiis enim ex dol', 93, 93, 131, 78, 'Inventore autem quis', 'Tenetur qui explicab', 'Dignissimos tempora ', 'Excepteur est omnis', '50', 'rama@gmail.com', '80', 'In sint officiis sed', 'Pariatur Dolor dolo', 43, 'Voluptate ut maiores', 'Ea corporis beatae d', 'Tempora non esse et ', 'Sunt voluptatem Nis', 'file/data_ttd_agen/tulus_icon.png', 131, '2023-12-08 13:08:13', '2023-12-08 13:08:13', NULL, NULL);
INSERT INTO `tbl_agen` VALUES (136, 'Burhanudin', 'burhan', 'saS3eimg8Mg1M', '1982-03-07 00:00:00', 'Sit est qui est sit', NULL, 'P', '54', 'Et excepteur ut lore', 93, 93, 133, 71, 'Et quia esse magni ', 'Ratione quia qui nob', 'Omnis sint doloremqu', 'Fugit nisi consequa', '73', 'resuwuta@mailinator.com', '72', 'Suscipit accusamus m', 'Cupidatat dolor illu', 37, 'Et aut consectetur ', 'Anim ut nulla molest', 'Consectetur non in b', 'Soluta veritatis pra', 'file/data_ttd_agen/tulus_icon1.png', 133, '2023-12-08 13:10:25', '2023-12-08 13:10:25', NULL, 5000000);
INSERT INTO `tbl_agen` VALUES (137, 'Desy Arianti Edit', 'desy', 'saS3eimg8Mg1M', '1992-09-25 00:00:00', 'Nostrum commodo quo ', NULL, 'P', '97', 'Do lorem consequat ', 95, 95, 135, 71, 'Id quos culpa et co', 'Ipsa ex pariatur V', 'Sint saepe modi aspe', 'Et nulla incidunt v', '99', 'jolugejani@mailinator.com', '92', 'Quis corrupti autem', 'Explicabo Et dolore', 94, 'Quia sunt blanditii', 'Sit provident expli', 'Deserunt adipisicing', 'Tempora est suscipit', 'file/data_ttd_agen/WhatsApp_Image_2023-12-05_at_10.08.5318.jpeg', 1, '2023-12-08 13:14:17', '2023-12-15 11:38:44', NULL, NULL);
INSERT INTO `tbl_agen` VALUES (138, 'Sofian Fansory', 'sofian', 'saS3eimg8Mg1M', '1985-11-04 00:00:00', 'Quis odio mollit vol', NULL, 'L', '11', 'Incidunt aut obcaec', 95, 95, 136, 71, 'Ex rerum dolorem exp', 'Est molestiae fugiat', 'Atque excepturi reru', 'Odio tenetur sint ei', '28', 'vugiwynoty@mailinator.com', '61', 'Sit velit voluptas s', 'Voluptatum sint labo', 87, 'Cupiditate molestiae', 'Quae dolore voluptas', 'Sint omnis ut Nam m', 'Sed exercitation rei', 'file/data_ttd_agen/WhatsApp_Image_2023-12-05_at_10.08.5319.jpeg', 136, '2023-12-08 13:14:57', '2023-12-08 13:14:57', NULL, 25000000);
INSERT INTO `tbl_agen` VALUES (139, 'Indah Paramita', 'indah', 'saS3eimg8Mg1M', '2000-10-16 00:00:00', 'Ut qui molestias qui', NULL, 'P', '38', 'Ipsa incidunt mole', 91, 91, 130, 71, 'Quas error nostrum c', 'Aut laudantium labo', 'Voluptatibus et repe', 'Accusamus esse vel ', '18', 'hejytucucy@mailinator.com', '78', 'Perferendis nihil es', 'Voluptatem ut ut sun', 50, 'Quaerat qui accusant', 'Natus temporibus eu ', 'Culpa ipsam illo au', 'Necessitatibus labor', 'file/data_ttd_agen/WhatsApp_Image_2023-12-05_at_10.08.5320.jpeg', 1, '2023-12-08 14:20:18', '2023-12-14 11:40:13', NULL, NULL);
INSERT INTO `tbl_agen` VALUES (142, 'Silvia Susanti', 'silvia', 'saS3eimg8Mg1M', '2004-03-24 00:00:00', 'Ut occaecat voluptat', NULL, 'P', '27', 'Esse consectetur ul', 93, 93, 131, 71, 'Voluptatem atque ma', 'Nostrum qui quia est', 'Aperiam quam volupta', 'Odio in exercitation', '19', 'xesor@mailinator.com', '57', 'Eos vero ea quisquam', 'Ratione ut est ut la', 26, 'Expedita at consequa', 'Voluptatem aliquid r', 'Similique et sed per', 'Repudiandae et iure ', 'file/data_ttd_agen/tulus_icon2.png', 1, '2023-12-09 07:36:31', '2023-12-15 09:32:48', NULL, NULL);
INSERT INTO `tbl_agen` VALUES (143, 'Dadik Rahman', 'dadik', 'saS3eimg8Mg1M', '2023-03-06 00:00:00', 'Consectetur aut rep', NULL, 'P', '56', 'Dolor quia voluptate', 93, 93, 133, 71, 'Esse non atque reic', 'Amet sapiente est u', 'Ipsa ut excepteur u', 'Eiusmod ea rem quisq', '32', 'kutozys@mailinator.com', '50', 'Enim esse amet qui', 'A ad fugiat consequa', 8, 'Dolores consequuntur', 'Sequi molestiae vero', 'Cupidatat dicta ut l', 'Iste quis sed enim v', 'file/data_ttd_agen/WhatsApp_Image_2023-12-05_at_10.08.5322.jpeg', 133, '2023-12-09 07:37:38', '2023-12-09 07:37:38', NULL, NULL);
INSERT INTO `tbl_agen` VALUES (149, 'Fakhrurozy Edit', 'rozy', 'saS3eimg8Mg1M', '1998-08-09 00:00:00', 'Est nemo optio quia', NULL, 'L', '62', 'Nobis esse mollitia', 90, 90, 1, 73, 'Amet illo voluptate', 'Et voluptatibus eius', 'Dolore voluptas dolo', 'Tenetur ratione mini', '42', 'suwiho@mailinator.com', '66', 'Accusamus quis saepe', 'Dicta minima veritat', 37, 'Dolorem placeat rer', 'Repellendus Nisi ab', 'Quis eveniet fugiat', 'Veritatis fuga In u', NULL, 1, '2023-12-15 09:14:35', '2023-12-15 09:34:31', NULL, NULL);
INSERT INTO `tbl_agen` VALUES (160, 'Johan Iswara', 'johan', 'saS3eimg8Mg1M', '2019-09-10 00:00:00', 'Quis qui aute expedi', NULL, 'P', '65', 'Laborum nisi volupta', 95, 95, 135, 74, 'Perferendis at non n', 'Magni delectus adip', 'Qui repellendus Eiu', 'Ut quis qui facere d', '10', 'hidupsehat973@gmail.com', '89', 'Consectetur quos qua', 'Libero fuga Sapient', 79, 'Nulla dignissimos is', 'Saepe non dolor veli', 'Et libero enim facil', 'Sit sed error in des', 'file/data_ttd_agen/WhatsApp_Image_2023-12-14_at_14.46.19.jpeg', 1, '2023-12-15 11:14:58', '2023-12-15 11:14:58', NULL, NULL);
INSERT INTO `tbl_agen` VALUES (161, 'John Is', 'john', 'saS3eimg8Mg1M', '2013-07-17 00:00:00', 'Elit quis eius mole', NULL, 'L', '11', 'Earum autem exceptur', 90, 90, 1, 74, 'Ab similique autem t', 'Quia aliquam aute do', 'Quia ex velit porro ', 'Debitis eius pariatu', '80', 'hidupsehat973@gmail.com', '51', 'Minima voluptas labo', 'Eiusmod voluptate no', 32, 'Soluta consequatur e', 'Illum suscipit assu', 'Laboris magni nulla ', 'Officia excepturi cu', NULL, 1, '2023-12-15 14:54:37', '2023-12-15 14:54:37', NULL, NULL);
INSERT INTO `tbl_agen` VALUES (162, 'Ahmad Fegie', 'fegie', 'saS3eimg8Mg1M', '1990-05-07 00:00:00', 'Veritatis dolor aspe', NULL, 'L', '94', 'Illum qui quasi et ', 95, 95, 136, 78, 'Aspernatur earum fug', 'Corrupti qui simili', 'Recusandae In archi', 'Libero eu nesciunt ', '67', 'hidupsehat973@gmail.com', '30', 'Enim consectetur de', 'Excepturi repellendu', 37, 'Expedita distinctio', 'Eius sequi et rerum ', 'Dignissimos id nisi ', 'Nostrum quam illum ', 'file/data_ttd_agen/WhatsApp_Image_2023-12-14_at_14.46.191.jpeg', 136, '2023-12-16 22:52:23', '2023-12-16 22:52:23', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
