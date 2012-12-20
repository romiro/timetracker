/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50515
Source Host           : localhost:3306
Source Database       : battask

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2012-12-20 16:43:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `entries`
-- ----------------------------
DROP TABLE IF EXISTS `entries`;
CREATE TABLE `entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int(10) unsigned NOT NULL,
  `comment` text,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of entries
-- ----------------------------

-- ----------------------------
-- Table structure for `tasks`
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `attask_id` int(10) unsigned DEFAULT NULL,
  `hour_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tasks
-- ----------------------------
