-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2023 at 07:39 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `j`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `status` text NOT NULL DEFAULT 'error',
  `msg` text NOT NULL,
  `t` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE `servers` (
  `id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `domain` text NOT NULL,
  `name` text NOT NULL,
  `uuid` text NOT NULL,
  `port` int(11) NOT NULL,
  `version` text NOT NULL,
  `description` text NOT NULL,
  `maxPlayers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `server_history`
--

CREATE TABLE `server_history` (
  `id` int(11) NOT NULL,
  `players` int(11) NOT NULL,
  `t` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `lastUsername` text NOT NULL,
  `uuid` text NOT NULL,
  `cape` text DEFAULT NULL,
  `lastJoin` int(11) NOT NULL,
  `firstJoin` int(11) NOT NULL,
  `g` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_coordinate_history`
--

CREATE TABLE `user_coordinate_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `z` int(11) NOT NULL,
  `world` text NOT NULL,
  `t` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_shops`
--

CREATE TABLE `user_shops` (
  `id` int(11) NOT NULL,
  `sign_id` int(11) NOT NULL,
  `username` text NOT NULL DEFAULT 'null',
  `amount` int(11) NOT NULL,
  `price` text NOT NULL,
  `item` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_signs`
--

CREATE TABLE `user_signs` (
  `id` int(11) NOT NULL,
  `chunk` text NOT NULL,
  `msg` text NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `z` int(11) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_stats`
--

CREATE TABLE `user_stats` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `playerDeaths` int(11) NOT NULL,
  `playersKilled` int(11) NOT NULL,
  `joinCount` int(11) NOT NULL,
  `itemDropDetails` text NOT NULL,
  `metersTraveled` int(11) NOT NULL,
  `trustScore` int(11) NOT NULL,
  `blockDetailsPlaced` text NOT NULL,
  `blocksPlaced` int(11) NOT NULL,
  `playTime` int(11) NOT NULL,
  `itemsDropped` int(11) NOT NULL,
  `blockDetailsDestroyed` text NOT NULL,
  `trustLevel` int(11) NOT NULL,
  `creaturesKilled` int(11) NOT NULL,
  `blocksDestroyed` int(11) NOT NULL,
  `t` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `id` int(11) NOT NULL,
  `uuid` text NOT NULL,
  `owner` text NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `village_stats`
--

CREATE TABLE `village_stats` (
  `id` int(11) NOT NULL,
  `village_id` int(11) NOT NULL,
  `claims` int(11) NOT NULL,
  `t` text NOT NULL,
  `members` text NOT NULL,
  `memberCount` int(11) NOT NULL,
  `flags` text NOT NULL,
  `spawn` text NOT NULL,
  `assistants` text NOT NULL,
  `assistantsCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server_history`
--
ALTER TABLE `server_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_coordinate_history`
--
ALTER TABLE `user_coordinate_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_shops`
--
ALTER TABLE `user_shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_signs`
--
ALTER TABLE `user_signs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_stats`
--
ALTER TABLE `user_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `village_stats`
--
ALTER TABLE `village_stats`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `server_history`
--
ALTER TABLE `server_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_coordinate_history`
--
ALTER TABLE `user_coordinate_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_shops`
--
ALTER TABLE `user_shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_signs`
--
ALTER TABLE `user_signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_stats`
--
ALTER TABLE `user_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `villages`
--
ALTER TABLE `villages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `village_stats`
--
ALTER TABLE `village_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
