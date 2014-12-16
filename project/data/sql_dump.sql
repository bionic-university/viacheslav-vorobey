-- --------------------------------------------------------
-- Сервер:                       127.0.0.1
-- Server version:               5.1.71-community-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Версія:              8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for eventmapia
CREATE DATABASE IF NOT EXISTS `eventmapia` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `eventmapia`;


-- Dumping structure for table eventmapia.comment
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `text` text,
  `event_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Dumping data for table eventmapia.comment: ~11 rows (approximately)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` (`id`, `text`, `event_id`, `user_id`, `created_time`) VALUES
	(1, 'Запрошено: Варшаву, Кривий Ріг, Люблін, Мінськ, Одесу', 4, 2, '2014-12-16 22:08:51'),
	(2, 'Прогулявшись по Почтовой площади и осмотрев ее, можно уехать с нее на метро', 2, 2, '2014-12-16 22:11:30'),
	(3, 'I\'am going!', 7, 2, '2014-12-16 22:22:01'),
	(15, 'Test comment', 2, 2, '2014-12-16 22:42:42'),
	(16, 'Реєстрація закінчена', 5, 1, '2014-12-16 04:46:43');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


-- Dumping structure for table eventmapia.event
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `destinations` text,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_user_id_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table eventmapia.event: ~1 rows (approximately)
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` (`id`, `title`, `description`, `date`, `end_date`, `destinations`, `created_time`, `updated_time`, `user_id`) VALUES
	(2, 'Прогулка по историческому центру Киева', 'Итак наш маршрут :\r\nм.Площадь Льва Толстого – Арена сити – музей Пинчука – Бессарабка – Крещатик – Дом плачущей вдовы – Дом с Химерами – НацБанк Украины – Площадь Независимости – Михайловская площадь - Большая житомирская – пейзажная алея – Андреевский спуск – (памятник за двумя зайцами - Десятинная – Михайловский Златоверхий Собор )– фуникулер – м.Почтовая площадь.', '2014-12-26 11:48:00', '2014-12-27 15:48:00', 'a:7:{s:9:"routeFrom";s:83:"площа Льва Толстого, Київ, місто Київ, Україна";s:7:"latFrom";d:50.4390541;s:7:"lngFrom";d:30.5159673;s:7:"routeTo";s:72:"Поштова площа, Київ, місто Київ, Україна";s:5:"latTo";d:50.459268999999999;s:5:"lngTo";d:30.524412000000002;s:9:"routeMode";s:7:"WALKING";}', '2014-12-16 21:09:29', NULL, 3),
	(3, 'Eurotrip', '- Kyiv, Rivne\r\n- Warsaw\r\n- Berlin, Dortmund\r\n- Brussel\r\n- London', '2014-12-01 11:57:00', '2014-12-08 21:57:00', 'a:7:{s:9:"routeFrom";s:45:"Київ, місто Київ, Україна";s:7:"latFrom";d:50.450099999999999;s:7:"lngFrom";d:30.523399999999999;s:7:"routeTo";s:42:"Лондон, Великобритания";s:5:"latTo";d:51.507350899999999;s:5:"lngTo";d:-0.12775829999999999;s:9:"routeMode";s:7:"DRIVING";}', '2014-12-16 20:59:13', NULL, 1),
	(4, 'Велопробіг “Критична маса-5″ в Києві', 'У Києві відбудеться п’ята Критична Маса – громадський рух, майже спонтанне масове зібрання велосипедистів міста.\r\n\r\nЗапрошуємо усіх охочих долучитися до масової прогулянки містом у компанії друзів та однодумців.\r\n\r\nКритична маса по-українськи — це можливість для кожного велосипедиста сказати: ”Ми не блокуємо рух – ми і є рухом!”\r\n\r\nНаша мета – згуртуватися, та з повагою та чемністю заявити про себе у форматі велосипедного свята.', '2014-12-22 12:06:00', '2014-12-23 11:06:00', 'a:7:{s:9:"routeFrom";s:0:"";s:7:"latFrom";N;s:7:"lngFrom";N;s:7:"routeTo";s:85:"Парк Тараса Шевченка, Київ, місто Київ, Україна";s:5:"latTo";d:50.441878199999998;s:5:"lngTo";d:30.512908400000001;s:9:"routeMode";s:7:"DRIVING";}', '2014-12-16 21:07:53', NULL, 2),
	(5, 'Захист фінальних проектів груп E-14 та PC-2', 'Наближається завершення навчання слухачів осіннього потоку у BIONIC University. По традиції підсумком навчання є презентації фінальних проектів. \r\n \r\n16 грудня о 18:00 захищають проекти випускники групи E-14 (Java EE). Тренер - Віктор Можарський.\r\n \r\nТакож, 16 грудня о 18:30 захищають проекти випускники групи PC-2 (PHP Core). Тренер - Владислав Волков.\r\n \r\nЗапрошуємо представників IT-компаній, технічх спеціалістів, HR менеджерів відвідати захист, дати експертну оцінку роботам та рекомендації випускникам Bionic University.', '2014-12-16 18:00:00', '2014-12-16 21:00:00', 'a:7:{s:9:"routeFrom";s:0:"";s:7:"latFrom";N;s:7:"lngFrom";N;s:7:"routeTo";s:43:"BIONIC University, Kiev, Kyiv city, Ukraine";s:5:"latTo";d:50.465107499999988;s:5:"lngTo";d:30.521178299999999;s:9:"routeMode";s:7:"WALKING";}', '2014-12-16 21:59:28', NULL, 1),
	(7, 'NIGHT MADNESS 2014', 'NIGHT MADNESS 2014 ВЕЛОМАРАФОН\r\n\r\nМета змагань\r\nПопуляризація гірського велосипеда та велосипедного руху в Україні.\r\nВизначення найкращих спортсменів-аматорів велосипедного MTБ-спорту України.\r\nПропаганда здорового способу життя, активного відпочинку.\r\nРозвиток нових тенденції в організації велосипедних заходів в Україні. ', '2014-12-18 02:16:00', '2014-12-21 02:16:00', 'a:7:{s:9:"routeFrom";s:95:"Дніпропетровськ, Дніпропетровська область, Україна";s:7:"latFrom";d:48.464717;s:7:"lngFrom";d:35.046182999999999;s:7:"routeTo";s:97:"Івано-Франківськ, Івано-Франківська область, Україна";s:5:"latTo";d:48.922632999999998;s:5:"lngTo";d:24.711117000000002;s:9:"routeMode";s:7:"DRIVING";}', '2014-12-16 21:16:58', NULL, 2);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;


-- Dumping structure for table eventmapia.event_user
CREATE TABLE IF NOT EXISTS `event_user` (
  `event_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`event_id`,`user_id`),
  KEY `event_user_event_id_idx` (`event_id`),
  KEY `event_user_user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table eventmapia.event_user: ~5 rows (approximately)
/*!40000 ALTER TABLE `event_user` DISABLE KEYS */;
INSERT INTO `event_user` (`event_id`, `user_id`) VALUES
	(4, 3),
	(5, 1),
	(5, 3),
	(5, 4),
	(5, 11),
	(7, 3),
	(7, 4);
/*!40000 ALTER TABLE `event_user` ENABLE KEYS */;


-- Dumping structure for table eventmapia.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table eventmapia.user: ~8 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `password`, `username`, `created_time`, `active`, `admin`) VALUES
	(1, 'admin@example.com', '7b21848ac9af35be0ddb2d6b9fc3851934db8420', 'Administrator', '2014-12-16 04:30:40', 1, 0),
	(2, 'demo@example.com', '7b21848ac9af35be0ddb2d6b9fc3851934db8420', 'Jessica Palma', '2014-12-16 04:35:57', 1, 0),
	(3, 'mikedoe@gmail.com', '7b21848ac9af35be0ddb2d6b9fc3851934db8420', 'Mike Doe', '2014-12-16 04:37:06', 1, 0),
	(4, 'johndoe@gmail.com', '7b21848ac9af35be0ddb2d6b9fc3851934db8420', 'Pawlick Morozoff', '2014-12-16 04:37:32', 1, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
