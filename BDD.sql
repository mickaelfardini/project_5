-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 20, 2021 at 08:11 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `projet_5`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id_comment`, `content`, `created_at`, `id_user`, `id_post`) VALUES
(1, 'Super article.', '2021-12-11', 6, 6),
(2, 'genial', '2021-12-15', 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `chapo` varchar(250) NOT NULL,
  `created_at` date NOT NULL,
  `update_at` datetime NOT NULL,
  `content` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `title`, `chapo`, `created_at`, `update_at`, `content`, `id_user`) VALUES
(3, 'PHP', 'PHP a permis de créer un grand nombre de sites web célèbres, comme Facebook et Wikipédia7. Il est considéré comme une des bases de la création de sites web dits dynamiques mais également des applications web.', '2021-12-09', '2021-12-09 18:35:45', 'Le langage PHP a été créé en 1994 par Rasmus Lerdorf pour son site web. C\'était à l\'origine une bibliothèque logicielle en C11 dont il se servait pour conserver une trace des visiteurs qui venaient consulter son CV. Au fur et à mesure qu\'il ajoutait de nouvelles fonctionnalités, Rasmus a transformé la bibliothèque en une implémentation capable de communiquer avec des bases de données et de créer des applications dynamiques et simples pour le Web. Rasmus a alors décidé, en 1995, de publier son code, pour que tout le monde puisse l\'utiliser et en profiter12. PHP s\'appelait alors PHP/FI (pour Personal Home Page Tools/Form Interpreter). En 1997, deux étudiants, Andi Gutmans et Zeev Suraski, ont redéveloppé le cœur de PHP/FI. Ce travail a abouti un an plus tard à la version 3 de PHP, devenu alors PHP: Hypertext Preprocessor. Peu de temps après, Andi Gutmans et Zeev Suraski ont commencé la réécriture du moteur interne de PHP. C’est ce nouveau moteur, appelé Zend Engine — le mot Zend est la contraction de Zeev et Andi — qui a servi de base à la version 4 de PHP13.', 5),
(6, 'JavaScript', 'JavaScript est un langage de programmation de scripts principalement employé dans les pages web interactives et à ce titre est une partie essentielle des applications web. ', '2021-12-10', '2021-12-10 18:42:24', 'Le langage a été créé en dix jours en mai 1995 pour le compte de la Netscape Communications Corporation par Brendan Eich, qui s\'est inspiré de nombreux langages, notamment de Java mais en simplifiant la syntaxe pour les débutants10. Brendan Eich a initialement développé un langage de script côté serveur, appelé LiveScript, pour renforcer l\'offre commerciale de serveur HTTP de Mosaic Communications Corporation. La sortie de LiveScript intervient à l\'époque où le NCSA force Mosaic Communications Corporation à changer de nom pour devenir Netscape Communications Corporation.. Netscape travaille alors au développement d\'une version orientée client de LiveScript. Quelques jours avant sa sortie, Netscape change le nom de LiveScript pour JavaScript. Sun Microsystems et Netscape étaient partenaires, et la machine virtuelle Java de plus en plus populaire. Ce changement de nom servait les intérêts des deux sociétés.\r\n\r\nEn décembre 1995, Sun et Netscape annoncent11 la sortie de JavaScript. En mars 1996, Netscape met en œuvre le moteur JavaScript dans son navigateur web Netscape Navigator 2.0. Le succès de ce navigateur contribue à l\'adoption rapide de JavaScript dans le développement web orienté client. Microsoft réagit alors en développant JScript, qu\'il inclut ensuite dans Internet Explorer 3.0 en août 1996 pour la sortie de son navigateur.\r\n\r\nJavaScript est décrit comme un complément à Java dans un communiqué de presse11 commun de Netscape et Sun Microsystems, daté du 4 décembre 1995. Cette initiative a contribué à créer auprès du public une certaine confusion entre les deux langages, proches syntaxiquement mais pas du tout dans leurs concepts fondamentaux, et qui perdure encore de nos jours12.\r\n\r\n« JavaScript » devient une marque déposée par Oracle aux États-Unis en mai 199713,14.', 5);

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
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `comment_ibfk_1` (`id_user`),
  ADD KEY `comment_ibfk_2` (`id_post`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_user` (`id_user`) USING BTREE;

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
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
