/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : suisou

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-03-12 15:52:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for genres
-- ----------------------------
DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `active_flg` tinyint(4) DEFAULT '1',
  `order` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of genres
-- ----------------------------
INSERT INTO `genres` VALUES ('1', 'genre_A', '1', '1');
INSERT INTO `genres` VALUES ('2', 'genre_B', '1', '2');
INSERT INTO `genres` VALUES ('3', 'genre_C', '1', '3');

-- ----------------------------
-- Table structure for offlines
-- ----------------------------
DROP TABLE IF EXISTS `offlines`;
CREATE TABLE `offlines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` tinyint(4) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `discription` varchar(255) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `new_flg` tinyint(255) DEFAULT '0',
  `size` varchar(255) DEFAULT NULL,
  `page` int(11) DEFAULT NULL,
  `r_flg` varchar(255) DEFAULT NULL,
  `cp` varchar(255) DEFAULT NULL,
  `issued_at` int(11) DEFAULT NULL,
  `sold_flg` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of offlines
-- ----------------------------

-- ----------------------------
-- Table structure for pictxts
-- ----------------------------
DROP TABLE IF EXISTS `pictxts`;
CREATE TABLE `pictxts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` int(11) DEFAULT NULL,
  `type` tinyint(11) DEFAULT NULL,
  `r_flg` tinyint(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `memo` text,
  `discription` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `active_flg` tinyint(4) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pictxts
-- ----------------------------
INSERT INTO `pictxts` VALUES ('1', '1', '1', '1', 'aaaa.jpg', 'title_a', 'texttext', null, '1', '1', '1394606017', null);
INSERT INTO `pictxts` VALUES ('2', '1', '2', '0', '1.txt', 'title_b', 'texttext', null, '2', '1', '1394606059', null);
INSERT INTO `pictxts` VALUES ('3', '2', '1', '0', 'bbbbb.jpg', 'title_c', 'texttext', null, '1', '1', '1394606066', null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'user1', 'pass', 'ユーザーA', 'aaaa@aa.aaa.jp');
INSERT INTO `users` VALUES ('2', 'user2', 'pass', 'ユーザーB', 'aaaa@aa.aaa.jp');
