/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : accountbook

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2017-04-19 22:50:39
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

-- ----------------------------
-- Table structure for `t101_user`
-- ----------------------------
DROP TABLE IF EXISTS `t101_user`;
CREATE TABLE `t101_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL COMMENT '邮箱',
  `nickname` varchar(50) NOT NULL COMMENT '英文名，用于登录',
  `password` varchar(50) NOT NULL COMMENT '密码，MD5加密后的结果',
  `is_verify` tinyint(1) NOT NULL COMMENT '0：邮箱未验证，1：已验证，是合法用户',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of t101_user
-- ----------------------------
INSERT INTO `t101_user` VALUES ('34', '1096101803@qq.com', 'bensonlin', 'b0baee9d279d34fa1dfd71aadb908c3f', '1', '2017-03-05 11:32:38', '2017-03-29 17:57:37');
INSERT INTO `t101_user` VALUES ('37', '2205763695@qq.com', 'test', '098f6bcd4621d373cade4e832627b4f6', '1', '2017-03-28 10:25:15', '2017-03-28 10:28:14');

-- ----------------------------
-- Table structure for `t102_reset_password_expiration`
-- ----------------------------
DROP TABLE IF EXISTS `t102_reset_password_expiration`;
CREATE TABLE `t102_reset_password_expiration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `crypt_params` text,
  `is_used` tinyint(4) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用来保存是否已重置密码';

-- ----------------------------
-- Records of t102_reset_password_expiration
-- ----------------------------
INSERT INTO `t102_reset_password_expiration` VALUES ('7', '1096101803@qq.com&ab1c7fd04d0f75070488b64f9542e4e7&1490780541', '1', '2017-03-29 17:42:22');

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
  `type` tinyint(4) DEFAULT NULL COMMENT '1收入，2支出',
  `remark` text,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='收入分类表';

-- ----------------------------
-- Records of t202_income_expend_category
-- ----------------------------
INSERT INTO `t202_income_expend_category` VALUES ('1', '工资收入', '1', null, '2017-01-24 11:22:13');
INSERT INTO `t202_income_expend_category` VALUES ('2', '补贴收入', '1', null, '2017-01-24 11:22:17');
INSERT INTO `t202_income_expend_category` VALUES ('3', '利息收入', '1', null, '2017-01-24 11:22:21');
INSERT INTO `t202_income_expend_category` VALUES ('4', '其它收入', '1', null, '2017-01-24 11:22:23');
INSERT INTO `t202_income_expend_category` VALUES ('18', '衣着消费支出', '2', '包括服装，做衣材料，鞋，袜子等其它穿着用品', '2017-01-24 11:17:00');
INSERT INTO `t202_income_expend_category` VALUES ('19', '食品消费支出', '2', '包括蔬菜,粮油及其制品,在外用餐,肉,禽,蛋及其制品.鲜奶及奶制品,水产品,调味品,豆制品,烟,酒,茶,糖,干鲜瓜果,饮料,糕点等。 ', '2017-01-24 11:17:27');
INSERT INTO `t202_income_expend_category` VALUES ('20', '医疗保健服务费支出', '2', '包括药品,及各类健身工具', '2017-01-24 11:17:41');
INSERT INTO `t202_income_expend_category` VALUES ('21', '交通和通信支出', '2', '包括交通费,交通工具购买费,燃料,维修及零部件,通信工具购买费,通信服务费', '2017-01-24 11:17:55');
INSERT INTO `t202_income_expend_category` VALUES ('22', '文化和教育费用支出', '2', '包括报名费,学杂费,赞助费,租书费,教材,教育软件,家教费,培训班费等。搜索', '2017-01-24 11:18:05');
INSERT INTO `t202_income_expend_category` VALUES ('23', '非商品及服务性支出', '2', '房租,水费,电费,煤气费,物业管理费中介费,旅游支出等。', '2017-01-24 11:18:23');
INSERT INTO `t202_income_expend_category` VALUES ('24', '日杂消费支出', '2', '日常用的东西', '2017-01-24 11:18:30');
INSERT INTO `t202_income_expend_category` VALUES ('25', '其它支出', '2', '包括理发,洗澡,美容等。', '2017-01-24 11:18:41');
INSERT INTO `t202_income_expend_category` VALUES ('26', '兼职收入', '1', null, '2017-01-24 11:23:28');
INSERT INTO `t202_income_expend_category` VALUES ('28', '股票收入', '1', null, '2017-01-24 11:24:40');
INSERT INTO `t202_income_expend_category` VALUES ('29', '房屋出租收入', '1', null, '2017-01-24 11:30:47');

-- ----------------------------
-- Table structure for `t301_income_expend_record`
-- ----------------------------
DROP TABLE IF EXISTS `t301_income_expend_record`;
CREATE TABLE `t301_income_expend_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `money` float NOT NULL COMMENT '支出或收入金额',
  `account_category_id` int(11) NOT NULL COMMENT '所属账户',
  `income_expend_category_id` int(11) NOT NULL COMMENT '用途',
  `type` tinyint(1) NOT NULL COMMENT '1收入，2支出',
  `remark` varchar(100) DEFAULT NULL COMMENT '备注',
  `add_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '记录时间',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='支出收入记录表';

-- ----------------------------
-- Records of t301_income_expend_record
-- ----------------------------
INSERT INTO `t301_income_expend_record` VALUES ('7', '34', '122', '1', '1', '1', '', '2017-04-10 21:05:22', '2017-04-10 21:05:31', '2017-04-10 21:05:31');
INSERT INTO `t301_income_expend_record` VALUES ('8', '34', '121', '1', '18', '2', '', '2017-04-10 21:08:23', '2017-04-10 21:08:26', '2017-04-10 21:08:26');
