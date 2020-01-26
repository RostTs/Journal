-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час генерацыі: 26 Сту 2020, 22:00
-- Версія сервера: 10.1.34-MariaDB
-- Вэрсія PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даных: `testdb`
--

-- --------------------------------------------------------

--
-- Структура табліцы `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `surname` varchar(255) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(255) COLLATE utf8_bin NOT NULL,
  `secondname` varchar(255) COLLATE utf8_bin NOT NULL,
  `birthdate` varchar(255) COLLATE utf8_bin NOT NULL,
  `age` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп дадзеных табліцы `students`
--

INSERT INTO `students` (`id`, `surname`, `firstname`, `secondname`, `birthdate`, `age`) VALUES
(22, 'Макаенко', 'Дмитрий', 'Яковлев', '22.11.2009', 10),
(23, 'Пашукевич', 'Алексей', 'Юрьевич', '31.01.2010', 9);

--
-- Індэксы для захаваных табліц
--

--
-- Індэксы табліцы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для захаваных табліц
--

--
-- AUTO_INCREMENT для табліцы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
