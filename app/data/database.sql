--
-- Table structure for `tasks`
--
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `updated` timestamp DEFAULT NOW() ON UPDATE NOW() ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` (`id`, `name`, `status`) VALUES (1, 'Go to cinema', 1);
INSERT INTO `tasks` (`id`, `name`, `status`) VALUES (2, 'Buying shoes', 1);
INSERT INTO `tasks` (`id`, `name`, `status`) VALUES (3, 'Go to shopping', 1);
INSERT INTO `tasks` (`id`, `name`, `status`) VALUES (4, 'Buy milk', 1);
INSERT INTO `tasks` (`id`, `name`, `status`) VALUES (5, 'Do homework...', 0);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci,
  `updated` timestamp DEFAULT NOW() ON UPDATE NOW() ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('1', 'Juan', 'juanmartin@mail.com');
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('2', 'Federico', null);
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('3', 'Leo', null);
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('4', 'Carlos', null);
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('5', 'Diego', 'diego1010@gmail.com');
