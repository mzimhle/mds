/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : mds

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-08-12 19:48:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `country`
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `iso` varchar(3) NOT NULL DEFAULT 'ZA',
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iso` (`iso`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('1', 'Republic of South Africa', 'ZA', '2021-08-12 11:39:26', null);

-- ----------------------------
-- Table structure for `dayofweek`
-- ----------------------------
DROP TABLE IF EXISTS `dayofweek`;
CREATE TABLE `dayofweek` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `position` int(1) NOT NULL COMMENT 'Number of the day between 1 to 7. Sunday is 1',
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `position` (`position`),
  KEY `name_pos` (`name`,`position`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of dayofweek
-- ----------------------------
INSERT INTO `dayofweek` VALUES ('1', 'Monday', '1', '2021-08-12 19:13:35', null);
INSERT INTO `dayofweek` VALUES ('2', 'Tuesday', '2', '2021-08-12 19:13:35', null);
INSERT INTO `dayofweek` VALUES ('3', 'Wednsday', '3', '2021-08-12 19:13:35', null);
INSERT INTO `dayofweek` VALUES ('4', 'Thursday', '4', '2021-08-12 19:13:35', null);
INSERT INTO `dayofweek` VALUES ('5', 'Friday', '5', '2021-08-12 19:13:35', null);
INSERT INTO `dayofweek` VALUES ('6', 'Saterday', '6', '2021-08-12 19:13:35', null);
INSERT INTO `dayofweek` VALUES ('7', 'Sunday', '7', '2021-08-12 19:13:35', null);

-- ----------------------------
-- Table structure for `holiday`
-- ----------------------------
DROP TABLE IF EXISTS `holiday`;
CREATE TABLE `holiday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `dayofweek` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `day` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `holiday` (`country`,`dayofweek`,`day`,`month`,`year`),
  KEY `dayofweek` (`dayofweek`),
  KEY `month` (`month`,`country`,`year`) USING BTREE,
  CONSTRAINT `country` FOREIGN KEY (`country`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dayofweek` FOREIGN KEY (`dayofweek`) REFERENCES `dayofweek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `month` FOREIGN KEY (`month`) REFERENCES `month` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of holiday
-- ----------------------------
INSERT INTO `holiday` VALUES ('2', '1', '1', '5', 'New Year\'s Day', '1', '2021', '2021-08-12 17:14:41', '2021-08-12 17:14:41');
INSERT INTO `holiday` VALUES ('3', '1', '3', '7', 'Human Rights Day', '21', '2021', '2021-08-12 17:14:42', '2021-08-12 17:14:42');
INSERT INTO `holiday` VALUES ('4', '1', '3', '1', 'Human Rights Day', '22', '2021', '2021-08-12 17:14:43', '2021-08-12 17:14:43');
INSERT INTO `holiday` VALUES ('5', '1', '4', '5', 'Good Friday', '2', '2021', '2021-08-12 17:14:44', '2021-08-12 17:14:44');
INSERT INTO `holiday` VALUES ('6', '1', '4', '1', 'Family Day', '5', '2021', '2021-08-12 17:14:45', '2021-08-12 17:14:45');
INSERT INTO `holiday` VALUES ('7', '1', '4', '2', 'Freedom Day', '27', '2021', '2021-08-12 17:14:46', '2021-08-12 17:14:46');
INSERT INTO `holiday` VALUES ('8', '1', '5', '6', 'Workers\' Day', '1', '2021', '2021-08-12 17:14:47', '2021-08-12 17:14:47');
INSERT INTO `holiday` VALUES ('9', '1', '6', '3', 'Youth Day', '16', '2021', '2021-08-12 17:14:48', '2021-08-12 17:14:48');
INSERT INTO `holiday` VALUES ('10', '1', '8', '1', 'National Women\'s Day', '9', '2021', '2021-08-12 17:14:48', '2021-08-12 17:14:48');
INSERT INTO `holiday` VALUES ('11', '1', '9', '5', 'Heritage Day', '24', '2021', '2021-08-12 17:14:49', '2021-08-12 17:14:49');
INSERT INTO `holiday` VALUES ('12', '1', '12', '4', 'Day of Reconciliation', '16', '2021', '2021-08-12 17:14:49', '2021-08-12 17:14:49');
INSERT INTO `holiday` VALUES ('13', '1', '12', '6', 'Christmas Day', '25', '2021', '2021-08-12 17:14:50', '2021-08-12 17:14:50');
INSERT INTO `holiday` VALUES ('14', '1', '12', '7', 'Day of Goodwill', '26', '2021', '2021-08-12 17:14:50', '2021-08-12 17:14:50');
INSERT INTO `holiday` VALUES ('15', '1', '12', '1', 'Day of Goodwill', '27', '2021', '2021-08-12 17:14:51', '2021-08-12 17:14:51');
INSERT INTO `holiday` VALUES ('16', '1', '1', '2', 'New Year\'s Day', '1', '2013', '2021-08-12 17:38:37', '2021-08-12 17:38:37');
INSERT INTO `holiday` VALUES ('17', '1', '3', '4', 'Human Rights Day', '21', '2013', '2021-08-12 17:38:38', '2021-08-12 17:38:38');
INSERT INTO `holiday` VALUES ('18', '1', '3', '5', 'Good Friday', '29', '2013', '2021-08-12 17:38:38', '2021-08-12 17:38:38');
INSERT INTO `holiday` VALUES ('19', '1', '4', '1', 'Family Day', '1', '2013', '2021-08-12 17:38:38', '2021-08-12 17:38:38');
INSERT INTO `holiday` VALUES ('20', '1', '4', '6', 'Freedom Day', '27', '2013', '2021-08-12 17:38:38', '2021-08-12 17:38:38');
INSERT INTO `holiday` VALUES ('21', '1', '5', '3', 'Workers\' Day', '1', '2013', '2021-08-12 17:38:38', '2021-08-12 17:38:38');
INSERT INTO `holiday` VALUES ('22', '1', '6', '7', 'Youth Day', '16', '2013', '2021-08-12 17:38:38', '2021-08-12 17:38:38');
INSERT INTO `holiday` VALUES ('23', '1', '6', '1', 'Youth Day', '17', '2013', '2021-08-12 17:38:38', '2021-08-12 17:38:38');
INSERT INTO `holiday` VALUES ('24', '1', '8', '5', 'National Women\'s Day', '9', '2013', '2021-08-12 17:38:38', '2021-08-12 17:38:38');
INSERT INTO `holiday` VALUES ('25', '1', '9', '2', 'Heritage Day', '24', '2013', '2021-08-12 17:38:38', '2021-08-12 17:38:38');
INSERT INTO `holiday` VALUES ('26', '1', '12', '1', 'Day of Reconciliation', '16', '2013', '2021-08-12 17:38:38', '2021-08-12 17:38:38');
INSERT INTO `holiday` VALUES ('27', '1', '12', '3', 'Christmas Day', '25', '2013', '2021-08-12 17:38:38', '2021-08-12 17:38:38');
INSERT INTO `holiday` VALUES ('28', '1', '12', '4', 'Day of Goodwill', '26', '2013', '2021-08-12 17:38:38', '2021-08-12 17:38:38');

-- ----------------------------
-- Table structure for `month`
-- ----------------------------
DROP TABLE IF EXISTS `month`;
CREATE TABLE `month` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `sequence` int(2) NOT NULL,
  `name` varchar(20) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `sequence` (`sequence`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of month
-- ----------------------------
INSERT INTO `month` VALUES ('1', '1', 'January', '2021-08-12 18:08:13', null);
INSERT INTO `month` VALUES ('2', '2', 'February', '2021-08-12 18:08:23', null);
INSERT INTO `month` VALUES ('3', '3', 'March', '2021-08-12 18:08:23', null);
INSERT INTO `month` VALUES ('4', '4', 'April', '2021-08-12 18:08:23', null);
INSERT INTO `month` VALUES ('5', '5', 'May', '2021-08-12 18:08:23', null);
INSERT INTO `month` VALUES ('6', '6', 'June', '2021-08-12 18:08:23', null);
INSERT INTO `month` VALUES ('7', '7', 'July', '2021-08-12 18:08:23', null);
INSERT INTO `month` VALUES ('8', '8', 'August', '2021-08-12 18:08:23', null);
INSERT INTO `month` VALUES ('9', '9', 'September', '2021-08-12 18:08:23', null);
INSERT INTO `month` VALUES ('10', '10', 'October', '2021-08-12 18:08:23', null);
INSERT INTO `month` VALUES ('11', '11', 'November', '2021-08-12 18:08:23', null);
INSERT INTO `month` VALUES ('12', '12', 'December', '2021-08-12 18:08:23', null);
