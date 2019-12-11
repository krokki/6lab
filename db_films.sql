-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 12 2019 г., 00:20
-- Версия сервера: 10.4.10-MariaDB
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_films`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cinema`
--

CREATE TABLE `cinema` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `cinema`
--

INSERT INTO `cinema` (`id`, `name`, `address`) VALUES
(4, 'KinoMax', 'St. Green, 9'),
(5, 'KinoLenta', 'Volgogradskaya, 10');

-- --------------------------------------------------------

--
-- Структура таблицы `films`
--

CREATE TABLE `films` (
  `id` int(255) NOT NULL,
  `namefilm` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `age` int(2) UNSIGNED NOT NULL,
  `country` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `films`
--

INSERT INTO `films` (`id`, `namefilm`, `year`, `genre`, `age`, `country`, `file`) VALUES
(2, 'testo', 0000, 'qwer', 0, 'rus', 'pic_5df172ad7b6ae'),
(3, 'tesq', 2007, 'Adventure', 14, 'England', 'pic_5df1744e9ec89');

-- --------------------------------------------------------

--
-- Структура таблицы `table_cinema_films`
--

CREATE TABLE `table_cinema_films` (
  `cinema_id` int(255) NOT NULL,
  `film_id` int(255) NOT NULL,
  `films` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `age` int(2) UNSIGNED NOT NULL,
  `country` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `table_cinema_films`
--

INSERT INTO `table_cinema_films` (`cinema_id`, `film_id`, `films`, `year`, `genre`, `age`, `country`, `file`) VALUES
(4, 2, 'testo', 0000, 'qwer', 0, 'rus', 'pic_5df172ad7b6ae'),
(4, 3, 'tesq', 2007, 'Adventure', 14, 'England', 'pic_5df1744e9ec89'),
(5, 2, 'testovichokjbhh', 0000, 'qwer', 0, 'rus', 'pic_5df172ad7b6ae'),
(5, 3, 'tesq', 2007, 'Adventure', 14, 'England', 'pic_5df1744e9ec89');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES
(1, 'proko', 'pokoe@gmail.com', '$2y$10$R5wNOOsl57uWpsViWhBDJ.UZtDe3/RPq8.B5QF/2ps7dS3nTDJqxK');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cinema`
--
ALTER TABLE `cinema`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `namefilm` (`namefilm`);

--
-- Индексы таблицы `table_cinema_films`
--
ALTER TABLE `table_cinema_films`
  ADD PRIMARY KEY (`cinema_id`,`film_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cinema`
--
ALTER TABLE `cinema`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `films`
--
ALTER TABLE `films`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
