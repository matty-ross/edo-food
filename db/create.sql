-- vytvorenie databázy 'edo-food'
CREATE DATABASE `edo_food`
    CHARACTER SET = 'utf8mb4';
USE `edo_food`;

-- jedlá
CREATE TABLE `meals` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `price` decimal(10,2) unsigned NOT NULL,
    `amount` decimal(10,2) unsigned NOT NULL,
    `meal_type` enum('soup','main_dish') NOT NULL,
    `last_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`)
);

-- alergény
CREATE TABLE `allergens` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `last_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`)
);

-- alergény pre jedlá
CREATE TABLE `meals_allergens` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `meal` int(10) unsigned NOT NULL,
    `allergen` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `meal` (`meal`),
    KEY `allergen` (`allergen`),
    CONSTRAINT `meals_allergens_meal` FOREIGN KEY (`meal`) REFERENCES `meals` (`id`)
    CONSTRAINT `meals_allergens_allergen` FOREIGN KEY (`allergen`) REFERENCES `allergens` (`id`),
);

-- ľudia
CREATE TABLE `people` (
    `id` int(10) unsigned NOT NULL,
    `card_id` varchar(10) NOT NULL,
    `full_name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `credit` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
    `admin` enum('Y','N') NOT NULL DEFAULT 'N',
    `last_edit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `card_id` (`card_id`)
    UNIQUE KEY `email` (`email`)
);

-- položky v menu
CREATE TABLE `menu_items` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `meal` int(10) unsigned NOT NULL,
    `date` date NOT NULL,
    PRIMARY KEY (`id`),
    KEY `meal` (`meal`),
    CONSTRAINT `menu_items_meal` FOREIGN KEY (`meal`) REFERENCES `meals` (`id`)
);

-- objednávky
CREATE TABLE `orders` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `menu_item` int(10) unsigned NOT NULL,
    `person` int(10) unsigned NOT NULL,
    `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `valid` enum('Y','N') NOT NULL DEFAULT 'Y',
    PRIMARY KEY (`id`),
    KEY `menu_item` (`menu_item`),
    KEY `person` (`person`),
    CONSTRAINT `orders_menu_item` FOREIGN KEY (`menu_item`) REFERENCES `menu_items` (`id`),
    CONSTRAINT `orders_person` FOREIGN KEY (`person`) REFERENCES `people` (`id`)
);