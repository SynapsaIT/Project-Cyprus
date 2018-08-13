-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Sie 2018, 12:37
-- Wersja serwera: 10.1.32-MariaDB
-- Wersja PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `cyprus`
--
CREATE DATABASE IF NOT EXISTS `cyprus` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cyprus`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `attachments`
--

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `group_id` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `attachments`
--

INSERT INTO `attachments` (`id`, `filename`, `group_id`) VALUES
(20, 'IMAG0041.jpg', '28af3ebaaf0833115d8f4f116d0e2b76'),
(21, 'IMAG0043.jpg', '28af3ebaaf0833115d8f4f116d0e2b76'),
(22, 'IMAG0044.jpg', '28af3ebaaf0833115d8f4f116d0e2b76'),
(23, 'IMAG0048.jpg', '28af3ebaaf0833115d8f4f116d0e2b76'),
(24, 'IMAG0049.jpg', '28af3ebaaf0833115d8f4f116d0e2b76'),
(25, 'LOGO_INFORMATICS_PNG (2).png', '2f84386d9011ee322020e549bad657bd'),
(26, '1533292418943667255532.jpg', 'eb10deb2669bfc889662d585dc6e9e23');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `emails`
--

CREATE TABLE `emails` (
  `group_id` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `emails`
--

INSERT INTO `emails` (`group_id`, `email`) VALUES
('28af3ebaaf0833115d8f4f116d0e2b76', 'radolf@o2.pl'),
('2f84386d9011ee322020e549bad657bd', 'mateusz.kotlarczyk@gmail.com'),
('553750988080d2b82aec6b655c1534d9', 'dddd@dd.pl'),
('c265ab9b705476024e8c962c45d04d15', 'test@o2.pl'),
('eb10deb2669bfc889662d585dc6e9e23', 'mateusz.kotlarczyk@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `personal_data`
--

CREATE TABLE `personal_data` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `passport` varchar(64) NOT NULL,
  `doi` date NOT NULL,
  `doe` date NOT NULL,
  `sex` int(1) NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(64) NOT NULL,
  `input_usr` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `personal_data`
--

INSERT INTO `personal_data` (`id`, `name`, `surname`, `passport`, `doi`, `doe`, `sex`, `dob`, `pob`, `input_usr`) VALUES
(1, 'asd', 'asdas', '0', '0000-00-00', '0000-00-00', 0, '0000-00-00', '1990', ''),
(2, 'Test', 'Test', 'dwersdpdawe2137127371', '0000-00-00', '0000-00-00', 1, '0000-00-00', 'Test', ''),
(3, 'Test', 'TEset2', 'qweqwsad2341241e', '2018-07-11', '2018-07-14', 0, '2018-07-27', 'FTRFEST', ''),
(4, 'RadosÅ‚aw', 'PigoÅ„', 'CAZ2139919', '2018-07-01', '2018-07-31', 0, '1997-09-23', 'Jaworzno', ''),
(5, 'bhjg', 'hgjhg', 'skjajdgauysgdas', '2018-07-02', '2018-07-05', 0, '2018-07-18', 'bvcv', ''),
(6, 'Radoslaw', 'Pigon', 'CAZwasdas2213', '2018-08-01', '2018-08-31', 0, '1997-09-23', 'Jaworzno', 'test'),
(7, 'sadas', 'sadsda', 'sadasdasdasqw3e211q', '2018-08-28', '2018-08-10', 0, '2018-08-24', 'sadas', 'rado');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `tasks`
--

INSERT INTO `tasks` (`task_id`, `group_id`, `user_id`) VALUES
(0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'rado', '89a3461f63318fa9ad48dc7a0864f106df1bd303'),
(2, 'test', 'ff12bbd8c907af067070211d87bdf098be17375b'),
(3, 'stolorz', 'a9f5577c4bdf6acbfadac0abfb1e8362e2f818ef');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `personal_data`
--
ALTER TABLE `personal_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT dla tabeli `personal_data`
--
ALTER TABLE `personal_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
