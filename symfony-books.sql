-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 03 août 2024 à 11:46
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `symfony-books`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

DROP TABLE IF EXISTS `abonnement`;
CREATE TABLE IF NOT EXISTS `abonnement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int NOT NULL,
  `type_abonnement_id` int NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_351268BBFB88E14F` (`utilisateur_id`),
  KEY `IDX_351268BB813AF326` (`type_abonnement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

DROP TABLE IF EXISTS `auteurs`;
CREATE TABLE IF NOT EXISTS `auteurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`id`, `nom`) VALUES
(1, 'Jay Luvaas'),
(2, 'Dmitry Glukhovsky'),
(3, 'Zep'),
(4, 'Jean Restayn'),
(5, 'Fernando Gamboa'),
(8, 'SUN TZU'),
(9, 'Eric S. Trautmann'),
(10, ' Albert Uderzo'),
(11, 'Stephen King'),
(12, 'Chloé Wallerand'),
(13, 'M.J SIGWIN'),
(14, 'François Julien'),
(15, 'Richard ALX'),
(16, 'Paolo Matricardi'),
(17, 'Jean-Marc Tanguy');

-- --------------------------------------------------------

--
-- Structure de la table `auteurs_livres`
--

DROP TABLE IF EXISTS `auteurs_livres`;
CREATE TABLE IF NOT EXISTS `auteurs_livres` (
  `auteurs_id` int NOT NULL,
  `livres_id` int NOT NULL,
  PRIMARY KEY (`auteurs_id`,`livres_id`),
  KEY `IDX_7BB9D45BAE784107` (`auteurs_id`),
  KEY `IDX_7BB9D45BEBF07F38` (`livres_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `auteurs_livres`
--

INSERT INTO `auteurs_livres` (`auteurs_id`, `livres_id`) VALUES
(1, 1),
(2, 3),
(2, 4),
(2, 5),
(3, 2),
(4, 6),
(5, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(11, 14),
(12, 12),
(13, 13),
(14, 15),
(15, 16);

-- --------------------------------------------------------

--
-- Structure de la table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `all_day` tinyint(1) NOT NULL,
  `background_color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int NOT NULL,
  `livres_id` int NOT NULL,
  `commentaire` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ajout` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D9BEC0C41E969C5` (`utilisateurs_id`),
  KEY `IDX_D9BEC0C4EBF07F38` (`livres_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `utilisateurs_id`, `livres_id`, `commentaire`, `date_ajout`) VALUES
(4, 1, 1, 'J\'aime bien ce livres', '2024-08-02 11:28:16');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires_emprunts`
--

DROP TABLE IF EXISTS `commentaires_emprunts`;
CREATE TABLE IF NOT EXISTS `commentaires_emprunts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `emprunts_id` int NOT NULL,
  `utilisateurs_id` int NOT NULL,
  `commentaire` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ajout` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F7B9E10410BD9597` (`emprunts_id`),
  KEY `IDX_F7B9E1041E969C5` (`utilisateurs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240502103659', '2024-05-02 10:37:09', 53),
('DoctrineMigrations\\Version20240708132938', '2024-07-08 13:29:48', 34);

-- --------------------------------------------------------

--
-- Structure de la table `emprunts`
--

DROP TABLE IF EXISTS `emprunts`;
CREATE TABLE IF NOT EXISTS `emprunts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int NOT NULL,
  `livres_id` int NOT NULL,
  `date_demande` date NOT NULL,
  `date_restitution_previsionnelle` date NOT NULL,
  `date_restitution_effective` date DEFAULT NULL,
  `extension_emprunt` tinyint(1) NOT NULL,
  `restitue` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_38FC80D1E969C5` (`utilisateurs_id`),
  KEY `IDX_38FC80DEBF07F38` (`livres_id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emprunts`
--

INSERT INTO `emprunts` (`id`, `utilisateurs_id`, `livres_id`, `date_demande`, `date_restitution_previsionnelle`, `date_restitution_effective`, `extension_emprunt`, `restitue`) VALUES
(67, 1, 2, '2024-05-08', '2024-05-14', '2024-05-08', 0, 1),
(68, 1, 3, '2024-05-08', '2024-05-14', '2024-05-08', 0, 1),
(69, 1, 1, '2023-05-03', '2023-05-09', '2024-05-10', 0, 1),
(70, 2, 3, '2024-05-08', '2024-05-14', NULL, 0, 0),
(71, 1, 4, '2024-05-10', '2024-05-16', '2024-05-10', 0, 1),
(72, 1, 4, '2024-05-08', '2024-05-14', '2024-05-10', 0, 1),
(73, 1, 1, '2024-05-10', '2024-05-16', '2024-05-10', 1, 1),
(74, 1, 1, '2024-05-10', '2024-05-22', '2024-05-10', 1, 1),
(75, 1, 1, '2024-05-10', '2024-05-26', '2024-05-10', 1, 1),
(76, 1, 1, '2024-05-10', '2024-05-26', '2024-05-10', 1, 1),
(77, 1, 2, '2024-05-01', '2024-05-12', '2024-07-09', 1, 1),
(78, 1, 1, '2024-05-10', '2024-05-22', '2024-05-10', 1, 1),
(79, 1, 1, '2024-05-10', '2024-05-22', '2024-05-10', 1, 1),
(80, 1, 1, '2024-05-10', '2024-05-22', '2024-07-09', 1, 1),
(81, 1, 13, '2024-05-17', '2024-05-29', '2024-05-17', 1, 1),
(82, 1, 11, '2024-07-09', '2024-07-15', NULL, 0, 0),
(83, 1, 1, '2024-07-10', '2024-07-16', '2024-07-10', 0, 1),
(84, 1, 10, '2024-07-10', '2024-07-16', NULL, 0, 0),
(85, 1, 4, '2024-07-10', '2024-07-16', NULL, 0, 0),
(86, 1, 16, '2024-07-18', '2024-07-30', NULL, 1, 0),
(87, 1, 2, '2024-08-02', '2024-08-14', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `equipements`
--

DROP TABLE IF EXISTS `equipements`;
CREATE TABLE IF NOT EXISTS `equipements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `wifi_equipement` tinyint(1) NOT NULL,
  `projecteur_equipement` tinyint(1) NOT NULL,
  `tableau_equipement` tinyint(1) NOT NULL,
  `prise_electrique_equipement` tinyint(1) NOT NULL,
  `television_equipement` tinyint(1) NOT NULL,
  `climatisation_equipement` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `equipements_salles_travail`
--

DROP TABLE IF EXISTS `equipements_salles_travail`;
CREATE TABLE IF NOT EXISTS `equipements_salles_travail` (
  `equipements_id` int NOT NULL,
  `salles_travail_id` int NOT NULL,
  PRIMARY KEY (`equipements_id`,`salles_travail_id`),
  KEY `IDX_4D36259A852CCFF5` (`equipements_id`),
  KEY `IDX_4D36259A6E318F2B` (`salles_travail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etats_livres`
--

DROP TABLE IF EXISTS `etats_livres`;
CREATE TABLE IF NOT EXISTS `etats_livres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etats_livres`
--

INSERT INTO `etats_livres` (`id`, `libelle`) VALUES
(1, 'Excellent état'),
(2, 'bon état'),
(3, 'état moyen'),
(4, 'mauvais état');

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `etats_livres_id` int NOT NULL,
  `image_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_size` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_publication` int NOT NULL,
  `resume` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `disponibilite` tinyint(1) NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_927187A483A6FF20` (`etats_livres_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id`, `etats_livres_id`, `image_name`, `image_size`, `updated_at`, `nom`, `annee_publication`, `resume`, `disponibilite`, `position`) VALUES
(1, 1, 'napoleon-66210754b3364809927184.jpeg', 10553, '2024-04-18 11:43:16', 'Napoleon On the art of war', 1970, 'Napoléon. Le passage du temps n’a pas atténué la puissance de son nom. Un siècle et demi après sa mort, Napoléon reste le plus grand génie militaire du monde moderne. Pourtant, contrairement à Machiavel, Clausewitz ou Sun Tzu, son nom n’a couronné aucune œuvre littéraire. Sujet de milliers de biographies et de traités sur la guerre, il n’en est l’auteur d’aucun. Jusqu\'à maintenant. Le grand général et conquérant de l’Europe n’a peut-être écrit aucun livre, mais il était un écrivain prolifique. Des milliers de ses missives à ses subordonnés survivent, et ces documents reflètent le large éventail d\'un esprit intrépide et incisif. À partir d’eux, l’historien militaire Jay Luvaas a construit un tout homogène. Luvaas a passé des décennies à trier, éditer et organiser les pensées de Napoléon en essais et arguments cohérents. Dans le résultat remarquable. Napoléon parle sans interruption dans une œuvre qui changera à jamais notre regard. Luvaas couvre tous les sujets abordés par Napoléon, depuis le besoin de préparation : « Le simple fait de rassembler des hommes ne produit pas de vrais soldats ; l\'exercice, l\'instruction et l\'habileté sont ce qui fait les vrais soldats. -- à l\'essence de la victoire -- « Gagner ne suffit pas : il faut profiter du succès ». En matière d\'éducation, de leadership, de stratégie et d\'histoire, Napoléon s\'exprime avec une autorité unique à ceux qui ont gouverné un continent. Dans ces pages réside la sagesse d\'un géant qui a connu les plus grandes réalisations de la vie et ses plus bas : triomphe et conquête, exil et disgrâce. Que vous soyez un étudiant en stratégie militaire ou un professionnel des affaires désireux d\'apprendre auprès du plus grand gestionnaire de personnel que le monde ait jamais connu, Napoléon sur l\'art de la guerre a quelque chose pour vous. Depuis les détails de l\'utilisation de la cavalerie par Napoléon et de sa dépendance unique à l\'artillerie jusqu\'à une vision globale de la vie d\'un homme de confiance et de succès suprêmes, vous le trouverez ici. C\'est la seule explication directe des campagnes et de la philosophie de Napoléon par l\'homme lui-même.', 1, 1),
(2, 2, 'titeuf-662107a490b39979172618.jpg', 440830, '2024-04-18 11:44:36', 'Titeuf', 2002, 'Titeuf est devenu une star, mais ça ne l\'empêche pas de vivre comme tous les enfants de sa génération. Il fait tout pour que son père ne l\'accompagne pas au parc d\'attractions, collectionne les cartes « mégadonjonfight », se dispute avec Manu pour avoir les plus puissantes, et  continue plus que jamai de détester la soupe (qui a sûrement été inventée par un sadique).En prise directe avec les enfants, Titeuf utilise un langage fait d\'invention et de réalité, de curiosité et de soif de découverte. Turbulent, drôle et abordant les problèmes de société, Titeuf a passé le cap de la BD pour devenir témoin de sa génération. Le regard de Titeuf est celui de l\'humour, du plaisir et de la liberté de ton...Zep regarde, écoute et retraduit le monde de l\'enfance avec un ton de vérité qui séduit tous les publics. Ce neuvième album, plus qu\'attendu, est un véritable événement dans le monde de l\'édition. Toutes les billes pour jouer dans la cour des grands...', 0, 6),
(3, 1, 'metro-2033-6621081a3544c554493151.jpeg', 15354, '2024-04-18 11:46:34', 'Metro 2033', 2017, '2033. Une guerre a décimé la planète. La surface, inhabitable, est désormais livrée à des monstruosités mutantes. Moscou est une ville abandonnée. Les survivants se sont réfugiés dans les profondeurs du métropolitain, où ils ont tant bien que mal organisé des microsociétés de la pénurie.\r\n	Dans ce monde réduit à des stations en déliquescence reliées par des tunnels où rôdent les dangers les plus insolites, le jeune Artyom entreprend une mission qui pourrait le conduire à sauver les derniers hommes d\'une menace obscure... mais aussi à se découvrir lui-même à travers des rencontres inattendues.\r\n	Un thriller fantastique inoubliable, traduit dans une vingtaine de langues, qui s\'est vendu à 1,5 million d\'exemplaires et a été adapté en jeux vidéo (Metro 2033 et Metro : Last Light).', 1, 7),
(4, 1, 'metro-2034-662108528590d298026808.jpeg', 11783, '2024-04-18 11:47:30', 'Metro 2034', 2017, '2034. La station Sevastopolskaya produit de l\'électricité qui alimente le métro moscovite, mais la dernière caravane d\'approvisionnement n’est jamais réapparue, pas plus que les groupes de reconnaissance envoyés à sa recherche...\r\n	Ils seront trois à devoir résoudre cette énigme. Hunter, le combattant impitoyable revenu d\'entre les morts, rongé de l\'intérieur par les ténèbres ; Homère, qui a tout perdu aux premiers instants de la guerre et projette d\'ériger un mémorial à l\'humanité disparue ; Sacha, enfin, toute jeune fille qu\'ils trouveront sur leur route dans une station où elle a vécu en exil avec son père.\r\n	Publié en Russie en 2009, Métro 2034 a suivi la carrière de best-seller international de Métro 2033.', 0, 2),
(5, 4, 'metro-2035-662108a661026849029913.jpg', 127411, '2024-04-18 11:48:54', 'Metro 2035', 2019, '2035. Station VDNKh. Artyom est retourné y vivre. C’est un héros brisé, obsédé par l’idée que c’est à la surface qu’est le salut de l’humanité. Les Noirs anéantis, un souvenir le taraude, celui de la voix qu’il a entendue sur une radio militaire, deux ans plus tôt, quand il était au sommet de la tour Ostankino avec les stalkers. Aussi, depuis son retour, il remonte quotidiennement à la surface et escalade des gratte-ciel en ruines pour tenter d’entrer en contact avec des survivants. Tenu pour fou, Artyom sombre peu à peu. Mais l’arrivée d’Homère bouleverse la situation : le vieil homme prétend en effet que des contacts radio ont déjà été établis avec d’autres enclaves.\r\n	Ce nouvel et dernier opus de la saga traduite en plus de trente langues et adaptée en jeux vidéo est le point de convergence de toutes les trames narratives mises en place par l’auteur.', 1, 4),
(6, 2, 'encyclopedie-blindes-662108f68d861188168739.jpg', 134428, '2024-04-18 11:50:14', 'L\'encyclopédie des blindés 1939-1945', 2009, 'Après le très grand succès recueilli par la précédente édition de ce livre (sous le titre Blindés de la Seconde Guerre mondiale), il est apparu nécessaire d\'en proposer au public une version entièrement refondue, remaniée et complétée. C\'est chose faite avec cette Encyclopédie qui présente chronologiquement et par nations tous les chars de combat qui ont participé aux batailles de 1939 à 1945, de la Pologne à Berlin en passant par le désert de Libye ou la Normandie, du Panzer I au tout dernier modèle de Cruiser britannique. Chaque profil en couleurs de char est accompagné de sa légende.', 1, 5),
(7, 4, 'citeperdu-6621096a75ad7464466741.jpg', 136897, '2024-04-18 11:52:10', 'LA DERNIÈRE CITÉ PERDUE', 2020, 'Le récit de La dernière cité perdue débute plusieurs mois après le retour des trois protagonistes des aventures narrées dans La dernière crypte : Ulysse, Cassie et le professeur Castillo. L’angoisse étreint le vieux professeur : sa fille Valéria a mystérieusement disparu dans l’une des contrées les plus lointaines et dangereuses de la Terre.\r\nDésespéré, il prend la décision de partir à sa recherche et demande à Ulysse et Cassie de l’accompagner dans son expédition. Incapables de le faire changer d’avis, et tout aussi incapables de le laisser y aller seul, ils accepteront à contrecœur de l’aider dans cette entreprise insensée, et nos trois amis se lanceront de nouveau dans une aventure téméraire vers l’inconnu.\r\nUne aventure qui ne ressemblera en rien à ce qu’ils attendaient.\r\nUne aventure qui les mènera au bord de la folie, là où la réalité s’effiloche à la lisière des certitudes et où l’impensable devient inévitable.\r\nLes trois compagnons l’ignorent encore, mais leur quête les conduira jusqu’à une cité légendaire où nul être humain n’a vécu depuis des milliers d’années. Une cité dont l’existence même semble impossible. Une cité dans laquelle ils découvriront – mais trop tard – qu’ils ne sont pas seuls.\r\n\r\nNOTE DE L’AUTEUR: LA DERNIÈRE CITÉ PERDUE commence quelques mois après le retour des trois protagonistes de LA DERNIÈRE CRYPTE, de sorte que les deux romans s’enchaînent facilement. Néanmoins, LA DERNIÈRE CITÉ PERDUE est une histoire complètement indépendante du premier volume et peut parfaitement être lue sans connaître les antécédents ni avoir lu LA DERNIÈRE CRYPTE.', 1, 8),
(8, 1, 'artdelaguerre-6621099b010ba422278526.jpg', 123813, '2024-04-18 11:52:59', 'L\'art de la guerre', 2017, 'Lecture incontournable des stratèges orientaux depuis la nuit des temps, L\'Art de la guerre de Sun Tzu est probablement le traité de guerre et de science militaire le plus connu au monde. Pragmatique, il enseigne comment s\'assurer la victoire à moindre coût, grâce à toutes sortes de moyens - ruse, espionnage, mobilité, surprise... -, en s\'adaptant à la stratégie de son adversaire. Véritable référence pour de nombreux leaders à travers l\'histoire - Napoléon et Mao Zedong notamment -, les techniques de résolutions des conflits qu\'il présente restent d\'une incroyable actualité et sont facilement transposables à d\'autres domaines, y compris à la stratégie d\'entreprise, le commerce, ou même le sport.', 1, 9),
(9, 1, 'vampirella-662109dae510b730150609.jpg', 302067, '2024-04-18 11:54:02', 'Vampirella Vol. 1: Crown of WormsVol', 2011, 'Dynamite Entertainment est heureux de réintroduire ses lecteurs dans le fléau des morts-vivants, Vampirella - et elle est tout ce qui nous sépare de la fin du monde ! Vampi est de retour et se lance sur les traces jonchées de cadavres de son ennemi juré, Vlad Dracula ! C\'est un monde plus sombre pour Vampirella, et quelque chose de plus sinistre que les vampires se cache dans l\'ombre... quelque chose que même Dracula lui-même a des raisons de craindre ! Recueille les sept premiers numéros de la série à succès Vampirella de Dynamite et présente une galerie de couvertures complète d\'Alex Ross, J Scott Campbell, Jelena Kevic-Djurdjevic, Joe Madureira et d\'autres.', 1, 10),
(10, 3, 'asterix-66210a1819fe1067386976.jpg', 49969, '2024-04-18 11:55:04', 'Astérix - Astérix aux jeux olympiques', 2005, 'Astérix et Obélix veulent faire participer leur village aux Jeux olympiques pour faire front aux occupants romains de leur contrée : ils réussiront au-delà de toute espérance', 0, 11),
(11, 1, 'holy-66210a5d27790703513476.jpg', 180830, '2024-04-18 11:56:13', 'Holly', 2024, 'Avec ce nouveau chef-d\'oeuvre, on retrouve un Stephen King au sommet de l\'horreur, et son enquêtrice Holly, célèbre héroïne de la trilogie Mr Mercedes et de L\'Outsider.', 0, 12),
(12, 3, 'devilsons-66210a9af07f9169082375.jpg', 35852, '2024-04-18 11:57:14', 'The Devil\'s Sons T.1', 2022, 'Si je pensais passer ma première année d’université de la façon la plus banale qui soit, concentrée sur mes études, accompagnée de deux ou trois amis, rien n’aurait pu me préparer au tournant qu’allait prendre ma vie.\r\n	J’aurais dû comprendre qu’avoir une meilleure amie dont le frère fait partie des Devil’s Sons allait être une source d’ennuis. Mais la dernière chose que j’imaginais, c’était de me retrouver liée aux activités d’un gang païen du Michigan. Encore moins forger une amitié avec ces bad boys armés. Et certainement pas être attirée par Clarke Taylor, le plus incontrôlable et dangereux de ces garçons...\r\n	Désormais, je suis piégée, et je n’ai qu’une seule option : les aider.', 1, 13),
(13, 2, 'loup-66210ae5a7c19898294258.jpg', 149832, '2024-04-18 11:58:29', 'L\'appel du loup', 2023, 'ui aurait cru qu\'un vieux grimoire poussiéreux légué par ma grand-mère ferait de ma vie une suite d\'événements surréalistes ?\r\n	Et pourtant, tout est de ma faute. Si je n\'avais pas fait la bêtise de suivre l\'un de ces rituels, je ne me serais pas retrouvé avec un loup-garou dans les pattes. Qui plus est, un loup-garou aussi exaspérant qu\'irrésistible qui ne veut plus décoller de mon canapé.\r\n	Gabriel est bien sympathique, mais il a apporté avec lui un tas d\'ennuis.\r\n	Moi qui pensais que rien ne pourrait être pire que les circonstances chaotiques de son arrivée, j\'avais tort.', 1, 14),
(14, 4, 'marchecreve-66210b6150fca651592768.jpg', 245987, '2024-04-18 12:00:33', 'Marche ou crève', 2004, 'Garraty, un jeune adolescent natif du Maine, va concourir pour \" La Longue Marche \", une compétition qui compte cent participants. Cet événement est très attendu. Il sera retransmis à la télévision, suivi par des milliers de personnes. Mais ce n\'est pas une marche comme les autres, plutôt un jeu sans foi ni loi... Garraty a tout intérêt à gagner. Le contraire pourrait lui coûter cher. Très cher...la couverture peut différer!', 1, 15),
(15, 1, 'johnny-66210b8ef12ca414247620.jpg', 46997, '2024-04-18 12:01:18', 'Johnny, toute une vie', 2022, 'Cinq ans déjà et, les hommages de la profession, les versions symphoniques de ses plus gros succès, les tournées triomphales de certains de ses sosies, et la vente phénoménale de ses plus grands succès n\'ont pas de fin.\r\n	Nous avons, nous, choisis de vous raconter pour la première fois Johnny dans le détail, année par année, revenant sur ses coups d\'éclat comme sur ses moments de doute, de ses années de jeunesse place de la Trinité aux plages de Saint-Barth\' et de Los Angeles. Avec en plat de résistance, ses plus beaux concerts, du Golf Douot au Stade de France, ses virées à moto, les femmes de sa vie et tous ses amis. Le tout raconté au jour le jour et illustré par d\'incroyables photos parfois inédites.\r\n	L\'album définitif sur Johnny que tout fan se doit de posséder. Un beau livre sous coffret cartonné.', 1, 16),
(16, 3, 'napoleonbon-66210bc80ad1c437507073.jpg', 28167, '2024-04-18 12:02:16', 'Anecdotes inédites ou peu connues sur Napoléon Bonaparte', 2024, 'Plongez dans les pages de l\'histoire avec des récits qui dévoilent le côté méconnu de l\'une des figures les plus emblématiques de l\'histoire française. \"Anecdotes inédites ou peu connues sur Napoléon Bonaparte\" vous invite à explorer les facettes cachées de cet homme extraordinaire, dont l\'ambition et la grandeur ont presque bouleversé l\'Europe.', 1, 3),
(17, 2, 'le-grand-livre-des-avions-de-combat-2e-edition-668d0ba37756d803800933.jpg', 32558, '2024-07-09 10:06:27', 'Le grand livre des avions de combat 2e édition', 2021, 'L’histoire des avions de combat en un panorama complet !Des fragiles biplans et monoplaces de la Grande Guerre aux avions de combat de la Seconde Guerre mondiale, des avions à réaction de la Guerre froide aux chasseurs et avions furtifs déployés dans les Balkans, en Iraq, en Afghanistan, ou plus récemment, en Libye ou au Mali, cet ouvrage encyclopédique retrace tous les progrès technologiques ayant marqué plus d’un siècle d’aviation militaire. Richement illustrée de 750 photos, dessins et schémas techniques, cette nouvelle...', 1, 17),
(18, 1, '81c4jlzjekl-sl1500-668d0e5c2b95d640739513.jpg', 201718, '2024-07-09 10:18:04', 'Les Rafale au combat', 2024, 'Le Rafale, une prouesse technique et un bond en avant dans l’art du combat aérien. Cet ouvrage est une plongée au cœur de 20 ans d’opérations. Afghanistan, Libye, Irak sont des noms qui ont marqué une génération entière de pilotes, de techniciens et de marins. Des souvenirs de préparations de missions complexes, de vols longs et éprouvants, de la concentration nécessaire à l’appontage… Autant de témoins d’une aéronavale de pointe, associant la performance d’un avion à la force d’un équipage. Ce recueil de témoignages de pilotes, de navigateurs et de mécaniciens ayant servi en opérations entre 2001 et 2022 offre une clé de compréhension à la fois juste, pertinente et complète sur le changement de paradigme engendré par l’arrivée du Rafale au sein des armées françaises.', 1, 18);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int NOT NULL,
  `livres_id` int NOT NULL,
  `note` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_11BA68C1E969C5` (`utilisateurs_id`),
  KEY `IDX_11BA68CEBF07F38` (`livres_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id`, `utilisateurs_id`, `livres_id`, `note`) VALUES
(1, 1, 3, 2),
(2, 1, 1, 5),
(3, 1, 2, 3),
(4, 1, 14, 4),
(5, 1, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int NOT NULL,
  `salles_travail_id` int NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4DA2391E969C5` (`utilisateurs_id`),
  KEY `IDX_4DA2396E318F2B` (`salles_travail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `salles_travail`
--

DROP TABLE IF EXISTS `salles_travail`;
CREATE TABLE IF NOT EXISTS `salles_travail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacite` int NOT NULL,
  `disponibilite` tinyint(1) NOT NULL,
  `wifi` tinyint(1) NOT NULL,
  `projecteur` tinyint(1) NOT NULL,
  `tableau` tinyint(1) NOT NULL,
  `prise_electrique` tinyint(1) NOT NULL,
  `television` tinyint(1) NOT NULL,
  `climatisation` tinyint(1) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_size` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salles_travail`
--

INSERT INTO `salles_travail` (`id`, `nom`, `capacite`, `disponibilite`, `wifi`, `projecteur`, `tableau`, `prise_electrique`, `television`, `climatisation`, `description`, `image_name`, `image_size`) VALUES
(2, 'Salle Solarium', 52, 1, 1, 0, 0, 1, 0, 1, 'La salle \"Solarium\" est un espace lumineux et ouvert, souvent doté de grandes baies vitrées ou de fenêtres, conçu pour profiter de la lumière naturelle du soleil. Elle est souvent aménagée pour offrir un environnement relaxant et apaisant, favorisant la d', 'salle-de-travail-2-solarium-662680847b087909815425.jpg', 1416243),
(3, 'Salles Multimedia', 10, 1, 1, 1, 1, 1, 1, 1, 'La salle \"Multimédia\" est un espace équipé de technologies modernes permettant l\'accès à une variété de médias tels que l\'audio, la vidéo et l\'informatique. Elle est conçue pour la création, la diffusion et la manipulation de contenus multimédias, favoris', 'salle-de-travail-3-multimedia-6626813cec839599041322.avif', 1709966),
(4, 'Salle Moderne', 50, 0, 1, 1, 1, 1, 0, 1, 'La salle \"Moderne\" est un espace contemporain et fonctionnel, conçu avec des équipements et des aménagements de pointe pour répondre aux besoins actuels. Elle peut inclure des caractéristiques telles que des meubles ergonomiques, un éclairage LED, des tec', 'salle-de-travail-4-modern-662681a900147610518080.avif', 1713900),
(5, 'Salles Silence', 12, 0, 1, 0, 0, 1, 0, 1, 'La salle \"Silence\" est un espace calme et tranquille, spécialement conçu pour offrir un environnement propice à la concentration, à la réflexion et au travail en silence. Elle est souvent équipée d\'aménagements et de matériaux absorbant le bruit, et peut', 'salle-de-travail-5-silente-6626851d5add5207562945.avif', 761068),
(6, 'Salle Archive', 10, 1, 0, 1, 1, 0, 0, 1, 'Salles Archive est une entité ou un modèle de données qui représente les informations sur les salles archivées dans un système ou une application. Cette entité peut contenir des attributs tels que le nom de la salle, sa capacité, sa disponibilité, ainsi', 'salle-de-travail-1-archive-662690b2bfaf1620317723.jpg', 83828);

-- --------------------------------------------------------

--
-- Structure de la table `type_abonnement`
--

DROP TABLE IF EXISTS `type_abonnement`;
CREATE TABLE IF NOT EXISTS `type_abonnement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_telephone` bigint NOT NULL,
  `langue_du_site_fr` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_497B315EE7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `date_naissance`, `adresse`, `code_postal`, `ville`, `numero_telephone`, `langue_du_site_fr`) VALUES
(1, 'admin@admin.fr', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$4xQZzdz1.h4ZvJ0yfEfi1uhu7zXIqGpispFyQI1anhAhPN.rJ0ijS', 'admin nom', 'admin prenom', '2019-01-01', 'adresse test ok', '51100', 'reims', 2147483647, 1),
(2, 'test@test.com', '[\"ROLE_USER\"]', '$2y$13$yg5sjxgWKjBdG2OEMbizr.KFAD/aAP6Tyk848T4OzA0.13K6/Xw8K', 'test2', 'testNom2', '2019-01-01', '10 rue de la pipe', '98959', 'luxembourg', 2147483647, 1),
(3, 'banni@test.com', '[\"ROLE_USER\", \"ROLE_BANNI\"]', '$2y$13$SchWfGNCJ6SwdIAo3ySzrupKlLslZBeAOi96.NcEXVQcj3ue0w3uC', 'banni', 'test', '1919-03-01', '40 rue du bannissement', '4125221', 'villa', 605522145632, 1),
(4, 'loic@mail.com', '[\"ROLE_USER\"]', '$2y$13$2HnwqpKn.Xivqe9PV82BH.6q0s8EdYI4.kwF1Q2V0Z106ObnXmoYK', 'Fenn', 'Loic', '1985-02-21', '40 rue de chez moi', '51100', 'Reims', 622222222, 1),
(5, 'loictest@hotmail.com', '[\"ROLE_USER\"]', '$2y$13$uAVdWOLQ..2rF9FB8RnIRuv24tTbaQyUDe8wHW9woCRMFR7Q2sjK.', 'loic', 'test', '1904-01-01', 'chez moi', '12345', 'villa', 145252652, 1),
(6, 'test@live.fr', '[\"ROLE_USER\"]', '$2y$13$VmjBm0n4uTmE/Yy3x1Eu3.0LOGQbxnNdxYNv5.cq8g5D0u7fpQ5QK', 'nomlive', 'prenomlive', '1921-03-18', '1 rue de chez live', '123456', 'villelive', 4552315231132, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD CONSTRAINT `FK_351268BB813AF326` FOREIGN KEY (`type_abonnement_id`) REFERENCES `type_abonnement` (`id`),
  ADD CONSTRAINT `FK_351268BBFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `auteurs_livres`
--
ALTER TABLE `auteurs_livres`
  ADD CONSTRAINT `FK_7BB9D45BAE784107` FOREIGN KEY (`auteurs_id`) REFERENCES `auteurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7BB9D45BEBF07F38` FOREIGN KEY (`livres_id`) REFERENCES `livres` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `FK_D9BEC0C41E969C5` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `FK_D9BEC0C4EBF07F38` FOREIGN KEY (`livres_id`) REFERENCES `livres` (`id`);

--
-- Contraintes pour la table `commentaires_emprunts`
--
ALTER TABLE `commentaires_emprunts`
  ADD CONSTRAINT `FK_F7B9E10410BD9597` FOREIGN KEY (`emprunts_id`) REFERENCES `emprunts` (`id`),
  ADD CONSTRAINT `FK_F7B9E1041E969C5` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`);

--
-- Contraintes pour la table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `FK_38FC80D1E969C5` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `FK_38FC80DEBF07F38` FOREIGN KEY (`livres_id`) REFERENCES `livres` (`id`);

--
-- Contraintes pour la table `equipements_salles_travail`
--
ALTER TABLE `equipements_salles_travail`
  ADD CONSTRAINT `FK_4D36259A6E318F2B` FOREIGN KEY (`salles_travail_id`) REFERENCES `salles_travail` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4D36259A852CCFF5` FOREIGN KEY (`equipements_id`) REFERENCES `equipements` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `livres`
--
ALTER TABLE `livres`
  ADD CONSTRAINT `FK_927187A483A6FF20` FOREIGN KEY (`etats_livres_id`) REFERENCES `etats_livres` (`id`);

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `FK_11BA68C1E969C5` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `FK_11BA68CEBF07F38` FOREIGN KEY (`livres_id`) REFERENCES `livres` (`id`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `FK_4DA2391E969C5` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `FK_4DA2396E318F2B` FOREIGN KEY (`salles_travail_id`) REFERENCES `salles_travail` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
