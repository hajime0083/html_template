/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : suisou

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-03-20 18:26:33
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_genres
-- ----------------------------
INSERT INTO `blog_genres` VALUES ('1', 'blog_genre_A', '1', '1');
INSERT INTO `blog_genres` VALUES ('2', 'blog_genre_B', '1', '2');
INSERT INTO `blog_genres` VALUES ('3', 'blog_genre_C', '1', '3');
INSERT INTO `blog_genres` VALUES ('4', 'blog_genre_D', '1', '4');
INSERT INTO `blog_genres` VALUES ('9', 'blog_genre_X', '1', '0');

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
  `release_date` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_genre` (`blog_genre`,`draft_flg`,`active_flg`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blogs
-- ----------------------------
INSERT INTO `blogs` VALUES ('1', 'ブログタイトル１', 'テキストテキスト', 'テキストテキスト', '1', '4', '1', '0', '1395107394', '1388534400', '1395107394');
INSERT INTO `blogs` VALUES ('2', 'ブログタイトル２', 'テキストテキスト２', 'テキストテキスト２', '2', '2', '1', '0', '1391212800', '1391212800', null);
INSERT INTO `blogs` VALUES ('3', 'ブログタイトル３', 'テキストテキスト３\r\naaaaaaaaa', 'テキストテキスト３aaaaaaaa\r\naaaaaaaaaaaa\r\naaaa', '1', '1', '1', '0', '1394791260', '1393632000', '1394791368');
INSERT INTO `blogs` VALUES ('4', 'ブログタイトル４', 'テキストテキスト４', 'テキストテキスト４', '2', '1', '1', '0', '1393718400', '1393718400', null);
INSERT INTO `blogs` VALUES ('5', 'ブログタイトル５', 'テキストテキスト５', 'テキストテキスト５', '1', '2', '1', '0', '1393804800', '1393804800', null);
INSERT INTO `blogs` VALUES ('6', 'ブログタイトル６', 'テキストテキスト６', 'テキストテキスト６', '2', '3', '1', '0', '1393891200', '1393891200', null);
INSERT INTO `blogs` VALUES ('7', 'ブログタイトル７', 'テキストテキスト７', 'テキストテキスト７', '1', '2', '1', '0', '1395291974', '1399161600', '1395291974');
INSERT INTO `blogs` VALUES ('8', 'ブログタイトル８', 'テキストテキスト８', 'テキストテキスト８', '2', '2', '1', '0', '1399161600', '1399161600', null);
INSERT INTO `blogs` VALUES ('9', '新規BLOG登録', '本文１テキストテキストテキストテキスト\r\nテキストテキストテキストテキストテキストテキスト\r\nテキストテキストテキストテキストテキストテキスト\r\n\r\nテキストテキストテキストテキストテキスト\r\n\r\nテキストテキストテキストテキストテキストテキスト\r\n\r\nテキストテキストテキストテキスト\r\nテキストテキストテキストテキストテキストテキスト\r\nテキストテキストテキストテキストテキストテキストテキスト\r\nテキストテキストテキスト', '本文２テキストテキストテキストテキスト\r\nテキストテキストテキストテキストテキストテキスト\r\nテキストテキストテキストテキストテキストテキスト\r\n\r\nテキストテキストテキストテキストテキスト\r\n\r\nテキストテキストテキストテキストテキストテキスト\r\n\r\nテキストテキストテキストテキスト\r\nテキストテキストテキストテキストテキストテキスト\r\nテキストテキストテキストテキストテキストテキストテキスト\r\nテキストテキストテキスト', '1', '3', '1', '0', '1395118004', '1395115629', '1395118004');

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` tinyint(4) DEFAULT NULL,
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
  `active_flg` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(9) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES ('1', '1', 'タイトル１', '説明１', '1', '1', 'B5', '100', '0', 'XXXX', null, '0', '1', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of genres
-- ----------------------------
INSERT INTO `genres` VALUES ('1', 'genre_A', '1', '1');
INSERT INTO `genres` VALUES ('2', 'genre_B', '1', '3');
INSERT INTO `genres` VALUES ('3', 'genre_C', '1', '2');
INSERT INTO `genres` VALUES ('6', 'genre_D', '1', '4');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'user1', '$2y$10$uKqLUrl3QX/SCBFJe95a8.qEkqg/PUppW4v5WqhjRNY7sSp/6j4fm', 'ユーザー名変更', '1234@aa.aaa.jp');
INSERT INTO `users` VALUES ('2', 'user2', '$2y$10$RwkkvWBFxIP57rlI2j6wUehe1YnQYNJfGkIAUwhk2yrHCzHhBkIgy', 'ユーザーB', 'bbbb@aa.aaa.jp');
