-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 05, 2023 at 07:58 PM
-- Server version: 8.0.32
-- PHP Version: 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesstype`
--

CREATE TABLE `accesstype` (
  `id` int NOT NULL,
  `access_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accesstype`
--

INSERT INTO `accesstype` (`id`, `access_type`) VALUES
(1, 'Admin'),
(2, 'Teacher'),
(3, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int NOT NULL,
  `chapter` varchar(30) NOT NULL,
  `sub_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `chapter`, `sub_id`) VALUES
(1, 'chapter1', 1),
(2, 'chapter2', NULL),
(7, 'chapter3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chapter_relation`
--

CREATE TABLE `chapter_relation` (
  `id` int NOT NULL,
  `chapter_id` int NOT NULL,
  `sub_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chapter_relation`
--

INSERT INTO `chapter_relation` (`id`, `chapter_id`, `sub_id`) VALUES
(1, 1, 1),
(2, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `contact` bigint NOT NULL,
  `age` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `profile_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `username`, `contact`, `age`, `email`, `password`, `profile_img`) VALUES
(13, '1', 1, 1, '2@a', '$2y$10$pAikFblBGRC6AolNo3VnQe5t/YdWT13ooBx7vzM7zLbnsSV5gIc0G', ''),
(17, 'charmi', 1234567890, 21, 'charmi@gmail.com', '$2y$10$nyG0tFAwL.DT8HdpwTlyW.Q35eHltBM.tfcqjCai8Xuduy62E2pmm', ''),
(18, 'Tushar', 1234567890, 21, 'tushar@gmail.com', '$2y$10$o/TbIGQj5r1ctca7flHELOegvYHKwA17CHY4.DhkoZzfh4ST4KSkq', ''),
(19, 'aayushi', 1234567489, 23, 'aayushi@gmail.com', '$2y$10$ThlEbJDNvov4uZJVe3cBu.VB7EgbAQdp6PKO3tqLq/CPCKSMQfjtq', ''),
(20, 'mitul', 1231231231, 22, 'mitul@gmail.com', '$2y$10$Z.LosXDfD4MMf6FpV.EwkO8eTr/YNz0CTEczYGyORFhU62FQKHMEW', ''),
(21, 'pathik', 1122334455, 22, 'pathik@gmail.com', '$2y$10$W7y9APseDL63BIUHfy0YH.aj6pU/D4BAWfaYAY6ywPTarKyhiijES', '');

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `id` int NOT NULL,
  `standard` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `standards`
--

INSERT INTO `standards` (`id`, `standard`) VALUES
(1, 1),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `student_relation`
--

CREATE TABLE `student_relation` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `std_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student_relation`
--

INSERT INTO `student_relation` (`id`, `student_id`, `std_id`) VALUES
(1, 17, 1),
(3, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `subject` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject`) VALUES
(1, 'Math'),
(2, 'Gujarati'),
(4, 'Hindi');

-- --------------------------------------------------------

--
-- Table structure for table `subject_relation`
--

CREATE TABLE `subject_relation` (
  `id` int NOT NULL,
  `sub_id` int NOT NULL,
  `std_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subject_relation`
--

INSERT INTO `subject_relation` (`id`, `sub_id`, `std_id`) VALUES
(6, 2, 6),
(8, 1, 3),
(9, 1, 4),
(12, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `user_type` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `user_id`, `user_type`) VALUES
(1, 17, 3),
(2, 18, 1),
(3, 19, 2),
(4, 20, 3),
(5, 21, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesstype`
--
ALTER TABLE `accesstype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapter_to_subject_id_fk` (`sub_id`);

--
-- Indexes for table `chapter_relation`
--
ALTER TABLE `chapter_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapter_id_to_chapter_id_fk` (`chapter_id`),
  ADD KEY `sub_id_to_subjects_id_fk` (`sub_id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_relation`
--
ALTER TABLE `student_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id_to_info_id_fk` (`student_id`),
  ADD KEY `student_relation_ibfk_1` (`std_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_relation`
--
ALTER TABLE `subject_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `std_id_to_std_id_fk` (`std_id`),
  ADD KEY `sub_id_to_sub_id_fk` (`sub_id`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_to_info_id` (`user_id`),
  ADD KEY `user_type_to_access_type_id_fk` (`user_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesstype`
--
ALTER TABLE `accesstype`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chapter_relation`
--
ALTER TABLE `chapter_relation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `info`
--
ALTER TABLE `info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_relation`
--
ALTER TABLE `student_relation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject_relation`
--
ALTER TABLE `subject_relation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapter_to_subject_id_fk` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chapter_relation`
--
ALTER TABLE `chapter_relation`
  ADD CONSTRAINT `chapter_id_to_chapter_id_fk` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_id_to_subjects_id_fk` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_relation`
--
ALTER TABLE `student_relation`
  ADD CONSTRAINT `student_id_to_info_id_fk` FOREIGN KEY (`student_id`) REFERENCES `info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_relation_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `standards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_relation`
--
ALTER TABLE `subject_relation`
  ADD CONSTRAINT `std_id_to_std_id_fk` FOREIGN KEY (`std_id`) REFERENCES `standards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_id_to_sub_id_fk` FOREIGN KEY (`sub_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usertype`
--
ALTER TABLE `usertype`
  ADD CONSTRAINT `user_id_to_info_id` FOREIGN KEY (`user_id`) REFERENCES `info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_type_to_access_type_id_fk` FOREIGN KEY (`user_type`) REFERENCES `accesstype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
