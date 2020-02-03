-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 03 Février 2020 à 08:51
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_quiz`
--

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200120083109', '2020-01-20 08:54:44'),
('20200120083513', '2020-01-20 08:58:21'),
('20200120085954', '2020-01-20 09:00:05'),
('20200120090614', '2020-01-20 09:06:21'),
('20200120090854', '2020-01-20 09:09:04'),
('20200203081540', '2020-02-03 08:19:14'),
('20200203082321', '2020-02-03 08:23:34');

-- --------------------------------------------------------

--
-- Structure de la table `tanswer`
--

CREATE TABLE `tanswer` (
  `id` int(11) NOT NULL,
  `ans_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ans_true_false` tinyint(1) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `tanswer`
--

INSERT INTO `tanswer` (`id`, `ans_title`, `ans_true_false`, `question_id`) VALUES
(1, 'Oui', 1, 1),
(2, 'non', 0, 1),
(3, 'df', 1, 3),
(4, 'élkjh', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `tquestion`
--

CREATE TABLE `tquestion` (
  `id` int(11) NOT NULL,
  `que_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `que_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `tquestion`
--

INSERT INTO `tquestion` (`id`, `que_title`, `que_type`) VALUES
(1, 'kjfgbsuzgfsuihfdsdf ?', 0),
(3, 'dffgfddfdd ?', 1),
(4, 'awdada', 1),
(5, 'awdada', 0),
(6, 'awdada', 1),
(7, 'awdada', 0),
(8, 'awdada', 0),
(9, 'awdada', 0),
(10, 'awdadaawdada', 1),
(11, 'awdadaawdadaawdada', 1),
(12, 'awdadaawdadaawdadaawdadaawdadaawdada', 1),
(13, 'awdada', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tuser`
--

CREATE TABLE `tuser` (
  `id` int(11) NOT NULL,
  `use_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tuser_answer`
--

CREATE TABLE `tuser_answer` (
  `id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tuser_score`
--

CREATE TABLE `tuser_score` (
  `id` int(11) NOT NULL,
  `sco_score` double NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `tanswer`
--
ALTER TABLE `tanswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EE54C0C01E27F6BF` (`question_id`);

--
-- Index pour la table `tquestion`
--
ALTER TABLE `tquestion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tuser_answer`
--
ALTER TABLE `tuser_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_88919C10AA334807` (`answer_id`);

--
-- Index pour la table `tuser_score`
--
ALTER TABLE `tuser_score`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_16AD34E2A76ED395` (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tanswer`
--
ALTER TABLE `tanswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `tquestion`
--
ALTER TABLE `tquestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tuser_answer`
--
ALTER TABLE `tuser_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tuser_score`
--
ALTER TABLE `tuser_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tanswer`
--
ALTER TABLE `tanswer`
  ADD CONSTRAINT `FK_EE54C0C01E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `tquestion` (`id`);

--
-- Contraintes pour la table `tuser_answer`
--
ALTER TABLE `tuser_answer`
  ADD CONSTRAINT `FK_88919C10AA334807` FOREIGN KEY (`answer_id`) REFERENCES `tanswer` (`id`);

--
-- Contraintes pour la table `tuser_score`
--
ALTER TABLE `tuser_score`
  ADD CONSTRAINT `FK_16AD34E2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tuser` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
