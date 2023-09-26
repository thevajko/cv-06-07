-- Adminer 4.8.1 MySQL 11.1.2-MariaDB-1:11.1.2+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `post_id` int(11) DEFAULT NULL,
                         `liker` text NOT NULL,
                         PRIMARY KEY (`id`),
                         KEY `Likes_posts_id_fk` (`post_id`),
                         CONSTRAINT `Likes_posts_id_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `likes` (`id`, `post_id`, `liker`) VALUES
                                                   (2,	2,	'test'),
                                                   (3,	1,	'test'),
                                                   (5,	1,	'janko'),
                                                   (7,	2,	'janko'),
                                                   (8,	2,	'eva'),
                                                   (9,	2,	'peter'),
                                                   (10,	2,	'fly');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `text` text DEFAULT NULL,
                         `picture` varchar(300) NOT NULL,
                         `user` text NOT NULL DEFAULT 'Anonym',
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `posts` (`id`, `text`, `picture`, `user`) VALUES
                                                          (1,	'asdasdasd as da sda sdasdasd asdasdasda sda sda sd asd asd',	'https://images.unsplash.com/photo-1481349518771-20055b2a7b24?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cmFuZG9tfGVufDB8fDB8fHww&w=1000&q=80',	'ivo'),
                                                          (2,	'Tu nic nieje',	'https://www.thisiscolossal.com/wp-content/uploads/2017/04/MatRandom_12.jpg',	'TheMonkeyBussines');

-- 2023-09-26 11:52:39