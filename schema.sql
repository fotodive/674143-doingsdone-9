CREATE DATABASE IF NOT EXISTS `doingsdone`;
USE `doingsdone`;

CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`project_id`),
  UNIQUE KEY `title` (`title`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_task` int(11) DEFAULT '0',
  `title` char(128) NOT NULL,
  `file_task` char(128) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` char(128) NOT NULL,
  `name` char(128) NOT NULL,
  `password` char(64) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
