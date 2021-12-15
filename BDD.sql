-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 15, 2021 at 09:20 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `projet_5`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` enum('EDITEUR','UTILISATEUR','ADMIN','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `user_role`) VALUES
(5, 'Jdoe', 'johndoe@gmail.com', '$2y$10$ELIL7TgkRwCOOjSB9.cA6O8YivXHwqurBNIVJbrU6ZpkANSePKjQm', 'EDITEUR'),
(6, 'Emdoe', 'Emilie.d@hotmail.fr', '$2y$10$XCQckQbiU4Ha6wwc0oXpgOCY6py0Aw2lP0dgfyXqKn39T7od3w/Ry', 'UTILISATEUR'),
(7, 'Noem23', 'Noemie.Silk@gmail.com', '$2y$10$7KQWo7DGpuAbV.29h0N8oe8aUaGHGNb7BzhIts5fkZJjttt9Y3wG6', 'ADMIN'),
(8, 'Claire21', 'Claire.Fdl@yahoo.fr', 'ee0378ebb0ad1577f1c0e59f7e4c4737', 'EDITEUR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
