-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for edo_food
CREATE DATABASE IF NOT EXISTS `edo_food` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `edo_food`;

-- Dumping structure for table edo_food.allergens
CREATE TABLE IF NOT EXISTS `allergens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `last_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edo_food.allergens: ~8 rows (approximately)
DELETE FROM `allergens`;
/*!40000 ALTER TABLE `allergens` DISABLE KEYS */;
INSERT INTO `allergens` (`id`, `name`, `last_edit`) VALUES
	(1, 'lepok', '2022-10-16 12:51:20'),
	(2, 'mlieko', '2022-10-16 12:51:20'),
	(3, 'vajcia', '2022-10-16 12:51:20'),
	(4, 'ryby', '2022-10-16 12:51:20'),
	(5, 'arašidy', '2022-10-16 12:51:20'),
	(6, 'sójové zrná', '2022-10-16 12:51:20'),
	(8, 'škrob', '2022-10-16 12:51:20'),
	(11, 'kukurica', '2022-10-16 12:51:20');
/*!40000 ALTER TABLE `allergens` ENABLE KEYS */;

-- Dumping structure for table edo_food.meals
CREATE TABLE IF NOT EXISTS `meals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) unsigned NOT NULL,
  `amount` decimal(10,2) unsigned NOT NULL,
  `meal_type` enum('soup','main_dish') NOT NULL,
  `last_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edo_food.meals: ~15 rows (approximately)
DELETE FROM `meals`;
/*!40000 ALTER TABLE `meals` DISABLE KEYS */;
INSERT INTO `meals` (`id`, `name`, `price`, `amount`, `meal_type`, `last_edit`) VALUES
	(1, 'Brokolicová krémova vec', 10.69, 5.00, 'soup', '2022-09-22 18:41:21'),
	(2, 'Slepačí vývar s mäsom a rezancami', 0.00, 0.33, 'soup', '2022-09-22 18:53:41'),
	(3, 'Držková desiatová', 2.70, 0.50, 'soup', '2022-09-29 18:42:59'),
	(4, 'Moravský bravčový vrabec , kyslá kapusta , knedľa', 5.50, 120.00, 'main_dish', '2022-09-22 18:41:21'),
	(5, 'Bravčové kocky na Bratislavský spôsob, cestovina', 5.00, 120.00, 'main_dish', '2022-09-27 20:05:55'),
	(6, 'Grilované kurča ¼ ( stehno , alebo krídlo ) , ryža , kompót', 5.20, 260.00, 'main_dish', '2022-09-22 18:41:21'),
	(7, 'Cesnaková so šunkou a syrom', 1.80, 0.33, 'soup', '2022-09-22 18:41:21'),
	(8, 'Kurací vyprážaný rezeň', 5.20, 150.00, 'main_dish', '2022-09-22 18:41:21'),
	(9, 'Fazuľová krémová', 0.00, 0.25, 'soup', '2022-09-22 18:53:43'),
	(11, 'Býčie vajca', 5.70, 300.00, 'main_dish', '2022-09-23 20:12:03'),
	(12, 'Korytnačia polievka', 0.00, 2.00, 'soup', '2022-09-22 18:53:45'),
	(18, 'Šnicel', 6.00, 500.00, 'main_dish', '2022-09-22 19:32:12'),
	(19, 'Šutelica', 1.00, 0.50, 'soup', '2022-09-22 18:41:21'),
	(20, 'Bravčové výpečky', 5.00, 200.00, 'main_dish', '2022-09-22 18:41:21'),
	(26, 'Hovädzí steak s hranolkami', 6.00, 350.00, 'main_dish', '2022-09-25 19:50:48');
/*!40000 ALTER TABLE `meals` ENABLE KEYS */;

-- Dumping structure for table edo_food.meals_allergens
CREATE TABLE IF NOT EXISTS `meals_allergens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meal` int(10) unsigned NOT NULL,
  `allergen` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meal` (`meal`),
  KEY `allergen` (`allergen`),
  CONSTRAINT `meals_allergens_allergen` FOREIGN KEY (`allergen`) REFERENCES `allergens` (`id`),
  CONSTRAINT `meals_allergens_meal` FOREIGN KEY (`meal`) REFERENCES `meals` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edo_food.meals_allergens: ~12 rows (approximately)
DELETE FROM `meals_allergens`;
/*!40000 ALTER TABLE `meals_allergens` DISABLE KEYS */;
INSERT INTO `meals_allergens` (`id`, `meal`, `allergen`) VALUES
	(3, 7, 3),
	(4, 4, 6),
	(5, 4, 5),
	(9, 18, 1),
	(10, 18, 2),
	(11, 1, 5),
	(12, 1, 2),
	(13, 1, 3),
	(14, 26, 1),
	(15, 26, 3),
	(16, 26, 8),
	(17, 5, 5),
	(18, 3, 1);
/*!40000 ALTER TABLE `meals_allergens` ENABLE KEYS */;

-- Dumping structure for table edo_food.menu_items
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meal` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meal` (`meal`),
  CONSTRAINT `menu_items_meal` FOREIGN KEY (`meal`) REFERENCES `meals` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edo_food.menu_items: ~12 rows (approximately)
DELETE FROM `menu_items`;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` (`id`, `meal`, `date`) VALUES
	(15, 5, '2022-09-26'),
	(17, 9, '2022-09-28'),
	(18, 11, '2022-09-28'),
	(19, 18, '2022-09-28'),
	(20, 5, '2022-09-28'),
	(22, 4, '2022-09-29'),
	(23, 3, '2022-09-29'),
	(24, 8, '2022-09-29'),
	(25, 6, '2022-09-29'),
	(26, 1, '2022-09-28'),
	(27, 3, '2022-09-28'),
	(28, 2, '2022-09-29');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;

-- Dumping structure for table edo_food.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_item` int(10) unsigned NOT NULL,
  `person` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valid` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `orders_menu_item` (`menu_item`),
  KEY `person` (`person`),
  CONSTRAINT `orders_menu_item` FOREIGN KEY (`menu_item`) REFERENCES `menu_items` (`id`),
  CONSTRAINT `orders_person` FOREIGN KEY (`person`) REFERENCES `people` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edo_food.orders: ~0 rows (approximately)
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `menu_item`, `person`, `timestamp`, `valid`) VALUES
	(5, 22, 123456789, '2022-10-06 18:47:24', 'Y');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table edo_food.people
CREATE TABLE IF NOT EXISTS `people` (
  `id` int(10) unsigned NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `credit` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `admin` enum('Y','N') NOT NULL DEFAULT 'N',
  `last_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edo_food.people: ~2 rows (approximately)
DELETE FROM `people`;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` (`id`, `full_name`, `email`, `password`, `credit`, `admin`, `last_edit`) VALUES
	(123456789, 'Tester Admin', 'admin@edofood.com', 'e7d012abd5716788da1868943d9488c3df6bc56c43fb5cd12e24de5e4410f66f', 150.00, 'Y', '2022-09-23 20:15:45'),
	(147258369, 'Tester Testovač', 'tester@edofood.com', '78005eb4fff88b1dcc9b0020aadaabe719b85f22aa47e5ce16d73ee20d188365', 5.00, 'N', '2022-09-23 20:15:52');
/*!40000 ALTER TABLE `people` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
