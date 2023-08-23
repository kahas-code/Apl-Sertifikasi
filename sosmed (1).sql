-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 06:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sosmed`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `uuid` varchar(100) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `post_id` varchar(100) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`uuid`, `user_id`, `post_id`, `comment`, `created`) VALUES
('603096aa-6cb1-4175-8133-4c19fd2f11c4', 'e31sd143123dsasd', '52e13782-0425-4025-95da-d05483', 'Halo', '2023-08-23 21:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `comment_tags`
--

CREATE TABLE `comment_tags` (
  `comment_id` varchar(30) NOT NULL,
  `tag_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_tags`
--

INSERT INTO `comment_tags` (`comment_id`, `tag_id`) VALUES
('610f82c3-8faf-4245-af8b-deaddc', 'b09224f9-551d-4111-b990-4d49e7');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `post_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postingan`
--

CREATE TABLE `postingan` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `postingan`
--

INSERT INTO `postingan` (`id`, `parent`, `nama`, `pesan`, `waktu`) VALUES
(1, 0, 'laksdjfl', 'AOSJIDFOSIAJF', '2023-08-22 07:08:31'),
(9, 0, 'ssd', 'sdsd', '2023-08-22 08:02:51'),
(10, 0, 'sdssds', 'sdsdsd', '2023-08-22 08:06:17'),
(11, 0, 'Elia Emisasmita', 'kjkhjkhkjhk', '2023-08-22 09:21:14'),
(12, 11, 'dsfsfg', 'sdfgsfsf', '2023-08-22 09:21:23'),
(13, 11, 'dfdfg', 'dfgdgd', '2023-08-22 09:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `uuid` varchar(30) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `post` varchar(250) NOT NULL,
  `post_image` varchar(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`uuid`, `user_id`, `post`, `post_image`, `created`) VALUES
('52e13782-0425-4025-95da-d05483', 'e31sd143123dsasd', 'Halo Kamu Yang disana yaa', 'uploads/', '2023-08-23 21:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `post_id` varchar(30) NOT NULL,
  `tag_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`post_id`, `tag_id`) VALUES
('9d7a2931-1337-4334-8096-9fb982', '2fc2154d-cd1d-432d-a96b-68f20e'),
('9d7a2931-1337-4334-8096-9fb982', 'd0d95a57-533d-4bde-a175-bc8f2c'),
('9d7a2931-1337-4334-8096-9fb982', 'f9e7148f-2c2f-48c8-8e07-df186e'),
('9d7a2931-1337-4334-8096-9fb982', '1301c100-0d8d-4df1-8248-7210b1'),
('3031e00e-c245-4611-8479-69b8d7', '2fc2154d-cd1d-432d-a96b-68f20e'),
('3031e00e-c245-4611-8479-69b8d7', 'd0d95a57-533d-4bde-a175-bc8f2c'),
('3031e00e-c245-4611-8479-69b8d7', 'f9e7148f-2c2f-48c8-8e07-df186e'),
('3031e00e-c245-4611-8479-69b8d7', '1301c100-0d8d-4df1-8248-7210b1'),
('d1a8edf7-a9e7-4da2-8c9e-1c334a', '2fc2154d-cd1d-432d-a96b-68f20e'),
('12d73596-03da-4c3c-bb7c-95e1c9', 'f2875e90-15d4-4f05-bf45-b1027a'),
('854e0cc4-c99f-4fe5-b6c0-5f13d6', '92fc1eed-7357-4404-bc6a-058aa6'),
('75dbde3e-6cc5-4a2d-b5d1-17f827', '92fc1eed-7357-4404-bc6a-058aa6'),
('52bb0e25-9c7e-4956-aea4-b910cb', 'f6eb244f-0748-47e4-b99f-454e63'),
('7e54da96-a206-4d61-b09e-e2b5f7', 'a392e180-1345-48ce-985b-5ad681'),
('8bce4624-166b-48a5-a550-a05b02', '8ef9bdae-cf82-4b31-bb23-b77c32');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `name`) VALUES
('8ef9bdae-cf82-4b31-bb23-b77c32', '#fkdasllaksddf'),
('a392e180-1345-48ce-985b-5ad681', '#dfasdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uuid` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uuid`, `email`, `password`, `created`, `keterangan`, `name`, `picture`) VALUES
('e31sd143123dsasd', 'kabidin42@gmail.com', '$2y$10$WaU2Bx/x6BxHhMglF5nnYetx1ybP8r0oQlVmstgkYj5XH8ggSxHti', '2023-08-22 17:30:49', 'Hai kamu', 'Khairul Abidin Hasibuan', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `postingan`
--
ALTER TABLE `postingan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postingan`
--
ALTER TABLE `postingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
