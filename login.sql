-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2021 at 06:00 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `magicLogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `magicLogin`
--

CREATE TABLE `magicLogin` (
  `id` int NOT NULL,
  `email` varchar(99) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(99) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `magicLogin`
--
ALTER TABLE `magicLogin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `magicLogin`
--
ALTER TABLE `magicLogin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;
