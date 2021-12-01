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
  PRIMARY KEY (`ticket_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla cau.tm_ticket: 3 rows
/*!40000 ALTER TABLE `tm_ticket` DISABLE KEYS */;
INSERT INTO `tm_ticket` (`ticket_id`, `usu_id`, `cat_id`, `tick_titulo`, `tick_description`, `est`) VALUES
	(2, 1, 4, 'Test soft', '<p>ghjg<br></p>', 1),
	(3, 1, 4, 'Ticket 3', '<p>TEst peti<br></p>', 1),
	(4, 1, 3, 'Test 4', '<p>Test 4<br></p>', 1);
/*!40000 ALTER TABLE `tm_ticket` ENABLE KEYS */;

-- Volcando estructura para tabla cau.tm_usuarios
CREATE TABLE IF NOT EXISTS `tm_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(150) DEFAULT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `correo` varchar(150) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL COMMENT '1: Activo\r\n0: Inactivo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla cau.tm_usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tm_usuarios` DISABLE KEYS */;
INSERT INTO `tm_usuarios` (`id`, `nombres`, `apellidos`, `correo`, `pass`, `created_at`, `updated_at`, `deleted_at`, `estado`) VALUES
	(1, 'test', 'testAp', 'test@test.com', 'test', '2020-02-02 00:00:00', '2020-02-02 00:00:00', '2020-02-02 00:00:00', 1),
	(2, 'test2', 'test2', 'test2@test.com', 'test2', '2020-02-02 00:00:00', '2020-02-02 00:00:00', '2020-02-02 00:00:00', 1);
/*!40000 ALTER TABLE `tm_usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
