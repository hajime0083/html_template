/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : suisou

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-03-13 19:00:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_genres
-- ----------------------------
DROP TABLE IF EXISTS `blog_genres`;
CREATE TABLE `blog_genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `active_flg` tinyint(4) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_genres
-- ----------------------------
INSERT INTO `blog_genres` VALUES ('1', 'blog_genre_A', '1', '3');
INSERT INTO `blog_genres` VALUES ('2', 'blog_genre_B', '1', '1');
INSERT INTO `blog_genres` VALUES ('3', 'blog_genre_C', '1', '2');

-- ----------------------------
-- Table structure for blogs
-- ----------------------------
DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `body` longtext,
  `body_detail` longtext,
  `user_id` int(11) DEFAULT NULL,
  `blog_genre` int(11) DEFAULT NULL,
  `active_flg` tinyint(4) DEFAULT NULL,
  `draft_flg` tinyint(4) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_genre` (`blog_genre`,`draft_flg`,`active_flg`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blogs
-- ----------------------------
INSERT INTO `blogs` VALUES ('1', 'ブログタイトル１', 'テキストテキスト', 'テキストテキスト', '1', '1', '1', '0', '1388534400', null);
INSERT INTO `blogs` VALUES ('2', 'ブログタイトル２', 'テキストテキスト２', 'テキストテキスト２', '2', '2', '1', '0', '1391212800', null);
INSERT INTO `blogs` VALUES ('3', 'ブログタイトル３', 'テキストテキスト３', 'テキストテキスト３', '1', '3', '1', '0', '1393632000', null);
INSERT INTO `blogs` VALUES ('4', 'ブログタイトル４', 'テキストテキスト４', 'テキストテキスト４', '2', '1', '1', '0', '1393718400', null);
INSERT INTO `blogs` VALUES ('5', 'ブログタイトル５', 'テキストテキスト５', 'テキストテキスト５', '1', '2', '1', '0', '1393804800', null);
INSERT INTO `blogs` VALUES ('6', 'ブログタイトル６', 'テキストテキスト６', 'テキストテキスト６', '2', '3', '1', '0', '1393891200', null);
INSERT INTO `blogs` VALUES ('7', 'ブログタイトル７', 'テキストテキスト７', 'テキストテキスト７', '1', '1', '1', '0', '1399161600', null);
INSERT INTO `blogs` VALUES ('8', 'ブログタイトル８', 'テキストテキスト８', 'テキストテキスト８', '2', '2', '1', '0', '1399161600', null);

-- ----------------------------
-- Table structure for genres
-- ----------------------------
DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `active_flg` tinyint(4) DEFAULT '1',
  `order` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`active_flg`)
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
INSERT INTO `users` VALUES ('1', 'user1', '$2y$10$RwkkvWBFxIP57rlI2j6wUehe1YnQYNJfGkIAUwhk2yrHCzHhBkIgy', 'ユーザーA', 'aaaa@aa.aaa.jp');
INSERT INTO `users` VALUES ('2', 'user2', 'pass', 'ユーザーB', 'aaaa@aa.aaa.jp');
