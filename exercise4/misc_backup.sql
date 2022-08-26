/*
 Navicat MySQL Data Transfer

 Source Server         : dict
 Source Server Type    : MySQL
 Source Server Version : 100424 (10.4.24-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : misc

 Target Server Type    : MySQL
 Target Server Version : 100424 (10.4.24-MariaDB)
 File Encoding         : 65001

 Date: 26/08/2022 08:09:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  INDEX `email`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Khel Andrew1', 'andrew@gmail.com', 'andrew@123');
INSERT INTO `users` VALUES (2, 'Juan Dela Cruz', 'juan@gmail.com', 'juan@123');
INSERT INTO `users` VALUES (3, 'Maria Eden', 'eden@gmail.com', 'eden@123');
INSERT INTO `users` VALUES (4, 'Amor Gecozo', 'amor@gmail.com', 'amor@123');
INSERT INTO `users` VALUES (6, 'Khel Andrew', 'andrew@gmail.com', 'andrew@123');
INSERT INTO `users` VALUES (9, 'Maria Clara', 'mariaclara@gmail.com', 'maria@123');

-- ----------------------------
-- Procedure structure for usp_delete_user
-- ----------------------------
DROP PROCEDURE IF EXISTS `usp_delete_user`;
delimiter ;;
CREATE PROCEDURE `usp_delete_user`(IN _user_id int,
	OUT _remark VARCHAR(25))
BEGIN
		DELETE FROM users where user_id=_user_id;
		
		set _remark ='OK';
		
		select _remark;
		
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for usp_post_user
-- ----------------------------
DROP PROCEDURE IF EXISTS `usp_post_user`;
delimiter ;;
CREATE PROCEDURE `usp_post_user`(IN _user_id int,
	IN _name varchar(25),
	IN _email varchar(25),
	IN _password varchar(25),
	OUT _new_id int)
BEGIN
			
			
			IF _user_id = 0 THEN
				INSERT INTO users(name, email,password)
				VALUES(_name,_email,_password);
				
				SET _new_id = (SELECT LAST_INSERT_ID());
				 
			ELSE
				UPDATE users
				SET name=_name,
				email=_email,
				password=_password
				WHERE user_id=_user_id;
				
				set _new_id = _user_id;
				
			END IF;	
	
		SELECT _new_id;
	END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
