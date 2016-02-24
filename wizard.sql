-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 28 2015 г., 17:14
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `wizard`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pm_imbox`
--

CREATE TABLE IF NOT EXISTS `pm_imbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` tinyint(4) NOT NULL,
  `username` varchar(150) NOT NULL,
  `from_id` tinyint(4) NOT NULL,
  `from_username` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` longtext NOT NULL,
  `viewed` enum('0','1') NOT NULL DEFAULT '0',
  `recieve_date` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `pm_imbox`
--

INSERT INTO `pm_imbox` (`id`, `userid`, `username`, `from_id`, `from_username`, `title`, `content`, `viewed`, `recieve_date`) VALUES
(14, 5, 'anton', 5, 'anton', 'qsd', 'sad', '1', '1, 28th June 2015, 3:12:20 am'),
(15, 5, 'anton', 5, 'anton', 'wdwd', 'sds', '0', '1, 28th June 2015, 3:13:51 am'),
(16, 5, 'anton', 5, 'anton', 'ada', 'asxd', '0', '1, 28th June 2015, 3:14:49 am'),
(19, 7, 'test', 4, 'jora', 'lkansdkj', 'adsksndkjansdjk', '0', '1, 28th June 2015, 2:03:20 pm'),
(20, 5, 'anton', 4, 'jora', 'hi', 'hello russia', '1', '1, 28th June 2015, 2:13:17 pm');

-- --------------------------------------------------------

--
-- Структура таблицы `pm_outbox`
--

CREATE TABLE IF NOT EXISTS `pm_outbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` tinyint(4) NOT NULL,
  `username` varchar(150) NOT NULL,
  `to_userid` tinyint(4) NOT NULL,
  `to_username` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` longtext NOT NULL,
  `senddate` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `pm_outbox`
--

INSERT INTO `pm_outbox` (`id`, `userid`, `username`, `to_userid`, `to_username`, `title`, `content`, `senddate`) VALUES
(10, 5, 'anton', 4, 'jora', 'wsd', 'qwe', '1, 28th June 2015, 3:02:54 am'),
(11, 5, 'anton', 5, 'anton', 'qsd', 'sad', '1, 28th June 2015, 3:12:20 am'),
(12, 5, 'anton', 5, 'anton', 'wdwd', 'sds', '1, 28th June 2015, 3:13:51 am'),
(13, 5, 'anton', 5, 'anton', 'ada', 'asxd', '1, 28th June 2015, 3:14:49 am'),
(17, 4, 'jora', 5, 'anton', 'hi', 'hello russia', '1, 28th June 2015, 2:13:17 pm');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(220) NOT NULL,
  `email` varchar(170) NOT NULL,
  `showing` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `showing`) VALUES
(9, 'jora', 'jora', '', '1'),
(10, 'valya', '123', '', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
