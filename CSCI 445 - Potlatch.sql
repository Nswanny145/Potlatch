CREATE TABLE `User` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50),
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
);

CREATE TABLE `Admin` (
  `user_id` int UNIQUE NOT NULL
);

CREATE TABLE `Potlatch` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL
);

CREATE TABLE `Item` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `potlatch_id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL
);

CREATE TABLE `Bid` (
  `item_id` int NOT NULL,
  `user_id` int NOT NULL,
  `amount` int NOT NULL,
  `timestamp` datetime NOT NULL
);

CREATE TABLE `Roster` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `potlatch_id` int NOT NULL,
  `user_id` int,
  `coins` int NOT NULL
);

CREATE TABLE `Invite` (
  `id` varchar(255) UNIQUE NOT NULL,
  `roster_id` int UNIQUE NOT NULL
);

ALTER TABLE `Admin` ADD CONSTRAINT `admin_user_fk` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

ALTER TABLE `Potlatch` ADD CONSTRAINT `potlatch_user_fk` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

ALTER TABLE `Item` ADD CONSTRAINT `item_potlatch_fk` FOREIGN KEY (`potlatch_id`) REFERENCES `Potlatch` (`id`);

ALTER TABLE `Bid` ADD CONSTRAINT `bid_item_fk` FOREIGN KEY (`item_id`) REFERENCES `Item` (`id`);

ALTER TABLE `Bid` ADD CONSTRAINT `bid_user_fk` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

ALTER TABLE `Roster` ADD CONSTRAINT `roster_potlatch_fk` FOREIGN KEY (`potlatch_id`) REFERENCES `Potlatch` (`id`);

ALTER TABLE `Roster` ADD CONSTRAINT `roster_user_fk` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

ALTER TABLE `Invite` ADD CONSTRAINT `invite_roster_fk` FOREIGN KEY (`roster_id`) REFERENCES `Roster` (`id`);
