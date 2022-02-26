-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.31 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para cau
CREATE DATABASE IF NOT EXISTS `cau` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cau`;

-- Volcando estructura para procedimiento cau.sp_d_usuario_01
DELIMITER //
CREATE PROCEDURE `sp_d_usuario_01`(IN `xusu_id` INT)
BEGIN
UPDATE tm_usuarios
	SET 
		estado='0',
		deleted_at = now() 
	where id=xusu_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento cau.sp_l_usuario_01
DELIMITER //
CREATE PROCEDURE `sp_l_usuario_01`()
BEGIN
	SELECT * FROM tm_usuarios where estado='1';
END//
DELIMITER ;

-- Volcando estructura para procedimiento cau.sp_l_usuario_02
DELIMITER //
CREATE PROCEDURE `sp_l_usuario_02`(IN `xusu_id` INT)
BEGIN
	SELECT * FROM tm_usuarios where id=xusu_id;
END//
DELIMITER ;

-- Volcando estructura para tabla cau.td_documento
CREATE TABLE IF NOT EXISTS `td_documento` (
  `doc_id` int(11) NOT NULL,
  `tick_id` varchar(45) DEFAULT NULL,
  `dock_nom` varchar(400) DEFAULT NULL,
  `fecha_crea` datetime DEFAULT NULL,
  `est` int(11) DEFAULT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla cau.td_documento: 0 rows
/*!40000 ALTER TABLE `td_documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `td_documento` ENABLE KEYS */;

-- Volcando estructura para tabla cau.td_ticketdetalle
CREATE TABLE IF NOT EXISTS `td_ticketdetalle` (
  `tickd_id` int(11) NOT NULL AUTO_INCREMENT,
  `tick_id` int(11) DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `tickd_descrip` varchar(255) DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) DEFAULT NULL,
  PRIMARY KEY (`tickd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla cau.td_ticketdetalle: 4 rows
/*!40000 ALTER TABLE `td_ticketdetalle` DISABLE KEYS */;
INSERT INTO `td_ticketdetalle` (`tickd_id`, `tick_id`, `usu_id`, `tickd_descrip`, `fech_crea`, `est`) VALUES
	(1, 1, 2, 'Te respondo', '2022-01-04 00:00:00', 1),
	(2, 1, 1, 'Soy el usuario respondiendo', '2022-01-04 00:00:00', 1),
	(3, 1, 2, 'Reiniciar el equipo', '2022-01-04 00:00:00', 1),
	(4, 1, 1, 'Se resolvio el problema', '2022-01-04 00:00:00', 1);
/*!40000 ALTER TABLE `td_ticketdetalle` ENABLE KEYS */;

-- Volcando estructura para tabla cau.tm_categoria
CREATE TABLE IF NOT EXISTS `tm_categoria` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nom` varchar(150) NOT NULL,
  `est` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla cau.tm_categoria: 4 rows
/*!40000 ALTER TABLE `tm_categoria` DISABLE KEYS */;
INSERT INTO `tm_categoria` (`cat_id`, `cat_nom`, `est`) VALUES
	(1, 'Hardware', 1),
	(2, 'Software', 1),
	(3, 'Incidencia', 1),
	(4, 'Peticion de servicio', 1);
/*!40000 ALTER TABLE `tm_categoria` ENABLE KEYS */;

-- Volcando estructura para tabla cau.tm_ticket
CREATE TABLE IF NOT EXISTS `tm_ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `tick_titulo` varchar(250) DEFAULT NULL,
  `tick_description` varchar(9000) DEFAULT NULL,
  `est` int(11) DEFAULT NULL COMMENT 'Estado de el ticket',
  `fech_crea` datetime DEFAULT NULL,
  `tick_estado` varchar(15) DEFAULT 'Abierto',
  `usu_asig` int(11) DEFAULT NULL,
  `fech_asig` datetime DEFAULT NULL,
  PRIMARY KEY (`ticket_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla cau.tm_ticket: 10 rows
/*!40000 ALTER TABLE `tm_ticket` DISABLE KEYS */;
INSERT INTO `tm_ticket` (`ticket_id`, `usu_id`, `cat_id`, `tick_titulo`, `tick_description`, `est`, `fech_crea`, `tick_estado`, `usu_asig`, `fech_asig`) VALUES
	(2, 1, 4, 'Test soft', '<p>ghjg<br></p>', 1, NULL, 'Abierto', 2, NULL),
	(3, 1, 4, 'Ticket 3', '<p>TEst peti<br></p>', 1, NULL, 'Abierto', 5, '2022-02-14 16:50:35'),
	(4, 1, 3, 'Test 4', '<p>Test 4<br></p>', 1, NULL, 'Abierto', NULL, NULL),
	(5, 1, 1, 'Titulo con fecha', '<p>Con fecha<br></p>', 1, '2021-12-01 20:37:33', 'Abierto', NULL, NULL),
	(6, 1, 2, 'Ticket de hoy 02 febrero', '<p>Descripcion de hoy<br></p>', 1, '2022-02-02 11:36:15', NULL, NULL, NULL),
	(7, 1, 1, 'Ticket de hoy 02 febrero 2', '<p>Ticket de hoy 02 febrero 2<br></p>', 1, '2022-02-02 11:54:21', NULL, NULL, NULL),
	(8, 1, 1, 'Ticket de hoy 02 febrero 3', '<p>Ticket de hoy 02 febrero 3<br></p>', 1, '2022-02-02 11:58:22', NULL, NULL, NULL),
	(9, 1, 1, 'Ticket de hoy 02 febrero 4', '<p>Ticket de hoy 02 febrero 4<br></p>', 1, '2022-02-02 11:59:27', 'Cerrado', NULL, NULL),
	(10, 1, 2, 'Prueba 11/02', '<p>Prueba 11/02<br></p>', 1, '2022-02-11 08:50:09', 'Cerrado', NULL, NULL),
	(12, 1, 1, 'Problema con impresora', '<p>Problema con A4<br></p>', 1, '2022-02-14 14:38:32', 'Abierto', NULL, NULL);
/*!40000 ALTER TABLE `tm_ticket` ENABLE KEYS */;

-- Volcando estructura para tabla cau.tm_usuarios
CREATE TABLE IF NOT EXISTS `tm_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(150) DEFAULT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `correo` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL COMMENT '1: Activo\r\n0: Inactivo',
  `rol_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla cau.tm_usuarios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tm_usuarios` DISABLE KEYS */;
INSERT INTO `tm_usuarios` (`id`, `nombres`, `apellidos`, `correo`, `pass`, `created_at`, `updated_at`, `deleted_at`, `estado`, `rol_id`) VALUES
	(1, 'test', 'testAp', 'test@test.com', 'test', '2020-02-02 00:00:00', '2020-02-02 00:00:00', '2020-02-02 00:00:00', 1, 1),
	(2, 'Camila', 'Lobo', 'cami@gmail.com', '12345', '2020-02-02 00:00:00', '2020-02-02 00:00:00', '2022-02-12 19:40:30', 0, 1),
	(3, 'santiago', 'del moro', 'santi@gmail.cm', 'e10adc3949ba59abbe56e057f20f883e', '2022-02-12 19:26:19', NULL, NULL, 1, 1),
	(4, 'Julio', 'Iglesias', 'ju@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2022-02-12 19:27:12', NULL, NULL, 1, 1),
	(5, 'Enrique', 'Pinti', 'enri@gmail.com', '12345', '2022-02-14 15:27:12', '2022-02-14 15:27:12', '2022-02-14 15:27:12', 1, 2);
/*!40000 ALTER TABLE `tm_usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
