-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 14 2016 г., 12:38
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `anunturi`
--

-- --------------------------------------------------------

--
-- Структура таблицы `anunt`
--

CREATE TABLE IF NOT EXISTS `anunt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_loc` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descriere` text NOT NULL,
  `nr_cam` int(11) NOT NULL,
  `starea` int(11) NOT NULL,
  `marimea` int(11) NOT NULL,
  `pret` int(11) NOT NULL,
  `add_data` int(11) NOT NULL,
  `vizionari` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `valabil` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`,`id_loc`),
  KEY `id_loc` (`id_loc`),
  KEY `categorie` (`categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `anunt`
--

INSERT INTO `anunt` (`id`, `id_user`, `id_loc`, `categorie`, `title`, `descriere`, `nr_cam`, `starea`, `marimea`, `pret`, `add_data`, `vizionari`, `foto`, `valabil`) VALUES
(17, 1, 2, 1, 'Botanica, Dacia, 4 camere, Urgent', 'Se vinde apartament cu 3 odai in bloc nou pe str. Alba Iulia (piata Delfin) construit de compania Ex-Factor in 2009,\r\n\r\nComplet mobilat, incalzire autonoma, curte amenajata, teren de joaca pentru copii...\r\n\r\nZona linistita, cu infrastructura bine dezvoltata, acces imediat la transportul public. In apropiere sunt situate liceu, gradinita, supermarket, banci si etc.\r\n\r\nPentru mai multe detalii nu ezitati sa telefonati! Posibil schimb pe teren pentru constructie sau casa!', 4, 3, 121, 49000, 1451564279, 23, '14515642796414.jpg::14515642796432.jpg::14515642796442.jpg::14515642796454.jpg', 1),
(19, 2, 1, 1, 'Se vinde apartament mare cu 3 camere', 'Blocul este situată într-o zonă verde  şi liniştită a Chişinăului, pe str. Ghioceilor nr.2, lingă centrul expozițional MOLDEXPO. Din ferestrele casei se deschide o panoramă frumoasă spre lacul Valea Morilor. În preajma blocului se află parc, magazine  alimentare, spital, grădiniță, scoală. \r\n  În perimetru - teren de joacă pentru copii, zona de recreare și o parcare subterană.\r\n   Clădirea este construită din carcasă beton armat prin umplerea pereților cu beton cellular(BCA). Folosind cea mai recentă tehnologie și materiale de constructie.  \r\n      La fiecare din cele 14 etaje sunt amplasate cite 4 apartamente pe scară cu 1 cameră, 2 camere și apartamente cu 3 camere.   Apartamentele se dau în exploatare în "varianta albă":\r\nperetii sunt tencuiti cu amestec uscat, încălzire autonomă inclusiv radiatoare, sunt montate rețele de electricitate , reţele inginereşti, contoarele de gaz, apă, electricitate, ferestre termopan, usi din fier la intrare, internet, televiziune, telefonie.', 3, 1, 107, 34000, 1451565021, 82, '14515650216635.jpg::14515650216644.jpg::14515650216653.JPG', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nume` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `categorie`
--

INSERT INTO `categorie` (`id`, `cat_nume`) VALUES
(1, 'Vinzare'),
(2, 'Schimbare'),
(3, 'Chirie');

-- --------------------------------------------------------

--
-- Структура таблицы `localitare`
--

CREATE TABLE IF NOT EXISTS `localitare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_loc` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `localitare`
--

INSERT INTO `localitare` (`id`, `name_loc`) VALUES
(1, 'Balti'),
(2, 'Chisinau'),
(3, 'Orhei');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL DEFAULT '1',
  `login` varchar(12) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nume` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `reg_date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_group` (`id_group`),
  KEY `id_group_2` (`id_group`),
  KEY `id_group_3` (`id_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `id_group`, `login`, `password`, `nume`, `email`, `phone`, `reg_date`) VALUES
(1, 3, 'Uzumachi', '530003d9bba5e07ead09881932144d83', 'Bejenaru Alexandru', 'uzumachi@rambler.ru', '37367364474', 1450561313),
(2, 1, 'Vasea', '98d062274f30c9e03be9cb9e791c5b9d', 'Vasile Rock', 'vasea@mail.ru', '373987654', 1450605479),
(3, 1, 'Marin', '39df81bf37be671f892a0c6e0698c892', 'Stefan M', 'marin@gmail.com', '228856', 1451412758),
(8, 2, 'MrAdmin', '750d4ed970686340dafc73eb3608e81d', 'Domnul Admin', 'MrAdmin@gmail.com', '022257333', 1451996921);

-- --------------------------------------------------------

--
-- Структура таблицы `users_group`
--

CREATE TABLE IF NOT EXISTS `users_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denumire` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users_group`
--

INSERT INTO `users_group` (`id`, `denumire`) VALUES
(1, 'Utilizator'),
(2, '<span style="color: red">Administrator</span>'),
(3, '<b style="color: #d41919">Создатель</b>');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `anunt`
--
ALTER TABLE `anunt`
  ADD CONSTRAINT `anunt_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `anunt_ibfk_2` FOREIGN KEY (`id_loc`) REFERENCES `localitare` (`id`),
  ADD CONSTRAINT `anunt_ibfk_3` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_group`) REFERENCES `users_group` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
