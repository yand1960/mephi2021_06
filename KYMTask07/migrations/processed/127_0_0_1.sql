-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 06 2021 г., 19:28
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `albumkym3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `PhotoID` int(11) NOT NULL,
  `URL` varchar(256) NOT NULL,
  `URL_large` varchar(256) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`PhotoID`, `URL`, `URL_large`, `Name`, `Created`) VALUES
(17, 'april-meyer.jpg', 'april-meyer-large.jpg', 'april meyer (Эйприл Мейер)', '2021-10-09'),
(18, 'david-alexander.jpg', 'david-alexander-large.jpg', 'david alexander', '2021-10-09'),
(19, 'mark-hanson.jpg', 'mark-hanson-large.jpg', 'mark hanson', '2021-10-09'),
(20, 'melissa-kerr.jpg', 'melissa-kerr-large.jpg', 'melissa kerr', '2021-10-09'),
(40, 'ozzy.jpg', 'ozzy-large.jpg', 'Ozzy Osbourne', '2021-11-06'),
(41, 'bowie.jpg', 'bowie-large.jpg', 'David Bowie', '2021-11-06'),
(42, 'lennon.jpg', 'lennon-large.jpg', 'John Lennon', '2021-11-06'),
(43, 'clapton.jpg', 'clapton-large.jpg', 'Eric Clapton', '2021-11-06');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`PhotoID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `PhotoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

