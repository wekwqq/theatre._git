-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 19 2022 г., 18:19
-- Версия сервера: 10.6.11-MariaDB-1:10.6.11+maria~ubu2004
-- Версия PHP: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `845-19_theatre`
--
CREATE DATABASE IF NOT EXISTS `845-19_theatre` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `845-19_theatre`;

-- --------------------------------------------------------

--
-- Структура таблицы `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `theatre_id` int(11) NOT NULL,
  `date_b` varchar(200) NOT NULL,
  `time_b` varchar(200) NOT NULL,
  `idusr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `booking`
--

INSERT INTO `booking` (`id`, `theatre_id`, `date_b`, `time_b`, `idusr`) VALUES
(1, 2, '21-12-2022', '18:00', 4),
(2, 2, '21-12-2022', '18:00', 7),
(3, 3, '20-12-2022', '12:00', 7),
(4, 1, '03-01-2023', '16:00', 7),
(5, 2, '07-01-2023', '10:00', 7),
(6, 3, '15-01-2023', '08:00', 7),
(7, 2, '15-01-2023', '09:00', 7),
(8, 1, '08-02-2023', '19:00', 7),
(9, 2, '04-02-2023', '19:00', 7),
(10, 3, '04-07-2023', '18:00', 7),
(11, 2, '08-02-2028', '10:00', 7),
(12, 1, '08-02-2023', '10:00', 7),
(13, 3, '12-05-2023', '18:00', 7),
(14, 2, '28-09-2023', '12:00', 7),
(15, 1, '133-04-2023', '19:00', 7),
(16, 1, '133-04-2023', '19:00', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `theatres`
--

CREATE TABLE `theatres` (
  `id` int(11) NOT NULL,
  `name_t` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `adres` varchar(200) NOT NULL,
  `photo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `theatres`
--

INSERT INTO `theatres` (`id`, `name_t`, `phone`, `email`, `adres`, `photo`) VALUES
(1, 'Буфф', '+7-800-111-22-33', 'buff@mail.ru', 'просп. Шаумяна, д. 22', NULL),
(2, 'Александринский театр', '+7-812-401-53-41', 'al_t@mail.ru', 'пл. Островского, 2', NULL),
(3, 'Эрмитажный театр', '+7-812-333-11-22', 'ermitazh_t@mail.ru', 'Дворцовая наб., 34', NULL),
(4, 'Иван', '81111112233', 'ivanvan@mail.ru', 'example', ''),
(5, 'Example', '81111112233', 'ex@mail.ru', 'example', ''),
(7, 'Example', '81111112233', 'ex@mail.ru', 'example', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `bday` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `login` varchar(200) NOT NULL,
  `passwd` varchar(200) NOT NULL,
  `token` varchar(150) DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `bday`, `phone`, `email`, `login`, `passwd`, `token`, `admin`) VALUES
(1, 'Святослав', 'Брусничкин', '17-03-2001', '+7-999-111-22-33', 'berry1703@mail.ru', 'berry2001', 'qwr52dgqab', NULL, 0),
(4, 'Елена', 'Арбузова', '14-05-2001', '+7-999-555-44-33', 'arbuzik04', 'leno4ka', 'fwyhux28dgsc', NULL, 0),
(6, 'Анжелика', 'Иванова', '19.03.2001', '89994442233', 'gell@mail.ru', 'angela', '$2y$13$3ha//MVyGzVplVSphqd4qOhIsPRUPF8ZytBLxI7nHB6U6W9pkhSfi', NULL, 0),
(7, 'Маруся', 'Яковлева', '26.10.2003', '81114442233', 'mary@mail.ru', 'mary', '$2y$13$A02rCMSeB28AZsM8enQeyu05OQq4nMU0ipMHtHNu8GiYkuwPIpmYO', '7zE1gzPYOH47yBDSkJl9G2FTXWmzkpfx', 1),
(8, 'Иван', 'Петров', '06.03.2002', '81111112233', 'ivanvan@mail.ru', 'ivan0603', '$2y$13$o7mg1LNYcQFU7wTkZaq8.ecgxmcdz6ADIjPr6RfnIEvPAWi2App4O', 'YtjIohvIeh4wJ0qWtFMcDAvn03Nx_Ull', 0),
(9, 'Василий', 'Иванов', '13.09.2001', '88009992233', 'vasilisk@mail.ru', 'vasilisk', '$2y$13$Yj.4l9qsafRvTLcMrq5cwOym4KZ1opjSN03i5DmwZq/JzxEHnYVUi', 'Ao3VUESD4oX8R9TvQ9FoPSJ_3D6bLdBA', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idusr` (`idusr`),
  ADD KEY `theatre_id` (`theatre_id`);

--
-- Индексы таблицы `theatres`
--
ALTER TABLE `theatres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `theatres`
--
ALTER TABLE `theatres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`idusr`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`theatre_id`) REFERENCES `theatres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
