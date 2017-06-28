CREATE DATABASE IF NOT EXISTS `db`;

CREATE TABLE IF NOT EXISTS `cash` (
  `nal_usd` INT NOT NULL,
  `nal_uah` INT NOT NULL,
  `nal_rub` INT NOT NULL,
  `b_nal_pb` INT NOT NULL,
  `b_nal_qiwi` INT NOT NULL,
  `b_nal_wmz` INT NOT NULL,
  `b_nal_wmr` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cash` (`nal_usd`, `nal_uah`, `nal_rub`, `b_nal_pb`, `b_nal_qiwi`, `b_nal_wmz`, `b_nal_wmr`) VALUES (100, 14126, 20, 641, 110, 1313, 131313);

CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` VARCHAR(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `categories` VALUES
	(NULL, 'Бытовые'),
	(NULL, 'Наука'),
	(NULL, 'Транспортные'),
	(NULL, 'Ювелирные'),
	(NULL, 'Кондитерская'),
	(NULL, 'Разработка сайтов');

CREATE TABLE IF NOT EXISTS `current_rate` (
  `current_dollar` float NOT NULL,
  `current_hryvnia` float NOT NULL,
  `current_ruble` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `current_rate` (`current_dollar`, `current_hryvnia`, `current_ruble`) VALUES (0.45, 24, 8);

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` VARCHAR(255) NOT NULL,
  `sum` INT NOT NULL,
  `payment_form_id` INT NOT NULL,
  `date` VARCHAR(255) NOT NULL,
  `subcategory_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `expenses` (`id`, `name`, `sum`, `payment_form_id`, `date`, `subcategory_id`) VALUES (1, 'Оплата коммуналки', 1300, 1, '23.05.2017', 1);

CREATE TABLE IF NOT EXISTS `incomes` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` VARCHAR(255) NOT NULL,
  `sum` INT NOT NULL,
  `payment_form_id` INT NOT NULL,
  `date` VARCHAR(255) NOT NULL,
  `partner_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `incomes` (`id`, `name`, `sum`, `payment_form_id`, `date`, `partner_id`) VALUES
	(1, 'Оплата рекламы', 1300, 1, '23.05.2017', 1),
	(2, 'Разработка логотипа', 2300, 2, '23.05.2017', 2),
	(3, 'Продажа стола', 500, 1, '22.05.2017', 1),
	(4, 'Оплата за сайт', 2900, 2, '22.05.2017', 2),
	(5, 'От Валеры', 12221, 3, '23,05,2017', 10),
	(6, 'За приложение', 1000, 1, '24.05.2017', 2),
	(7, 'test', 1000, 1, '24.05.2017', 2),
	(8, 'test', 1000, 1, '12313', 11),
	(9, 'teqwe', 500, 1, '123', 1),
	(10, 'валера', 100, 1, '214123', 10),
	(11, 'test qiwi', 100, 2, '123', 10),
	(12, 'ствол', 12750, 5, 'undefined', 10);

CREATE TABLE IF NOT EXISTS `map` (
  `lat` FLOAT NOT NULL,
  `lng` FLOAT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `map` (`lat`, `lng`) VALUES (52.5187, 103.903);

CREATE TABLE IF NOT EXISTS `partners` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `category_id` INT NOT NULL,
  `agent_name` VARCHAR(255) DEFAULT NULL,
  `agent_phone` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `partners` (`id`, `name`, `phone`, `email`, `category_id`, `agent_name`, `agent_phone`) VALUES
	(1, 'ЧП "Жилстрой"', '055123412', 'test@test.com', 1, 'Иванов Иван', '3198231983'),
	(2, 'Золотой Век', '095123673', 'zoloto@test.com', 4, 'undefined', '0'),
	(10, 'валера настало твое время', 'test@test.com', 'test@qwe.com', 4, 'undefined', '0'),
	(11, 'тест справочник', '123123', 'test@test.com', 5, 'undefined', '0');

CREATE TABLE IF NOT EXISTS `payment_forms` (
  `payment_form_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `payment_form_bank_name` VARCHAR(255) NOT NULL,
  `payment_form_currency` VARCHAR(255) NOT NULL,
  `payment_form_name` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `payment_forms` (`payment_form_id`, `payment_form_bank_name`, `payment_form_currency`, `payment_form_name`) VALUES
	(1, 'ПБ', 'Грн', 'Безнал'),
	(2, 'QIWI', 'Р', 'Безнал'),
	(3, 'WMZ', 'USD', 'Безнал'),
	(4, 'WMR', 'Р', 'Безнал'),
	(5, '', 'Грн', 'Нал'),
	(6, '', 'Р', 'Нал'),
	(7, '', 'USD', 'Нал');

CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` VARCHAR(200) NOT NULL,
  `category_id` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `subcategories` (`id`, `name`, `category_id`) VALUES
	(1, 'Печеньки', 5),
	(2, 'Сайты визитки', 7),
	(3, 'test', 7);

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');
