-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 23 2021 г., 12:11
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `album`
--
CREATE DATABASE IF NOT EXISTS `albumAR` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `albumAR`;

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `photoId` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `name` varchar(64) NOT NULL,
  `created` date NOT NULL,
  `urlLarge` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`photoId`, `url`, `name`, `created`, `urlLarge`) VALUES
(81, 'images/april-meyer.jpg', 'april meyer', '2021-10-09', 'images/april-meyer-large.jpg'),
(82, 'images/david-alexander.jpg', 'david alexander', '2021-10-09', 'images/david-alexander-large.jpg'),
(83, 'images/mark-hanson.jpg', 'mark hanson', '2021-10-09', 'images/mark-hanson-large.jpg'),
(84, 'images/melissa-kerr.jpg', 'melissa kerr', '2021-10-09', 'images/melissa-kerr-large.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photoId`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `photoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
