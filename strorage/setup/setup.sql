CREATE TABLE `postdata` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `tree_key` varchar(255) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` varchar(255) NULL,
  `create_at` int(11) NOT NULL,
  `update_at` int(11) NOT NULL,
  `delete_at` int(11) NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  INDEX `tree_key` (`tree_key`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
CREATE TABLE `users__` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `sid` varchar(64) NOT NULL,
  `login` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `psswd` varchar(80) NOT NULL,
  `restime` int(11) NOT NULL,
  `regtime` int(11) NOT NULL,
  `descr` text NOT NULL,
  `roles` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sid` (`sid`),
  UNIQUE KEY `login` (`login`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
