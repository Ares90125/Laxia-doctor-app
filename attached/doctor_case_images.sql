/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80011
 Source Host           : localhost:3306
 Source Schema         : laravel_vue_spa

 Target Server Type    : MySQL
 Target Server Version : 80011
 File Encoding         : 65001

 Date: 25/04/2021 20:58:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for doctor_case_images
-- ----------------------------
DROP TABLE IF EXISTS `doctor_case_images`;
CREATE TABLE `doctor_case_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `case_id` bigint(20) unsigned DEFAULT NULL,
  `type` enum('before','after') CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `comments_patient_id_foreign` (`case_id`),
  CONSTRAINT `doctor_cases_images_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `doctor_cases` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
