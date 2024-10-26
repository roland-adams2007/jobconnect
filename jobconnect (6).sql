-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2024 at 11:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `cover_letter` text NOT NULL,
  `years` varchar(100) NOT NULL,
  `url` varchar(200) DEFAULT 'none',
  `comment` text DEFAULT 'none',
  `resume` varchar(200) NOT NULL,
  `application_status` varchar(100) DEFAULT 'Pending',
  `date_applied` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `job_id`, `applicant_id`, `fname`, `lname`, `email`, `phone`, `cover_letter`, `years`, `url`, `comment`, `resume`, `application_status`, `date_applied`) VALUES
(815, 481, 2714, 'Roland', 'Adams', 'adamsrolly7@gmail.com', '07043507082', 'Kluiyutryyio', '6-10', '', '', 'assets/uploads/resumes/1729972130_Roland-Adams-3.pdf', 'Pending', '2024-10-26 20:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `user_id`, `fname`, `lname`, `email`, `message`, `date_added`) VALUES
(991, 2714, 'Roland', 'Adams', 'adamsrolly7@gmail.com', 'Need help pls..', '2024-10-26 18:01:25'),
(2634, 2714, 'Roland', 'Adams', 'adamsrolly7@gmail.com', 'Jvytf', '2024-10-26 18:01:37'),
(3731, 2714, 'Roland', 'Adams', 'adamsrolly7@gmail.com', 'Jvytf', '2024-10-26 18:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(5, 'Australia'),
(11, 'Brazil'),
(4, 'Canada'),
(12, 'China'),
(8, 'France'),
(7, 'Germany'),
(6, 'India'),
(9, 'Japan'),
(14, 'Mexico'),
(1, 'Nigeria'),
(13, 'Russia'),
(10, 'South Africa'),
(15, 'Spain'),
(3, 'United Kingdom'),
(2, 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `country_codes`
--

CREATE TABLE `country_codes` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country_codes`
--

INSERT INTO `country_codes` (`id`, `country_id`, `code`) VALUES
(1, 1, '+234'),
(2, 2, '+1'),
(33, 3, '+44'),
(34, 4, '+1'),
(35, 5, '+61'),
(36, 6, '+91'),
(37, 7, '+49'),
(38, 8, '+33'),
(39, 9, '+81'),
(40, 10, '+27'),
(41, 11, '+55'),
(42, 12, '+86'),
(43, 13, '+7'),
(44, 14, '+52'),
(45, 15, '+34');

-- --------------------------------------------------------

--
-- Table structure for table `industries`
--

CREATE TABLE `industries` (
  `industry_id` int(11) NOT NULL,
  `industry_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `industries`
--

INSERT INTO `industries` (`industry_id`, `industry_name`) VALUES
(1, 'Healthcare'),
(2, 'Technology'),
(3, 'Finance '),
(4, 'Education'),
(5, 'Retail'),
(6, 'Manufacturing'),
(7, 'Construction'),
(8, 'Hospitality'),
(9, 'Real Estate'),
(10, 'Transportation'),
(11, 'Loogistics'),
(12, 'Marketing'),
(13, 'Advertising'),
(14, 'Media'),
(15, 'Entertainment'),
(16, 'Energy'),
(17, 'Utilities'),
(18, 'Government'),
(19, 'Non-profit'),
(20, 'Agriculture'),
(21, 'Software Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `salary` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `job_type` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `expiration_date` date DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `employer_id`, `title`, `location`, `country`, `salary`, `category`, `job_type`, `description`, `status`, `expiration_date`, `date_added`) VALUES
(481, 2567, 'Front End Developer', 'Lagos', 'Nigeria', '$40,000 - $50,000', 'Web Developer', 'part time', '<p>;l;.</p>', 1, '2025-10-25', '2024-10-25 22:32:25');

-- --------------------------------------------------------

--
-- Table structure for table `job_functions`
--

CREATE TABLE `job_functions` (
  `id` int(11) NOT NULL,
  `function_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_functions`
--

INSERT INTO `job_functions` (`id`, `function_name`) VALUES
(1, 'Web Developer'),
(2, 'Software Developer'),
(3, 'Project Manager'),
(4, 'Data Analyst'),
(5, 'UX/UI Designer'),
(6, 'Marketing Manager'),
(7, 'Sales Executive'),
(8, 'Human Resources Specialist'),
(9, 'Financial Analyst'),
(10, 'Product Manager'),
(11, 'Network Administrator'),
(12, 'Customer Support Specialist'),
(13, 'Content Writer'),
(14, 'Operations Manager'),
(15, 'Business Analyst'),
(16, 'SEO Specialist'),
(17, 'Graphic Designer'),
(18, 'IT Support Technician'),
(19, 'Quality Assurance Engineer'),
(20, 'Digital Marketing Specialist'),
(21, 'Supply Chain Manager'),
(22, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `country`, `state`) VALUES
(1, 'United States', 'Alabama'),
(2, 'United States', 'Alaska'),
(3, 'United States', 'Arizona'),
(4, 'United States', 'Arkansas'),
(5, 'United States', 'California'),
(6, 'United States', 'Colorado'),
(7, 'United States', 'Connecticut'),
(8, 'United States', 'Delaware'),
(9, 'United States', 'Florida'),
(10, 'United States', 'Georgia'),
(11, 'United States', 'Hawaii'),
(12, 'United States', 'Idaho'),
(13, 'United States', 'Illinois'),
(14, 'United States', 'Indiana'),
(15, 'United States', 'Iowa'),
(16, 'United States', 'Kansas'),
(17, 'United States', 'Kentucky'),
(18, 'United States', 'Louisiana'),
(19, 'United States', 'Maine'),
(20, 'United States', 'Maryland'),
(21, 'United States', 'Massachusetts'),
(22, 'United States', 'Michigan'),
(23, 'United States', 'Minnesota'),
(24, 'United States', 'Mississippi'),
(25, 'United States', 'Missouri'),
(26, 'United States', 'Montana'),
(27, 'United States', 'Nebraska'),
(28, 'United States', 'Nevada'),
(29, 'United States', 'New Hampshire'),
(30, 'United States', 'New Jersey'),
(31, 'United States', 'New Mexico'),
(32, 'United States', 'New York'),
(33, 'United States', 'North Carolina'),
(34, 'United States', 'North Dakota'),
(35, 'United States', 'Ohio'),
(36, 'United States', 'Oklahoma'),
(37, 'United States', 'Oregon'),
(38, 'United States', 'Pennsylvania'),
(39, 'United States', 'Rhode Island'),
(40, 'United States', 'South Carolina'),
(41, 'United States', 'South Dakota'),
(42, 'United States', 'Tennessee'),
(43, 'United States', 'Texas'),
(44, 'United States', 'Utah'),
(45, 'United States', 'Vermont'),
(46, 'United States', 'Virginia'),
(47, 'United States', 'Washington'),
(48, 'United States', 'West Virginia'),
(49, 'United States', 'Wisconsin'),
(50, 'United States', 'Wyoming'),
(51, 'United Kingdom', 'England'),
(52, 'United Kingdom', 'Scotland'),
(53, 'United Kingdom', 'Wales'),
(54, 'United Kingdom', 'Northern Ireland'),
(55, 'Nigeria', 'Abia'),
(56, 'Nigeria', 'Adamawa'),
(57, 'Nigeria', 'Akwa Ibom'),
(58, 'Nigeria', 'Anambra'),
(59, 'Nigeria', 'Bauchi'),
(60, 'Nigeria', 'Bayelsa'),
(61, 'Nigeria', 'Benue'),
(62, 'Nigeria', 'Borno'),
(63, 'Nigeria', 'Cross River'),
(64, 'Nigeria', 'Delta'),
(65, 'Nigeria', 'Ebonyi'),
(66, 'Nigeria', 'Edo'),
(67, 'Nigeria', 'Ekiti'),
(68, 'Nigeria', 'Enugu'),
(69, 'Nigeria', 'Gombe'),
(70, 'Nigeria', 'Imo'),
(71, 'Nigeria', 'Jigawa'),
(72, 'Nigeria', 'Kaduna'),
(73, 'Nigeria', 'Kano'),
(74, 'Nigeria', 'Kogi'),
(75, 'Nigeria', 'Kwara'),
(76, 'Nigeria', 'Lagos'),
(77, 'Nigeria', 'Nasarawa'),
(78, 'Nigeria', 'Niger'),
(79, 'Nigeria', 'Ogun'),
(80, 'Nigeria', 'Ondo'),
(81, 'Nigeria', 'Osun'),
(82, 'Nigeria', 'Oyo'),
(83, 'Nigeria', 'Plateau'),
(84, 'Nigeria', 'Rivers'),
(85, 'Nigeria', 'Sokoto'),
(86, 'Nigeria', 'Taraba'),
(87, 'Nigeria', 'Yobe'),
(88, 'Nigeria', 'Zamfara'),
(89, 'Brazil', 'Acre'),
(90, 'Brazil', 'Alagoas'),
(91, 'Brazil', 'Amapá'),
(92, 'Brazil', 'Amazonas'),
(93, 'Brazil', 'Bahia'),
(94, 'Brazil', 'Ceará'),
(95, 'Brazil', 'Distrito Federal'),
(96, 'Brazil', 'Espírito Santo'),
(97, 'Brazil', 'Goiás'),
(98, 'Brazil', 'Maranhão'),
(99, 'Brazil', 'Mato Grosso'),
(100, 'Brazil', 'Mato Grosso do Sul'),
(101, 'Brazil', 'Minas Gerais'),
(102, 'Brazil', 'Pará'),
(103, 'Brazil', 'Paraíba'),
(104, 'Brazil', 'Paraná'),
(105, 'Brazil', 'Pernambuco'),
(106, 'Brazil', 'Piauí'),
(107, 'Brazil', 'Rio de Janeiro'),
(108, 'Brazil', 'Rio Grande do Norte'),
(109, 'Brazil', 'Rio Grande do Sul'),
(110, 'Brazil', 'Rondônia'),
(111, 'Brazil', 'Roraima'),
(112, 'Brazil', 'Santa Catarina'),
(113, 'Brazil', 'São Paulo'),
(114, 'Brazil', 'Sergipe'),
(115, 'Brazil', 'Tocantins'),
(116, 'Australia', 'Australian Capital Territory'),
(117, 'Australia', 'New South Wales'),
(118, 'Australia', 'Northern Territory'),
(119, 'Australia', 'Queensland'),
(120, 'Australia', 'South Australia'),
(121, 'Australia', 'Tasmania'),
(122, 'Australia', 'Victoria'),
(123, 'Australia', 'Western Australia'),
(124, 'Canada', 'Alberta'),
(125, 'Canada', 'British Columbia'),
(126, 'Canada', 'Manitoba'),
(127, 'Canada', 'New Brunswick'),
(128, 'Canada', 'Newfoundland and Labrador'),
(129, 'Canada', 'Nova Scotia'),
(130, 'Canada', 'Ontario'),
(131, 'Canada', 'Prince Edward Island'),
(132, 'Canada', 'Quebec'),
(133, 'Canada', 'Saskatchewan'),
(134, 'China', 'Anhui'),
(135, 'China', 'Beijing'),
(136, 'China', 'Chongqing'),
(137, 'China', 'Fujian'),
(138, 'China', 'Gansu'),
(139, 'China', 'Guangdong'),
(140, 'China', 'Guangxi'),
(141, 'China', 'Guizhou'),
(142, 'China', 'Hainan'),
(143, 'China', 'Hebei'),
(144, 'China', 'Heilongjiang'),
(145, 'China', 'Henan'),
(146, 'China', 'Hubei'),
(147, 'China', 'Hunan'),
(148, 'China', 'Inner Mongolia'),
(149, 'China', 'Jiangsu'),
(150, 'China', 'Jiangxi'),
(151, 'China', 'Jilin'),
(152, 'China', 'Liaoning'),
(153, 'China', 'Ningxia'),
(154, 'China', 'Qinghai'),
(155, 'China', 'Shaanxi'),
(156, 'China', 'Shandong'),
(157, 'China', 'Shanghai'),
(158, 'China', 'Shanxi'),
(159, 'China', 'Sichuan'),
(160, 'China', 'Tianjin'),
(161, 'China', 'Tibet'),
(162, 'China', 'Xinjiang'),
(163, 'China', 'Yunnan'),
(164, 'China', 'Zhejiang'),
(165, 'France', 'Auvergne-Rhône-Alpes'),
(166, 'France', 'Bourgogne-Franche-Comté'),
(167, 'France', 'Brittany'),
(168, 'France', 'Centre-Val de Loire'),
(169, 'France', 'Grand Est'),
(170, 'France', 'Hauts-de-France'),
(171, 'France', 'Île-de-France'),
(172, 'France', 'Normandy'),
(173, 'France', 'Nouvelle-Aquitaine'),
(174, 'France', 'Occitanie'),
(175, 'France', 'Pays de la Loire'),
(176, 'France', 'Provence-Alpes-Côte d\'Azur'),
(177, 'Germany', 'Baden-Württemberg'),
(178, 'Germany', 'Bavaria'),
(179, 'Germany', 'Berlin'),
(180, 'Germany', 'Brandenburg'),
(181, 'Germany', 'Bremen'),
(182, 'Germany', 'Hamburg'),
(183, 'Germany', 'Hesse'),
(184, 'Germany', 'Lower Saxony'),
(185, 'Germany', 'Mecklenburg-Vorpommern'),
(186, 'Germany', 'North Rhine-Westphalia'),
(187, 'Germany', 'Rhineland-Palatinate'),
(188, 'Germany', 'Saarland'),
(189, 'Germany', 'Saxony'),
(190, 'Germany', 'Saxony-Anhalt'),
(191, 'Germany', 'Schleswig-Holstein'),
(192, 'Germany', 'Thuringia'),
(193, 'India', 'Andhra Pradesh'),
(194, 'India', 'Arunachal Pradesh'),
(195, 'India', 'Assam'),
(196, 'India', 'Bihar'),
(197, 'India', 'Chhattisgarh'),
(198, 'India', 'Goa'),
(199, 'India', 'Gujarat'),
(200, 'India', 'Haryana'),
(201, 'India', 'Himachal Pradesh'),
(202, 'India', 'Jharkhand'),
(203, 'India', 'Karnataka'),
(204, 'India', 'Kerala'),
(205, 'India', 'Madhya Pradesh'),
(206, 'India', 'Maharashtra'),
(207, 'India', 'Manipur'),
(208, 'India', 'Meghalaya'),
(209, 'India', 'Mizoram'),
(210, 'India', 'Nagaland'),
(211, 'India', 'Odisha'),
(212, 'India', 'Punjab'),
(213, 'India', 'Rajasthan'),
(214, 'India', 'Sikkim'),
(215, 'India', 'Tamil Nadu'),
(216, 'India', 'Telangana'),
(217, 'India', 'Uttar Pradesh'),
(218, 'India', 'Uttarakhand'),
(219, 'India', 'West Bengal'),
(220, 'Japan', 'Aichi'),
(221, 'Japan', 'Akita'),
(222, 'Japan', 'Aomori'),
(223, 'Japan', 'Chiba'),
(224, 'Japan', 'Ehime'),
(225, 'Japan', 'Fukui'),
(226, 'Japan', 'Fukuoka'),
(227, 'Japan', 'Gifu'),
(228, 'Japan', 'Gunma'),
(229, 'Japan', 'Hiroshima'),
(230, 'Japan', 'Hyōgo'),
(231, 'Japan', 'Ibaraki'),
(232, 'Japan', 'Ishikawa'),
(233, 'Japan', 'Yamagata'),
(234, 'Japan', 'Yamaguchi'),
(235, 'Japan', 'Kagawa'),
(236, 'Japan', 'Kumamoto'),
(237, 'Japan', 'Miyagi'),
(238, 'Japan', 'Miyazaki'),
(239, 'Japan', 'Nagano'),
(240, 'Japan', 'Nagasaki'),
(241, 'Japan', 'Niigata'),
(242, 'Japan', 'Okayama'),
(243, 'Japan', 'Okinawa'),
(244, 'Japan', 'Osaka'),
(245, 'Japan', 'Saga'),
(246, 'Japan', 'Shiga'),
(247, 'Japan', 'Shimane'),
(248, 'Japan', 'Shizuoka'),
(249, 'Japan', 'Tochigi'),
(250, 'Japan', 'Tokushima'),
(251, 'Japan', 'Tokyo'),
(252, 'Japan', 'Tottori'),
(253, 'Japan', 'Toyama'),
(254, 'Japan', 'Wakayama'),
(255, 'Japan', 'Yamaguchi'),
(256, 'Mexico', 'Aguascalientes'),
(257, 'Mexico', 'Baja California'),
(258, 'Mexico', 'Baja California Sur'),
(259, 'Mexico', 'Campeche'),
(260, 'Mexico', 'Chiapas'),
(261, 'Mexico', 'Chihuahua'),
(262, 'Mexico', 'Coahuila'),
(263, 'Mexico', 'Colima'),
(264, 'Mexico', 'Durango'),
(265, 'Mexico', 'Guanajuato'),
(266, 'Mexico', 'Guerrero'),
(267, 'Mexico', 'Hidalgo'),
(268, 'Mexico', 'Jalisco'),
(269, 'Mexico', 'Mexico City'),
(270, 'Mexico', 'Mexico State'),
(271, 'Mexico', 'Michoacán'),
(272, 'Mexico', 'Morelos'),
(273, 'Mexico', 'Nayarit'),
(274, 'Mexico', 'Nuevo León'),
(275, 'Mexico', 'Oaxaca'),
(276, 'Mexico', 'Puebla'),
(277, 'Mexico', 'Querétaro'),
(278, 'Mexico', 'Quintana Roo'),
(279, 'Mexico', 'San Luis Potosí'),
(280, 'Mexico', 'Sinaloa'),
(281, 'Mexico', 'Sonora'),
(282, 'Mexico', 'Tabasco'),
(283, 'Mexico', 'Tamaulipas'),
(284, 'Mexico', 'Tlaxcala'),
(285, 'Mexico', 'Veracruz'),
(286, 'Mexico', 'Yucatán'),
(287, 'Mexico', 'Zacatecas'),
(288, 'Russia', 'Adygea'),
(289, 'Russia', 'Altai Krai'),
(290, 'Russia', 'Amur Oblast'),
(291, 'Russia', 'Arkhangelsk Oblast'),
(292, 'Russia', 'Astrakhan Oblast'),
(293, 'Russia', 'Bashkortostan'),
(294, 'Russia', 'Buryatia'),
(295, 'Russia', 'Chechen Republic'),
(296, 'Russia', 'Chuvash Republic'),
(297, 'Russia', 'Dagestan'),
(298, 'Russia', 'Irkutsk Oblast'),
(299, 'Russia', 'Ivanovo Oblast'),
(300, 'Russia', 'Kabardino-Balkar Republic'),
(301, 'Russia', 'Kaliningrad Oblast'),
(302, 'Russia', 'Kaluga Oblast'),
(303, 'Russia', 'Kamchatka Krai'),
(304, 'Russia', 'Kemerovo Oblast'),
(305, 'Russia', 'Khabarovsk Krai'),
(306, 'Russia', 'Kirov Oblast'),
(307, 'Russia', 'Kostroma Oblast'),
(308, 'Russia', 'Krasnodar Krai'),
(309, 'Russia', 'Krasnoyarsk Krai'),
(310, 'Russia', 'Lipetsk Oblast'),
(311, 'Russia', 'Moscow'),
(312, 'Russia', 'Moscow Oblast'),
(313, 'Russia', 'Murmansk Oblast'),
(314, 'Russia', 'Nizhny Novgorod Oblast'),
(315, 'Russia', 'Novgorod Oblast'),
(316, 'Russia', 'Novosibirsk Oblast'),
(317, 'Russia', 'Omsk Oblast'),
(318, 'Russia', 'Orenburg Oblast'),
(319, 'Russia', 'Oryol Oblast'),
(320, 'Russia', 'Penza Oblast'),
(321, 'Russia', 'Perm Krai'),
(322, 'Russia', 'Pskov Oblast'),
(323, 'Russia', 'Rostov Oblast'),
(324, 'Russia', 'Ryazan Oblast'),
(325, 'Russia', 'Saint Petersburg'),
(326, 'Russia', 'Saratov Oblast'),
(327, 'Russia', 'Sakha Republic'),
(328, 'Russia', 'Sverdlovsk Oblast'),
(329, 'Russia', 'Tambov Oblast'),
(330, 'Russia', 'Tatarstan'),
(331, 'Russia', 'Tomsk Oblast'),
(332, 'Russia', 'Tula Oblast'),
(333, 'Russia', 'Tyumen Oblast'),
(334, 'Russia', 'Udmurt Republic'),
(335, 'Russia', 'Ulyanovsk Oblast'),
(336, 'Russia', 'Vladimir Oblast'),
(337, 'Russia', 'Volgograd Oblast'),
(338, 'Russia', 'Vologda Oblast'),
(339, 'Russia', 'Voronezh Oblast'),
(340, 'Russia', 'Yamalo-Nenets Autonomous Okrug'),
(341, 'Russia', 'Zabaykalsky Krai'),
(342, 'South Africa', 'Eastern Cape'),
(343, 'South Africa', 'Free State'),
(344, 'South Africa', 'Gauteng'),
(345, 'South Africa', 'KwaZulu-Natal'),
(346, 'South Africa', 'Limpopo'),
(347, 'South Africa', 'Mpumalanga'),
(348, 'South Africa', 'Northern Cape'),
(349, 'South Africa', 'North West'),
(350, 'South Africa', 'Western Cape'),
(351, 'Spain', 'Andalusia'),
(352, 'Spain', 'Aragon'),
(353, 'Spain', 'Asturias'),
(354, 'Spain', 'Balearic Islands'),
(355, 'Spain', 'Basque Country'),
(356, 'Spain', 'Canary Islands'),
(357, 'Spain', 'Cantabria'),
(358, 'Spain', 'Castile and León'),
(359, 'Spain', 'Castile-La Mancha'),
(360, 'Spain', 'Catalonia'),
(361, 'Spain', 'Extremadura'),
(362, 'Spain', 'Galicia'),
(363, 'Spain', 'La Rioja'),
(364, 'Spain', 'Madrid'),
(365, 'Spain', 'Murcia'),
(366, 'Spain', 'Navarre'),
(367, 'Spain', 'Valencia'),
(368, 'Remote', 'Remote');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_type` enum('job seeker','employer') NOT NULL,
  `name` varchar(100) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `country` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `highest_qualification` varchar(100) DEFAULT NULL,
  `experience` varchar(100) DEFAULT NULL,
  `current_job` varchar(100) DEFAULT NULL,
  `availability` varchar(100) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `employees` varchar(100) DEFAULT NULL,
  `referral` varchar(100) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `name`, `company_name`, `email`, `password`, `phone`, `country`, `address`, `dob`, `gender`, `highest_qualification`, `experience`, `current_job`, `availability`, `industry`, `employees`, `referral`, `resume`) VALUES
(157, 'job seeker', 'Roland Adams', NULL, 'ayomideadams132@gmail.com', '$2y$10$B9vtsXZsxolsL7FphOv3peBYnxUhpiQYokoF6uhtttVjt0X9DETum', '+2347043507083', 'Nigeria', '3, Oluwasanmi Close, Mafoluku Oshodi', '2024-10-29', 'male', 'highschool', '0-1', 'Graphic Designer', 'within-1-month', NULL, NULL, NULL, 'uploads/resumes/1729639782_Roland-Adams-3.pdf'),
(2567, 'employer', 'Onxy Sliver', 'Onxy', 'adamsrolly0@gmail.com', '$2y$10$B9vtsXZsxolsL7FphOv3peBYnxUhpiQYokoF6uhtttVjt0X9DETum', '+23407043507084', 'Nigeria', '3, Oluwasanmi Close, Mafoluku Oshodi', NULL, NULL, NULL, NULL, NULL, NULL, 'Software Engineering', '1-10', 'social-media', NULL),
(2714, 'job seeker', 'Roland Adams', NULL, 'adamsrolly7@gmail.com', '$2y$10$B9vtsXZsxolsL7FphOv3peBYnxUhpiQYokoF6uhtttVjt0X9DETum', '+23407043507082', 'Nigeria', '3, Oluwasanmi Close, Mafoluku Oshodi', '2024-10-02', 'male', 'highschool', '2-5', 'Graphic Designer', 'within-1-month', NULL, NULL, NULL, 'assets/uploads/resumes/1729972824_Roland-Adams-3.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `country_codes`
--
ALTER TABLE `country_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `industries`
--
ALTER TABLE `industries`
  ADD PRIMARY KEY (`industry_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `job_functions`
--
ALTER TABLE `job_functions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `country_codes`
--
ALTER TABLE `country_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `industries`
--
ALTER TABLE `industries`
  MODIFY `industry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `job_functions`
--
ALTER TABLE `job_functions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `country_codes`
--
ALTER TABLE `country_codes`
  ADD CONSTRAINT `country_codes_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
