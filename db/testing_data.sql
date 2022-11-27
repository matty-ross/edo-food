-- alergény
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

-- jedlá
INSERT INTO `meals` (`id`, `name`, `price`, `amount`, `meal_type`, `last_edit`) VALUES
    (1, 'Hrachový krém, klobáska, 1 ks chlieb', 0.00, 0.33, 'soup', '2022-10-23 12:39:38'),
    (2, 'Slepačí vývar s mäsom a rezancami', 0.00, 0.33, 'soup', '2022-10-23 12:40:05'),
    (3, 'Držková desiatová, 2 ks chlieb', 2.90, 0.50, 'soup', '2022-10-23 12:40:25'),
    (4, 'Bravčový mletý rezeň so syrom, zemiaky varené, čalamáda', 5.90, 240.00, 'main_dish', '2022-10-23 12:41:01'),
    (6, 'Kurací steak, syrová omáčka, ½ ryža, ½ hranolky', 5.70, 240.00, 'main_dish', '2022-10-23 12:42:51'),
    (7, 'Mix zeleninový šalát, kuracie stripsy, BBQ dressing,  toust', 5.00, 200.00, 'main_dish', '2022-10-23 12:44:13');

-- alergény pre jedlá
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

-- položky v menu
INSERT INTO `menu_items` (`id`, `meal`, `date`) VALUES
    (1, 1, '2022-10-23'),
    (2, 4, '2022-10-23'),
    (3, 7, '2022-10-23');

-- ľudia
INSERT INTO `people` (`id`, `full_name`, `email`, `password`, `credit`, `admin`, `last_edit`) VALUES
    (123456789, 'Tester Admin', 'admin@edofood.com', 'e7d012abd5716788da1868943d9488c3df6bc56c43fb5cd12e24de5e4410f66f', 150.00, 'Y', '2022-09-23 20:15:45'),
    (147258369, 'Tester Testovač', 'tester@edofood.com', '78005eb4fff88b1dcc9b0020aadaabe719b85f22aa47e5ce16d73ee20d188365', 5.00, 'N', '2022-09-23 20:15:52');

-- objednávky
INSERT INTO `orders` (`id`, `menu_item`, `person`, `timestamp`, `valid`) VALUES
    (1, 1, 123456789, '2022-10-23 19:51:26', 'Y'),
    (2, 3, 123456789, '2022-10-23 19:51:29', 'Y');