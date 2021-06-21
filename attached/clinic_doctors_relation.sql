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

 Date: 24/04/2021 23:32:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for clinic_doctors_relation
-- ----------------------------
DROP TABLE IF EXISTS `clinic_doctors_relation`;
CREATE TABLE `clinic_doctors_relation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `clinic_id` bigint(20) unsigned NOT NULL,
  `doctor_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clinic_patient_info_memos_clinic_id_foreign` (`clinic_id`),
  KEY `clinic_patient_info_memos_patient_info_id_foreign` (`doctor_id`),
  CONSTRAINT `clinic_doctors_relation_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `clinic_doctors_relation_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
