-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 16, 2021 at 11:32 PM
-- Server version: 8.0.25-0ubuntu0.20.04.1
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizz`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'DB'),
(2, 'Actualités'),
(3, 'Arts'),
(4, 'Cinéma'),
(5, 'Cuisine'),
(6, 'Culture géneral'),
(7, 'Esotérisme');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210512131038', '2021-05-12 15:22:49', 88491),
('DoctrineMigrations\\Version20210512135506', '2021-05-12 15:55:19', 1698),
('DoctrineMigrations\\Version20210512135747', '2021-05-12 15:57:56', 257);

-- --------------------------------------------------------

--
-- Table structure for table `historique`
--

CREATE TABLE `historique` (
  `id` int NOT NULL,
  `users_id` int NOT NULL,
  `quizz_id` int NOT NULL,
  `categories_id` int NOT NULL,
  `score` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `historique`
--

INSERT INTO `historique` (`id`, `users_id`, `quizz_id`, `categories_id`, `score`, `date`) VALUES
(9, 1, 1, 1, '30', '2021-05-12 15:56:01'),
(10, 1, 1, 1, '30', '2021-05-12 16:02:52'),
(11, 2, 1, 1, '30', '2021-05-16 19:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int NOT NULL,
  `quizz_id` int NOT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `index_question` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `quizz_id`, `question`, `index_question`) VALUES
(1, 1, 'Dans quel pays se passent les aventures de Tintin et le Temple du Soleil ?', 1),
(2, 1, 'Dans quel journal travaille Tintin ?', 2),
(3, 1, 'Quel est le pays du général Alcazar ?', 3),
(4, 1, 'Quel homme politique a dit que « Tintin était son rival international » ?  ', 4),
(5, 1, 'Quel ennemi de Tintin a été capturé par des extra-terrestres à la fin de l’album Vol 714 pour Sydney ?', 5),
(6, 1, ' Dans quelle aventure, Tintin est-il décoré chevalier de l’ordre du Pélican d’Or ?', 6),
(7, 1, 'Quel est le prénom du Professeur Tournesol ?', 7),
(8, 1, 'Dans quelle aventure Tintin doit-il empêcher la Syldavie et la Bordurie de s’emparer d’une arme très destructrice ?', 8),
(9, 1, 'Les Sept Boules de Cristal', 9),
(10, 1, 'Quelle race de chiens est Milou ?', 10),
(11, 2, 'Qui a dit : « Non, s’il vous plaît, Mme Le Pen, je ne vous fais pas parler, je n’ai pas besoin d’un ventriloque » ?', 1),
(12, 2, 'Qui a dit « Le vote utile ne sert qu’à une classe politique carbonisée » ?', 2),
(13, 2, 'Qui a dit en s’adressant à François Fillon « Vous, c’est 500 000 fonctionnaires en moins. Vous êtes fort en soustraction, un peu moins en addition quand il s’agit de votre propre argent » ?', 3),
(14, 2, 'Qui a dit « Le vrai serial killer du pouvoir d’achat, c’est Marine Le Pen avec la sortie de l’euro, une inflation galopante » ?', 4),
(15, 2, 'Qui a dit « Si les travailleurs se levaient, demandaient des comptes ils seraient en possibilité de changer la situation. J’ai un exemple : la Commune de Paris en 1871 » ?', 5),
(16, 2, 'Qui a dit « Vous avez un talent fou, vous arrivez à parler sept minutes, je suis incapable de résumer votre pensée, vous n’avez rien dit » en s’adressant à Emmanuel Macron ?', 6),
(17, 2, 'Qui a dit « Les deux grands partis, c’est l’amicale des boulistes. Mais sans l’amitié et sans les boules » ?', 7),
(18, 2, 'Qui a dit « Nous, quand on est convoqué par la police, on n’a pas d’immunité ouvrière, on y va » ?', 8),
(19, 2, 'Qui a dit « Je sais que je tiendrai tête à Monsieur Trump, à Monsieur Poutine, parce que moi j’ai eu affaire aux ours, aux loups et aux cavernes » ?', 9),
(20, 2, 'Qui a dit « Dans les meetings de Macron, les gens découvrent qu’en fait, c’est une espèce de sèche-cheveux (...). Il brasse de l’air chaud, il n’y a rien dedans » ?', 10),
(21, 3, 'Quel président français est à l’origine de la construction de la pyramide du Louvre ?', 1),
(22, 3, 'À quel peintre doit-on « Bateaux dans le port de Collioure » ?', 2),
(23, 3, 'À quel mouvement artistique appartenaient Rembrandt, Vermeer,  Velázquez ou Rubens ?', 3),
(24, 3, 'À quel peintre doit-on « L\'autoportrait au gilet vert » ?', 4),
(25, 3, 'Qui a peint le tableau « Barques à Martigues » ?', 5),
(26, 3, 'Quel architecte américain a conçu le musée d\'Art moderne de Kiasma ?', 6),
(27, 3, 'Qui a peint le célèbre tableau « Café de nuit à Arles »  ?', 7),
(28, 3, 'Quel peintre a représenté la fameuse « Fusillade du 3 mai » ?', 8),
(29, 3, 'Dans quelle ville européenne se trouve le musée Guggenheim ?', 9),
(30, 3, 'À quel peintre doit-on « La Dentellière » ?', 10),
(31, 4, 'Quel ennemi de Mario a enlevé la Princess Peach ?', 1),
(32, 4, 'Quel est le nom américain du Yéti ?', 2),
(33, 4, 'Quel est le prénom du Capitaine Crochet, ennemi de Peter Pan ?', 3),
(34, 4, 'Dans les aventures de Tintin, quel est le méchant qui s’est fait passer pour mort dans « Coke en Stock » ?', 4),
(35, 4, 'Quel « méchant » est à l’affiche du film « Vendredi 13 » ?', 5),
(36, 4, ' Dans un célèbre dessin animé, qui se bat contre Shredder ?', 6),
(37, 4, ' Quel ennemi de James Bond a les dents en acier ?', 7),
(38, 4, 'Quel est le vrai nom de Dark Vador, avant qu’il ne sombre dans le côté de la force obscure ?', 8),
(39, 4, 'Qui se bat contre Lex Luthor ?', 9),
(40, 4, 'Quelle est le nom de cette jeune enquêtrice du FBI qui pourchasse Hannibal Lecter dans \"le Silence des Agneaux\" ?', 10),
(41, 5, 'En quelle année, les César du cinéma ont-ils été créés ?', 1),
(42, 5, 'Quel film a obtenu le tout premier César du meilleur film ?', 2),
(43, 5, 'Avec Cyrano de Bergerac, quel est l’autre film qui a obtenu 10 César ?', 3),
(44, 5, ' Quel acteur a été le premier président du jury des César ?', 4),
(45, 5, 'Quelle actrice a trébuché lors de la cérémonie, tombant dans les bras d’Orson Welles ?', 5),
(46, 5, 'Pour quel film Coluche a-t-il obtenu le César du meilleur acteur en 1984 ?', 6),
(47, 5, 'Lors des César 2005, quelle actrice est parodiée par Gad Elmaleh et Will Smith ?', 7),
(48, 5, 'Aux César 1991, quelle actrice s\'est trompée en annonçant le nom de la lauréate du César de la meilleure actrice ?', 8),
(49, 5, 'Quel acteur sera le président du Jury des César 2013 ?', 9),
(50, 5, ' Pour quel film Catherine Deneuve a-t-elle obtenu le César de la meilleure actrice en 1993 ?', 10),
(51, 6, 'Outre le gingembre, la muscade et le poivre, quelle est la 4e épice du mélange 4 Épices ?', 1),
(52, 6, 'Quel pays est le premier producteur mondial d’épices ?', 2),
(53, 6, 'De quel pays est originaire le wasabi ?', 3),
(54, 6, 'A quelle épice Dioscoride, Pline et Avicenne attribuaient-ils des vertus aphrodisiaques ?', 4),
(55, 6, 'Quelle épice peut être utilisée comme substitut à la moutarde ?', 5),
(56, 6, 'Quelle plante vivace est un élixir de longue vie pour la médecine chinoise ?', 6),
(57, 6, ' Qu’est-ce que la bergamote ?', 7),
(58, 6, 'Quelle plante est également appelée « persil arabe » ou « persil chinois » ?', 8),
(59, 6, ' A quelle plante, le goût de l\'Ajowan, graine du sud de l’Inde, se rapproche-t-il le plus ?', 9),
(60, 6, 'D’où est originaire le condiment appelé Gomashio ?', 10),
(61, 7, 'Quelle est la racine carrée de 36 ?', 1),
(62, 7, 'Quel département français a pour chef-lieu Bordeaux ?', 2),
(63, 7, 'Qu\'est pour moi le père de mon père ?', 3),
(64, 7, 'Combien de voleurs accompagnaient Ali Baba ?', 4),
(65, 7, '-aud ou -eau ? Quel mot est mal orthographié ?', 5),
(66, 7, 'Lequel de ces nombres est un nombre premier ?', 6),
(67, 7, 'Combien d\'années compte-t-on dans une décennie ?', 7),
(68, 7, 'Lequel de ces termes est synonyme de joyeux ?', 8),
(69, 7, 'Combien compte-t-on de jours durant le mois de juillet ?', 9),
(70, 7, 'Quel âge a un enfant de 18 mois ?', 10),
(71, 8, 'À quoi correspondent les douze signes chinois ?', 1),
(72, 8, ' Quel signe chinois êtes-vous si vous êtes né en 1968 ou en 1980 ?', 2),
(73, 8, 'Selon la légende, qui aurait convoqué les animaux pour une course, définissant ainsi les 12 signes arrivant en premier ?', 3),
(74, 8, 'Quel animal serait arrivé en tête de cette fameuse course ?', 4),
(75, 8, 'Quel animal serait arrivé dernier lors de cette course ?', 5),
(76, 8, 'Combien de signes composent l’astrologie chinoise ?', 6),
(77, 8, 'Parmi ces animaux, lequel fait partie de l’astrologie chinoise ?', 7),
(78, 8, 'Quel élément n’est pas présent dans l’astrologie chinoise ?', 8),
(79, 8, 'Quel animal célèbre-t-on cette année 2013 ?', 9),
(80, 8, ' Sur quoi se fonde l’astrologie chinoise ?', 10),
(81, 9, 'Quel journaliste télé a pris la direction de la rédaction du journal Vanity Fair France en juin 2013 ?', 1),
(82, 9, 'Dans quel journal américain, le scandale du Watergate a-t-il été révélé ?', 2),
(83, 9, 'Quel journal français a été dirigé par Philippe Val de 1992 à 2009 ?', 3),
(84, 9, 'Quel quotidien français, toujours édité, est le plus ancien titre de la presse ?', 4),
(85, 9, 'Quel journal américain a le tirage le plus important ?', 5),
(86, 9, 'Quel hebdomadaire français a été créé en 1953 par Françoise Giroud et Jean-Jacques Servan-Schreiber ?', 6),
(87, 9, 'Quel journal a célébré son grand retour dans les kiosques français en septembre 2013, sous l’impulsion de Frédéric Beigbeder ?', 7),
(88, 9, 'Dans quel tabloïd anglais, la page 3 est-elle réservée pour présenter le buste dénudé d’une femme ?', 8),
(89, 9, 'À la tête de quel magazine, Anna Wintour est-elle la rédactrice en chef depuis 1988 ?', 9),
(90, 9, 'Quel journaliste a créé en 1984 l’hebdomadaire « L’Événement du jeudi » ?', 10),
(91, 10, 'Quelle est la nationalité de l’architecte Apollodore de Damas ?', 1),
(92, 10, 'Quel architecte a conçu la Sagrada Familia ?', 2),
(93, 10, ' Quel architecte de l’Antiquité a conçu le forum de Trajan et les Thermes de Trajan ?', 3),
(94, 10, ' Quel architecte en exil en France a conçu le siège du Parti communiste français, place du Colonel Fabien et le siège du journal L\'Humanité à Saint-Denis ?', 4),
(95, 10, ' De quel roi égyptien, Imhotep était-il l’architecte ?', 5),
(96, 10, ' Avec qui Jean-Baptiste Rondelet a-t-il dessiné les plans du Panthéon ?', 6),
(97, 10, 'Qu’héberge le Palais Brongniart à Paris, du nom du célèbre architecte Alexandre Théodore Brongniart ?', 7),
(98, 10, 'Quel architecte conçut le phare d’Alexandrie ?', 8),
(99, 10, 'Quel architecte français a ajouté un dôme de verre sur l’Opéra de Lyon ?', 9),
(100, 10, 'Quel architecte a conçu l’Arc de Triomphe de l’Étoile ?', 10),
(101, 11, 'Qui a réalisé le film « Orange Mécanique » ?', 1),
(102, 11, 'Qui a réalisé le film « Le Seigneur des Anneaux : La Communauté de l\'Anneau » ?', 2),
(103, 11, 'Qui a réalisé le film « Vol au-dessus d\'un nid de coucou » ?', 3),
(104, 11, 'Qui a réalisé le film « Les Affranchis » ?', 4),
(105, 11, 'Qui a réalisé le film « Arnaques, crimes et botanique » ?', 5),
(106, 11, 'Qui a réalisé le film « Psychose » ?', 6),
(107, 11, 'Qui a réalisé le film « La Haine » ?', 7),
(108, 11, 'Qui a réalisé le film « Rasta Rockett » ?', 8),
(109, 11, 'Qui a réalisé le film « Le Grand Bleu » ?', 9),
(110, 11, 'Qui a réalisé le film « Donnie Brasco » ?', 10),
(111, 12, 'Quel est le dessert préféré d’Harry Potter ?', 1),
(112, 12, ' À quel groupe de musique pop rock doit-on le titre « The Bakery Song » ?', 2),
(113, 12, ' Qui a « apporté des bonbons, parce que les fleurs, c´est périssable » dans l\'une de se chansons ?', 3),
(114, 12, 'Quel est le dessert préféré des Schtroumpfs ?', 4),
(115, 12, 'Qui veut offrir des « caramels, bonbons et chocolats » à Dalida dans une chanson ?', 5),
(116, 12, 'Qui chante « L\'amour c\'est du bonbon » ?', 6),
(117, 12, ' Qui a chanté « La femme chocolat » ?', 7),
(118, 12, 'Qui a écrit le roman « Charlie et la chocolaterie » ?', 8),
(119, 12, ' Qu\'est-ce qu\'un Mistral Gagnant, cité dans une chanson de Renaud ?', 9),
(120, 12, 'Quelle actrice tient le rôle principal dans le film « Le chocolat », de Lasse Hallström en 2001 ?', 10),
(121, 13, ' Sur quoi repose la théorie philosophique de l\'hédonisme ?', 1),
(122, 13, 'À quel philosophe doit-on cette injonction « Connais-toi toi-même » ?', 2),
(123, 13, 'Qui a affirmé que « L\'homme est un animal politique » ?', 3),
(124, 13, 'Quel philosophe était également médecin, écrivain et astronome ?', 4),
(125, 13, 'Lors de quel siècle vécurent Montesquieu, Rousseau et Voltaire ?', 5),
(126, 13, ' Quel est le prénom de Schopenhauer ?', 6),
(127, 13, 'Qui a écrit « La Généalogie de la morale » ?', 7),
(128, 13, 'Qui a dit « Le cœur a ses raisons que la raison ne connait pas » ?', 8),
(129, 13, ' À qui doit-on l\'allégorie de la caverne ?', 9),
(130, 13, 'Quel est le véritable nom de Voltaire ?', 10),
(131, 14, 'Qu\'est-ce que la chiromancie ?', 1),
(132, 14, ' Dans le tarot de Marseille, quelle lame qui ne porte pas de numéro ?', 2),
(133, 14, 'De quelle manière s’effectue habituellement le tirage en croix, méthode d’interprétation tarologique ?', 3),
(134, 14, 'Le carré de Mars est le fruit de deux arts divinatoires. Lesquels ?', 4),
(135, 14, ' Qu’appelle-t-on « écriture automatique » en voyance ?', 5),
(136, 14, 'Combien y a-t-il d’arcanes mineurs dans le tarot de Marseille ?', 6),
(137, 14, 'Un cartomancien, c’est quelqu’un qui :', 7),
(138, 14, 'Combien de maisons astrologiques dénombre-t-on ?', 8),
(139, 14, 'Comment se calcule le chemin de vie ?', 9),
(140, 14, 'Le but du Yi King c’est de trouver l’hexagramme qui répondra à votre question. Ainsi, on utilise en général :', 10);

-- --------------------------------------------------------

--
-- Table structure for table `quizz`
--

CREATE TABLE `quizz` (
  `id` int NOT NULL,
  `categories_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizz`
--

INSERT INTO `quizz` (`id`, `categories_id`, `name`) VALUES
(1, 1, 'tintin'),
(2, 2, 'Élections présidentielles 2017'),
(3, 3, 'Peinture et musée'),
(4, 1, 'Les méchants de fiction'),
(5, 4, 'Les César'),
(6, 5, 'Les épices'),
(7, 6, 'Retour à l’école'),
(8, 7, 'Astrologie chinoise'),
(9, 2, 'La presse écrite'),
(10, 3, 'Les architectes célèbres'),
(11, 4, 'Les réalisateurs'),
(12, 5, 'Le monde du sucré dans la culture'),
(13, 6, 'Philosophie'),
(14, 7, 'Esotérisme ');

-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

CREATE TABLE `reponse` (
  `id` int NOT NULL,
  `question_id` int NOT NULL,
  `reponse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `indice_reponse` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reponse`
--

INSERT INTO `reponse` (`id`, `question_id`, `reponse`, `indice_reponse`) VALUES
(1, 1, 'La Bolivie', 0),
(2, 1, 'La Colombie ', 0),
(3, 1, 'Le Mexique ', 0),
(4, 1, 'Le Pérou', 1),
(5, 2, 'Le Petit Vingtième ', 1),
(6, 2, 'Pilote ', 0),
(7, 2, 'La Belle Belgique ', 0),
(8, 2, 'Le Matin de Bruxelles', 0),
(9, 3, 'Le San Salvador ', 0),
(10, 3, 'La Bolibanie ', 0),
(11, 3, 'La Bordurie ', 0),
(12, 3, 'Le San Theodoros', 1),
(13, 4, 'Hitler', 0),
(14, 4, 'Winston Churchill ', 0),
(15, 4, 'De Gaulle ', 1),
(16, 4, 'Staline', 0),
(17, 5, 'Rastatopoulos ', 1),
(18, 5, 'Le docteur Muller ', 0),
(19, 5, 'Le général Tapioca', 0),
(20, 5, 'Le Fakir', 0),
(21, 6, 'Les Bijoux de la Castafiore ', 0),
(22, 6, 'Le Sceptre d’Ottokar ', 1),
(23, 6, 'Tintin au Tibet ', 0),
(24, 6, 'Tintin et les Picaros', 0),
(25, 7, 'Triton ', 0),
(26, 7, 'Mortimer ', 0),
(27, 7, 'Ernest ', 0),
(28, 7, 'Tryphon', 1),
(29, 8, 'L’Affaire Tournesol', 1),
(30, 8, 'Coke en Stock ', 0),
(31, 8, 'Le Lotus Bleu ', 0),
(32, 8, 'Les Sept Boules de Cristal', 0),
(33, 9, 'Tintin au Congo ', 0),
(34, 9, 'Les Cigares du pharaon ', 0),
(35, 9, 'Le Secret de La Licorne', 0),
(36, 9, 'intin au Pays des Soviets ', 1),
(37, 10, 'Un fox-terrier ', 1),
(38, 10, 'Un yorkshire-terrier', 0),
(39, 10, 'Un bichon maltais ', 0),
(40, 10, 'Un caniche', 0),
(41, 11, 'Nicolas Dupont-Aignan', 0),
(42, 11, 'Emmanuel Macron', 1),
(43, 11, 'François Fillon', 0),
(44, 11, 'Benoît Hamon', 0),
(45, 12, 'Nicolas Dupont-Aignan', 1),
(46, 12, 'François Fillon', 0),
(47, 12, 'Benoît Hamon', 0),
(48, 12, 'Emmanuel Macron', 0),
(49, 13, 'Nathalie Arthaud', 0),
(50, 13, 'Qui a dit « Le vrai serial killer du pouvoir d’achat, c’est Marine Le Pen avec la sortie de l’euro, une inflation galopante » ?Nicolas Dupont-Aignan', 0),
(51, 13, 'Nicolas Dupont-Aignan', 0),
(52, 13, 'Benoît Hamon', 1),
(53, 14, 'François Fillon', 1),
(54, 14, 'Jean-Luc Mélenchon', 0),
(55, 14, 'Philippe Poutou', 0),
(56, 14, 'Jacques Cheminade', 0),
(57, 15, 'Philippe Poutou', 0),
(58, 15, 'Jean-Luc Mélenchon', 0),
(59, 15, 'Emmanuel Macron', 0),
(60, 15, 'Nathalie Arthaud', 1),
(61, 16, 'François Asselineau', 1),
(62, 16, 'Jean Lassalle', 0),
(63, 16, 'Marine Le Pen', 0),
(64, 16, 'Philippe Poutou', 0),
(65, 17, 'Jean Lassalle', 0),
(66, 17, 'Marine Le Pen', 0),
(67, 17, 'Emmanuel Macron', 1),
(68, 17, 'Jean-Luc Mélenchon', 0),
(69, 18, 'Nicolas Dupont-Aignan', 0),
(70, 18, 'Philippe Poutou', 1),
(71, 18, 'Jean-Luc Mélenchon', 0),
(72, 18, 'Nathalie Arthaud', 0),
(73, 19, 'François Asselineau', 0),
(74, 19, 'Jacques Cheminade', 0),
(75, 19, 'Nicolas Dupont-Aignan', 0),
(76, 19, 'Jean Lassalle', 1),
(77, 20, 'Marine Le Pen', 0),
(78, 20, 'François Asselineau', 1),
(79, 20, 'François Fillon', 0),
(80, 20, 'Benoît Hamon', 0),
(81, 21, 'Georges Pompidou', 0),
(82, 21, 'François Mitterrand', 1),
(83, 21, 'Charles de Gaulle', 0),
(84, 21, 'Jacques Chirac', 0),
(85, 22, 'Nicolas de Staël', 0),
(86, 22, 'Henri Matisse', 0),
(87, 22, 'Paul Gauguin', 0),
(88, 22, 'André Derain', 1),
(89, 23, 'À quel mouvement artistique appartenaient Rembrandt, Vermeer,  Velázquez ou Rubens ?', 1),
(90, 23, 'Le rococo', 0),
(91, 23, 'Le pop art', 0),
(92, 23, 'Le symbolisme', 0),
(93, 24, 'Pierre Bonnard', 0),
(94, 24, 'Rembrandt', 0),
(95, 24, 'Eugène Delacroix', 1),
(96, 24, 'Jacques-Louis David', 0),
(97, 25, 'Raoul Dufy', 1),
(98, 25, 'André Derain', 0),
(99, 25, 'Pablo Picasso', 0),
(100, 25, 'Albert Marquet', 0),
(101, 26, 'Peter Harrison', 0),
(102, 26, 'David Rockwell', 0),
(103, 26, 'Steven Holl', 1),
(104, 26, 'David Childs', 0),
(105, 27, 'Paul Cézanne', 0),
(106, 27, 'Claude Monet', 0),
(107, 27, 'Pablo Picasso', 0),
(108, 27, 'Vincent Van Gogh', 1),
(109, 28, 'Delacroix', 0),
(110, 28, 'David', 0),
(111, 28, 'Goya', 1),
(112, 28, 'El Gréco', 0),
(113, 29, 'Berlin', 0),
(114, 29, 'Bilbao', 1),
(115, 29, 'Londres', 0),
(116, 29, 'Paris', 0),
(117, 30, 'Rembrandt', 0),
(118, 30, 'Vermeer', 1),
(119, 30, 'Bruegel l\'Ancien', 0),
(120, 30, 'Sisley', 0),
(121, 31, 'Bowser', 1),
(122, 31, 'Wario', 0),
(123, 31, 'Yoshi', 0),
(124, 31, 'Waluigi', 0),
(125, 32, 'Sasquatch', 0),
(126, 32, 'L’Almasty', 0),
(127, 32, 'Yowie', 0),
(128, 32, 'BigFoot', 1),
(129, 33, 'John', 0),
(130, 33, 'Jerry', 1),
(131, 33, 'James', 0),
(132, 33, 'Jonas', 0),
(133, 34, 'Rastapopoulos', 1),
(134, 34, 'Le Général Alcazar', 0),
(135, 34, 'Le docteur Müller', 0),
(136, 34, 'Le colonel Sponsz', 0),
(137, 35, 'Jason Bourne', 0),
(138, 35, 'Jason Voorhees', 1),
(139, 35, 'Jason Donovan', 0),
(140, 35, 'Jason White', 0),
(141, 36, 'Cat’s Eyes', 0),
(142, 36, 'Nicky Larson', 0),
(143, 36, 'Dragon Ball Z', 0),
(144, 36, 'Les Tortues Ninja', 1),
(145, 37, 'Auric Goldfinger', 0),
(146, 37, 'Requin', 1),
(147, 37, 'Julius No', 0),
(148, 37, 'Renard', 0),
(149, 38, 'Maître Obiwan Kenobi', 0),
(150, 38, 'Luke Skywalker', 0),
(151, 38, 'Anakin Skywalker', 1),
(152, 38, 'Comte Dooku', 0),
(153, 39, 'Iron Man', 0),
(154, 39, 'Batman', 0),
(155, 39, 'Superman', 1),
(156, 39, 'Spiderman', 0),
(157, 40, 'Sara Sidle', 0),
(158, 40, 'Samantha Spade', 0),
(159, 40, 'Olivia Benson', 0),
(160, 40, 'Clarice Starling', 1),
(161, 41, '1950', 0),
(162, 41, '1968', 0),
(163, 41, '1976', 1),
(164, 41, '1988', 0),
(165, 42, 'Le Vieux Fusil', 1),
(166, 42, 'Le Dernier Métro', 0),
(167, 42, 'Nous irons tous au paradis', 0),
(168, 42, 'Que la fête commence', 0),
(169, 43, 'Au revoir les enfants', 0),
(170, 43, 'Le Fabuleux destin d’Amélie Poulain', 0),
(171, 43, 'Le Pianiste', 0),
(172, 43, 'Le Dernier Métro', 1),
(173, 44, 'Jean Gabin', 1),
(174, 44, 'Lino Ventura', 0),
(175, 44, 'Alain Delon', 0),
(176, 44, 'Yves Montand', 0),
(177, 45, 'Catherine Deneuve', 0),
(178, 45, 'Simone Signoret', 0),
(179, 45, 'Fanny Ardant', 1),
(180, 45, 'Emmanuelle Béart', 0),
(181, 46, 'L\'Aile ou la Cuisse', 0),
(182, 46, 'Inspecteur la Bavure', 0),
(183, 46, 'Tchao Pantin', 1),
(184, 46, 'Banzaï', 0),
(185, 47, 'Isabelle Adjani', 1),
(186, 47, 'Carole Bouquet', 0),
(187, 47, 'Sophie Marceau', 0),
(188, 47, 'Brigitte Bardot', 0),
(189, 48, 'Jane Birkin', 0),
(190, 48, 'Annie Girardot', 0),
(191, 48, 'Juliette Binoche', 0),
(192, 48, 'Vanessa Paradis', 1),
(193, 49, 'Gad Elmaleh', 0),
(194, 49, 'Mathieu Amalric', 0),
(195, 49, 'Jacques Gamblin', 0),
(196, 49, 'Jamel Debbouze', 1),
(197, 50, 'Ma Saison préférée', 0),
(198, 50, 'Place Vendôme', 0),
(199, 50, 'Indochine', 1),
(200, 50, 'Fort Saganne', 0),
(201, 51, 'Le girofle', 1),
(202, 51, 'L’anis', 0),
(203, 51, 'La baie de genièvre', 0),
(204, 51, 'La ciboulette', 0),
(205, 52, 'La Turquie', 0),
(206, 52, 'L’Inde', 1),
(207, 52, 'L’Afrique du Sud', 0),
(208, 52, 'L’Indonésie', 0),
(209, 53, 'La Chine', 0),
(210, 53, 'L’Inde', 0),
(211, 53, 'Le Japon', 1),
(212, 53, 'La Thaïlande', 0),
(213, 54, 'L’ail', 0),
(214, 54, 'Le basilic', 0),
(215, 54, 'La mélisse', 0),
(216, 54, 'Le gingembre', 1),
(217, 55, 'Le raifort', 1),
(218, 55, 'Le céleri', 0),
(219, 55, 'La livèche', 0),
(220, 55, 'Le serpolet', 0),
(221, 56, 'La réglisse', 1),
(222, 56, 'La marjolaine', 0),
(223, 56, 'La verveine', 0),
(224, 56, 'La bourrache', 0),
(225, 57, 'Une racine', 0),
(226, 57, 'Un fruit', 1),
(227, 57, 'Une graine', 0),
(228, 57, 'Un bulbe', 0),
(229, 58, 'Le myrte', 0),
(230, 58, 'L’origan', 0),
(231, 58, 'La coriandre', 1),
(232, 58, 'La sauge', 0),
(233, 59, 'Le curcuma', 0),
(234, 59, 'Le pavot', 0),
(235, 59, 'Le sésame', 0),
(236, 59, 'Le thym', 1),
(237, 60, 'Du Brésil', 0),
(238, 60, 'Du Mexique', 0),
(239, 60, 'De Thaïlande', 0),
(240, 60, 'Du Japon', 1),
(241, 61, '6', 1),
(242, 61, '9', 0),
(243, 61, '12', 0),
(244, 61, '18', 0),
(245, 62, 'Landes', 1),
(246, 62, 'Mayenne', 0),
(247, 62, 'Gironde', 0),
(248, 62, 'Ardèche', 0),
(249, 63, 'Mon oncle', 1),
(250, 63, 'Mon frère', 0),
(251, 63, 'Mon neveu', 0),
(252, 63, 'Mon grand-père', 0),
(253, 64, '12', 0),
(254, 64, '40', 1),
(255, 64, '1000', 0),
(256, 64, '10000', 0),
(257, 65, 'Lapereau', 1),
(258, 65, 'Ruisseau', 0),
(259, 65, 'Crapeau', 0),
(260, 65, 'Manteau', 0),
(261, 66, '13', 1),
(262, 66, '25', 0),
(263, 66, '32', 0),
(264, 66, '33', 0),
(265, 67, '1', 0),
(266, 67, '10', 1),
(267, 67, '12', 0),
(268, 67, '100', 0),
(269, 68, 'Gai', 0),
(270, 68, 'Bouleversé', 0),
(271, 68, 'Désolé', 0),
(272, 68, 'Navré', 1),
(273, 69, '28', 1),
(274, 69, '29', 0),
(275, 69, '30', 0),
(276, 69, '31', 0),
(277, 70, '1 an', 0),
(278, 70, '1 an et demi', 1),
(279, 70, '2 ans ', 0),
(280, 70, '3 ans ', 0),
(281, 71, 'Des végétaux', 0),
(282, 71, 'Des animaux', 1),
(283, 71, 'Des aliments', 0),
(284, 71, 'Des objets fétiches', 0),
(285, 72, 'Cochon', 0),
(286, 72, 'Dragon', 0),
(287, 72, 'Singe', 1),
(288, 72, 'Chèvre', 0),
(289, 73, 'Gengis Khan', 0),
(290, 73, 'Lao Tseu', 0),
(291, 73, 'L’Empereur de Jade', 1),
(292, 73, 'Le Dalaï-Lama', 0),
(293, 74, 'Le Bœuf', 0),
(294, 74, 'Le Rat', 1),
(295, 74, 'Le Lièvre', 0),
(296, 74, 'Le Cheval', 0),
(297, 75, 'Le Cochon', 1),
(298, 75, 'La Chèvre', 0),
(299, 75, 'Le Serpent', 0),
(300, 75, 'Le Dragon', 0),
(301, 76, '10', 1),
(302, 76, '12', 0),
(303, 76, '18', 0),
(304, 76, '24', 0),
(305, 77, 'Zèbre', 0),
(306, 77, 'Chouette', 0),
(307, 77, 'Lièvre', 1),
(308, 77, 'Lion', 0),
(309, 78, 'Air', 1),
(310, 78, 'Eau', 0),
(311, 78, 'Bois', 0),
(312, 78, 'Terre', 0),
(313, 79, 'Le Dragon', 0),
(314, 79, 'Le Tigre ', 0),
(315, 79, 'Le Serpent', 1),
(316, 79, 'Le Rat', 0),
(317, 80, 'Sur le Soleil', 0),
(318, 80, 'Sur la Lune', 1),
(319, 80, 'Sur Vénus', 0),
(320, 80, 'Sur Chiron', 0),
(321, 81, 'Michel Denisot', 1),
(322, 81, 'Patrick Poivre d’Arvor', 0),
(323, 81, 'Pierre Lescure', 0),
(324, 81, 'Jean-Marie Cavada', 0),
(325, 82, 'The Los Angeles Times', 0),
(326, 82, 'USA Today', 0),
(327, 82, 'The New York Post ', 0),
(328, 82, 'The Washington Post', 1),
(329, 83, 'Charlie Hebdo ', 1),
(330, 83, 'Le Canard Enchaîné', 0),
(331, 83, 'Siné Hebdo', 0),
(332, 83, 'Hara Kiri', 0),
(333, 84, 'L’Humanité', 0),
(334, 84, 'La Croix', 0),
(335, 84, 'Le Figaro', 1),
(336, 84, 'Le Monde', 0),
(337, 85, 'USA Today', 0),
(338, 85, 'The Wall Street Journal', 1),
(339, 85, 'The New York Times', 0),
(340, 85, 'The Daily News', 0),
(341, 86, ' Le Point', 0),
(342, 86, 'L’Express  ', 1),
(343, 86, 'Le Nouvel Obs', 0),
(344, 86, 'Marianne', 0),
(345, 87, 'Salut les Copains', 0),
(346, 87, 'Hara-Kiri', 0),
(347, 87, 'Lui', 1),
(348, 87, 'Têtu', 0),
(349, 88, 'The Daily Mirror', 0),
(350, 88, 'The People', 0),
(351, 88, 'The Sun', 1),
(352, 88, 'The Times', 0),
(353, 89, 'Time ', 0),
(354, 89, 'Elle', 0),
(355, 89, 'Vanity Fair US', 0),
(356, 89, 'Vogue', 1),
(357, 90, 'Jean-François Khan', 1),
(358, 90, 'Christophe Barbier', 0),
(359, 90, 'Edwy Plenel', 0),
(360, 90, 'Michel Field', 0),
(361, 91, 'Libanais', 0),
(362, 91, 'Lybien', 0),
(363, 91, 'Syrien', 1),
(364, 91, 'Jordanien', 0),
(365, 92, 'Ricardo Bofill', 0),
(366, 92, 'Juan de Villanueva', 0),
(367, 92, 'Antoni Gaudi', 1),
(368, 92, 'Eloy Celaya', 0),
(369, 93, 'Celer', 0),
(370, 93, 'Apollodore de Damas', 1),
(371, 93, 'Hygin le Gromatique', 0),
(372, 93, 'Vitruve', 0),
(373, 94, 'Lucio Costa', 0),
(374, 94, 'Hiroshi Hara', 0),
(375, 94, 'Alvar Aalto', 0),
(376, 94, 'Oscar Niemeyer', 1),
(377, 95, 'Djéser', 1),
(378, 95, 'Thoutmôsis', 0),
(379, 95, 'Numerobis', 0),
(380, 95, 'Amonbofis', 0),
(381, 96, ' Avec qui Jean-Baptiste Rondelet a-t-il dessiné les plans du Panthéon ?', 0),
(382, 96, 'Joseph Garnier', 0),
(383, 96, 'Blaise Pagan', 0),
(384, 96, 'Jacques-Germain Soufflot', 1),
(385, 97, 'Le ministère de l\'Éducation nationale', 0),
(386, 97, 'Le musée des arts naïfs', 0),
(387, 97, 'La Bourse', 1),
(388, 97, 'L\'Assemblée nationale', 0),
(389, 98, 'Ictinos', 0),
(390, 98, 'Pythéos de Priène', 0),
(391, 98, 'Sostrate de Cnide', 1),
(392, 98, 'Celer', 0),
(393, 99, 'Jean Nouvel', 1),
(394, 99, 'Gaspard André', 0),
(395, 99, 'Fernand Pouillon', 0),
(396, 99, 'Victor Louis', 0),
(397, 100, 'Jean-François-Thérèse Chalgrin', 1),
(398, 100, 'Jules Hardouin-Mansart', 0),
(399, 100, 'Victor Baltard', 0),
(400, 100, 'Alexandre Théodore Brongniart', 0),
(401, 101, 'Akira Kurosawa', 0),
(402, 101, 'Alejandro González Inárritu', 0),
(403, 101, 'Clint Eastwood', 0),
(404, 101, 'Stanley Kubrick', 1),
(405, 102, 'Martin Scorsese', 0),
(406, 102, 'Peter Jackson', 1),
(407, 102, 'Ridley Scott', 0),
(408, 102, 'David Carpenter', 0),
(409, 103, 'Costa-Gavras', 0),
(410, 103, 'Roman Polanski', 0),
(411, 103, 'Milos Forman', 1),
(412, 103, 'Elia Kazan', 0),
(413, 104, 'Martin Scorsese', 1),
(414, 104, 'Steven Spielberg', 0),
(415, 104, 'Francis Ford Coppola', 0),
(416, 104, 'Guillermo Del Toro', 0),
(417, 105, 'Jean-Jacques Beineix', 0),
(418, 105, 'Guy Ritchie', 1),
(419, 105, 'Woody Allen', 0),
(420, 105, 'Woody Allen', 0),
(421, 106, 'Alfred Hitchcock', 1),
(422, 106, 'Anthony Minghella', 0),
(423, 106, 'Arthur Penn', 0),
(424, 106, 'Barry Levinson', 0),
(425, 107, 'Vincent Cassel', 0),
(426, 107, 'Jean-Pierre Mocky', 0),
(427, 107, 'Laurent Baffie', 0),
(428, 107, 'Mathieu Kassovitz', 1),
(429, 108, 'Jon Turteltaub', 1),
(430, 108, 'Ron Howard', 0),
(431, 108, 'Baz Luhrmann', 0),
(432, 108, 'John Malkovich', 0),
(433, 109, 'Ken Loach', 0),
(434, 109, 'Manuel Poirier', 0),
(435, 109, 'Luc Besson', 1),
(436, 109, 'Olivier Assayas', 0),
(437, 110, 'Mike Newell', 1),
(438, 110, 'Mike Leigh', 0),
(439, 110, 'Neil Jordan', 0),
(440, 110, 'Oliver Stone', 0),
(441, 111, 'Le brownie', 0),
(442, 111, 'Le brownie', 0),
(443, 111, 'Le brownie', 0),
(444, 111, 'La tarte à la mélasse', 1),
(445, 112, 'Red Hot Chili Pepers', 0),
(446, 112, 'Arctic Monkeys', 1),
(447, 112, 'The Libertines', 0),
(448, 112, 'The Kills', 0),
(449, 113, 'Calogero', 0),
(450, 113, 'Jacques Brel', 1),
(451, 113, 'Bobby Lapointe', 0),
(452, 113, 'Francis Cabrel', 0),
(453, 114, 'Le champignon coco-chocolat', 0),
(454, 114, 'Le cupcake à la framboise', 0),
(455, 114, 'Le cake aux mûres', 0),
(456, 114, 'La tarte à la salsepareille', 1),
(457, 115, 'Yves Montand', 0),
(458, 115, 'Jean-Paul Belmondo', 0),
(459, 115, 'Serge Lama', 0),
(460, 115, 'Alain Delon', 1),
(461, 116, 'Richard Gotainer', 1),
(462, 116, 'Dorothée', 0),
(463, 116, 'Carlos', 0),
(464, 116, 'Chantal Goya', 0),
(465, 117, 'Juliette', 0),
(466, 117, 'Olivia Ruiz', 1),
(467, 117, 'Annie Cordy', 0),
(468, 117, 'Lio', 0),
(469, 118, 'Roald Dahl', 1),
(470, 118, 'J.K. Rowling', 0),
(471, 118, 'TR Tolkien', 0),
(472, 118, 'Daniel Pennac', 0),
(473, 119, 'Un caramel', 0),
(474, 119, 'Un bonbon', 1),
(475, 119, 'Un chocolat', 0),
(476, 119, 'Un gâteau', 0),
(477, 120, 'Sabine Azéma', 0),
(478, 120, 'Josiane Balasko', 0),
(479, 120, 'Juliette Binoche', 1),
(480, 120, 'Isabelle Huppert', 0),
(481, 121, ' Sur quoi repose la théorie philosophique de l\'hédonisme ?', 1),
(482, 121, 'Le rejet de toute forme de doute', 0),
(483, 121, 'Les fondements de la morale', 0),
(484, 121, 'L\'affirmation de l\'existence de Dieu', 0),
(485, 122, 'Bergson', 0),
(486, 122, 'Socrate', 1),
(487, 122, 'Montaigne', 0),
(488, 122, 'Platon', 0),
(489, 123, 'Hobbes', 0),
(490, 123, 'Voltaire', 0),
(491, 123, 'Machiavel', 0),
(492, 123, 'Aristote', 1),
(493, 124, 'Avicenne', 1),
(494, 124, 'Épicure', 0),
(495, 124, 'Voltaire', 0),
(496, 124, 'Heidegger', 0),
(497, 125, 'XVe', 0),
(498, 125, 'XVIe', 0),
(499, 125, 'XVIIe', 0),
(500, 125, 'XVIIIe', 1),
(501, 126, 'Martin', 0),
(502, 126, 'Jean-Jacques', 0),
(503, 126, 'Arthur', 1),
(504, 126, 'Émile', 0),
(505, 127, 'Kierkegaard', 0),
(506, 127, 'Pascal', 0),
(507, 127, 'Kant', 0),
(508, 127, 'Nietzsche', 1),
(509, 128, 'Pascal', 1),
(510, 128, 'Descartes', 0),
(511, 128, 'Montaigne', 0),
(512, 128, 'Bergson', 0),
(513, 129, 'Épicure', 0),
(514, 129, 'Machiavel', 0),
(515, 129, 'Platon', 1),
(516, 129, 'Cicéron', 0),
(517, 130, 'François-Marie Arouet', 1),
(518, 130, 'Eugène Grindele', 0),
(519, 130, 'Michel Eyquem', 0),
(520, 130, 'Henri Beyle', 0),
(521, 131, 'La divination par les miroirs', 0),
(522, 131, 'La lecture des lignes de la main', 1),
(523, 131, 'La divination par les pépins de pommes', 0),
(524, 131, 'L\'interprétation des rêves', 0),
(525, 132, 'Le Pendu', 0),
(526, 132, 'Le Pape', 0),
(527, 132, 'L\'Arcane sans nom', 0),
(528, 132, 'Le Mat', 1),
(529, 133, 'En tirant successivement quatre lames', 1),
(530, 133, 'En portant une croix autour du cou', 0),
(531, 133, 'En alignant 8 cartes en forme de croix', 0),
(532, 133, 'En priant avant le tirage', 0),
(533, 134, 'La géomancie et la numérologie', 0),
(534, 134, 'La cartomancie et la numérologie', 0),
(535, 134, 'La numérologie et les arts divinatoires chinois', 1),
(536, 134, 'La tarologie et les arts divinatoires égyptiens', 0),
(537, 135, 'C’est le résultat donné à la fin d’une consultation', 0),
(538, 135, 'C’est l’art de recevoir des messages d\'une entité par écrit', 1),
(539, 135, 'C’est l’ensemble des conseils donnés par le voyant', 0),
(540, 135, 'C’est la voyance par mail', 0),
(541, 136, '10', 0),
(542, 136, '22', 0),
(543, 136, '56', 1),
(544, 136, '80', 0),
(545, 137, 'lit l’avenir dans une boule de cristal', 0),
(546, 137, 'utilise les cartes pour lire le futur', 1),
(547, 137, 'interprète l’avenir dans le marc de café', 0),
(548, 137, 'fait des consultations en cabinet', 0),
(549, 138, '8', 0),
(550, 138, '9', 0),
(551, 138, '12', 1),
(552, 138, '16', 0),
(553, 139, 'Comment se calcule le chemin de vie ?', 1),
(554, 139, 'en additionnant quatre nombres que l’on choisit au hasard', 0),
(555, 139, 'en additionnant les chiffres qui composent une date qui nous a marquée', 0),
(556, 139, 'en additionnant les chiffres qui composent une date qui nous a marquée', 0),
(557, 140, 'Le but du Yi King c’est de trouver l’hexagramme qui répondra à votre question. Ainsi, on utilise en général :', 0),
(558, 140, '2 tiges de fleurs et une pierre', 0),
(559, 140, '2 tiges de fleurs et une pierre', 1),
(560, 140, 'Un pendule et une planche', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reponsehistorique`
--

CREATE TABLE `reponsehistorique` (
  `id` int NOT NULL,
  `historique_id` int NOT NULL,
  `reponse` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reponsehistorique`
--

INSERT INTO `reponsehistorique` (`id`, `historique_id`, `reponse`) VALUES
(9, 9, 'null'),
(10, 10, '{\"1\": {\"corect\": \"Le Pérou\", \"repUser\": \"La Bolivie\", \"question\": \"Dans quel pays se passent les aventures de Tintin et le Temple du Soleil ?\", \"index_ques\": 1, \"result_repUser\": 0}, \"2\": {\"corect\": \"Le Petit Vingtième \", \"repUser\": \"Le Petit Vingtième \", \"question\": \"Dans quel journal travaille Tintin ?\", \"index_ques\": 2, \"result_repUser\": 1}, \"3\": {\"corect\": \"Le San Theodoros\", \"repUser\": \"Le San Salvador \", \"question\": \"Quel est le pays du général Alcazar ?\", \"index_ques\": 3, \"result_repUser\": 0}, \"4\": {\"corect\": \"De Gaulle \", \"repUser\": \"Winston Churchill \", \"question\": \"Quel homme politique a dit que « Tintin était son rival international » ?  \", \"index_ques\": 4, \"result_repUser\": 0}, \"5\": {\"corect\": \"Rastatopoulos \", \"repUser\": \"Rastatopoulos \", \"question\": \"Quel ennemi de Tintin a été capturé par des extra-terrestres à la fin de l’album Vol 714 pour Sydney ?\", \"index_ques\": 5, \"result_repUser\": 1}, \"6\": {\"corect\": \"Le Sceptre d’Ottokar \", \"repUser\": \"Les Bijoux de la Castafiore \", \"question\": \" Dans quelle aventure, Tintin est-il décoré chevalier de l’ordre du Pélican d’Or ?\", \"index_ques\": 6, \"result_repUser\": 0}, \"7\": {\"corect\": \"Tryphon\", \"repUser\": \"Ernest \", \"question\": \"Quel est le prénom du Professeur Tournesol ?\", \"index_ques\": 7, \"result_repUser\": 0}, \"8\": {\"corect\": \"L’Affaire Tournesol\", \"repUser\": \"L’Affaire Tournesol\", \"question\": \"Dans quelle aventure Tintin doit-il empêcher la Syldavie et la Bordurie de s’emparer d’une arme très destructrice ?\", \"index_ques\": 8, \"result_repUser\": 1}, \"9\": {\"corect\": \"intin au Pays des Soviets \", \"repUser\": \"Tintin au Congo \", \"question\": \"Les Sept Boules de Cristal\", \"index_ques\": 9, \"result_repUser\": 0}, \"10\": {\"corect\": \"Un fox-terrier \", \"repUser\": \"Un yorkshire-terrier\", \"question\": \"Quelle race de chiens est Milou ?\", \"index_ques\": 10, \"result_repUser\": 0}}'),
(11, 11, '{\"1\": {\"corect\": \"Le Pérou\", \"repUser\": \"La Bolivie\", \"question\": \"Dans quel pays se passent les aventures de Tintin et le Temple du Soleil ?\", \"index_ques\": 1, \"result_repUser\": 0}, \"2\": {\"corect\": \"Le Petit Vingtième \", \"repUser\": \"Le Matin de Bruxelles\", \"question\": \"Dans quel journal travaille Tintin ?\", \"index_ques\": 2, \"result_repUser\": 0}, \"3\": {\"corect\": \"Le San Theodoros\", \"repUser\": \"La Bolibanie \", \"question\": \"Quel est le pays du général Alcazar ?\", \"index_ques\": 3, \"result_repUser\": 0}, \"4\": {\"corect\": \"De Gaulle \", \"repUser\": \"Hitler\", \"question\": \"Quel homme politique a dit que « Tintin était son rival international » ?  \", \"index_ques\": 4, \"result_repUser\": 0}, \"5\": {\"corect\": \"Rastatopoulos \", \"repUser\": \"Rastatopoulos \", \"question\": \"Quel ennemi de Tintin a été capturé par des extra-terrestres à la fin de l’album Vol 714 pour Sydney ?\", \"index_ques\": 5, \"result_repUser\": 1}, \"6\": {\"corect\": \"Le Sceptre d’Ottokar \", \"repUser\": \"Tintin au Tibet \", \"question\": \" Dans quelle aventure, Tintin est-il décoré chevalier de l’ordre du Pélican d’Or ?\", \"index_ques\": 6, \"result_repUser\": 0}, \"7\": {\"corect\": \"Tryphon\", \"repUser\": \"Ernest \", \"question\": \"Quel est le prénom du Professeur Tournesol ?\", \"index_ques\": 7, \"result_repUser\": 0}, \"8\": {\"corect\": \"L’Affaire Tournesol\", \"repUser\": \"L’Affaire Tournesol\", \"question\": \"Dans quelle aventure Tintin doit-il empêcher la Syldavie et la Bordurie de s’emparer d’une arme très destructrice ?\", \"index_ques\": 8, \"result_repUser\": 1}, \"9\": {\"corect\": \"intin au Pays des Soviets \", \"repUser\": \"intin au Pays des Soviets \", \"question\": \"Les Sept Boules de Cristal\", \"index_ques\": 9, \"result_repUser\": 1}, \"10\": {\"corect\": \"Un fox-terrier \", \"repUser\": \"Un bichon maltais \", \"question\": \"Quelle race de chiens est Milou ?\", \"index_ques\": 10, \"result_repUser\": 0}}');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_at` datetime NOT NULL,
  `create_at` datetime NOT NULL,
  `lastconnect` datetime NOT NULL,
  `activation_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `lastname`, `firstname`, `update_at`, `create_at`, `lastconnect`, `activation_token`, `reset_token`) VALUES
(1, 'petubrt@gmail.com', '{\"2\": \"ROLE_USER\"}', '$2y$13$Io6d9l9NHAEjjcXUfCX0GOV6CQxq4D9a3ILCsWde.nqb51W8Pfk5C', '89mohamadi', 'msa', 'mohamadi', '2021-05-12 16:25:52', '2021-05-12 15:37:49', '2021-05-12 15:37:49', NULL, NULL),
(2, 'tnifasshouda@gmail.com', '[]', '$2y$13$kOg7alkb0rZPFP8gVGeqluGfTr8QzZg3I0cZth9yDRd3HT14hucOi', '2houda', 'tnifass', 'houda', '2021-05-16 19:22:01', '2021-05-16 19:22:01', '2021-05-16 19:22:01', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EDBFD5EC67B3B43D` (`users_id`),
  ADD KEY `IDX_EDBFD5ECBA934BCD` (`quizz_id`),
  ADD KEY `IDX_EDBFD5ECA21214B7` (`categories_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6F7494EBA934BCD` (`quizz_id`);

--
-- Indexes for table `quizz`
--
ALTER TABLE `quizz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7C77973DA21214B7` (`categories_id`);

--
-- Indexes for table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5FB6DEC71E27F6BF` (`question_id`);

--
-- Indexes for table `reponsehistorique`
--
ALTER TABLE `reponsehistorique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6E1D1CE16128735E` (`historique_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D64986CC499D` (`pseudo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `historique`
--
ALTER TABLE `historique`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `quizz`
--
ALTER TABLE `quizz`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=561;

--
-- AUTO_INCREMENT for table `reponsehistorique`
--
ALTER TABLE `reponsehistorique`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `FK_EDBFD5EC67B3B43D` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_EDBFD5ECA21214B7` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_EDBFD5ECBA934BCD` FOREIGN KEY (`quizz_id`) REFERENCES `quizz` (`id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494EBA934BCD` FOREIGN KEY (`quizz_id`) REFERENCES `quizz` (`id`);

--
-- Constraints for table `quizz`
--
ALTER TABLE `quizz`
  ADD CONSTRAINT `FK_7C77973DA21214B7` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_5FB6DEC71E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Constraints for table `reponsehistorique`
--
ALTER TABLE `reponsehistorique`
  ADD CONSTRAINT `FK_6E1D1CE16128735E` FOREIGN KEY (`historique_id`) REFERENCES `historique` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
