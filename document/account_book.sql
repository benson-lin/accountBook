/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : account_book

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-01-24 15:21:29
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
INSERT INTO `sessions` VALUES ('71979ca087e46b4a1e4d977e4f7f826447e8f4b0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMHJFUUlWc2ZyRVdlWmpRUklTUlVDbVlHMUJ1SXhxVk52RDJYdk9kUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjE7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0ODQ0ODE3ODQ7czoxOiJjIjtpOjE0ODQ0NTQ3MjI7czoxOiJsIjtzOjE6IjAiO319', '1484481784');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of t101_user
-- ----------------------------
INSERT INTO `t101_user` VALUES ('1', '林泽斌', 'bensonlin', '1', '2017-01-07 20:30:16', '2017-01-07 20:38:20');

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
  `income_expend_category_id` varchar(100) NOT NULL COMMENT '用途',
  `type` tinyint(1) NOT NULL COMMENT '1收入，2支出',
  `remark` varchar(100) DEFAULT NULL COMMENT '备注',
  `add_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '记录时间',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='支出收入记录表';

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
INSERT INTO `t301_income_expend_record` VALUES ('31', '1', '2', '1', '1', '2', '', '2017-01-24 10:53:23', '2017-01-24 10:21:08', '2017-01-24 10:53:23');
INSERT INTO `t301_income_expend_record` VALUES ('32', '1', '2', '1', '1', '2', '', '2017-01-24 10:53:22', '2017-01-24 10:30:37', '2017-01-24 10:53:22');
INSERT INTO `t301_income_expend_record` VALUES ('33', '1', '2', '2', '1', '1', '', '2017-01-24 10:53:24', '2017-01-24 10:31:26', '2017-01-24 10:53:24');
INSERT INTO `t301_income_expend_record` VALUES ('34', '1', '10', '1', '3', '2', '备注', '2017-01-24 10:46:46', '2017-01-24 10:47:06', '2017-01-24 10:47:06');
INSERT INTO `t301_income_expend_record` VALUES ('35', '1', '111', '1', '1', '2', '1111', '2017-01-24 10:50:49', '2017-01-24 10:50:56', '2017-01-24 10:50:56');
INSERT INTO `t301_income_expend_record` VALUES ('36', '1', '20', '1', '1', '2', '1111', '2017-01-24 10:51:19', '2017-01-24 10:51:32', '2017-01-24 10:51:32');
INSERT INTO `t301_income_expend_record` VALUES ('37', '1', '12', '2', '2', '2', '', '2017-01-09 10:52:26', '2017-01-24 10:52:35', '2017-01-24 10:52:35');
INSERT INTO `t301_income_expend_record` VALUES ('38', '1', '100', '1', '18', '2', '近距离经历了', '2017-01-24 14:09:27', '2017-01-24 14:09:34', '2017-01-24 14:09:34');
