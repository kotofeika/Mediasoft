-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 06 2020 г., 16:24
-- Версия сервера: 5.7.29
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `texts`
--

-- --------------------------------------------------------

--
-- Структура таблицы `uploaded_text`
--

CREATE TABLE `uploaded_text`(
    `ID` int AUTO_INCREMENT,
    `content` text DEFAULT NULL,
    `date` date DEFAULT NULL,
    `words_count` int DEFAULT NULL,
    PRIMARY KEY(ID)
);


-- --------------------------------------------------------

--
-- Структура таблицы `words`
--

CREATE TABLE `words` (
  `ID` int AUTO_INCREMENT,
  `text_id` int DEFAULT NULL,
  `word` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY(ID)
);



