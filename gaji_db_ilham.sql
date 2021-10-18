/*
 Navicat Premium Data Transfer

 Source Server         : DATABASE-ENDRA
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : gaji_db_ilham

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 17/08/2021 18:36:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for absensis
-- ----------------------------
DROP TABLE IF EXISTS `absensis`;
CREATE TABLE `absensis`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `jam_masuk` time(0) NULL DEFAULT NULL,
  `jam_keluar` time(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `absensis_user_id_foreign`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of absensis
-- ----------------------------
INSERT INTO `absensis` VALUES (1, '14', 'Ijin', '2021-08-15', 'alasan..', '2021-08-15 12:29:54', '2021-08-15 12:29:54', '19:29:00', '22:29:00');

-- ----------------------------
-- Table structure for buku_besar_gajis
-- ----------------------------
DROP TABLE IF EXISTS `buku_besar_gajis`;
CREATE TABLE `buku_besar_gajis`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `laporan_id` int(10) UNSIGNED NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `buku_besar_gajis_laporan_id_foreign`(`laporan_id`) USING BTREE,
  CONSTRAINT `buku_besar_gajis_laporan_id_foreign` FOREIGN KEY (`laporan_id`) REFERENCES `laporans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for buku_besar_kas
-- ----------------------------
DROP TABLE IF EXISTS `buku_besar_kas`;
CREATE TABLE `buku_besar_kas`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `laporan_id` int(10) UNSIGNED NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `buku_besar_kas_laporan_id_foreign`(`laporan_id`) USING BTREE,
  CONSTRAINT `buku_besar_kas_laporan_id_foreign` FOREIGN KEY (`laporan_id`) REFERENCES `laporans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jabatans
-- ----------------------------
DROP TABLE IF EXISTS `jabatans`;
CREATE TABLE `jabatans`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan_min` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gapok` int(11) NOT NULL,
  `tunjangan` int(11) NOT NULL,
  `lembur` int(11) NOT NULL,
  `uang_makan` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jabatans
-- ----------------------------
INSERT INTO `jabatans` VALUES (1, 'HDP', 'Kepala produksi', 'S1', 1800000, 55000, 15000, 10000, '2021-06-16 13:20:02', '2021-08-15 04:53:34');
INSERT INTO `jabatans` VALUES (2, 'JHT', 'Sewing (jahit)', 'SMA', 1400000, 25000, 15000, 10000, '2021-06-16 13:20:49', '2021-08-15 04:53:17');
INSERT INTO `jabatans` VALUES (3, 'PRO', 'Produksi Celana', 'SMA', 1400000, 25000, 15000, 10000, '2021-07-10 13:06:19', '2021-08-15 04:53:07');
INSERT INTO `jabatans` VALUES (4, 'ADM', 'Admin', 'S1', 500000, 30000, 10000, 15000, '2021-08-15 04:52:54', '2021-08-15 04:52:54');

-- ----------------------------
-- Table structure for jurnal_umums
-- ----------------------------
DROP TABLE IF EXISTS `jurnal_umums`;
CREATE TABLE `jurnal_umums`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `laporan_id` int(10) UNSIGNED NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jurnal_umums_laporan_id_foreign`(`laporan_id`) USING BTREE,
  CONSTRAINT `jurnal_umums_laporan_id_foreign` FOREIGN KEY (`laporan_id`) REFERENCES `laporans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jurnal_umums
-- ----------------------------
INSERT INTO `jurnal_umums` VALUES (1, 1, 'Gaji', 55000, 0, '2021-08-17', '2021-08-17 07:45:46', '2021-08-17 07:45:46');
INSERT INTO `jurnal_umums` VALUES (2, 1, 'Kas', 0, 55000, '2021-08-17', '2021-08-17 07:45:46', '2021-08-17 07:45:46');

-- ----------------------------
-- Table structure for laporans
-- ----------------------------
DROP TABLE IF EXISTS `laporans`;
CREATE TABLE `laporans`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bulan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gapok` int(11) NOT NULL,
  `tunjangan` int(11) NOT NULL,
  `lembur` int(11) NOT NULL,
  `gaji_bersih` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `laporans_user_id_foreign`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of laporans
-- ----------------------------
INSERT INTO `laporans` VALUES (1, '13', '8', '2021', 1800000, 55000, 0, 55000, '2021-08-17 07:45:46', '2021-08-17 07:45:46');

-- ----------------------------
-- Table structure for lemburs
-- ----------------------------
DROP TABLE IF EXISTS `lemburs`;
CREATE TABLE `lemburs`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `lama_lembur` int(11) NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `lemburs_user_id_foreign`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lemburs
-- ----------------------------
INSERT INTO `lemburs` VALUES (1, '14', '2021-08-15', 2, 'Lembur..', '2021-08-15 12:30:46', '2021-08-15 12:30:46');

-- ----------------------------
-- Table structure for levels
-- ----------------------------
DROP TABLE IF EXISTS `levels`;
CREATE TABLE `levels`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of levels
-- ----------------------------
INSERT INTO `levels` VALUES (1, 'admin', 'admin', '2021-06-16 01:31:50', '2021-06-16 01:31:50');
INSERT INTO `levels` VALUES (2, 'karyawan', 'karyawan', '2021-06-16 01:32:05', '2021-06-16 01:32:05');
INSERT INTO `levels` VALUES (3, 'Pemilik', 'owner', '2021-07-11 03:22:22', '2021-07-11 03:24:07');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2021_06_10_144700_create_jabatans_table', 1);
INSERT INTO `migrations` VALUES (4, '2021_06_10_144819_create_absensis_table', 1);
INSERT INTO `migrations` VALUES (5, '2021_06_10_145033_create_lemburs_table', 1);
INSERT INTO `migrations` VALUES (6, '2021_06_10_145124_create_penggajians_table', 1);
INSERT INTO `migrations` VALUES (7, '2021_06_10_145210_create_laporans_table', 1);
INSERT INTO `migrations` VALUES (8, '2021_06_10_145323_create_jurnal_umums_table', 1);
INSERT INTO `migrations` VALUES (9, '2021_06_10_145436_create_buku_besar_kas_table', 1);
INSERT INTO `migrations` VALUES (10, '2021_06_10_145516_create_buku_besar_gajis_table', 1);
INSERT INTO `migrations` VALUES (11, '2021_06_10_154909_create_levels_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for penggajians
-- ----------------------------
DROP TABLE IF EXISTS `penggajians`;
CREATE TABLE `penggajians`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pendidikan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kota_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tgl_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tgl_masuk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `agama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `jabatan_id` int(11) NULL DEFAULT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (11, 'Admin', 'admin@gmail.com', '$2y$10$U9hICRH0/.ofr6W/P7v95.EzRKIDzs9kst9/NSOa0b60qQtearXL.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'HiK9X2QdDjFSiK0uV4r1UFhgVrQsxIcvTI2rjRK5qzmx0KaXtLbTyV6tsgpn', '2021-06-16 15:31:01', '2021-06-16 15:31:01', NULL);
INSERT INTO `users` VALUES (13, 'Endra Setiawan', 'setiaendra18@gmail.com', '$2y$10$b5NOGZ4HepjtQKDUktTrEetbxfA19wuL9SavhwsNU4wCEgfXOyUB2', 'HDP001', 'S1', 'Sleman', '1991-08-15', '2021-08-15', 'Laki-Laki', 'Islam', 'Jl. Wonosari Km 8.5, Gandu Baru, Berbah (Barat Yamaha SBR)', 1, 'karyawan', NULL, '2021-08-15 12:22:51', '2021-08-15 12:22:51', NULL);
INSERT INTO `users` VALUES (14, 'Gisti Wulandari', 'setiaendra1812@gmail.com', '$2y$10$fErj8QgOhnY9K/fFKuSjOOQowYtHNnDP7wsDkW9LQkQ0Xyj1F7fFS', 'HDP002', 'S1', 'Yogyakarta', '1991-08-15', '2021-08-15', 'Laki-Laki', 'Islam', 'Jl. Wonosari Km 8.5, Gandu Baru, Berbah (Barat Yamaha SBR)', 1, 'karyawan', NULL, '2021-08-15 12:28:19', '2021-08-15 12:28:19', NULL);
INSERT INTO `users` VALUES (15, 'Marcelino Tegar Y', 'setiaendra@gmail.com', '$2y$10$shG70JIICpBNcQs2uOsBTuLm0KuNXYqUnArUM6UiQKIaIBvxiRMvS', 'JHT001', 'SMA', 'Sleman', '1991-08-15', '2021-08-15', 'Perempuan', 'Islam', 'Jl. Wonosari Km 8.5, Gandu Baru, Berbah (Barat Yamaha SBR)', 2, 'karyawan', NULL, '2021-08-15 12:29:08', '2021-08-15 12:29:08', NULL);

SET FOREIGN_KEY_CHECKS = 1;
