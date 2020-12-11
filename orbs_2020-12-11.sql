# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 8.0.19)
# Database: orbs
# Generation Time: 2020-12-11 16:13:55 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cart
# ------------------------------------------------------------

CREATE TABLE `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `code` int DEFAULT NULL,
  `food` varchar(100) DEFAULT NULL,
  `qty` int NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;

INSERT INTO `cart` (`cart_id`, `code`, `food`, `qty`, `user_id`)
VALUES
	(29,13760,'Jollof Rice ',3,5),
	(31,71668,'Chips and Eggs',1,6);

/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table food
# ------------------------------------------------------------

CREATE TABLE `food` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_of_food` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `cost` varchar(10) NOT NULL,
  `description` varchar(225) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `category` varchar(10) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `food` WRITE;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;

INSERT INTO `food` (`id`, `name_of_food`, `cost`, `description`, `code`, `image`, `category`, `date`)
VALUES
	(1,'Chips and Eggs','200','Lorem Ipsum is simply dummy text of the printing and typesetting industry. ','ChipsE2','images/chips and egg.jpg','Breakfast','2020-04-01 00:00:00'),
	(2,'Jollof Rice ','700','The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; ','Jollof002','images/jollof rice.jpg','Lunch','2020-04-01 00:00:00'),
	(3,'Pounded Yam','1000','There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#039;t look even slightly believable.','Poundy001','images/Pounded-Yam-with-Egusi-Soup-1.jpg','Dinner','2020-04-01 00:00:00');

/*!40000 ALTER TABLE `food` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table meal_type
# ------------------------------------------------------------

CREATE TABLE `meal_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `meal_type` WRITE;
/*!40000 ALTER TABLE `meal_type` DISABLE KEYS */;

INSERT INTO `meal_type` (`id`, `name`)
VALUES
	(4,'Breakfast'),
	(5,'Lunch'),
	(6,'Dinner'),
	(7,'Dessert');

/*!40000 ALTER TABLE `meal_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table orders
# ------------------------------------------------------------

CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `total` varchar(50) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;

INSERT INTO `orders` (`order_id`, `user_id`, `name`, `email`, `address`, `phone`, `total`, `status`, `date`)
VALUES
	(29,5,'Dickson','dickson@orbs.com','Kaduna','+447990719422','2100','confirmed','2020-05-12'),
	(30,6,'admin','admin@orbs.com','kaduna','09035041854','200','pending','2020-05-28');

/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reserve
# ------------------------------------------------------------

CREATE TABLE `reserve` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_of_persons` int NOT NULL,
  `phone` varchar(100) NOT NULL,
  `time` varchar(50) NOT NULL,
  `msg` text,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `reserve` WRITE;
/*!40000 ALTER TABLE `reserve` DISABLE KEYS */;

INSERT INTO `reserve` (`id`, `name`, `email`, `no_of_persons`, `phone`, `time`, `msg`, `date`)
VALUES
	(1,'Dickson','dickson@orbs.com',2,'09035041854','8AM TO 10AM','sjdfhjjhfhhajsfh ahhahjfdahjhjas jsahjhjadhjashjdhjas jhashjdhjahjdahjda','02-04-2020'),
	(2,'Dickson','dickson@orbs.com',3,'09035041854','10AM TO 12PM','lkhkjaf jhjkajfjk agfka kfg afasfkag fasufuias fasfsaugfuasgufasu gfiuaf','02-04-2020'),
	(3,'Akoke','antoakay@gmail.com',4,'09035041854','10AM TO 12PM','klkjhashkhds aiugduuaysgdad','02-04-2020');

/*!40000 ALTER TABLE `reserve` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`)
VALUES
	(1,'','zizohanto@yahoo.com','1234567',1),
	(2,'','veeqanto@gmail.com','243e61e9410a9f577d2d662c67025ee9',2),
	(3,'','admin@orbs.com','12345678',1),
	(5,'Dickson','dickson@orbs.com','$2y$10$XSticxINJDvvGxcgFWL7i.I2uLrF3nuerFKPEgnXzsr7ILJ0zrC5O',1),
	(6,'Akoke Anto','antoakay@gmail.com','$2y$10$iusesomecrazystrings2u7pw9iX8.UITurTbhib6PcWtsreyfzKG',2);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
