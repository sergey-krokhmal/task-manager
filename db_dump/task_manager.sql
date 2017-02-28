-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 01 2017 г., 02:28
-- Версия сервера: 5.7.13
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `task_manager`
--

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(10) unsigned NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `id_priority` int(10) unsigned NOT NULL DEFAULT '1',
  `id_status` int(10) unsigned NOT NULL DEFAULT '1',
  `tags` varchar(256) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `uuid`, `name`, `id_priority`, `id_status`, `tags`) VALUES
(1, '933f969d-98e7-4158-9368-cabecbc3f400', 'Новая задача', 2, 2, ''),
(2, '1d543188-c552-4219-9951-c9ca2b265140', 'Написать задачник', 3, 1, ''),
(3, '0ef59550-26e8-495c-b98e-7c22ab70ff01', 'Убраться в квартире', 1, 2, ''),
(4, '896c372d-bf00-4089-9e17-59ccb293af38', 'Купить продукты', 1, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `task_priority`
--

CREATE TABLE IF NOT EXISTS `task_priority` (
  `id` int(10) unsigned NOT NULL,
  `value` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task_priority`
--

INSERT INTO `task_priority` (`id`, `value`, `name`) VALUES
(1, 'low', 'Низкий'),
(2, 'middle', 'Средний'),
(3, 'high', 'Высокий');

-- --------------------------------------------------------

--
-- Структура таблицы `task_status`
--

CREATE TABLE IF NOT EXISTS `task_status` (
  `id` int(10) unsigned NOT NULL,
  `value` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task_status`
--

INSERT INTO `task_status` (`id`, `value`, `name`) VALUES
(1, 'active', 'В работе'),
(2, 'done', 'Завершена');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task_priority`
--
ALTER TABLE `task_priority`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task_status`
--
ALTER TABLE `task_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `task_priority`
--
ALTER TABLE `task_priority`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `task_status`
--
ALTER TABLE `task_status`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
