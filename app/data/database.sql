
-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` (`id`, `name`, `status`) VALUES (1, 'Go to cinema', 1);
INSERT INTO `tasks` (`id`, `name`, `status`) VALUES (2, 'Buy shoes', 0);
INSERT INTO `tasks` (`id`, `name`, `status`) VALUES (3, 'Go to shopping', 0);
INSERT INTO `tasks` (`id`, `name`, `status`) VALUES (4, 'Pay the credit card ;-)', 1);
INSERT INTO `tasks` (`id`, `name`, `status`) VALUES (5, 'Do math homework...', 0);


-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(50),
  `password` varchar(128),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('1', 'Juan', 'juanmartin@mail.com');
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('2', 'James', 'jbond@yahoo.net');
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('3', 'Lionel', 'mess10@gmail.gol');
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('4', 'Carlos', 'bianchini@hotmail.com.ar');
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('5', 'Diego', 'diego1010@gmail.com');


-- ----------------------------
-- Table structure for notes
-- ----------------------------
DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of notes
-- ----------------------------
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('1', 'My Note 1', 'My first online note');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('2', 'Note 2', null);
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('3', 'Long Note 3', 'This is a very large note, or maybe not...');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('4', 'Note Number 4', null);
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('5', 'Note 5', 'A Random Note');
