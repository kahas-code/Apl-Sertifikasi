-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2023 at 08:52 PM
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
  `uuid` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `post_id` varchar(50) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`uuid`, `user_id`, `post_id`, `comment`, `picture`, `created`) VALUES
('f86d99e1-0646-406d-8787-346cdfffad7d', 'e31sd143123dsasd', '79303fa9-5d2b-46b3-93bd-04a536', 'Hayuk #merasabahagia', 'uploads/', '2023-08-25 00:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `comment_tags`
--

CREATE TABLE `comment_tags` (
  `comment_id` varchar(50) NOT NULL,
  `tag_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_tags`
--

INSERT INTO `comment_tags` (`comment_id`, `tag_id`) VALUES
('f86d99e1-0646-406d-8787-346cdf', '7e7faf11-1c6e-4268-92c8-87ccaa'),
('f86d99e1-0646-406d-8787-346cdfffad7d', '7e7faf11-1c6e-4268-92c8-87ccaa');

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `uuid` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `post` varchar(250) NOT NULL,
  `post_image` varchar(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`uuid`, `user_id`, `post`, `post_image`, `created`) VALUES
('71fc52cf-c9e5-4599-b463-f2f06d', 'e31sd143123dsasd', 'Apaan luh', 'uploads/', '2023-08-25 00:19:52'),
('79303fa9-5d2b-46b3-93bd-04a536', 'e31sd143123dsasd', 'Kenalan yuk', 'uploads/', '2023-08-25 00:19:12'),
('e651c6bf-5c52-4694-8ae8-9d1332', 'e31sd143123dsasd', 'Simpan disini dulu #merasabahagia', 'uploads/Scan_20230720 (7).png', '2023-08-25 00:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `post_id` varchar(50) NOT NULL,
  `tag_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`post_id`, `tag_id`) VALUES
('e651c6bf-5c52-4694-8ae8-9d1332', '7e7faf11-1c6e-4268-92c8-87ccaa');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `name`) VALUES
('7e7faf11-1c6e-4268-92c8-87ccaa', '#merasabahagia');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uuid` varchar(50) NOT NULL,
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
