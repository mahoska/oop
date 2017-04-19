-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Апр 19 2017 г., 12:35
-- Версия сервера: 10.1.19-MariaDB
-- Версия PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fractures`
--

-- --------------------------------------------------------

--
-- Структура таблицы `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `fracture_1` varchar(30) NOT NULL,
  `fracture_2` varchar(30) NOT NULL,
  `summ` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `log`
--

INSERT INTO `log` (`id`, `fracture_1`, `fracture_2`, `summ`) VALUES
(1, '1/2', '1/3', '5/6'),
(2, '1/10', '1/10', '1/5'),
(3, '1/2', '3/5', '11/10'),
(6, '1/2', '1/2', '1/1'),
(7, '1/2', '-5/2', '-2/1'),
(8, '0/1', '-1/2', '-1/2'),
(9, '1/5', '1/5', '2/5'),
(10, '1/5', '1/5', '2/5'),
(11, '4/5', '1/2', '13/10'),
(12, '4/2', '2/3', '8/3'),
(13, '2/1', '1/1', '3/1'),
(14, '2/1', '1/3', '7/3'),
(15, '2/5', '3/5', '1/1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
