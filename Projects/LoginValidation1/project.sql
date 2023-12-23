-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2023 at 04:56 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie_table`
--

CREATE TABLE `movie_table` (
  `movie` varchar(255) NOT NULL,
  `main_character` varchar(255) NOT NULL,
  `id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie_table`
--

INSERT INTO `movie_table` (`movie`, `main_character`, `id`) VALUES
('spiderman', 'peter parker', 1),
('star wars', 'luke skywalker', 3),
('cars', 'lightning mcqueen', 4),
('iron man', 'tony stark', 5),
('It\'s a wonderful life', 'Jimmy Stuart', 6),
('toy story', 'woody and buzz', 7),
('Finding Nemo', 'Nemo', 8);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(7) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `username`, `password`) VALUES
(1, 'user1', '$2y$10$qHRikqLyUNFE9XfWbgMBT.p9MANfnqVikCHPphbI5p3Z5Gc280F/S'),
(2, 'admin', '$2y$10$/FjSZI7U/ZKdDY9qYiwZrO7ZKG9TeghaGuUJevftrzjaFCVS7vJr2'),
(3, 'user2', '$2y$10$PjznrPP.wBr66KSr0X9bteoGCfnoyOzBdWgDee1G456OWMeJ0vDR2'),
(4, 'user3', '$2y$10$x8MlO0LKUKJCr072Pep4OO2z9cZSo.f3N/4bAXqaXOe0H5rl5lpvy'),
(5, 'user4', '$2y$10$dUKL8Wl7nvvjp21oYSNjX.AIuoi0rk5WzzwO17.4RfERtDvwkhysa'),
(6, 'user5', '$2y$10$Hm7c8E1ub493F82ifY2Rye1bvpNI1FxpYKq6WDLi5XGGvwX2KmjB.'),
(7, 'user6', '$2y$10$5sKC1dlHuZ8tu1vfYWRgB.ANuklbFQ5vJ7U8xChxThdVuHoxvzMc6'),
(8, 'Shelbyy__11', '$2y$10$GoprZH0ulE5i/1OV/klmZOLbJz4S1YVWxG5O0joWYpPJnPyHyOp7G');

-- --------------------------------------------------------

--
-- Table structure for table `sports_table`
--

CREATE TABLE `sports_table` (
  `sport` varchar(255) NOT NULL,
  `team` varchar(255) NOT NULL,
  `id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sports_table`
--

INSERT INTO `sports_table` (`sport`, `team`, `id`) VALUES
('baseball', 'cubs', 1),
('baseball', 'yankees', 3),
('football', 'vikings', 4),
('basketball', 'bulls', 5),
('football', 'bears', 6),
('basketball', 'warriors', 7),
('basketball', 'Iowa State', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie_table`
--
ALTER TABLE `movie_table`
  ADD KEY `id` (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sports_table`
--
ALTER TABLE `sports_table`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie_table`
--
ALTER TABLE `movie_table`
  ADD CONSTRAINT `movie_table_ibfk_1` FOREIGN KEY (`id`) REFERENCES `registration` (`id`);

--
-- Constraints for table `sports_table`
--
ALTER TABLE `sports_table`
  ADD CONSTRAINT `sports_table_ibfk_1` FOREIGN KEY (`id`) REFERENCES `registration` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
