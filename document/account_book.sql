/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : account_book

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-21 20:23:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2017_01_07_124355_create_sessions_table', '1');

-- ----------------------------
-- Table structure for `sessions`
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('76d9bc088c9977c3cec4e782bd28c5eeca75810b', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUVlvd003R1Z3TTB3OWNHOWR5cWw2RUJRSWNsaUVNVjJ6eE9wNHFXciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjE7czo4OiJuaWNrbmFtZSI7czo5OiJiZW5zb25saW4iO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDg1MDAxMzU3O3M6MToiYyI7aToxNDg0OTg1NjI1O3M6MToibCI7czoxOiIwIjt9fQ==', '1485001357');

-- ----------------------------
-- Table structure for `t101_user`
-- ----------------------------
DROP TABLE IF EXISTS `t101_user`;
CREATE TABLE `t101_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL COMMENT '中文名',
  `nickname` varchar(50) NOT NULL COMMENT '英文名，用于登录',
  `password` varchar(50) NOT NULL COMMENT '密码，MD5加密后的结果',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of t101_user
-- ----------------------------
INSERT INTO `t101_user` VALUES ('1', '林泽斌', 'bensonlin', '1', '2017-01-07 20:30:16', '2017-01-07 20:38:20');
INSERT INTO `t101_user` VALUES ('2', '1212', 'yewang', '23', '2017-01-09 20:10:59', '2017-01-09 20:10:59');
INSERT INTO `t101_user` VALUES ('3', 'bensonlin', 'test222', '1', '2017-01-14 17:51:35', '2017-01-14 17:51:35');

-- ----------------------------
-- Table structure for `t102_admin`
-- ----------------------------
DROP TABLE IF EXISTS `t102_admin`;
CREATE TABLE `t102_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) NOT NULL COMMENT '英文名，用于登录',
  `password` varchar(50) NOT NULL COMMENT '密码，MD5加密后的结果',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of t102_admin
-- ----------------------------

-- ----------------------------
-- Table structure for `t201_account_category`
-- ----------------------------
DROP TABLE IF EXISTS `t201_account_category`;
CREATE TABLE `t201_account_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '账户分类',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='帐号分类表';

-- ----------------------------
-- Records of t201_account_category
-- ----------------------------
INSERT INTO `t201_account_category` VALUES ('1', '银行卡', '2017-01-15 16:46:15');
INSERT INTO `t201_account_category` VALUES ('2', '现金', '2017-01-15 16:46:16');
INSERT INTO `t201_account_category` VALUES ('3', '支付宝', '2017-01-15 16:46:16');
INSERT INTO `t201_account_category` VALUES ('4', '微信', '2017-01-15 16:46:17');
INSERT INTO `t201_account_category` VALUES ('5', '存折', '2017-01-15 16:46:17');
INSERT INTO `t201_account_category` VALUES ('6', '其它', '2017-01-15 16:46:18');

-- ----------------------------
-- Table structure for `t202_income_expend_category`
-- ----------------------------
DROP TABLE IF EXISTS `t202_income_expend_category`;
CREATE TABLE `t202_income_expend_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '收入分类',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='收入分类表';

-- ----------------------------
-- Records of t202_income_expend_category
-- ----------------------------
INSERT INTO `t202_income_expend_category` VALUES ('1', '工资', '2017-01-15 16:46:21');
INSERT INTO `t202_income_expend_category` VALUES ('2', '补贴', '2017-01-15 16:46:24');
INSERT INTO `t202_income_expend_category` VALUES ('3', '利息', '2017-01-15 16:46:24');
INSERT INTO `t202_income_expend_category` VALUES ('4', '其它', '2017-01-15 16:46:25');

-- ----------------------------
-- Table structure for `t301_income_expend_record`
-- ----------------------------
DROP TABLE IF EXISTS `t301_income_expend_record`;
CREATE TABLE `t301_income_expend_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `money` float NOT NULL COMMENT '支出或收入金额',
  `account_id` int(11) NOT NULL COMMENT '所属账户',
  `income_expend_category_id` varchar(100) NOT NULL COMMENT '用途',
  `type` tinyint(1) DEFAULT NULL,
  `remark` varchar(100) NOT NULL COMMENT '备注',
  `add_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '记录时间',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='支出收入记录表';

-- ----------------------------
-- Records of t301_income_expend_record
-- ----------------------------
INSERT INTO `t301_income_expend_record` VALUES ('1', '1', '10', '2', '2', '1', '121', '2017-01-12 18:43:15', '2017-01-15 16:22:56', '2017-01-15 18:43:32');
INSERT INTO `t301_income_expend_record` VALUES ('2', '1', '11', '2', '2', '1', '1212', '2017-01-15 18:43:15', '2017-01-15 16:58:48', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('4', '1', '10', '1', '1', '2', 'test', '2017-01-03 18:43:15', '2017-01-15 17:00:48', '2017-01-15 18:43:35');
INSERT INTO `t301_income_expend_record` VALUES ('5', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:48', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('6', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:49', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('7', '1', '10', '2', '2', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:49', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('8', '1', '10', '3', '3', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:49', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('9', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:49', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('10', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:49', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('11', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:50', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('12', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:50', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('13', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:50', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('14', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:50', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('15', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:50', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('16', '1', '10100', '1', '1', '1', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:51', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('17', '1', '100', '1', '1', '1', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:51', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('18', '1', '100', '1', '1', '1', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:51', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('19', '1', '100', '1', '1', '1', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:51', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('20', '1', '1001', '1', '1', '1', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:51', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('21', '1', '10', '1', '1', '1', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:52', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('22', '1', '10', '1', '1', '1', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:52', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('23', '1', '10', '1', '1', '1', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:52', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('24', '1', '10', '1', '1', '1', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:52', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('25', '1', '10', '1', '1', '1', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:52', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('26', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:53', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('27', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:53', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('28', '1', '10', '1', '1', '1', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:53', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('29', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:53', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('30', '1', '10', '1', '1', '2', 'test', '2017-01-15 18:43:15', '2017-01-15 17:00:53', '2017-01-15 18:43:15');
INSERT INTO `t301_income_expend_record` VALUES ('31', '1', '200', '3', '4', '1', '备注', '2017-01-21 20:21:59', '2017-01-21 20:22:01', '2017-01-21 20:22:01');
