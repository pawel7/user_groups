DROP TABLE IF EXISTS `groups`;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS user_groups;

CREATE TABLE `groups` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `groups` ADD UNIQUE( `name`);

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` char(32) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `born_at` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `users` ADD UNIQUE( `username`);

CREATE TABLE `user_groups` (
  `group_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`group_id`,`user_id`),
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB;

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `born_at`) 
VALUES (NULL, 'adam', md5('kzwimz'), 'Adam', 'Adamski', '1980-01-01'),
       (NULL, 'beata', md5('pscts'), 'Beata', 'Babacka', '1992-02-02'),
       (NULL, 'celina', md5('1234'), 'Celina', 'Kowalska', '2003-03-03'),
       (NULL, 'dorota', md5('2345'), 'Dorota', 'Nowak', '1990-04-04');

INSERT INTO `groups` (`id`, `name`) 
  VALUES 
  (NULL, 'Pierwsza grupa'), 
  (NULL, 'Druga ciekawa grupa'), 
  (NULL, 'To jest trzecia grupa'),
  (NULL, 'Czwarta grupa o długiej nazwie'),
  (NULL, 'Piąta grupa dobra dla każdego'),
  (NULL, 'Szósta grupa na początku bez użytkowników');

INSERT INTO `user_groups` (`group_id`, `user_id`) 
  VALUES 
  (1, 1),         (1, 3),
          (2, 2),
  (3, 1), (3, 2), (3, 3),
          (4, 2), (4, 3),
  (5, 1), (5, 2), (5, 3);


ALTER TABLE `user_groups` ADD  CONSTRAINT `user_groups_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `user_groups` ADD  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
