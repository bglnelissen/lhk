-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 06, 2017 at 11:50 AM
-- Server version: 5.5.53-0+deb8u1
-- PHP Version: 7.0.14-2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lhk`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `session_id` varchar(40) NOT NULL,
  `answer` text NOT NULL,
  `correct` tinyint(4) NOT NULL,
  `question_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `session_id`, `answer`, `correct`, `question_id`, `timestamp`) VALUES
(1, 'ap40le3nvf5oe6ris15v72u6k0', 'Bekkenbodemoefeningen', 1, 1, '2017-01-30 20:44:21'),
(2, 'ap40le3nvf5oe6ris15v72u6k0', 'Blaastraining', 0, 1, '2017-01-30 20:44:21'),
(3, 'ap40le3nvf5oe6ris15v72u6k0', 'Oraal anticholinergicum voorschrijven', 0, 1, '2017-01-30 20:44:21'),
(4, 'ap40le3nvf5oe6ris15v72u6k0', 'Vaginale oestrogenen voorschrijven', 0, 1, '2017-01-30 20:44:21'),
(5, 'ap40le3nvf5oe6ris15v72u6k0', 'Een niet-zieke patiÃ«nt zonder afwijkingen bij lichamelijk onderzoek, die sinds 20 dagen hoest zonder koorts.', 0, 2, '2017-01-30 20:45:26'),
(6, 'ap40le3nvf5oe6ris15v72u6k0', 'Een matig zieke patiÃ«nt met eenzijdige auscultatoire afwijkingen bij lichamelijk onderzoek, die sinds 10 dagen hoest zonder koorts.', 1, 2, '2017-01-30 20:45:26'),
(7, 'ap40le3nvf5oe6ris15v72u6k0', 'Een ernstig zieke patiÃ«nt met auscultatoire afwijkingen en een tachypneu, die sinds 7 dagen hoest met koorts.', 0, 2, '2017-01-30 20:45:26'),
(8, 'ap40le3nvf5oe6ris15v72u6k0', 'Chlooramfenicol', 0, 3, '2017-01-30 20:46:13'),
(9, 'ap40le3nvf5oe6ris15v72u6k0', 'Fusidinezuur', 1, 3, '2017-01-30 20:46:13'),
(10, 'ap40le3nvf5oe6ris15v72u6k0', 'Tetracycline', 0, 3, '2017-01-30 20:46:13'),
(11, 'ap40le3nvf5oe6ris15v72u6k0', 'Chronische spanningshoofdpijn', 0, 4, '2017-01-30 20:47:16'),
(12, 'ap40le3nvf5oe6ris15v72u6k0', 'Clusterhoofdpijn', 0, 4, '2017-01-30 20:47:16'),
(13, 'ap40le3nvf5oe6ris15v72u6k0', 'Medicatieovergebruikshoofdpijn', 1, 4, '2017-01-30 20:47:16'),
(14, 'ap40le3nvf5oe6ris15v72u6k0', 'Migraine', 0, 4, '2017-01-30 20:47:16'),
(15, 'ap40le3nvf5oe6ris15v72u6k0', 'Verhouding HDL-cholesterol/totaal cholesterol', 0, 5, '2017-01-30 20:48:39'),
(16, 'ap40le3nvf5oe6ris15v72u6k0', 'Verhouding LDL-cholesterol/totaal cholesterol', 0, 5, '2017-01-30 20:48:39'),
(17, 'ap40le3nvf5oe6ris15v72u6k0', 'Verhouding totaal cholesterol/HDL-cholesterol', 1, 5, '2017-01-30 20:48:39'),
(18, 'ap40le3nvf5oe6ris15v72u6k0', 'Verhouding totaal cholesterol/LDL-cholesterol', 0, 5, '2017-01-30 20:48:39'),
(19, 'ap40le3nvf5oe6ris15v72u6k0', 'Alleen aan de biologische ouders', 0, 6, '2017-01-30 20:49:44'),
(20, 'ap40le3nvf5oe6ris15v72u6k0', 'Alleen aan de pleegouders', 1, 6, '2017-01-30 20:49:44'),
(21, 'ap40le3nvf5oe6ris15v72u6k0', 'Aan de biologische- en de pleegouders', 0, 6, '2017-01-30 20:49:44'),
(22, 'ap40le3nvf5oe6ris15v72u6k0', 'Verhoging van de suppletie met foliumzuur tot eenmaal daags 5 mg', 0, 7, '2017-01-30 20:51:36'),
(23, 'ap40le3nvf5oe6ris15v72u6k0', 'Parenterale suppletie met foliumzuur', 0, 7, '2017-01-30 20:51:36'),
(24, 'ap40le3nvf5oe6ris15v72u6k0', 'Verwijzing naar de tweede lijn', 1, 7, '2017-01-30 20:51:37'),
(25, 'ap40le3nvf5oe6ris15v72u6k0', 'Het feit dat de testis slecht af te grenzen is.', 1, 8, '2017-01-30 20:52:50'),
(26, 'ap40le3nvf5oe6ris15v72u6k0', 'De afwezigheid van pijn.', 0, 8, '2017-01-30 20:52:50'),
(27, 'ap40le3nvf5oe6ris15v72u6k0', 'De lichtdoorlatendheid (diafanie) van de zwelling.', 0, 8, '2017-01-30 20:52:50'),
(28, 'ap40le3nvf5oe6ris15v72u6k0', 'Een koperhoudend IUD plaatsen.', 1, 9, '2017-01-30 20:53:57'),
(29, 'ap40le3nvf5oe6ris15v72u6k0', 'Een levonorgestrelbevattend IUD plaatsen.', 0, 9, '2017-01-30 20:53:57'),
(30, 'ap40le3nvf5oe6ris15v72u6k0', 'Levonorgestrel tablet 1,5 mg voorschrijven.', 0, 9, '2017-01-30 20:53:58'),
(31, 'ap40le3nvf5oe6ris15v72u6k0', 'Nee, want de duur van de symptomen van Minoes is te kort.', 0, 10, '2017-01-30 20:56:06'),
(32, 'ap40le3nvf5oe6ris15v72u6k0', 'Nee, want er zijn geen problemen in het functioneren van Minoes.', 1, 10, '2017-01-30 20:56:07'),
(33, 'ap40le3nvf5oe6ris15v72u6k0', 'Nee, want Minoes is te jong voor de diagnose ADHD.', 0, 10, '2017-01-30 20:56:07'),
(34, 'ap40le3nvf5oe6ris15v72u6k0', 'De proef van Rinne is afwijkend.', 0, 11, '2017-01-30 20:57:01'),
(35, 'ap40le3nvf5oe6ris15v72u6k0', 'De proef van Rinne is niet afwijkend.', 1, 11, '2017-01-30 20:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_mime` tinytext NOT NULL,
  `image` mediumblob NOT NULL,
  `session_id` varchar(40) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `session_id` varchar(40) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user` text NOT NULL,
  `useragent` text NOT NULL,
  `url` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `session_id` varchar(40) NOT NULL,
  `question` text NOT NULL,
  `image_id` int(11) NOT NULL,
  `origin` text NOT NULL,
  `subject_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `session_id`, `question`, `image_id`, `origin`, `subject_id`, `timestamp`) VALUES
(1, 'ap40le3nvf5oe6ris15v72u6k0', 'Mevrouw De Graaf, 55 jaar, komt op het spreekuur wegens incontinentieklachten. Na anamnese en onderzoek legt de huisarts haar uit dat er sprake is van stressincontinentie. Mevrouw De Graaf vraagt of er een behandeling mogelijk is. Wat is het aangewezen beleid?', 0, 'LHK2014OKT', 11, '2017-01-30 20:44:21'),
(2, 'ap40le3nvf5oe6ris15v72u6k0', 'Tijdens een leergesprek bespreken aios en opleider wanneer het aangewezen is bij een patiÃ«nt met hoestklachten een CRP-bepaling uit te voeren. Bij welk van de volgende patiÃ«nten is dit aangewezen?', 0, 'LHK2014OKT', 14, '2017-01-30 20:45:26'),
(3, 'ap40le3nvf5oe6ris15v72u6k0', 'Mevrouw Stam, 67 jaar, heeft een hardnekkige blefaritis. Ze heeft de ooglidrand de afgelopen weken dagelijks gereinigd met een wattenstokje, gedrenkt in verdunde babyshampoo. Ze houdt echter schilferende, rode ooglidranden. De huisarts besluit in overleg met mevrouw Stam de behandeling aan te vullen met een lokaal antibioticum. Wat is in dit geval het eerst aangewezen middel?', 0, 'LHK2014OKT', 13, '2017-01-30 20:46:13'),
(4, 'ap40le3nvf5oe6ris15v72u6k0', 'Mevrouw Van der Bijl, 34 jaar, komt op het spreekuur omdat haar hoofdpijnaanvallen in frequentie zijn toegenomen. Vroeger had ze ongeveer drie keer per maand een aanval van eenzijdige bonkende hoofdpijn, met lichtschuwheid en overgevoeligheid voor geluid. De laatste vier maanden heeft ze veel vaker hoofdpijn. Ze wordt gemiddeld vijf keer per week wakker met eenzijdige hoofdpijn. Ze neemt dan ibuprofen in, maar dit helpt niet meer. Wat is op dit moment de meest waarschijnlijke diagnose?', 0, 'LHK2014OKT', 2, '2017-01-30 20:47:16'),
(5, 'ap40le3nvf5oe6ris15v72u6k0', 'Bij de heer YÃ¼cel, 47 jaar, vraagt de huisarts in het kader van cardiovasculair risicomanagement bloedonderzoek aan. Welke lipidenratio dient te worden gebruikt om het risico op hart- en vaatziekten te schatten bij personen die nog geen klinische manifestatie hebben van hart- en vaatziekten?', 0, 'LHK2014OKT', 8, '2017-01-30 20:48:39'),
(6, 'ap40le3nvf5oe6ris15v72u6k0', 'Jelle, 5 jaar, woont sinds een half jaar bij pleegouders. Zij hebben het ouderlijk gezag over hem. De huisarts wil bij Jelle bloed laten prikken. Aan wie moet de huisarts volgens de WGBO toestemming vragen?', 0, 'LHK2014OKT', 5, '2017-01-30 20:49:44'),
(7, 'ap40le3nvf5oe6ris15v72u6k0', 'De huisarts heeft bij mevrouw Smit, 68 jaar, een anemie ten gevolge van een foliumzuurdeficiÃ«ntie vastgesteld. De bloeduitslag liet een normaal vitamine B12-gehalte zien. Ondanks een adequate behandeling met foliumzuurtabletten (eenmaal daags 0,5 mg) en bewezen therapietrouw neemt het Hb-gehalte niet toe. Wat is in dit geval het aangewezen beleid?', 0, 'LHK2014OKT', 6, '2017-01-30 20:51:36'),
(8, 'ap40le3nvf5oe6ris15v72u6k0', 'De heer Wempe, 42 jaar, voelt een zwelling rechts in zijn scrotum. De zwelling is de laatste weken toegenomen. Bij onderzoek blijkt de rechterkant van het scrotum vrijwel volledig opgevuld te zijn door een gladde, pijnloze, weke zwelling, die fluctueert. De testis is slecht afgrensbaar. Links voelt de huisarts geen afwijkingen. Palpatie is niet pijnlijk. Bij onderzoek blijkt de zwelling lichtdoorlatend. De huisarts twijfelt tussen een hydrokÃ¨le en een spermatokÃ¨le.\nWelk gegeven maakt onderscheid tussen een hydrokÃ¨le en een spermatokÃ¨le?', 0, 'LHK2014OKT', 7, '2017-01-30 20:52:50'),
(9, 'ap40le3nvf5oe6ris15v72u6k0', 'Mevrouw Gozbag, 32 jaar, komt op het spreekuur. Vier dagen geleden had ze seksueel contact waarbij het condoom is gescheurd. Ze komt er nu pas mee naar de huisarts. Ze heeft twee kinderen en gebruikt geen andere anticonceptie. Haar cyclus is regelmatig en duurt 30 dagen. Haar laatste menstruatie begon 16 dagen geleden. Ze vraagt de huisarts wat ze kan doen om het risico op zwangerschap te verkleinen. Wat is in deze situatie het aangewezen beleid?', 0, 'LHK2014OKT', 12, '2017-01-30 20:53:57'),
(10, 'ap40le3nvf5oe6ris15v72u6k0', 'Moeder komt met Minoes op het spreekuur omdat Minoes, 6 jaar, geen moment stil kan zitten en ontzettend veel praat in de klas. Deze symptomen zijn de laatste 9 maanden opvallender geworden. De leerkracht zegt dat Minoes goed functioneert op school en op sociaal vlak, maar dat ze het afgelopen schooljaar erg druk was. Thuis is Minoes ook erg druk en praat ze veel. Ze speelt wel leuk met andere kinderen. Moeder vraagt zich af of Minoes ADHD heeft. Voldoet Minoes aan de criteria voor ADHD?', 0, 'LHK2014OKT', 18, '2017-01-30 20:56:06'),
(11, 'ap40le3nvf5oe6ris15v72u6k0', 'De heer Dirks, 54 jaar, komt op het spreekuur omdat hij slechter is gaan horen met zijn rechteroor. Om te differentiÃ«ren tussen geleidings- en perceptief gehoorverlies voert de huisarts de stemvorkproef van Rinne uit. Ze drukt de steel van de stomp aangeslagen stemvork op zijn rechter mastoÃ¯d en vraagt de heer Dirks of hij het geluid hoort. Vervolgens houdt ze de stemvork voor de gehoorgang aan dezelfde zijde en vraagt of het geluid harder of zachter gehoord wordt. De heer Dirks geeft aan het geluid harder te horen. Welke conclusie is correct?', 0, 'LHK2014OKT', 4, '2017-01-30 20:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `score_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `session_id` varchar(40) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `icpc` tinytext NOT NULL,
  `subject` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `icpc`, `subject`) VALUES
(1, '', 'Onbekend onderwerp'),
(2, 'N', 'Neurologie'),
(3, 'S', 'Huid en subcutis'),
(4, 'H', 'Oor'),
(5, '', 'Huisartsgeneeskundig-theoretische onderwerpen'),
(6, 'B', 'Bloed en bloedvormende organen'),
(7, 'Y', 'Geslachtsorganen man'),
(8, 'K', 'Tractus circulatorius'),
(9, 'L', 'Bewegingsapparaat'),
(10, 'A', 'Algemeen en niet gespecificeerd'),
(11, 'U', 'Urinewegen'),
(12, 'W', 'Zwangerschap/anticonceptie'),
(13, 'F', 'Oog'),
(14, 'R', 'Tractus respiratorius'),
(15, 'X', 'Geslachtsorganen vrouw'),
(16, 'T', 'Endocriene klieren'),
(17, 'D', 'Tractus digestivus'),
(18, 'P', 'Psychische problemen'),
(19, 'Z', 'Sociale problematiek');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`) VALUES
(1, 'Bas', 'b.g.l.nelissen@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD UNIQUE KEY `id` (`answer_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD UNIQUE KEY `image_id` (`image_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD UNIQUE KEY `log_id` (`log_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD UNIQUE KEY `id` (`question_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD UNIQUE KEY `score_id` (`score_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD UNIQUE KEY `subject_id` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
