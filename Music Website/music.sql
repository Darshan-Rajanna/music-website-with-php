-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 11:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`username`, `password`) VALUES
('admin1', '12345'),
('admin2', '23456'),
('admin3', '34567');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `Album` varchar(20) NOT NULL,
  `no_songs` int(11) DEFAULT NULL,
  `dates` varchar(10) DEFAULT NULL,
  `Album_cover` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`Album`, `no_songs`, `dates`, `Album_cover`) VALUES
('ek-love-ya', 2, '2021', 'images\\ek love ya.jpg'),
('kantara', 3, '2022', 'images\\Kantara pos.jpg'),
('katera', 3, '2023', 'images\\katera pos.jpg'),
('KGF2', 2, '2022', 'images\\kgf2.jpg'),
('Kiss', 3, '2020', 'images\\kiss pos.jpg'),
('Seetharama Kalyana', 1, '2018', 'images/seetha rama pos.jpg'),
('Unknown Album', NULL, '-', 'images/unknown albm.jpg'),
('Vikranthrona', 3, '2021', 'images\\vikaranth pos.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `Artist` varchar(20) NOT NULL,
  `no_songs` int(11) DEFAULT NULL,
  `Artist_cover` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`Artist`, `no_songs`, `Artist_cover`) VALUES
('Ananya Bhat', 3, 'images\\ananya.jpg'),
('Arjun Janya', 3, 'images\\arjun.jpg'),
('Armaan Malik', 1, 'images\\arman.jpg'),
('Chandan Shetty', 1, 'images\\chandan.jpg'),
('Sanjeeth Hegde', 1, 'images\\sanjeeth.jpg'),
('Shreya Ghoshal', 1, 'images\\shreya.jpg'),
('Sonu Nigam', 2, 'images\\sonu.jpg'),
('unknown', 3, 'images\\unknown.jpg'),
('Vijay Prakash', 2, 'images\\vijay.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `Title` varchar(20) NOT NULL,
  `Artist` varchar(20) NOT NULL,
  `Album` varchar(20) NOT NULL,
  `audio` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`Title`, `Artist`, `Album`, `audio`) VALUES
('Chikki Bombe', 'Vijay Prakash', 'Vikranthrona', 'audio\\Chikki Bombe.mp3'),
('Gagana-Nee', 'unknown', 'KGF2', 'audio\\Gagana-Nee-Suchetha-Basrur.mp3'),
('I-Love-You-Idiot', 'Sanjeeth Hegde', 'Kiss', 'audio\\I-Love-You-Idiot-Sanjith-Hegde.mp3'),
('Karma Song', 'unknown', 'kantara', 'audio\\Karma Song(RaagaBeat.In)-KannadaMaza.Com.mp3'),
('katera Title', 'unknown', 'katera', 'audio\\katera Title.mp3'),
('Lullaby Song', 'Vijay Prakash', 'Vikranthrona', 'audio\\Lullaby Song.mp3'),
('Matthe Nodabeda', 'Arjun Janya', 'ek-love-ya', 'audio\\Matthe Nodabeda.mp3'),
('Meet Madana Illa Dat', 'Arjun Janya', 'ek-love-ya', 'audio\\Meet Madana Illa Date Madana.mp3'),
('Mehabooba', 'Ananya Bhat', 'KGF2', 'audio\\Mehabooba.mp3'),
('Neene-Modalu', 'Shreya Ghoshal', 'Kiss', 'audio\\Neene-Modalu-Shreya-Ghoshal.mp3'),
('Ninna raja nanu', 'Armaan Malik', 'Seetharama Kalyana', 'audio/[iSongs.info] 01 - Ninna Raja Naanu Nanna Rani Neenu.mp3'),
('pasandaagavne', 'Ananya Bhat', 'katera', 'audio\\pasandaagavne.mp3'),
('Ra Ra Rakkamma', 'Sonu Nigam', 'Vikranthrona', 'audio\\Ra Ra Rakkamma.mp3'),
('Sheela-Susheela', 'Chandan Shetty', 'Kiss', 'audio\\Sheela-Susheela-Chandan-Shetty.mp3'),
('Singara Siriye', 'Ananya Bhat', 'kantara', 'audio\\Singara Siriye.mp3'),
('Varaha Roopam Daiva ', 'Arjun Janya', 'kantara', 'audio\\Varaha Roopam Daiva Rihstam-KannadaMaza.Com.mp3'),
('Yava Janumada Gelath', 'Sonu Nigam', 'katera', 'audio\\Yava Janumada Gelathi.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `pass` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `email`, `pass`) VALUES
('chandana', 'chandu@gmail.com', 'chandu123'),
('chandrika', 'chandrika@gmail.com', '123123'),
('darshan', 'darshan.gmail.com', 'darshan'),
('deeksha', 'dee@gmail.com', '123deeksha'),
('impana', 'abc@gmail.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`Album`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`Artist`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`Title`),
  ADD KEY `Album` (`Album`),
  ADD KEY `Artist` (`Artist`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`Album`) REFERENCES `albums` (`Album`) ON UPDATE CASCADE,
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`Artist`) REFERENCES `artists` (`Artist`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
