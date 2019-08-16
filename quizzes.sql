-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 16, 2019 at 08:34 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.3.7-2+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizzes`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `text`, `is_correct`, `question_id`) VALUES
(1, 'Ar simbolu \"$\"', 1, 1),
(2, 'Ar atslēgvārdu \"var\"', 0, 1),
(3, 'Ar atslēgvārdu \"let\"', 0, 1),
(4, 'Atkarīgs no datu tipa', 0, 1),
(5, 'Ar operātoru \"+\"', 0, 2),
(6, 'Ar funkciju \"strcat()\"', 0, 2),
(7, 'Ar operātoru \".\"', 1, 2),
(8, 'Ar metodi \".toString()\"', 0, 2),
(9, 'Uz datubāzes servera', 0, 3),
(10, 'Mākonī', 0, 3),
(11, 'Uz lietotāja datora', 0, 3),
(12, 'Uz web servera', 1, 3),
(13, 'Uz web servera', 0, 4),
(14, 'Uz lietotāja datora', 1, 4),
(15, 'Mākonī', 0, 4),
(16, 'Uz datubāzes servera', 0, 4),
(17, 'Objekts', 0, 5),
(18, 'Asociatīvs masīvs', 0, 5),
(19, 'Sintakses kļūda', 0, 5),
(20, 'Anonīma funkcija', 1, 5),
(21, '22', 1, 6),
(22, '4', 0, 6),
(23, 'Tipu kļūda', 0, 6),
(24, 'NaN', 0, 6),
(25, '5', 0, 7),
(26, 'Adresi atmiņā', 1, 7),
(27, 'Sintakses kļūdu', 0, 7),
(28, 'Null pointer exception', 0, 7),
(29, 'Null pointer exception', 0, 8),
(30, 'Rādītāja adresi', 0, 8),
(31, '5', 1, 8),
(32, 'Adresi uz dinamisko atmiņu', 0, 8),
(33, 'Adresi uz dinamisko atmiņu', 1, 9),
(34, 'Rādītāja adresi', 0, 9),
(35, '5', 0, 9),
(36, 'Vai tad šitais jau nebija?', 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `quiz_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `quiz_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `quiz_id`) VALUES
(1, 'Kā PHP apzīmē mainīgos?', 1),
(2, 'Kā PHP var salīmēt kopā string tipa mainīgos?', 1),
(3, 'Kur tiek izpildīts PHP kods?', 1),
(4, 'Kur tiek izpildīts JavaScript kods?', 2),
(5, 'Kas ir šis: \"(a,b)=>{return a+b};\"', 2),
(6, 'Cik būs \"2\" + \"2\"?', 2),
(7, 'Rindiņa: \"int a = 5;\". Ko atgriezīs rindiņa \"return &a;\"?', 3),
(8, 'Rindiņa: \"int* a = 5\". Ko atgriezīs rindiņa \"return *a;\"?', 3),
(9, 'Rindiņa: \"int* a = 5\". Ko atgriezīs rindiņa \"return a;\"?', 3);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`) VALUES
(1, 'PHP'),
(2, 'JavaScript'),
(3, 'C++');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_level`) VALUES
(14, 'Edgars', 'edgars@edgars', '$2y$10$aSkXZKHeaGBi11zGoQFNvOSd5BH19p1GIhLIf/V0nrDZ5W/H4Tl2.', 1),
(15, 'zxcv', 'zxcv@zxcv.zx', '$2y$10$3qzcyVH7s3iaGHMXvpdYjOwBc/tjiBysIhjWgmcCdicASE3kEzkom', 0),
(16, 'aaa', 'aaa@aaa.aa', '$2y$10$qTDaXXcG4mRAwtRgFSMJI.CINOZCjtzzo018fepGEalBGKeeGlph2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `attempt_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `answer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `answer_id` (`answer_id`),
  ADD KEY `attempt_id` (`attempt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `attempts_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `user_answers_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`),
  ADD CONSTRAINT `user_answers_ibfk_3` FOREIGN KEY (`attempt_id`) REFERENCES `attempts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
