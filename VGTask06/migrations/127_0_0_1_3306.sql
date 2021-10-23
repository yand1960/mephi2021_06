-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 23 2021 г., 12:10
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.0.10

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
CREATE DATABASE IF NOT EXISTS `albumVG3` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `albumVG3`;

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
(13, 'april-meyer.jpg', 'april-meyer-large.jpg', 'april meyer (Айприл Мейер)', '2021-10-09'),
(14, 'david-alexander.jpg', 'david-alexander-large.jpg', 'david alexander', '2021-10-09'),
(15, 'mark-hanson.jpg', 'mark-hanson-large.jpg', 'mark hanson', '2021-10-09'),
(16, 'melissa-kerr.jpg', 'melissa-kerr-large.jpg', 'melissa kerr', '2021-10-09');

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
  MODIFY `PhotoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

