-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 14 fév. 2024 à 16:50
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_cinema`
--

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `id_film` int(11) NOT NULL,
  `titre` text NOT NULL,
  `duree` int(11) NOT NULL,
  `resume` text NOT NULL,
  `date_sortie` date NOT NULL,
  `pays` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`id_film`, `titre`, `duree`, `resume`, `date_sortie`, `pays`, `image`) VALUES
(1, 'Extinction', 95, 'Un père hanté par l\'idée de perdre sa famille voit son pire cauchemar se réaliser quand une puissance destructrice venue d\'une autre planète débarque sur Terre. Alors qu\'il lutte pour leur survie, il se découvre une force inconnue pour protéger sa famille du danger.', '2018-07-27', 'Etats-Unis', 'https://placehold.co/200x200'),
(2, 'Carter', 132, 'Un agent de renseignement se réveille avec une amnésie totale, ignorant jusqu\'à son nom. Il est cependant pris dans une course entre des agences de renseignement de trois pays (États-Unis, Corée du Nord, et Corée du Sud) sans savoir à laquelle il appartient. Les trois veulent mettre un terme à une épidémie et ont besoin de la fille du scientifique pouvant trouver le remède à cette épidémie. Grâce à des implants dans sa tête et son oreille, Carter est dirigé par la voix d\'une agente nord-coréenne pour ramener la fille du scientifique en Corée du Nord, et échapper non seulement aux agents de la CIA, mais aussi à une faction de rebelles nord-coréens.', '2022-08-05', 'Corée du Sud', 'https://placehold.co/200x200?text=Carter'),
(3, 'Alive', 98, 'Joon-woo (Yoo Ah-in) passe ses journées à faire des streaming de jeux vidéo en direct et à végéter dans son appartement. Un jour, d\'autres joueurs semblent paniquer et l\'exhortent à regarder la télévision. Joon-woo réalise alors qu\'un mystérieux virus se propage dans toute la Corée et voit, par sa fenêtre, des personnes en train de courir dans tous les sens et se dévorer. Il se barricade à l\'intérieur de son appartement puis accepte de laisser entrer un de ses voisins qui se révèle finalement infecté, et qu\'il réussit à expulser.', '2020-06-24', 'Corée du Sud', 'https://placehold.co/200x200?text=Alive'),
(4, 'L\'Ascension', 103, 'Samy Diakhaté est un jeune d\'origine sénégalaise de la Cité des 4000 à La Courneuve. Comme beaucoup de ses copains, il est au chômage mais veut s\'en sortir. Depuis le collège, il est amoureux de Nadia, employée du supermarché du quartier, d\'origine maghrébine. Il essaye de la séduire par sa gentillesse, mais celle-ci lui résiste, de peur de tomber sur un garçon frivole qui la décevrait et la ferait souffrir. Samy lui dit un jour que par amour pour elle, il serait prêt à gravir l’Everest, mais Nadia prend la phrase pour une boutade. Samy, bien décidé à épater Nadia pour la conquérir, se met à la recherche d\'un financement pour son voyage au Népal. Sans avoir ni expérience de l\'alpinisme ni même entraînement physique, il se jette dans l\'aventure mais s\'aperçoit vite de ses faiblesses et du défi colossal qu\'il doit affronter. Pendant ce temps, la nouvelle s\'est propagée en banlieue et à Paris comme une traînée de poudre : toute la banlieue, radio et presse en tête, est avec Samy pour l\'encourager et observer ses exploits heure par heure, pendant que ses parents se meurent d\'angoisse de perdre leur fils.', '2017-01-25', 'France', 'https://placehold.co/200x200?text=L%27ascension'),
(5, 'Beaux-parents', 84, 'Garance reçoit ses parents, en larmes. En effet, elle souhaite quitter son mari, Harold, car il l\'a « trompée » avec Chloé, la femme du meilleur ami d\'Harold. Mais ses parents, Coline et André, ne l\'entendent pas de cette oreille et continuent à voir leur gendre en cachette. Cependant, quand Garance découvre leur « double vie », les choses se compliquent.', '2019-06-19', 'France', 'https://placehold.co/200x200?text=Beaux-parents'),
(6, 'Pandora ', 136, 'Quand un séisme dévaste un village coréen où une centrale nucléaire est en activité malgré sa vétusté, un homme risque sa vie pour sauver le pays du désastre annoncé. ', '2016-12-07', 'Corée du Sud', 'https://placehold.co/200x200?text=Pandora'),
(7, 'Proxima ', 107, 'Sarah est une spationaute qui s\'entraîne avec acharnement au Centre spatial de Cologne, unique femme au milieu des astronautes européens. Elle vit seule avec sa fille de 8 ans, Stella, qu\'elle couve d\'un amour inquiet, se sentant coupable de ne pas pouvoir lui consacrer plus de temps. Quand Sarah est choisie pour partir à bord d\'une mission spatiale d\'un an, baptisée Proxima, sa vie et celle de Stella sont bouleversées.\r\n\r\nStella doit en effet déménager de Cologne à Darmstadt, pour aller vivre avec son père, dont Sarah est séparée. Sarah doit bientôt rejoindre la Cité des étoiles, en Russie, pour peaufiner son entraînement en compagnie de ses deux coéquipiers américain et russe.\r\n\r\nStella a un peu de mal à s\'habituer à sa vie à Darmstadt, et ses conversations téléphoniques avec sa mère se font plus tendues. Elle lui rend néanmoins visite, et Sarah lui promet qu\'elles iront, avant le décollage, voir ensemble la fusée.', '2019-11-27', 'France', 'https://placehold.co/200x200?text=Proxima'),
(8, 'La Colonie', 104, 'Devenue inhabitable, la Terre a été abandonnée par ses habitants les plus riches partis s\'installer sur la planète Kepler. Après deux générations passées là-bas, un mal ronge l\'humanité : les femmes et les hommes sont devenus infertiles, provoquant à terme la disparition de leur espèce. Une mission de la dernière chance est alors envoyée sur Terre.', '2021-08-26', 'Allemagne', 'https://placehold.co/200x200?text=La%20Colonie'),
(9, 'Ferrari, un mythe immortel', 95, 'Dans les années 1950, la compétition fait rage dans le sport automobile. Enzo Ferrari et ses pilotes prennent tous les risques, parfois jusqu\'au drame.', '2017-12-05', 'Royaume-Uni', 'https://placehold.co/200x200?text=Ferrari,%20un%20mythe%20immortel'),
(10, 'Forgotten', 109, 'Un homme est amnésique depuis son enlèvement et sa séquestration qui a duré dix-neuf jours : son jeune frère, très déterminé, recherche la raison de son enlèvement.', '2017-11-29', 'Corée du Sud', 'https://placehold.co/200x200?text=Forgotten'),
(11, 'Marie-Line et son juge', 103, 'Marie-Line, 25 ans, mène une vie précaire au Havre, où elle s\'occupe de son père dépressif. Dynamique et joyeuse, la jeune femme aux cheveux roses est serveuse dans un café-brasserie. Parmi les clients se trouvent Alexandre, un étudiant avec qui elle commence une idylle, et un juge bougon qui enchaîne les whiskies. Alexandre s\'éloigne d\'elle. Marie-Line le frappe et retrouve le juge au tribunal pour être jugée. Elle est condamnée à verser des dommages et intérêts et perd son emploi. Le juge, momentanément sans permis de conduire, propose à Marie-Line de devenir son chauffeur pendant un mois contre rémunération.', '2023-10-11', 'France', 'https://placehold.co/200x200?text=Marie-Line%20et%20son%20juge'),
(12, 'Un prince', 82, 'A l\'âge de 16 ans, Pierre-Joseph suit une formation pour devenir jardinier. Plusieurs événements seront déterminants dans son apprentissage et la découverte de la sexualité. Quarante ans plus tard, il rencontre Kutta, enfant adopté par la directrice de son école de formation. Devenu propriétaire d\'un château, Kutta semble rechercher un jardinier.', '2023-05-18', 'France', 'https://placehold.co/200x200?text=Un%20prince'),
(13, 'Surclassée', 104, 'Ana est une stagiaire ambitieuse qui rêve d\'une carrière dans le monde de l\'art tout en essayant d\'impressionner son exigeante patronne Claire. Lorsqu\'elle est surclassée en première classe lors d\'un voyage d\'affaires, elle rencontre le beau Will, qui confond Ana avec sa patronne - un mensonge blanc qui déclenche une chaîne d\'événements glamour, de romances et d\'opportunités, jusqu\'à ce que ses mensonges menacent de remonter à la surface.', '2024-02-09', 'États-Unis', 'https://placehold.co/200x200?text=Surclass%C3%A9e'),
(14, 'Le Règne animal', 128, 'Alors que le monde s\'est déjà habitué à une épidémie de mutations qui transforment les humains en animaux, François doit déménager dans le sud de la France pour se rapprocher de sa femme Lana, touchée par ce mal mystérieux et envoyée dans un centre spécialisé. Sur place, lui et son fils Émile doivent se réinventer dans un monde qui se peuple de créatures d\'un nouveau genre.', '2023-10-04', 'France', 'https://placehold.co/200x200?text=Le%20R%C3%A8gne%20animal'),
(15, 'The Moon', 129, 'En 2030, le projet de l\'exploration habitée sur la Lune a remarquablement progressé. L\'astronaute Hwang Seon-woo (Do Kyung-soo), s\'est piégé seul sur la Lune en plein espace au-delà de 384 000 km à la suite d\'un accident, et Kim Jae-gook (Sol Kyung-gu), ancien chef de la base spatiale, tente de le sauver1. La directrice générale de la NASA, Moon-yeong (Kim Hee-ae), cache un secret5…', '2023-08-02', 'Corée du Sud', 'https://placehold.co/200x200?text=The%20Moon'),
(16, 'The Underdoggs', 96, 'Jaycen Two Js Jennings est une ancienne star du football professionnel qui a touché le fond. Lorsqu\'il est condamné à des travaux d\'intérêt général comme entraîneur des Underdoggs, une équipe de football d\'enfants indisciplinés dans sa ville natale, il y voit une opportunité de reconstruire son image publique. Cependant, il pourrait bien changer sa vie et redécouvrir son amour du sport.', '2024-01-26', 'Etats-Unis', 'https://placehold.co/200x200?text=The%20Underdoggs'),
(17, 'La Fiancée du poète', 103, 'Amoureuse de peinture et de poésie, Mireille s\'accommode de son travail de serveuse à la cafétéria des Beaux-Arts de Charleville-Mézières tout en vivant de petits larcins et de trafic de cartouches de cigarettes.\r\n\r\nN\'ayant pas les moyens d\'entretenir la grande maison familiale des bords de Meuse dont elle hérite, Mireille décide d\'accueillir trois locataires : trois hommes qui vont bouleverser sa routine et la préparer, sans le savoir, au retour du quatrième, le poète, son grand amour de jeunesse.', '2023-10-11', 'France', 'https://placehold.co/200x200?text=La%20Fianc%C3%A9e%20du%20po%C3%A8te'),
(18, 'Le Procès Goldman', 115, 'En avril 1976, se tient le second procès de Pierre Goldman. En prison depuis six ans, il est soupçonné d\'avoir tué deux pharmaciennes lors d\'un vol à main armé en décembre 1969. Alors qu\'il a reconnu dès son arrestation en avril 1970 trois braquages sans envergure, commis un peu avant et après Noël 1969, il clame cependant son innocence pour le double meurtre perpétré à la même époque, au cours duquel un jeune gendarme courageux a tenté dans la nuit d\'arrêter le coupable en fuite.\r\n\r\nAprès la publication d\'un livre dans lequel il dénonce une série d\'erreurs dans l\'enquête ayant pesé sur le premier procès, il obtient l\'annulation du procès par la Cour de cassation et la tenue d\'un nouveau procès aux assises. Plusieurs passages de ce livre sont d\'ailleurs lus lors du second procès.', '2023-09-27', 'France', 'https://placehold.co/200x200?text=Le%20Proc%C3%A8s%20Goldman'),
(19, 'She Came to Me', 102, 'À New York, Katrina, une capitaine de remorqueur, a du mal à faire le deuil de son mariage. Dans un bar, elle fait la connaissance de Steven, un compositeur d\'opéra en panne d\'inspiration. Celui-ci est malheureux dans le couple qu\'il forme avec Patricia, une psychothérapeute souffrant de nombreux TOC.', '2024-02-07', 'États-Unis', 'https://placehold.co/200x200?text=She%20Came%20to%20Me'),
(20, 'Suncoast', 109, 'Une adolescente qui vit avec sa mère au caractère bien trempé doit emmener son frère dans un établissement spécialisé. Elle se lie d\'une amitié improbable avec un activiste excentrique lors des manifestations entourant un cas médical historique.', '2024-01-21', 'Etats-Unis', 'https://placehold.co/200x200?text=Suncoast');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
