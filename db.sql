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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edo_food.allergens: ~13 rows (approximately)
DELETE FROM `allergens`;
/*!40000 ALTER TABLE `allergens` DISABLE KEYS */;
INSERT INTO `allergens` (`id`, `name`, `last_edit`) VALUES
	(1, 'lepok', '2022-10-23 12:36:23'),
	(2, 'kôrovce', '2022-10-23 12:36:29'),
	(3, 'vajcia', '2022-10-23 12:36:35'),
	(5, 'arašidy', '2022-10-23 12:38:12'),
	(6, 'sójové zrná', '2022-10-23 12:37:03'),
	(7, 'mlieko', '2022-10-23 12:37:09'),
	(8, 'orechy', '2022-10-23 12:37:14'),
	(9, 'zeler', '2022-10-23 12:37:19'),
	(10, 'horčica', '2022-10-23 12:37:25'),
	(11, 'sezamové zrná', '2022-10-23 12:37:31'),
	(12, 'oxid siričitý', '2022-10-23 12:37:36'),
	(13, 'vlčí bôb', '2022-10-23 12:37:40'),
	(14, 'mäkkýše', '2022-10-23 12:37:43'),
	(15, 'ryby', '2022-10-23 12:36:50');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edo_food.meals: ~6 rows (approximately)
DELETE FROM `meals`;
/*!40000 ALTER TABLE `meals` DISABLE KEYS */;
INSERT INTO `meals` (`id`, `name`, `price`, `amount`, `meal_type`, `last_edit`) VALUES
	(1, 'Hrachový krém, klobáska, 1 ks chlieb', 0.00, 0.33, 'soup', '2022-10-23 12:39:38'),
	(2, 'Slepačí vývar s mäsom a rezancami', 0.00, 0.33, 'soup', '2022-10-23 12:40:05'),
	(3, 'Držková desiatová, 2 ks chlieb', 2.90, 0.50, 'soup', '2022-10-23 12:40:25'),
	(4, 'Bravčový mletý rezeň so syrom, zemiaky varené, čalamáda', 5.90, 240.00, 'main_dish', '2022-10-23 12:41:01'),
	(6, 'Kurací steak, syrová omáčka, ½ ryža, ½ hranolky', 5.70, 240.00, 'main_dish', '2022-10-23 12:42:51'),
	(7, 'Mix zeleninový šalát, kuracie stripsy, BBQ dressing,  toust', 5.00, 200.00, 'main_dish', '2022-10-23 12:44:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edo_food.meals_allergens: ~14 rows (approximately)
DELETE FROM `meals_allergens`;
/*!40000 ALTER TABLE `meals_allergens` DISABLE KEYS */;
INSERT INTO `meals_allergens` (`id`, `meal`, `allergen`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 2, 3),
	(4, 3, 1),
	(5, 4, 1),
	(6, 4, 3),
	(7, 4, 7),
	(11, 6, 1),
	(12, 6, 3),
	(13, 6, 7),
	(14, 7, 1),
	(15, 7, 2),
	(16, 7, 7),
	(17, 7, 9);
/*!40000 ALTER TABLE `meals_allergens` ENABLE KEYS */;

-- Dumping structure for table edo_food.menu_items
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `meal` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `meal` (`meal`),
  CONSTRAINT `menu_items_meal` FOREIGN KEY (`meal`) REFERENCES `meals` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edo_food.menu_items: ~2 rows (approximately)
DELETE FROM `menu_items`;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` (`id`, `meal`, `date`) VALUES
	(1, 1, '2022-10-23'),
	(2, 4, '2022-10-23'),
	(3, 7, '2022-10-23');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table edo_food.orders: ~2 rows (approximately)
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `menu_item`, `person`, `timestamp`, `valid`) VALUES
	(1, 1, 123456789, '2022-10-23 19:51:26', 'Y'),
	(2, 3, 123456789, '2022-10-23 19:51:29', 'Y');
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
