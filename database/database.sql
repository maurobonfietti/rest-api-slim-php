
-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (1, 'Go to cinema', 1, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (2, 'Buy shoes', 0, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (3, 'Go to shopping', 0, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (4, 'Pay the credit card ;-)', 1, 8);
INSERT INTO `tasks` (`id`, `name`, `status`, `userId`) VALUES (5, 'Do math homework...', 0, 8);


-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL UNIQUE,
  `password` varchar(128),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Juan', 'juanmartin@mail.com', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('James', 'jbond@yahoo.net', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Lionel', 'mess10@gmail.gol', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Carlos', 'bianchini@hotmail.com.ar', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Diego', 'diego1010@gmail.com', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('One User', 'one@user.com', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Diegol', 'diego@gol.com.ar', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');
INSERT INTO `users` (`name`, `email`, `password`) VALUES ('Test User', 'test@user.com', 'd5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e');

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
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('2', 'Chinese Proverb', 'Those who say it can not be done, should not interrupt those doing it.');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('3', 'Long Note 3', 'This is a very large note, or maybe not...');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('4', 'Napoleon Hill', 'Whatever the mind of man can conceive and believe, it can achieve.');
INSERT INTO `notes` (`id`, `name`, `description`) VALUES ('5', 'Note 5', 'A Random Note');
