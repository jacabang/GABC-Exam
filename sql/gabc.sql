/*
 Navicat Premium Data Transfer

 Source Server         : myLocal
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : gabc

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 20/10/2023 13:40:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for branch
-- ----------------------------
DROP TABLE IF EXISTS `branch`;
CREATE TABLE `branch`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `branch_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `branch_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `open_at` date NULL DEFAULT NULL,
  `barangay` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `permit_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `branch_manager_id` bigint NULL DEFAULT NULL,
  `is_active` tinyint(1) NULL DEFAULT 1,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  INDEX `branch_manager_id`(`branch_manager_id`) USING BTREE,
  INDEX `deleted_at`(`deleted_at`) USING BTREE,
  CONSTRAINT `branch_manager_id_to_employee` FOREIGN KEY (`branch_manager_id`) REFERENCES `employee` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `middle_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image_path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hired_at` date NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  INDEX `deleted_at`(`deleted_at`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Procedure structure for delete_branch
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_branch`;
delimiter ;;
CREATE PROCEDURE `delete_branch`(IN `branch_id` INT(20))
BEGIN
	#Routine body goes here...
	UPDATE branch 
	SET `deleted_at` = NOW()
	WHERE `id` = branch_id ;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for delete_employee
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_employee`;
delimiter ;;
CREATE PROCEDURE `delete_employee`(IN `employee_id` INT(20))
BEGIN
	#Routine body goes here...
	UPDATE employee 
	SET `deleted_at` = NOW()
	WHERE `id` = employee_id ;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for fetch_branch
-- ----------------------------
DROP PROCEDURE IF EXISTS `fetch_branch`;
delimiter ;;
CREATE PROCEDURE `fetch_branch`()
BEGIN
	#Routine body goes here...
	SELECT *, a.id as branch_id, b.id as employee_id FROM branch a
		LEFT JOIN (SELECT * FROM employee WHERE deleted_at IS NULL) as b ON a.branch_manager_id = b.id WHERE a.deleted_at IS NULL  ORDER BY a.id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for fetch_branch_by_branch_code
-- ----------------------------
DROP PROCEDURE IF EXISTS `fetch_branch_by_branch_code`;
delimiter ;;
CREATE PROCEDURE `fetch_branch_by_branch_code`(IN `branch_code` varchar(191))
BEGIN
	#Routine body goes here...
	SELECT *, a.id as branch_id, b.id as employee_id FROM branch a
		LEFT JOIN employee b ON a.branch_manager_id = b.id WHERE a.`deleted_at` IS NULL AND b.`deleted_at` IS NULL AND a.branch_code = branch_code  ORDER BY a.id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for fetch_branch_by_id
-- ----------------------------
DROP PROCEDURE IF EXISTS `fetch_branch_by_id`;
delimiter ;;
CREATE PROCEDURE `fetch_branch_by_id`(IN `branch_id` INT(20))
BEGIN
	#Routine body goes here...
	SELECT *, a.id as branch_id, b.id as employee_id FROM branch a
		LEFT JOIN (SELECT * FROM employee WHERE `deleted_at` IS NULL) as b ON a.branch_manager_id = b.id WHERE a.`deleted_at` IS NULL AND a.id = branch_id  ORDER BY a.id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for fetch_branch_w_trashed
-- ----------------------------
DROP PROCEDURE IF EXISTS `fetch_branch_w_trashed`;
delimiter ;;
CREATE PROCEDURE `fetch_branch_w_trashed`()
BEGIN
	#Routine body goes here...
	SELECT *, a.id as branch_id, b.id as employee_id FROM branch a
		LEFT JOIN employee b ON a.branch_manager_id = b.id ORDER BY a.id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for fetch_employee
-- ----------------------------
DROP PROCEDURE IF EXISTS `fetch_employee`;
delimiter ;;
CREATE PROCEDURE `fetch_employee`()
BEGIN
	#Routine body goes here...
	SELECT * FROM employee WHERE deleted_at IS NULL ORDER BY id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for fetch_employee_by_id
-- ----------------------------
DROP PROCEDURE IF EXISTS `fetch_employee_by_id`;
delimiter ;;
CREATE PROCEDURE `fetch_employee_by_id`(IN `employee_id` INT(20))
BEGIN
	#Routine body goes here...
	SELECT * FROM employee WHERE id = employee_id AND deleted_at IS NULL  ORDER BY id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for fetch_employee_w_trashed
-- ----------------------------
DROP PROCEDURE IF EXISTS `fetch_employee_w_trashed`;
delimiter ;;
CREATE PROCEDURE `fetch_employee_w_trashed`()
BEGIN
	#Routine body goes here...
	SELECT * FROM employee ORDER BY id;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_branch
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_branch`;
delimiter ;;
CREATE PROCEDURE `insert_branch`(IN `branch_code` varchar(191),IN `branch_name` varchar(191),IN `address` varchar(191),IN `barangay` varchar(191),IN `city` varchar(191),IN `permit_no` varchar(191),IN `open_at` date,IN `branch_manager_id` varchar(191),IN `is_active` INT(1))
BEGIN
	#Routine body goes here...
	INSERT INTO branch (`branch_code`,`branch_name`,`address`,`barangay`,`city`,`permit_no`,`open_at`,`branch_manager_id`,`is_active`) VALUES (branch_code, branch_name, address, barangay, city, permit_no, open_at, branch_manager_id, is_active);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for insert_employee
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_employee`;
delimiter ;;
CREATE PROCEDURE `insert_employee`(IN `first_name` varchar(191),IN `middle_name` varchar(191),IN `last_name` varchar(191),IN `image_path` varchar(191),IN `hired_at` date)
BEGIN
	#Routine body goes here...
	INSERT INTO employee (`first_name`,`middle_name`,`last_name`,`hired_at`,`image_path`) VALUES (first_name, middle_name, last_name, hired_at, image_path);
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for search_employee
-- ----------------------------
DROP PROCEDURE IF EXISTS `search_employee`;
delimiter ;;
CREATE PROCEDURE `search_employee`(IN `q` varchar(191))
BEGIN
	#Routine body goes here...
	SELECT * FROM employee WHERE (`first_name` LIKE CONCAT('%',q,'%') OR `last_name` LIKE CONCAT('%',q,'%') OR `middle_name` LIKE CONCAT('%',q,'%')) AND deleted_at IS NULL;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_branch
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_branch`;
delimiter ;;
CREATE PROCEDURE `update_branch`(IN `branch_code` varchar(191),IN `branch_name` varchar(191),IN `address` varchar(191),IN `barangay` varchar(191),IN `city` varchar(191),IN `permit_no` varchar(191),IN `open_at` date,IN `branch_manager_id` varchar(191),IN `is_active` INT(1),IN `branch_id` INT(20))
BEGIN
	#Routine body goes here...
	UPDATE branch 
	SET `branch_code` = branch_code, 
		`branch_name` = branch_name, 
		`address` = address, 
		`barangay` = barangay,
		`city` = city,
		`permit_no` = permit_no,
		`branch_manager_id` = branch_manager_id,
		`is_active` = is_active,
		`open_at` = open_at
	WHERE `id` = branch_id;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for update_employee
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_employee`;
delimiter ;;
CREATE PROCEDURE `update_employee`(IN `first_name` varchar(191),IN `middle_name` varchar(191),IN `last_name` varchar(191),IN `image_path` varchar(191),IN `hired_at` date,IN `employee_id` INT(20))
BEGIN
	#Routine body goes here...
	UPDATE employee 
	SET `first_name` = first_name, 
		`middle_name` = middle_name, 
		`last_name` = last_name, 
		`hired_at` = hired_at, 
		`image_path` = image_path
	WHERE `id` = employee_id ;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
