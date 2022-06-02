-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2022 a las 02:34:23
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ttc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunas`
--

CREATE TABLE `comunas` (
  `id` int(11) NOT NULL,
  `comuna` varchar(64) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comunas`
--

INSERT INTO `comunas` (`id`, `comuna`, `region_id`) VALUES
(1, 'Arica', 1),
(2, 'Camarones', 1),
(3, 'General Lagos', 1),
(4, 'Putre', 1),
(5, 'Alto Hospicio', 2),
(6, 'Iquique', 2),
(7, 'Camiña', 2),
(8, 'Colchane', 2),
(9, 'Huara', 2),
(10, 'Pica', 2),
(11, 'Pozo Almonte', 2),
(12, 'Tocopilla', 3),
(13, 'María Elena', 3),
(14, 'Calama', 3),
(15, 'Ollague', 3),
(16, 'San Pedro de Atacama', 3),
(17, 'Antofagasta', 3),
(18, 'Mejillones', 3),
(19, 'Sierra Gorda', 3),
(20, 'Taltal', 3),
(21, 'Chañaral', 4),
(22, 'Diego de Almagro', 4),
(23, 'Copiapó', 4),
(24, 'Caldera', 4),
(25, 'Tierra Amarilla', 4),
(26, 'Vallenar', 4),
(27, 'Alto del Carmen', 4),
(28, 'Freirina', 4),
(29, 'Huasco', 4),
(30, 'La Serena', 5),
(31, 'Coquimbo', 5),
(32, 'Andacollo', 5),
(33, 'La Higuera', 5),
(34, 'Paihuano', 5),
(35, 'Vicuña', 5),
(36, 'Ovalle', 5),
(37, 'Combarbalá', 5),
(38, 'Monte Patria', 5),
(39, 'Punitaqui', 5),
(40, 'Río Hurtado', 5),
(41, 'Illapel', 5),
(42, 'Canela', 5),
(43, 'Los Vilos', 5),
(44, 'Salamanca', 5),
(45, 'La Ligua', 6),
(46, 'Cabildo', 6),
(47, 'Zapallar', 6),
(48, 'Papudo', 6),
(49, 'Petorca', 6),
(50, 'Los Andes', 6),
(51, 'San Esteban', 6),
(52, 'Calle Larga', 6),
(53, 'Rinconada', 6),
(54, 'San Felipe', 6),
(55, 'Llaillay', 6),
(56, 'Putaendo', 6),
(57, 'Santa María', 6),
(58, 'Catemu', 6),
(59, 'Panquehue', 6),
(60, 'Quillota', 6),
(61, 'La Cruz', 6),
(62, 'La Calera', 6),
(63, 'Nogales', 6),
(64, 'Hijuelas', 6),
(65, 'Valparaíso', 6),
(66, 'Viña del Mar', 6),
(67, 'Concón', 6),
(68, 'Quintero', 6),
(69, 'Puchuncaví', 6),
(70, 'Casablanca', 6),
(71, 'Juan Fernández', 6),
(72, 'San Antonio', 6),
(73, 'Cartagena', 6),
(74, 'El Tabo', 6),
(75, 'El Quisco', 6),
(76, 'Algarrobo', 6),
(77, 'Santo Domingo', 6),
(78, 'Isla de Pascua', 6),
(79, 'Quilpué', 6),
(80, 'Limache', 6),
(81, 'Olmué', 6),
(82, 'Villa Alemana', 6),
(83, 'Colina', 7),
(84, 'Lampa', 7),
(85, 'Tiltil', 7),
(86, 'Santiago', 7),
(87, 'Vitacura', 7),
(88, 'San Ramón', 7),
(89, 'San Miguel', 7),
(90, 'San Joaquín', 7),
(91, 'Renca', 7),
(92, 'Recoleta', 7),
(93, 'Quinta Normal', 7),
(94, 'Quilicura', 7),
(95, 'Pudahuel', 7),
(96, 'Providencia', 7),
(97, 'Peñalolén', 7),
(98, 'Pedro Aguirre Cerda', 7),
(99, 'Ñuñoa', 7),
(100, 'Maipú', 7),
(101, 'Macul', 7),
(102, 'Lo Prado', 7),
(103, 'Lo Espejo', 7),
(104, 'Lo Barnechea', 7),
(105, 'Las Condes', 7),
(106, 'La Reina', 7),
(107, 'La Pintana', 7),
(108, 'La Granja', 7),
(109, 'La Florida', 7),
(110, 'La Cisterna', 7),
(111, 'Independencia', 7),
(112, 'Huechuraba', 7),
(113, 'Estación Central', 7),
(114, 'El Bosque', 7),
(115, 'Conchalí', 7),
(116, 'Cerro Navia', 7),
(117, 'Cerrillos', 7),
(118, 'Puente Alto', 7),
(119, 'San José de Maipo', 7),
(120, 'Pirque', 7),
(121, 'San Bernardo', 7),
(122, 'Buin', 7),
(123, 'Paine', 7),
(124, 'Calera de Tango', 7),
(125, 'Melipilla', 7),
(126, 'Alhué', 7),
(127, 'Curacaví', 7),
(128, 'María Pinto', 7),
(129, 'San Pedro', 7),
(130, 'Isla de Maipo', 7),
(131, 'El Monte', 7),
(132, 'Padre Hurtado', 7),
(133, 'Peñaflor', 7),
(134, 'Talagante', 7),
(135, 'Codegua', 8),
(136, 'Coínco', 8),
(137, 'Coltauco', 8),
(138, 'Doñihue', 8),
(139, 'Graneros', 8),
(140, 'Las Cabras', 8),
(141, 'Machalí', 8),
(142, 'Malloa', 8),
(143, 'Mostazal', 8),
(144, 'Olivar', 8),
(145, 'Peumo', 8),
(146, 'Pichidegua', 8),
(147, 'Quinta de Tilcoco', 8),
(148, 'Rancagua', 8),
(149, 'Rengo', 8),
(150, 'Requínoa', 8),
(151, 'San Vicente de Tagua Tagua', 8),
(152, 'Chépica', 8),
(153, 'Chimbarongo', 8),
(154, 'Lolol', 8),
(155, 'Nancagua', 8),
(156, 'Palmilla', 8),
(157, 'Peralillo', 8),
(158, 'Placilla', 8),
(159, 'Pumanque', 8),
(160, 'San Fernando', 8),
(161, 'Santa Cruz', 8),
(162, 'La Estrella', 8),
(163, 'Litueche', 8),
(164, 'Marchigüe', 8),
(165, 'Navidad', 8),
(166, 'Paredones', 8),
(167, 'Pichilemu', 8),
(168, 'Curicó', 9),
(169, 'Hualañé', 9),
(170, 'Licantén', 9),
(171, 'Molina', 9),
(172, 'Rauco', 9),
(173, 'Romeral', 9),
(174, 'Sagrada Familia', 9),
(175, 'Teno', 9),
(176, 'Vichuquén', 9),
(177, 'Talca', 9),
(178, 'San Clemente', 9),
(179, 'Pelarco', 9),
(180, 'Pencahue', 9),
(181, 'Maule', 9),
(182, 'San Rafael', 9),
(183, 'Curepto', 9),
(184, 'Constitución', 9),
(185, 'Empedrado', 9),
(186, 'Río Claro', 9),
(187, 'Linares', 9),
(188, 'San Javier', 9),
(189, 'Parral', 9),
(190, 'Villa Alegre', 9),
(191, 'Longaví', 9),
(192, 'Colbún', 9),
(193, 'Retiro', 9),
(194, 'Yerbas Buenas', 9),
(195, 'Cauquenes', 9),
(196, 'Chanco', 9),
(197, 'Pelluhue', 9),
(198, 'Bulnes', 10),
(199, 'Chillán', 10),
(200, 'Chillán Viejo', 10),
(201, 'El Carmen', 10),
(202, 'Pemuco', 10),
(203, 'Pinto', 10),
(204, 'Quillón', 10),
(205, 'San Ignacio', 10),
(206, 'Yungay', 10),
(207, 'Cobquecura', 10),
(208, 'Coelemu', 10),
(209, 'Ninhue', 10),
(210, 'Portezuelo', 10),
(211, 'Quirihue', 10),
(212, 'Ránquil', 10),
(213, 'Treguaco', 10),
(214, 'San Carlos', 10),
(215, 'Coihueco', 10),
(216, 'San Nicolás', 10),
(217, 'Ñiquén', 10),
(218, 'San Fabián', 10),
(219, 'Alto Biobío', 11),
(220, 'Antuco', 11),
(221, 'Cabrero', 11),
(222, 'Laja', 11),
(223, 'Los Ángeles', 11),
(224, 'Mulchén', 11),
(225, 'Nacimiento', 11),
(226, 'Negrete', 11),
(227, 'Quilaco', 11),
(228, 'Quilleco', 11),
(229, 'San Rosendo', 11),
(230, 'Santa Bárbara', 11),
(231, 'Tucapel', 11),
(232, 'Yumbel', 11),
(233, 'Concepción', 11),
(234, 'Coronel', 11),
(235, 'Chiguayante', 11),
(236, 'Florida', 11),
(237, 'Hualpén', 11),
(238, 'Hualqui', 11),
(239, 'Lota', 11),
(240, 'Penco', 11),
(241, 'San Pedro de La Paz', 11),
(242, 'Santa Juana', 11),
(243, 'Talcahuano', 11),
(244, 'Tomé', 11),
(245, 'Arauco', 11),
(246, 'Cañete', 11),
(247, 'Contulmo', 11),
(248, 'Curanilahue', 11),
(249, 'Lebu', 11),
(250, 'Los Álamos', 11),
(251, 'Tirúa', 11),
(252, 'Angol', 12),
(253, 'Collipulli', 12),
(254, 'Curacautín', 12),
(255, 'Ercilla', 12),
(256, 'Lonquimay', 12),
(257, 'Los Sauces', 12),
(258, 'Lumaco', 12),
(259, 'Purén', 12),
(260, 'Renaico', 12),
(261, 'Traiguén', 12),
(262, 'Victoria', 12),
(263, 'Temuco', 12),
(264, 'Carahue', 12),
(265, 'Cholchol', 12),
(266, 'Cunco', 12),
(267, 'Curarrehue', 12),
(268, 'Freire', 12),
(269, 'Galvarino', 12),
(270, 'Gorbea', 12),
(271, 'Lautaro', 12),
(272, 'Loncoche', 12),
(273, 'Melipeuco', 12),
(274, 'Nueva Imperial', 12),
(275, 'Padre Las Casas', 12),
(276, 'Perquenco', 12),
(277, 'Pitrufquén', 12),
(278, 'Pucón', 12),
(279, 'Saavedra', 12),
(280, 'Teodoro Schmidt', 12),
(281, 'Toltén', 12),
(282, 'Vilcún', 12),
(283, 'Villarrica', 12),
(284, 'Valdivia', 13),
(285, 'Corral', 13),
(286, 'Lanco', 13),
(287, 'Los Lagos', 13),
(288, 'Máfil', 13),
(289, 'Mariquina', 13),
(290, 'Paillaco', 13),
(291, 'Panguipulli', 13),
(292, 'La Unión', 13),
(293, 'Futrono', 13),
(294, 'Lago Ranco', 13),
(295, 'Río Bueno', 13),
(297, 'Osorno', 14),
(298, 'Puerto Octay', 14),
(299, 'Purranque', 14),
(300, 'Puyehue', 14),
(301, 'Río Negro', 14),
(302, 'San Juan de la Costa', 14),
(303, 'San Pablo', 14),
(304, 'Calbuco', 14),
(305, 'Cochamó', 14),
(306, 'Fresia', 14),
(307, 'Frutillar', 14),
(308, 'Llanquihue', 14),
(309, 'Los Muermos', 14),
(310, 'Maullín', 14),
(311, 'Puerto Montt', 14),
(312, 'Puerto Varas', 14),
(313, 'Ancud', 14),
(314, 'Castro', 14),
(315, 'Chonchi', 14),
(316, 'Curaco de Vélez', 14),
(317, 'Dalcahue', 14),
(318, 'Puqueldón', 14),
(319, 'Queilén', 14),
(320, 'Quellón', 14),
(321, 'Quemchi', 14),
(322, 'Quinchao', 14),
(323, 'Chaitén', 14),
(324, 'Futaleufú', 14),
(325, 'Hualaihué', 14),
(326, 'Palena', 14),
(327, 'Lago Verde', 15),
(328, 'Coihaique', 15),
(329, 'Aysén', 15),
(330, 'Cisnes', 15),
(331, 'Guaitecas', 15),
(332, 'Río Ibáñez', 15),
(333, 'Chile Chico', 15),
(334, 'Cochrane', 15),
(335, 'O\'Higgins', 15),
(336, 'Tortel', 15),
(337, 'Natales', 16),
(338, 'Torres del Paine', 16),
(339, 'Laguna Blanca', 16),
(340, 'Punta Arenas', 16),
(341, 'Río Verde', 16),
(342, 'San Gregorio', 16),
(343, 'Porvenir', 16),
(344, 'Primavera', 16),
(345, 'Timaukel', 16),
(346, 'Cabo de Hornos', 16),
(347, 'Antártica', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE `regiones` (
  `COL 1` varchar(2) DEFAULT NULL,
  `COL 2` varchar(41) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`COL 1`, `COL 2`) VALUES
('id', 'region'),
('1', 'Arica y Parinacota'),
('2', 'Tarapacá'),
('3', 'Antofagasta'),
('4', 'Atacama'),
('5', 'Coquimbo'),
('6', 'Valparaiso'),
('7', 'Metropolitana de Santiago'),
('8', 'Libertador General Bernardo O\'Higgins'),
('9', 'Maule'),
('10', 'Ñuble'),
('11', 'Biobío'),
('12', 'La Araucanía'),
('13', 'Los Ríos'),
('14', 'Los Lagos'),
('15', 'Aysén del General Carlos Ibáñez del Campo'),
('16', 'Magallanes y de la Antártica Chilena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla`
--

CREATE TABLE `tabla` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `idDispositivo` varchar(255) NOT NULL,
  `valor` float NOT NULL COMMENT 'sell',
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'created at'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Atomic database';

--
-- Volcado de datos para la tabla `tabla`
--

INSERT INTO `tabla` (`id`, `idDispositivo`, `valor`, `fecha`) VALUES
(989, '', 0, '2022-04-15 16:00:07'),
(990, 'AquiToy', 52, '2022-04-15 16:05:25'),
(991, 'AquiToy', 56.3, '2022-04-15 16:05:38'),
(992, 'AquiToy', 52, '2022-04-15 16:05:50'),
(993, 'AquiToy', 52.2, '2022-04-15 16:06:02'),
(994, 'AquiToy', 52.3, '2022-04-15 16:06:15'),
(995, 'AquiToy', 52.3, '2022-04-15 16:06:27'),
(996, 'AquiToy', 52.39, '2022-04-15 16:06:40'),
(997, 'AquiToy', 51.12, '2022-04-15 16:06:52'),
(998, 'AquiToy', 52, '2022-04-15 16:07:04'),
(999, 'AquiToy', 51.61, '2022-04-15 16:07:17'),
(1000, 'AquiToy', 52.3, '2022-04-15 16:07:29'),
(1001, 'AquiToy', 52.49, '2022-04-15 16:07:42'),
(1002, 'AquiToy', 52.49, '2022-04-15 16:07:54'),
(1003, 'AquiToy', 52.98, '2022-04-15 16:08:06'),
(1004, 'AquiToy', 52.88, '2022-04-15 16:08:19'),
(1005, 'AquiToy', 52.98, '2022-04-15 16:08:31'),
(1006, 'AquiToy', 52.39, '2022-04-15 16:08:44'),
(1007, 'AquiToy', 53.08, '2022-04-15 16:08:56'),
(1008, 'AquiToy', 52.98, '2022-04-15 16:09:08'),
(1009, 'AquiToy', 52.88, '2022-04-15 16:09:21'),
(1010, 'AquiToy', 52.98, '2022-04-15 16:09:33'),
(1011, 'AquiToy', 52.98, '2022-04-15 16:09:45'),
(1012, 'AquiToy', 52.88, '2022-04-15 16:09:58'),
(1013, 'AquiToy', 53.08, '2022-04-15 16:10:10'),
(1014, 'AquiToy', 52.3, '2022-04-15 16:10:23'),
(1015, 'AquiToy', 52.39, '2022-04-15 16:10:35'),
(1016, 'AquiToy', 52.2, '2022-04-15 16:10:47'),
(1017, 'AquiToy', 52.98, '2022-04-15 16:11:00'),
(1018, 'AquiToy', 53.18, '2022-04-15 16:11:12'),
(1019, 'AquiToy', 52.39, '2022-04-15 16:11:24'),
(1020, 'AquiToy', 52, '2022-04-15 16:11:37'),
(1021, 'AquiToy', 52.59, '2022-04-15 16:11:49'),
(1022, 'AquiToy', 52.88, '2022-04-15 16:12:02'),
(1023, 'AquiToy', 52.88, '2022-04-15 16:12:14'),
(1024, 'AquiToy', 52.79, '2022-04-15 16:12:26'),
(1025, 'AquiToy', 52.98, '2022-04-15 16:12:39'),
(1026, 'AquiToy', 52.88, '2022-04-15 16:12:51'),
(1027, 'AquiToy', 52.98, '2022-04-15 16:13:04'),
(1028, 'AquiToy', 53.37, '2022-04-15 16:13:16'),
(1029, 'AquiToy', 53.37, '2022-04-15 16:13:28'),
(1030, 'AquiToy', 53.18, '2022-04-15 16:13:41'),
(1031, 'AquiToy', 52.88, '2022-04-15 16:13:53'),
(1032, 'AquiToy', 53.37, '2022-04-15 16:14:05'),
(1033, 'AquiToy', 53.76, '2022-04-15 16:14:18'),
(1034, 'AquiToy', 53.08, '2022-04-15 16:14:30'),
(1035, 'AquiToy', 53.47, '2022-04-15 16:14:42'),
(1036, 'AquiToy', 52.88, '2022-04-15 16:14:55'),
(1037, 'AquiToy', 52.88, '2022-04-15 16:15:07'),
(1038, 'AquiToy', 53.47, '2022-04-15 16:15:20'),
(1039, 'AquiToy', 52.98, '2022-04-15 16:15:32'),
(1040, 'AquiToy', 53.18, '2022-04-15 16:15:45'),
(1041, 'AquiToy', 53.37, '2022-04-15 16:15:57'),
(1042, 'AquiToy', 53.27, '2022-04-15 16:16:09'),
(1043, 'AquiToy', 53.27, '2022-04-15 16:16:22'),
(1044, 'AquiToy', 53.27, '2022-04-15 16:16:34'),
(1045, 'AquiToy', 53.37, '2022-04-15 16:16:46'),
(1046, 'AquiToy', 53.08, '2022-04-15 16:16:59'),
(1047, 'AquiToy', 53.18, '2022-04-15 16:17:11'),
(1048, 'AquiToy', 52.88, '2022-04-15 16:17:24'),
(1049, 'AquiToy', 53.08, '2022-04-15 16:17:36'),
(1050, 'AquiToy', 53.37, '2022-04-15 16:17:49'),
(1051, 'AquiToy', 52.98, '2022-04-15 16:18:03'),
(1052, 'AquiToy', 53.08, '2022-04-15 16:18:16'),
(1053, 'AquiToy', 53.08, '2022-04-15 16:18:28'),
(1054, 'AquiToy', 53.47, '2022-04-15 16:18:41'),
(1055, 'AquiToy', 53.47, '2022-04-15 16:18:53'),
(1056, 'AquiToy', 53.76, '2022-04-15 16:19:05'),
(1057, 'AquiToy', 53.37, '2022-04-15 16:19:18'),
(1058, 'AquiToy', 53.37, '2022-04-15 16:19:30'),
(1059, 'AquiToy', 52.98, '2022-04-15 16:19:43'),
(1060, 'AquiToy', 53.18, '2022-04-15 16:19:55'),
(1061, 'AquiToy', 53.27, '2022-04-15 16:20:08'),
(1062, 'AquiToy', 53.37, '2022-04-15 16:20:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tableros`
--

CREATE TABLE `tableros` (
  `idTablero` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Region` int(11) NOT NULL,
  `Comuna` int(11) NOT NULL,
  `Ubicacion` varchar(255) NOT NULL,
  `Sector` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tableros`
--

INSERT INTO `tableros` (`idTablero`, `Nombre`, `Region`, `Comuna`, `Ubicacion`, `Sector`) VALUES
(1, 'Tablero ejemplo.', 1, 1, 'Calle X, numero de casa Y.', 'Sector 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `Nombre`, `Correo`, `clave`, `Tipo`, `imagen`) VALUES
(1, 'Cristobal Henriquez', 'ejemplo@gmail.com', '$2y$10$0WzGgG4ve2I/asMpHKzdROZRHDedh6M4EqTM9ARoW2euFcELN1w1a', 0, ''),
(8, 'Prueba', 'Prueba1@gmail.com', '$2y$10$sRBbmgD6GKqUS95nGvBeXuiU9yVdXUvXtEyiBwQFqOJ.dkC2LZZsm', 0, 'No disponible'),
(10, 'Prueba2', 'prueba2@gmail.com', '$2y$10$ntbanleyMdH44SBaQe6XNOcjWVVDv0prHvFpg.IYzqDXMsghaPtni', 1, 'No disponible');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comunas`
--
ALTER TABLE `comunas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tabla`
--
ALTER TABLE `tabla`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tableros`
--
ALTER TABLE `tableros`
  ADD PRIMARY KEY (`idTablero`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comunas`
--
ALTER TABLE `comunas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=348;

--
-- AUTO_INCREMENT de la tabla `tabla`
--
ALTER TABLE `tabla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=1063;

--
-- AUTO_INCREMENT de la tabla `tableros`
--
ALTER TABLE `tableros`
  MODIFY `idTablero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
