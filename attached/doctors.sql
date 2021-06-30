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

 Date: 22/04/2021 12:17:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for doctors
-- ----------------------------
DROP TABLE IF EXISTS `doctors`;
CREATE TABLE `doctors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `doctor_id` bigint(20) unsigned NOT NULL,
  `kata_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '氏名（漢字）',
  `hira_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '氏名（カタカナ）',
  `gender` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '性別',
  `phone_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '電話番号',
  `birthday` date DEFAULT NULL COMMENT '生年月日',
  `area_id` tinyint(3) unsigned DEFAULT NULL COMMENT '施術を考えているエリア',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `job_id` tinyint(3) unsigned DEFAULT NULL COMMENT '役職',
  `experience_year` tinyint(3) DEFAULT NULL COMMENT '経歴',
  `spec0` bigint(20) unsigned DEFAULT NULL COMMENT '得意分野①',
  `spec1` bigint(20) unsigned DEFAULT NULL COMMENT '得意分野②',
  `spec2` bigint(20) unsigned DEFAULT NULL COMMENT '得意分野③',
  `profile` text COLLATE utf8mb4_unicode_ci COMMENT '経歴',
  `career` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '資格・実績',
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `patients_user_id_foreign` (`doctor_id`),
  KEY `patients_area_id_foreign` (`area_id`),
  KEY `doctors_ibfk_3` (`job_id`),
  KEY `doctors_ibfk_5` (`spec1`),
  KEY `doctors_ibfk_4` (`spec0`),
  KEY `doctors_ibfk_6` (`spec2`),
  CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `mtb_prefs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `doctors_ibfk_3` FOREIGN KEY (`job_id`) REFERENCES `mtb_jobs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `doctors_ibfk_4` FOREIGN KEY (`spec0`) REFERENCES `mtb_specialities` (`id`) ON DELETE SET NULL,
  CONSTRAINT `doctors_ibfk_5` FOREIGN KEY (`spec1`) REFERENCES `mtb_specialities` (`id`) ON DELETE SET NULL,
  CONSTRAINT `doctors_ibfk_6` FOREIGN KEY (`spec2`) REFERENCES `mtb_specialities` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
