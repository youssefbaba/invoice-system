-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour facture
DROP DATABASE IF EXISTS `facture`;
CREATE DATABASE IF NOT EXISTS `facture` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `facture`;

-- Listage de la structure de la table facture. articles
DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_article` enum('Service','Acompte','Heures','Jours','Produit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantité_article` int(11) NOT NULL,
  `prix_ht_article` double(8,2) NOT NULL,
  `tva` int(11) DEFAULT NULL,
  `reduction_article` int(11) DEFAULT NULL,
  `total_ht_article` double(8,2) NOT NULL,
  `total_ttc_article` double(8,2) NOT NULL,
  `description_article` text COLLATE utf8mb4_unicode_ci,
  `facture_id` int(10) unsigned DEFAULT NULL,
  `devi_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avoir_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_facture_id_foreign` (`facture_id`),
  KEY `articles_devi_id_foreign` (`devi_id`),
  KEY `articles_user_id_foreign` (`user_id`),
  KEY `articles_avoir_id_foreign` (`avoir_id`),
  CONSTRAINT `articles_avoir_id_foreign` FOREIGN KEY (`avoir_id`) REFERENCES `avoirs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `articles_devi_id_foreign` FOREIGN KEY (`devi_id`) REFERENCES `devis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `articles_facture_id_foreign` FOREIGN KEY (`facture_id`) REFERENCES `factures` (`id`) ON DELETE CASCADE,
  CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table facture.articles : ~40 rows (environ)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `type_article`, `quantité_article`, `prix_ht_article`, `tva`, `reduction_article`, `total_ht_article`, `total_ttc_article`, `description_article`, `facture_id`, `devi_id`, `user_id`, `created_at`, `updated_at`, `avoir_id`) VALUES
	(114, 'Acompte', 53, 57.00, 78, 60, 1208.40, 2151.00, 'Fugit perferendis a', 55, NULL, NULL, '2021-05-17 14:07:47', '2021-05-17 14:07:47', NULL),
	(190, 'Acompte', 21, 36.00, 6, 39, 461.16, 488.80, 'Quasi facere a minim', NULL, 36, NULL, '2021-05-20 23:09:56', '2021-05-20 23:09:56', NULL),
	(191, 'Service', 66, 11.00, 72, 46, 392.04, 674.30, 'Quis ut aliquid fugi', NULL, 37, NULL, '2021-05-20 23:11:04', '2021-05-20 23:11:04', NULL),
	(193, 'Jours', 41, 92.00, 44, 70, 1131.60, 1629.50, 'Et laudantium offic', NULL, 39, NULL, '2021-05-21 06:53:45', '2021-05-21 06:53:45', NULL),
	(194, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', NULL, 35, NULL, NULL, '2021-05-21 07:15:04', NULL),
	(195, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', NULL, 40, NULL, '2021-05-21 07:15:32', '2021-05-21 07:15:32', NULL),
	(196, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', 80, NULL, NULL, '2021-05-21 07:20:47', '2021-05-21 07:20:47', NULL),
	(197, 'Produit', 1, 1000.00, 20, 1, 990.00, 1188.00, 'produit 12', NULL, 41, NULL, '2021-05-21 09:34:54', '2021-05-21 09:34:54', NULL),
	(198, 'Produit', 1, 1000.00, 20, 1, 990.00, 1188.00, 'produit 2', 81, NULL, NULL, '2021-05-21 09:36:41', '2021-05-21 09:36:41', NULL),
	(200, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 'service 1', 83, NULL, NULL, '2021-05-21 11:51:23', '2021-05-21 11:51:23', NULL),
	(203, 'Produit', 1, 100.00, 20, 1, 99.00, 118.80, 'p 1', 84, NULL, NULL, '2021-05-21 12:06:46', '2021-05-21 12:06:46', NULL),
	(204, 'Produit', 1, 200.00, 20, 1, 198.00, 237.60, 'p 1', 84, NULL, NULL, '2021-05-21 12:06:46', '2021-05-21 12:06:46', NULL),
	(205, 'Produit', 1, 100.00, 20, 1, 99.00, 118.80, 'p 1', NULL, 42, NULL, '2021-05-21 15:43:06', '2021-05-21 15:43:06', NULL),
	(206, 'Produit', 1, 200.00, 20, 1, 198.00, 237.60, 'p 1', NULL, 42, NULL, '2021-05-21 15:43:06', '2021-05-21 15:43:06', NULL),
	(212, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', 85, NULL, NULL, '2021-05-21 16:22:29', '2021-05-21 16:22:29', NULL),
	(213, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', NULL, 43, NULL, '2021-05-21 16:22:49', '2021-05-21 16:22:49', NULL),
	(214, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', 86, NULL, NULL, '2021-05-21 16:29:19', '2021-05-21 16:29:19', NULL),
	(215, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', NULL, 44, NULL, '2021-05-21 16:29:36', '2021-05-21 16:29:36', NULL),
	(216, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', 87, NULL, NULL, '2021-05-21 16:30:56', '2021-05-21 16:30:56', NULL),
	(217, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', NULL, 45, NULL, '2021-05-21 16:31:16', '2021-05-21 16:31:16', NULL),
	(218, 'Produit', 1, 1000.00, 20, 1, 990.00, 1188.00, 'produit 2', 88, NULL, NULL, '2021-05-21 16:36:21', '2021-05-21 16:36:21', NULL),
	(219, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', NULL, 46, NULL, '2021-05-21 16:37:11', '2021-05-21 16:37:11', NULL),
	(223, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 'service 1', 89, NULL, NULL, '2021-05-21 17:12:00', '2021-05-21 17:12:00', NULL),
	(224, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 'service 1', NULL, 47, NULL, '2021-05-21 17:12:22', '2021-05-21 17:12:22', NULL),
	(231, 'Acompte', 59, 15.00, 5, 72, 247.80, 260.20, 'Enim alias quibusdam', 90, NULL, NULL, '2021-05-21 20:43:44', '2021-05-21 20:43:44', NULL),
	(235, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', 91, NULL, NULL, '2021-05-21 21:29:56', '2021-05-21 21:29:56', NULL),
	(236, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', 92, NULL, NULL, '2021-05-21 21:38:19', '2021-05-21 21:38:19', NULL),
	(241, 'Service', 1, 1000.00, 10, 1, 990.00, 1188.00, 'service 1', 93, NULL, NULL, '2021-05-21 22:00:17', '2021-05-21 22:00:17', NULL),
	(244, 'Acompte', 59, 15.00, 5, 72, 247.80, 260.20, 'Enim alias quibusdam', 94, NULL, NULL, '2021-05-21 22:05:39', '2021-05-21 22:05:39', NULL),
	(245, 'Acompte', 59, 15.00, 5, 72, 247.80, 260.20, 'Enim alias quibusdam', 95, NULL, NULL, '2021-05-21 22:07:20', '2021-05-21 22:07:20', NULL),
	(246, 'Acompte', 59, 15.00, 5, 72, 247.80, 260.20, 'Enim alias quibusdam', 96, NULL, NULL, '2021-05-21 22:20:34', '2021-05-21 22:20:34', NULL),
	(247, 'Service', 1, 1000.00, 10, 1, 990.00, 1188.00, 'service 1', NULL, 48, NULL, '2021-05-21 23:59:52', '2021-05-21 23:59:52', NULL),
	(248, 'Acompte', 59, 15.00, 5, 72, 247.80, 260.20, 'Enim alias quibusdam', NULL, 49, NULL, '2021-05-22 00:04:19', '2021-05-22 00:04:19', NULL),
	(249, 'Service', 1, 1000.00, 10, 1, 990.00, 1188.00, 'service 1', NULL, 50, NULL, '2021-05-22 00:04:43', '2021-05-22 00:04:43', NULL),
	(251, 'Acompte', 59, 15.00, 5, 72, 247.80, 260.20, 'Enim alias quibusdam', NULL, NULL, NULL, '2021-05-25 11:12:12', '2021-05-25 11:12:12', 10),
	(252, 'Acompte', 59, 15.00, 5, 72, 247.80, 260.20, 'Enim alias quibusdam', NULL, NULL, NULL, '2021-05-25 11:30:10', '2021-05-25 11:30:10', 11),
	(253, 'Acompte', 59, 15.00, 5, 72, 247.80, 260.20, 'Enim alias quibusdam', NULL, NULL, NULL, '2021-05-25 11:49:52', '2021-05-25 11:49:52', 12),
	(254, 'Acompte', 59, 15.00, 5, 72, 247.80, 260.20, 'Enim alias quibusdam', NULL, NULL, NULL, '2021-05-25 11:53:13', '2021-05-25 11:53:13', 13),
	(255, 'Service', 1, 1000.00, 20, 1, 990.00, 1188.00, 's 2', NULL, NULL, NULL, '2021-05-25 12:42:27', '2021-05-25 12:42:27', 14),
	(256, 'Produit', 1, 1000.00, 20, 1, 990.00, 1188.00, 'produit 2', NULL, NULL, NULL, '2021-05-25 12:42:55', '2021-05-25 12:42:55', 15);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Listage de la structure de la table facture. avoirs
DROP TABLE IF EXISTS `avoirs`;
CREATE TABLE IF NOT EXISTS `avoirs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `etat_facture` enum('Provisoire','Finalisé','Remboursé') COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_ht_articlesf` double(8,2) NOT NULL,
  `remise_genf` double(8,2) DEFAULT NULL,
  `total_ht_apres_remise_genf` double(8,2) NOT NULL,
  `tvaf` double(8,2) NOT NULL,
  `total_debours` double(8,2) DEFAULT NULL,
  `total_facturef` double(8,2) NOT NULL,
  `condition_reglf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode_reglf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interet_reglf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_bancf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_introductionf` longtext COLLATE utf8mb4_unicode_ci,
  `text_conclusionf` longtext COLLATE utf8mb4_unicode_ci,
  `pied_pagef` longtext COLLATE utf8mb4_unicode_ci,
  `client_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `devis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remised` int(11) DEFAULT NULL,
  `code_avoir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `facture_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `avoirs_client_id_foreign` (`client_id`),
  KEY `avoirs_user_id_foreign` (`user_id`),
  KEY `avoirs_facture_id_foreign` (`facture_id`),
  CONSTRAINT `avoirs_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avoirs_facture_id_foreign` FOREIGN KEY (`facture_id`) REFERENCES `factures` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avoirs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table facture.avoirs : ~6 rows (environ)
/*!40000 ALTER TABLE `avoirs` DISABLE KEYS */;
INSERT INTO `avoirs` (`id`, `etat_facture`, `total_ht_articlesf`, `remise_genf`, `total_ht_apres_remise_genf`, `tvaf`, `total_debours`, `total_facturef`, `condition_reglf`, `mode_reglf`, `interet_reglf`, `code_bancf`, `text_introductionf`, `text_conclusionf`, `pied_pagef`, `client_id`, `user_id`, `devis`, `created_at`, `updated_at`, `remised`, `code_avoir`, `facture_id`) VALUES
	(10, 'Provisoire', 247.80, 136.29, 111.51, 5.58, 122.00, 239.09, '120 Jours Fin De Mois', 'Carte bancaire', 'Taux d’intérêt légal en vigueur', 'Molestiae modi place', 'intro', 'conclu', 'pied de page', 14, 28, '(DH)', '2021-05-25 11:12:12', '2021-05-25 11:12:12', 55, 'A202110', 94),
	(11, 'Provisoire', 247.80, 136.29, 111.51, 5.58, 122.00, 239.09, '120 Jours Fin De Mois', 'Carte bancaire', 'Taux d’intérêt légal en vigueur', 'Molestiae modi place', 'intro', 'conclu', 'pied de page', 14, 28, '(DH)', '2021-05-25 11:30:10', '2021-05-25 11:30:10', 55, 'A202111', 94),
	(12, 'Finalisé', 247.80, 136.29, 111.51, 5.58, 122.00, 239.09, '120 Jours Fin De Mois', 'Carte bancaire', 'Taux d’intérêt légal en vigueur', 'Molestiae modi place', 'intro', 'conclu', 'pied de page', 14, 28, '(DH)', '2021-05-25 11:49:52', '2021-05-25 11:49:52', 55, 'A202112', 94),
	(13, 'Finalisé', 247.80, 136.29, 111.51, 5.58, 122.00, 239.09, '120 Jours Fin De Mois', 'Carte bancaire', 'Taux d’intérêt légal en vigueur', 'Molestiae modi place', 'intro', 'conclu', 'pied de page', 14, 28, '(DH)', '2021-05-25 11:53:13', '2021-05-25 11:53:13', 55, 'A202113', 94),
	(14, 'Remboursé', 990.00, 970.20, 970.20, 194.04, 0.00, 1164.24, 'A Réception', 'Non spécifié', 'none', '90030093999809393', 'introduction', 'conclusion', 'pied de  page', 12, 28, '(DH)', '2021-05-25 12:42:27', '2021-05-25 12:42:27', 2, 'A202114', 80),
	(15, 'Remboursé', 990.00, 19.80, 970.20, 194.04, 120.00, 1284.24, 'Fin de mois', 'Virement bancaire', '1% par mois', '90030093999809393', 'cc', 'dd', 'ssss', 12, 28, '(DH)', '2021-05-25 12:42:55', '2021-05-25 12:42:55', 2, 'A202115', 81);
/*!40000 ALTER TABLE `avoirs` ENABLE KEYS */;

-- Listage de la structure de la table facture. cles
DROP TABLE IF EXISTS `cles`;
CREATE TABLE IF NOT EXISTS `cles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned DEFAULT NULL,
  `facture_id` int(10) unsigned DEFAULT NULL,
  `devi_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `mot_cle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avoir_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cles_client_id_foreign` (`client_id`),
  KEY `cles_facture_id_foreign` (`facture_id`),
  KEY `cles_devi_id_foreign` (`devi_id`),
  KEY `cles_user_id_foreign` (`user_id`),
  KEY `cles_avoir_id_foreign` (`avoir_id`),
  CONSTRAINT `cles_avoir_id_foreign` FOREIGN KEY (`avoir_id`) REFERENCES `avoirs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cles_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cles_devi_id_foreign` FOREIGN KEY (`devi_id`) REFERENCES `devis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cles_facture_id_foreign` FOREIGN KEY (`facture_id`) REFERENCES `factures` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=487 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table facture.cles : ~63 rows (environ)
/*!40000 ALTER TABLE `cles` DISABLE KEYS */;
INSERT INTO `cles` (`id`, `client_id`, `facture_id`, `devi_id`, `user_id`, `mot_cle`, `created_at`, `updated_at`, `avoir_id`) VALUES
	(108, 7, NULL, NULL, NULL, 'designe', NULL, NULL, NULL),
	(109, 7, NULL, NULL, NULL, 'page-web-1', NULL, NULL, NULL),
	(110, 7, NULL, NULL, NULL, 'Illo', NULL, NULL, NULL),
	(113, NULL, 55, NULL, NULL, 'designe', NULL, NULL, NULL),
	(346, NULL, NULL, 36, NULL, 'logo', NULL, NULL, NULL),
	(347, NULL, NULL, 36, NULL, 'Minima', NULL, NULL, NULL),
	(348, NULL, NULL, 37, NULL, 'hebergement', NULL, NULL, NULL),
	(349, NULL, NULL, 37, NULL, 'hebergement2', NULL, NULL, NULL),
	(399, 14, NULL, NULL, NULL, 'hebergement', NULL, NULL, NULL),
	(403, NULL, NULL, 39, NULL, 'page-web-1', NULL, NULL, NULL),
	(404, NULL, NULL, 39, NULL, 'hebergement', NULL, NULL, NULL),
	(405, NULL, NULL, 35, NULL, 'Illo', NULL, NULL, NULL),
	(406, NULL, NULL, 40, NULL, 'Illo', NULL, NULL, NULL),
	(407, NULL, 80, NULL, NULL, 'Illo', NULL, NULL, NULL),
	(411, NULL, NULL, 41, NULL, 'site-django', NULL, NULL, NULL),
	(412, NULL, 81, NULL, NULL, 'designe-figma', NULL, NULL, NULL),
	(414, 17, NULL, NULL, NULL, 'page-web-1', NULL, NULL, NULL),
	(415, 12, NULL, NULL, NULL, 'page-web-1', NULL, NULL, NULL),
	(416, 12, NULL, NULL, NULL, 'logo', NULL, NULL, NULL),
	(417, NULL, 83, NULL, NULL, 'hebergement', NULL, NULL, NULL),
	(419, NULL, 84, NULL, NULL, 'hebergement', NULL, NULL, NULL),
	(420, NULL, NULL, 42, NULL, 'hebergement', NULL, NULL, NULL),
	(424, NULL, 85, NULL, NULL, 'Illo', NULL, NULL, NULL),
	(425, NULL, NULL, 43, NULL, 'Illo', NULL, NULL, NULL),
	(426, NULL, 86, NULL, NULL, 'Illo', NULL, NULL, NULL),
	(427, NULL, NULL, 44, NULL, 'Illo', NULL, NULL, NULL),
	(428, NULL, 87, NULL, NULL, 'Illo', NULL, NULL, NULL),
	(429, NULL, NULL, 45, NULL, 'Illo', NULL, NULL, NULL),
	(430, NULL, 88, NULL, NULL, 'designe-figma', NULL, NULL, NULL),
	(431, NULL, NULL, 46, NULL, 'Illo', NULL, NULL, NULL),
	(435, NULL, 89, NULL, NULL, 'hebergement', NULL, NULL, NULL),
	(436, NULL, NULL, 47, NULL, 'hebergement', NULL, NULL, NULL),
	(443, NULL, 90, NULL, NULL, 'page-web-1', NULL, NULL, NULL),
	(444, NULL, 90, NULL, NULL, 'logo', NULL, NULL, NULL),
	(445, NULL, 90, NULL, NULL, 'Ipsum,', NULL, NULL, NULL),
	(451, NULL, 91, NULL, NULL, 'page-web-1', NULL, NULL, NULL),
	(452, NULL, 92, NULL, NULL, 'page-web-1', NULL, NULL, NULL),
	(459, NULL, 93, NULL, NULL, 'hebergement', NULL, NULL, NULL),
	(461, NULL, 94, NULL, NULL, 'page-web-1', NULL, NULL, NULL),
	(462, NULL, 94, NULL, NULL, 'logo', NULL, NULL, NULL),
	(463, NULL, 94, NULL, NULL, 'Ipsum,', NULL, NULL, NULL),
	(464, NULL, 95, NULL, NULL, 'page-web-1', NULL, NULL, NULL),
	(465, NULL, 95, NULL, NULL, 'logo', NULL, NULL, NULL),
	(466, NULL, 95, NULL, NULL, 'Ipsum,', NULL, NULL, NULL),
	(467, NULL, 96, NULL, NULL, 'page-web-1', NULL, NULL, NULL),
	(468, NULL, 96, NULL, NULL, 'logo', NULL, NULL, NULL),
	(469, NULL, 96, NULL, NULL, 'Ipsum,', NULL, NULL, NULL),
	(470, NULL, NULL, 48, NULL, 'hebergement', NULL, NULL, NULL),
	(471, NULL, NULL, 49, NULL, 'page-web-1', NULL, NULL, NULL),
	(472, NULL, NULL, 49, NULL, 'logo', NULL, NULL, NULL),
	(473, NULL, NULL, 49, NULL, 'Ipsum,', NULL, NULL, NULL),
	(474, NULL, NULL, 50, NULL, 'hebergement', NULL, NULL, NULL),
	(475, 19, NULL, NULL, NULL, 'designe', NULL, NULL, NULL),
	(477, NULL, NULL, NULL, NULL, 'page-web-1', NULL, NULL, 10),
	(478, NULL, NULL, NULL, NULL, 'logo', NULL, NULL, 10),
	(479, NULL, NULL, NULL, NULL, 'page-web-1', NULL, NULL, 11),
	(480, NULL, NULL, NULL, NULL, 'logo', NULL, NULL, 11),
	(481, NULL, NULL, NULL, NULL, 'page-web-1', NULL, NULL, 12),
	(482, NULL, NULL, NULL, NULL, 'logo', NULL, NULL, 12),
	(483, NULL, NULL, NULL, NULL, 'page-web-1', NULL, NULL, 13),
	(484, NULL, NULL, NULL, NULL, 'logo', NULL, NULL, 13),
	(485, NULL, NULL, NULL, NULL, 'Illo', NULL, NULL, 14),
	(486, NULL, NULL, NULL, NULL, 'designe-figma', NULL, NULL, 15);
/*!40000 ALTER TABLE `cles` ENABLE KEYS */;

-- Listage de la structure de la table facture. clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adresse_email_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_client` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_client` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fonction_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langue_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codep_client` int(11) DEFAULT NULL,
  `ville_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `societe_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_client` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_user_id_foreign` (`user_id`),
  CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table facture.clients : ~5 rows (environ)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`id`, `adresse_email_client`, `nom_client`, `prenom_client`, `fonction_client`, `adresse_client`, `langue_client`, `codep_client`, `ville_client`, `site_client`, `tel_client`, `societe_client`, `note_client`, `user_id`, `created_at`, `updated_at`, `code_client`) VALUES
	(7, 'ybaba@gmail.com', 'youssef', 'baba', 'programmer', '09BD PRINCE SIDI MOHAMED SIDI BENNOUR', 'Arabic', 0, 'SIDI BENNOUR', 'https://devosoft.ma/', '+212608087965', 'devosoft', 'Sed sunt qui molesti', 7, '2021-05-13 21:21:38', '2021-05-13 21:21:38', 'C20217'),
	(12, 'reda@gmail.com', 'reda', 'driouch', 'designer', '09BD PRINCE SIDI MOHAMED SIDI BENNOUR', 'Arabic', 0, 'SIDI BENNOUR', 'https://devosoft.ma/', '+212608053460', NULL, 'note', 28, '2021-05-20 17:19:29', '2021-05-21 10:26:40', 'C202112'),
	(14, 'abdelhadi@gmail.com', 'abdelhadi', 'esmahi', 'designer', '09BD PRINCE SIDI MOHAMED SIDI BENNOUR', 'Arabic', 0, 'SIDI BENNOUR', 'https://devosoft.ma/', '+212603953543', 'ocp', 'note', 28, '2021-05-21 06:43:12', '2021-05-21 06:43:12', 'C202114'),
	(17, 'omar@gmail.com', 'omar', 'abderahmane', 'designer', '09BD PRINCE SIDI MOHAMED SIDI BENNOUR', 'Francais', 0, 'SIDI BENNOUR', 'https://devosoft.ma/', '+212608068765', NULL, 'note pour omar', 28, '2021-05-21 10:13:25', '2021-05-21 10:13:25', 'C202117'),
	(19, 'hamza@gmail.com', 'hamza', 'aziz', 'designer', '09BD PRINCE SIDI MOHAMED SIDI BENNOUR', 'Arabic', 0, 'SIDI BENNOUR', 'https://devosoft.ma/', '+212606553960', NULL, 'note', 28, '2021-05-23 15:39:53', '2021-05-23 15:39:53', 'C202119');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Listage de la structure de la table facture. debours
DROP TABLE IF EXISTS `debours`;
CREATE TABLE IF NOT EXISTS `debours` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ref_debours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant_ht_debours` double(8,2) DEFAULT NULL,
  `description_debours` text COLLATE utf8mb4_unicode_ci,
  `facture_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avoir_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `debours_facture_id_foreign` (`facture_id`),
  KEY `debours_user_id_foreign` (`user_id`),
  KEY `debours_avoir_id_foreign` (`avoir_id`),
  CONSTRAINT `debours_avoir_id_foreign` FOREIGN KEY (`avoir_id`) REFERENCES `avoirs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `debours_facture_id_foreign` FOREIGN KEY (`facture_id`) REFERENCES `factures` (`id`) ON DELETE CASCADE,
  CONSTRAINT `debours_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table facture.debours : ~16 rows (environ)
/*!40000 ALTER TABLE `debours` DISABLE KEYS */;
INSERT INTO `debours` (`id`, `ref_debours`, `montant_ht_debours`, `description_debours`, `facture_id`, `user_id`, `created_at`, `updated_at`, `avoir_id`) VALUES
	(37, 'ref  12', 120.00, 'debour 12', 81, NULL, '2021-05-21 09:36:41', '2021-05-21 09:36:41', NULL),
	(39, 'ref 14', 130.00, 'debours 14', 83, NULL, '2021-05-21 11:51:23', '2021-05-21 11:51:23', NULL),
	(40, 'reference facture', 100.00, 'd 1', 84, NULL, '2021-05-21 12:06:46', '2021-05-21 12:06:46', NULL),
	(43, 'ref  12', 120.00, 'debour 12', 88, NULL, '2021-05-21 16:36:21', '2021-05-21 16:36:21', NULL),
	(45, 'ref 14', 130.00, 'debours 14', 89, NULL, '2021-05-21 17:12:00', '2021-05-21 17:12:00', NULL),
	(48, 'reference facture', 122.00, 'd 1', 90, NULL, '2021-05-21 20:43:44', '2021-05-21 20:43:44', NULL),
	(50, 'reference facture', 453.00, 'd 1', 91, NULL, '2021-05-21 21:29:56', '2021-05-21 21:29:56', NULL),
	(53, 'ref 14', 130.00, 'debours 14', 93, NULL, '2021-05-21 22:00:17', '2021-05-21 22:00:17', NULL),
	(55, 'reference facture', 122.00, 'd 1', 94, NULL, '2021-05-21 22:05:39', '2021-05-21 22:05:39', NULL),
	(56, 'reference facture', 122.00, 'd 1', 95, NULL, '2021-05-21 22:07:20', '2021-05-21 22:07:20', NULL),
	(57, 'reference facture', 122.00, 'd 1', 96, NULL, '2021-05-21 22:20:34', '2021-05-21 22:20:34', NULL),
	(58, 'reference facture', 122.00, 'd 1', NULL, NULL, '2021-05-25 11:12:12', '2021-05-25 11:12:12', 10),
	(59, 'reference facture', 122.00, 'd 1', NULL, NULL, '2021-05-25 11:30:10', '2021-05-25 11:30:10', 11),
	(60, 'reference facture', 122.00, 'd 1', NULL, NULL, '2021-05-25 11:49:52', '2021-05-25 11:49:52', 12),
	(61, 'reference facture', 122.00, 'd 1', NULL, NULL, '2021-05-25 11:53:13', '2021-05-25 11:53:13', 13),
	(62, 'ref  12', 120.00, 'debour 12', NULL, NULL, '2021-05-25 12:42:55', '2021-05-25 12:42:55', 15);
/*!40000 ALTER TABLE `debours` ENABLE KEYS */;

-- Listage de la structure de la table facture. devis
DROP TABLE IF EXISTS `devis`;
CREATE TABLE IF NOT EXISTS `devis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `etat_devis` enum('Provisoire','Finalisé','Refusés','Signés') COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_ht_articlesdf` double(8,2) DEFAULT NULL,
  `remise_gendf` double(8,2) DEFAULT NULL,
  `remised` int(11) DEFAULT NULL,
  `total_ht_apres_remise_gendf` double(8,2) DEFAULT NULL,
  `tvadf` double(8,2) DEFAULT NULL,
  `total_facturedf` double(8,2) DEFAULT NULL,
  `condition_regld` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode_regld` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interet_regld` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_introductiond` longtext COLLATE utf8mb4_unicode_ci,
  `text_conclusiond` longtext COLLATE utf8mb4_unicode_ci,
  `pied_paged` longtext COLLATE utf8mb4_unicode_ci,
  `condition_vented` longtext COLLATE utf8mb4_unicode_ci,
  `client_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `devis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code_devis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `devis_client_id_foreign` (`client_id`),
  KEY `devis_user_id_foreign` (`user_id`),
  CONSTRAINT `devis_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `devis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table facture.devis : ~15 rows (environ)
/*!40000 ALTER TABLE `devis` DISABLE KEYS */;
INSERT INTO `devis` (`id`, `etat_devis`, `total_ht_articlesdf`, `remise_gendf`, `remised`, `total_ht_apres_remise_gendf`, `tvadf`, `total_facturedf`, `condition_regld`, `mode_regld`, `interet_regld`, `text_introductiond`, `text_conclusiond`, `pied_paged`, `condition_vented`, `client_id`, `user_id`, `devis`, `created_at`, `updated_at`, `code_devis`) VALUES
	(35, 'Signés', 990.00, 970.20, 2, 970.20, 194.04, 1164.24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 28, '(DH)', '2021-05-20 23:08:51', '2021-05-24 16:48:05', 'D202135'),
	(36, 'Refusés', 461.16, 341.26, 74, 119.90, 7.19, 127.09, '30 Jours Fin De Mois', 'Non spécifié', 'À préciser', 'Eos eius nihil moll', 'Ea quia error quod a', 'Tempore sunt est v', 'Laboris tempor ea al', 12, 28, '(DH)', '2021-05-20 23:09:56', '2021-05-21 07:16:51', 'D202136'),
	(37, 'Provisoire', 392.04, 313.63, 80, 78.41, 56.45, 134.86, 'A Réception', 'Virement bancaire', '1,5% par mois', 'Pariatur Nulla anim', 'Minima dolore est vo', 'Cupiditate dignissim', 'Consequat Duis exce', 12, 28, '($)', '2021-05-20 23:11:04', '2021-05-20 23:11:04', 'D202137'),
	(39, 'Provisoire', 1131.60, 407.38, 36, 724.22, 318.66, 1042.88, '30 Jours Fin De Mois', 'Espèces', '2% par mois', 'Obcaecati alias faci', 'Corrupti qui totam', 'A autem in possimus', 'Est mollitia quo qu', 12, 28, '(DH)', '2021-05-21 06:53:45', '2021-05-21 06:53:45', 'D202139'),
	(40, 'Provisoire', 990.00, 970.20, 2, 970.20, 194.04, 1164.24, 'A Réception', 'Non spécifié', 'none', NULL, NULL, NULL, NULL, 12, 28, '(DH)', '2021-05-21 07:15:32', '2021-05-21 07:15:32', 'D202140'),
	(41, 'Finalisé', 990.00, 19.80, 2, 970.20, 194.04, 1164.24, 'Fin de mois', 'Espèces', 'Pas d\'intérêts de retard', 'introduction', 'conclusion', 'pied de page', 'conditions', 12, 28, '(DH)', '2021-05-21 09:34:54', '2021-05-21 09:34:54', 'D202141'),
	(42, 'Finalisé', 297.00, 5.94, 2, 291.06, 58.21, 449.27, '10 Jours', 'Espèces', '1% par mois', 'intro', 'conclu', 'pied', 'condition', 12, 28, '(DH)', '2021-05-21 15:43:06', '2021-05-21 15:43:06', 'D202142'),
	(43, 'Provisoire', 990.00, 970.20, 2, 970.20, 194.04, 1164.24, 'A Réception', 'Non spécifié', 'none', 'intro', 'conclu', 'pied', 'condition', 12, 28, '(DH)', '2021-05-21 16:22:49', '2021-05-21 16:22:49', 'D202143'),
	(44, 'Provisoire', 990.00, 970.20, 2, 970.20, 194.04, 1164.24, 'A Réception', 'Non spécifié', 'none', 'intro', 'conclu', 'pied', 'condition', 12, 28, '(DH)', '2021-05-21 16:29:36', '2021-05-21 16:29:36', 'D202144'),
	(45, 'Provisoire', 990.00, 970.20, 2, 970.20, 194.04, 1164.24, 'A Réception', 'Non spécifié', 'none', 'intro', 'conclu', 'pied', 'condition', 12, 28, '(DH)', '2021-05-21 16:31:16', '2021-05-21 16:31:16', 'D202145'),
	(46, 'Provisoire', 990.00, 970.20, 2, 970.20, 194.04, 1164.24, 'A Réception', 'Non spécifié', 'none', 'intro', 'conclu', 'pied', 'condition', 12, 28, '(DH)', '2021-05-21 16:37:11', '2021-05-21 16:37:11', 'D202146'),
	(47, 'Provisoire', 990.00, 19.80, 2, 970.20, 194.04, 1294.24, 'Fin de mois', 'Espèces', '1% par mois', 'introduction', 'texte conclu', 'pied de page', 'con', 12, 28, '(DH)', '2021-05-21 17:12:22', '2021-05-21 17:12:22', 'D202147'),
	(48, 'Provisoire', 990.00, 19.80, 2, 970.20, 194.04, 1294.24, 'Fin de mois', 'Espèces', '1% par mois', 'introduction', 'conclusion', 'pied de page', 'condition', 12, 28, '(DH)', '2021-05-21 23:59:52', '2021-05-21 23:59:52', 'D202148'),
	(49, 'Provisoire', 247.80, 136.29, 55, 111.51, 5.58, 239.09, '120 Jours Fin De Mois', 'Non spécifié', 'Taux d’intérêt légal en vigueur', 'intro', 'conclu', 'pied de page', 'condition', 14, 28, '(DH)', '2021-05-22 00:04:19', '2021-05-22 00:04:19', 'D202149'),
	(50, 'Provisoire', 990.00, 19.80, 2, 970.20, 194.04, 1294.24, 'Fin de mois', 'Espèces', '1% par mois', 'introduction', 'conclusion', 'pied de page', 'condition', 12, 28, '(DH)', '2021-05-22 00:04:43', '2021-05-22 00:04:43', 'D202150');
/*!40000 ALTER TABLE `devis` ENABLE KEYS */;

-- Listage de la structure de la table facture. factures
DROP TABLE IF EXISTS `factures`;
CREATE TABLE IF NOT EXISTS `factures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `etat_facture` enum('Provisoire','Finalisé','Payée') COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_ht_articlesf` double(8,2) NOT NULL,
  `remise_genf` double(8,2) DEFAULT NULL,
  `total_ht_apres_remise_genf` double(8,2) NOT NULL,
  `tvaf` double(8,2) NOT NULL,
  `total_debours` double(8,2) DEFAULT NULL,
  `total_facturef` double(8,2) NOT NULL,
  `condition_reglf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode_reglf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interet_reglf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_bancf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_introductionf` longtext COLLATE utf8mb4_unicode_ci,
  `text_conclusionf` longtext COLLATE utf8mb4_unicode_ci,
  `pied_pagef` longtext COLLATE utf8mb4_unicode_ci,
  `client_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `devis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remised` int(11) DEFAULT NULL,
  `code_facture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `factures_client_id_foreign` (`client_id`),
  KEY `factures_user_id_foreign` (`user_id`),
  CONSTRAINT `factures_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `factures_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table facture.factures : ~17 rows (environ)
/*!40000 ALTER TABLE `factures` DISABLE KEYS */;
INSERT INTO `factures` (`id`, `etat_facture`, `total_ht_articlesf`, `remise_genf`, `total_ht_apres_remise_genf`, `tvaf`, `total_debours`, `total_facturef`, `condition_reglf`, `mode_reglf`, `interet_reglf`, `code_bancf`, `text_introductionf`, `text_conclusionf`, `pied_pagef`, `client_id`, `user_id`, `devis`, `created_at`, `updated_at`, `remised`, `code_facture`) VALUES
	(55, 'Provisoire', 1208.40, 906.30, 302.10, 235.64, 100.00, 537.74, '120 Jours Fin De Mois', 'Non spécifié', '1,5% par mois', 'Tempor consequuntur', 'Cupidatat et tempor', 'Vitae nulla dolore e', 'In aspernatur corrup', 7, 7, '($)', '2021-05-17 14:07:47', '2021-05-17 14:07:47', 75, 'F202155'),
	(80, 'Payée', 990.00, 970.20, 970.20, 194.04, 0.00, 1164.24, 'A Réception', 'Non spécifié', 'none', '90030093999809393', 'intro', 'conclu', 'pied', 12, 28, '(DH)', '2021-05-24 21:33:20', '2021-05-24 21:33:20', 2, 'F202180'),
	(81, 'Payée', 990.00, 19.80, 970.20, 194.04, 120.00, 1284.24, 'Fin de mois', 'Virement bancaire', '1% par mois', '90030093999809393', 'introduction', 'conclusion', 'pied de page', 12, 28, '(DH)', '2021-05-24 21:32:37', '2021-05-24 21:32:37', 2, 'F202181'),
	(83, 'Payée', 990.00, 19.80, 970.20, 194.04, 130.00, 1294.24, 'Fin de mois', 'Espèces', '1% par mois', '90030093999809393', 'introduction', 'texte conclu', 'pied de page', 12, 28, '(DH)', '2021-05-21 11:51:23', '2021-05-21 11:51:23', 2, 'F202183'),
	(84, 'Provisoire', 297.00, 5.94, 291.06, 58.21, 100.00, 449.27, '10 Jours', 'Espèces', '1% par mois', '90030093999809393', 'intro', 'conclu', 'pied', 12, 28, '(DH)', '2021-05-21 12:06:46', '2021-05-21 12:06:46', 2, 'F202184'),
	(85, 'Finalisé', 990.00, 970.20, 970.20, 194.04, 0.00, 1164.24, 'A Réception', 'Non spécifié', 'none', '90030093999809393', 'intro', 'conclu', 'pied', 12, 28, '(DH)', '2021-05-24 21:33:08', '2021-05-24 21:33:08', 2, 'F202185'),
	(86, 'Provisoire', 990.00, 970.20, 970.20, 194.04, 0.00, 1164.24, 'A Réception', 'Non spécifié', 'none', '90030093999809393', 'intro', 'conclu', 'pied', 12, 28, '(DH)', '2021-05-21 16:29:19', '2021-05-21 16:29:19', 2, 'F202186'),
	(87, 'Provisoire', 990.00, 970.20, 970.20, 194.04, 0.00, 1164.24, 'A Réception', 'Non spécifié', 'none', '90030093999809393', 'intro', 'conclu', 'pied', 12, 28, '(DH)', '2021-05-21 16:30:56', '2021-05-21 16:30:56', 2, 'F202187'),
	(88, 'Finalisé', 990.00, 19.80, 970.20, 194.04, 120.00, 1284.24, 'Fin de mois', 'Virement bancaire', '1% par mois', '90030093999809393', 'introduction', 'conclusion', 'pied de page', 12, 28, '(DH)', '2021-05-24 21:33:00', '2021-05-24 21:33:00', 2, 'F202188'),
	(89, 'Provisoire', 990.00, 19.80, 970.20, 194.04, 130.00, 1294.24, 'Fin de mois', 'Espèces', '1% par mois', '90030093999809393', 'introduction', 'texte conclu', 'pied de page', 12, 28, '(DH)', '2021-05-21 17:12:00', '2021-05-21 17:12:00', 2, 'F202189'),
	(90, 'Provisoire', 247.80, 136.29, 111.51, 5.58, 122.00, 239.09, '120 Jours Fin De Mois', 'Carte bancaire', 'Taux d’intérêt légal en vigueur', 'Molestiae modi place', 'Dolorum reiciendis s', 'Natus Nam voluptatem', 'Optio culpa quos ne', 14, 28, '(DH)', '2021-05-21 20:43:44', '2021-05-21 20:43:44', 55, 'F202190'),
	(91, 'Provisoire', 990.00, 970.20, 970.20, 194.04, 453.00, 1617.24, 'A Réception', 'Non spécifié', 'none', '90030093999809393', 'intro', 'conclu', 'pied de page', 12, 28, '(DH)', '2021-05-21 21:29:56', '2021-05-21 21:29:56', 2, 'F202191'),
	(92, 'Provisoire', 990.00, 970.20, 970.20, 194.04, 0.00, 1164.24, 'A Réception', 'Non spécifié', 'none', '90030093999809393', 'intro', 'conclu', 'pied de page', 12, 28, '(DH)', '2021-05-21 21:38:19', '2021-05-21 21:38:19', 2, 'F202192'),
	(93, 'Provisoire', 990.00, 19.80, 970.20, 194.04, 130.00, 1294.24, 'Fin de mois', 'Espèces', '1% par mois', '90030093999809393', 'introduction', 'conclusion', 'pied de page', 12, 28, '(DH)', '2021-05-21 22:00:17', '2021-05-21 22:00:17', 2, 'F202193'),
	(94, 'Payée', 247.80, 136.29, 111.51, 5.58, 122.00, 239.09, '120 Jours Fin De Mois', 'Carte bancaire', 'Taux d’intérêt légal en vigueur', 'Molestiae modi place', 'intro', 'conclusion', 'pied de page', 14, 28, '(DH)', '2021-05-25 11:04:20', '2021-05-25 11:04:20', 55, 'F202194'),
	(95, 'Provisoire', 247.80, 136.29, 111.51, 5.58, 122.00, 239.09, '120 Jours Fin De Mois', 'Carte bancaire', 'Taux d’intérêt légal en vigueur', 'Molestiae modi place', 'intro', 'conclusion', 'pied de page', 14, 28, '(DH)', '2021-05-21 22:07:20', '2021-05-21 22:07:20', 55, 'F202195'),
	(96, 'Provisoire', 247.80, 136.29, 111.51, 5.58, 122.00, 239.09, '120 Jours Fin De Mois', 'Carte bancaire', 'Taux d’intérêt légal en vigueur', 'Molestiae modi place', 'intro', 'conclusion', 'pied de page', 14, 28, '(DH)', '2021-05-21 22:20:34', '2021-05-21 22:20:34', 55, 'F202196');
/*!40000 ALTER TABLE `factures` ENABLE KEYS */;

-- Listage de la structure de la table facture. failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table facture.failed_jobs : ~0 rows (environ)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage de la structure de la table facture. migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table facture.migrations : ~25 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(37, '2021_05_06_121713_add_mot_cle_to_cles_table', 1),
	(38, '2014_10_12_000000_create_users_table', 2),
	(39, '2014_10_12_100000_create_password_resets_table', 2),
	(40, '2019_08_19_000000_create_failed_jobs_table', 2),
	(41, '2020_02_29_114856_create_clients_table', 2),
	(42, '2020_02_29_115003_create_factures_table', 2),
	(43, '2020_02_29_115033_create_devis_table', 2),
	(44, '2020_02_29_116923_create_articles_table', 2),
	(45, '2020_03_26_212014_create_debours_table', 2),
	(46, '2020_03_31_204207_create_cles_table', 2),
	(47, '2020_06_14_152125_create_raisons_table', 2),
	(48, '2021_05_03_141815_add_column_to_factures', 2),
	(49, '2021_05_05_160530_create_avoirs_table', 2),
	(50, '2021_05_08_113435_add_avoir_id_to_cles_table', 3),
	(51, '2021_05_08_113800_add_avoir_id_to_articles_table', 3),
	(52, '2021_05_08_113901_add_avoir_id_to_debours_table', 3),
	(53, '2021_05_08_122545_add_remised_to_avoirs_table', 4),
	(54, '2021_05_09_164832_add_code_facture_to_factures_table', 5),
	(55, '2021_05_09_170723_add_code_devis_to_devis_table', 6),
	(56, '2021_05_09_170855_add_code_avoir_to_avoirs_table', 6),
	(57, '2021_05_11_205459_add_is_admin_to_users_table', 7),
	(58, '2021_05_12_010909_add_role_to_users_table', 8),
	(59, '2021_05_23_153815_add_code_client_to_clients_table', 9),
	(60, '2021_05_25_104455_add_facture_id_to_factures_table', 10),
	(61, '2021_05_25_104652_add_facture_id_to_avoirs_table', 10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table facture. password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table facture.password_resets : ~0 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table facture. raisons
DROP TABLE IF EXISTS `raisons`;
CREATE TABLE IF NOT EXISTS `raisons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `raison` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarques` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table facture.raisons : ~1 rows (environ)
/*!40000 ALTER TABLE `raisons` DISABLE KEYS */;
INSERT INTO `raisons` (`id`, `email`, `raison`, `remarques`, `created_at`, `updated_at`) VALUES
	(1, 'omar@gmail.com', 'other_account', 'remarque', NULL, NULL);
/*!40000 ALTER TABLE `raisons` ENABLE KEYS */;

-- Listage de la structure de la table facture. users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` text COLLATE utf8mb4_unicode_ci,
  `name_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codepostal` int(11) DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` bigint(20) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twiter_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `users_remember_token_index` (`remember_token`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table facture.users : ~4 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `lastname`, `adresse`, `name_company`, `codepostal`, `ville`, `pays`, `tel`, `email`, `email_verified_at`, `password`, `facebook_id`, `google_id`, `twiter_id`, `active`, `avatar`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
	(7, 'admin', 'admin', '09BD PRINCE SIDI MOHAMED SIDI BENNOUR', 'ocp', 0, 'SIDI BENNOUR', 'maroc', 212608753960, 'admin@gmail.com', '2021-05-12 11:45:05', '$2y$10$rgVQm/kugawPu1MvKMcHs.Q2ym1xdXaba9n02XAYmi6n95GWOoCSK', NULL, NULL, NULL, 0, 'default.jpg', NULL, '2021-05-12 11:44:54', '2021-05-19 18:34:18', 1),
	(28, 'reda', 'driouch', '09BD PRINCE SIDI MOHAMED EL JADIDIDA', 'etudiant', 0, 'SIDI BENNOUR', 'maroc', 212608093943, 'reda@gmail.com', NULL, '$2y$10$LusBQev/DK2w/AuwZlp3.uEZauX4uK1uIdyh4kd21iRKEqyUVUOcS', NULL, NULL, NULL, 0, 'default.jpg', 'cHexxcSleJCuuGohlfR2QYonQyQ9ca4aMmAYtAqjIV9uayFJvFwLFd1KLBg8', '2021-05-18 11:02:02', '2021-05-21 23:27:02', 0),
	(38, 'test', 'test', '09BD PRINCE SIDI MOHAMED SIDI BENNOUR', 'adria', 0, 'SIDI BENNOUR', 'Selectionner Votre Pays', 212608053960, 'test@gmail.com', NULL, '$2y$10$jLGjdsNvNQr4Vg5bO1l9KuwpQg4RbBfYtLs5vcWnNPK0xpU2A0l2G', NULL, NULL, NULL, 0, 'default.jpg', NULL, '2021-05-19 22:23:51', '2021-05-19 22:27:19', 0),
	(39, 'said', 'addi', NULL, NULL, NULL, NULL, NULL, NULL, 'said@gmail.com', NULL, '$2y$10$5Q/iBHjIlHMBBQ2GSIw2F.BjRGUhcYGmrLl9edmFkgJjdvsZPbz0O', NULL, NULL, NULL, 0, 'default.jpg', NULL, '2021-05-21 23:16:35', '2021-05-21 23:16:35', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
