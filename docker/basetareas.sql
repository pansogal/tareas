-- Adminer 4.8.1 MySQL 5.5.5-10.6.9-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

use basetareas;

DROP TABLE IF EXISTS `acciones`;
CREATE TABLE `acciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `avance_id` int(11) NOT NULL,
  `code` varchar(30) DEFAULT NULL,
  `accion` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `realizada` tinyint(1) NOT NULL DEFAULT 0,
  `luzverde` tinyint(1) NOT NULL DEFAULT 0,
  `critico` tinyint(1) NOT NULL DEFAULT 1,
  `iniciada` date DEFAULT NULL,
  `finalizada` date DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `documentar` text DEFAULT NULL,
  `dura_prevista` int(11) NOT NULL DEFAULT 5,
  PRIMARY KEY (`id`),
  KEY `avance_id` (`avance_id`),
  CONSTRAINT `acciones_ibfk_2` FOREIGN KEY (`avance_id`) REFERENCES `avances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `asignados`;
CREATE TABLE `asignados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tecnico_id` int(11) NOT NULL,
  `tarea_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tarea_id` (`tarea_id`),
  KEY `tecnico_id` (`tecnico_id`),
  CONSTRAINT `asignados_ibfk_1` FOREIGN KEY (`tarea_id`) REFERENCES `tareas` (`id`),
  CONSTRAINT `asignados_ibfk_2` FOREIGN KEY (`tecnico_id`) REFERENCES `tecnicos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `avances`;
CREATE TABLE `avances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `proyecto_id` int(11) NOT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `avance` varchar(70) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `completado` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`),
  KEY `parent_id` (`parent_id`),
  KEY `proyecto_id` (`proyecto_id`),
  CONSTRAINT `avances_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `avances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `avances_ibfk_4` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `confavances`;
CREATE TABLE `confavances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `prefijo` varchar(10) DEFAULT NULL,
  `cavance` varchar(80) NOT NULL,
  `explicacion` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `confavances_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `confavances` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `contactos`;
CREATE TABLE `contactos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `persona` varchar(100) NOT NULL,
  `rol` varchar(30) NOT NULL DEFAULT 'contacto',
  `tlfno_mail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `delegaciones`;
CREATE TABLE `delegaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delegacion` varchar(50) NOT NULL,
  `corto` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `empresas`;
CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(80) NOT NULL,
  `provincia` varchar(30) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `implicados`;
CREATE TABLE `implicados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accione_id` int(11) NOT NULL,
  `tecnico_id` int(11) NOT NULL,
  `fecha_limite` date DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accione_id` (`accione_id`),
  KEY `tecnico_id` (`tecnico_id`),
  CONSTRAINT `implicados_ibfk_3` FOREIGN KEY (`accione_id`) REFERENCES `acciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `implicados_ibfk_4` FOREIGN KEY (`tecnico_id`) REFERENCES `tecnicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `notas`;
CREATE TABLE `notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `left` int(11) DEFAULT NULL,
  `right` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `accione_id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL DEFAULT 'Nota',
  `texto` text DEFAULT NULL,
  `created` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `accione_id` (`accione_id`),
  KEY `left` (`left`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`accione_id`) REFERENCES `acciones` (`id`),
  CONSTRAINT `notas_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `notas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `parametros`;
CREATE TABLE `parametros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `familia` varchar(20) NOT NULL DEFAULT '01 -General',
  `indice` int(11) NOT NULL DEFAULT 1,
  `parametro` varchar(255) NOT NULL,
  `requiere_doc` tinyint(1) NOT NULL DEFAULT 0,
  `puede_otro` tinyint(1) NOT NULL DEFAULT 0,
  `describe` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delegacione_id` int(11) NOT NULL,
  `lugar` varchar(80) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `proyecto` varchar(255) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `corto` varchar(50) NOT NULL,
  `es_fv` tinyint(1) NOT NULL DEFAULT 1,
  `es_clima` tinyint(1) NOT NULL DEFAULT 0,
  `es_industrial` tinyint(1) NOT NULL DEFAULT 1,
  `es_residencial` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `delegacione_id` (`delegacione_id`),
  KEY `empresa_id` (`empresa_id`),
  CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`delegacione_id`) REFERENCES `delegaciones` (`id`),
  CONSTRAINT `proyectos_ibfk_2` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `rojos`;
CREATE TABLE `rojos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `propio` int(11) NOT NULL,
  `noantesde` int(11) NOT NULL,
  `conlimitede` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `propio` (`propio`),
  KEY `noantesde` (`noantesde`),
  KEY `conlimitede` (`conlimitede`),
  CONSTRAINT `rojos_ibfk_1` FOREIGN KEY (`propio`) REFERENCES `tareas` (`id`),
  CONSTRAINT `rojos_ibfk_2` FOREIGN KEY (`noantesde`) REFERENCES `tareas` (`id`),
  CONSTRAINT `rojos_ibfk_3` FOREIGN KEY (`conlimitede`) REFERENCES `tareas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `tareas`;
CREATE TABLE `tareas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(30) DEFAULT NULL,
  `tarea` varchar(30) NOT NULL,
  `dura_tipico` int(11) NOT NULL DEFAULT 5,
  `descripcion` text DEFAULT NULL,
  `documentar` text DEFAULT NULL,
  `critico` tinyint(1) NOT NULL DEFAULT 1,
  `confavance_id` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `confavance_id` (`confavance_id`),
  CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`confavance_id`) REFERENCES `confavances` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `tecnicos`;
CREATE TABLE `tecnicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delegacione_id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `cargo` varchar(80) DEFAULT NULL,
  `central` tinyint(1) DEFAULT 0 COMMENT '1 - No le afecta delegación, está en todas',
  PRIMARY KEY (`id`),
  KEY `delegacione_id` (`delegacione_id`),
  CONSTRAINT `tecnicos_ibfk_1` FOREIGN KEY (`delegacione_id`) REFERENCES `delegaciones` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `tecnicos` (`id`, `delegacione_id`, `nombre`, `cargo`, `central`) VALUES
(1,	1,	'Julian M.',	'Comercial',	0),
(2,	2,	'Pedro F.',	'Comercial',	0),
(3,	3,	'Ana M.',	'Estudios',	0),
(4,	2,	'Aurelio J.',	'Ejecutivo, Coordinador',	1),
(5,	2,	'Tadeo H.',	'Estudios',	0),
(6,	1,	'Jorge R.',	'Jefe Obra',	0),
(7,	2,	'Marisa Z.',	'Jefe de Obra',	0),
(8,	3,	'Marta G.',	'Comercial',	0),
(9,	2,	'Vicente F.',	'Ejecutivo, Coordinador',	1),
(10,	1,	'Manuel L.',	'Coordinador',	0),
(11,	2,	'Rosa D.',	'Tramitador/a',	1),
(12,	3,	'Jose Maria E.',	'Proyectos',	1),
(13,	3,	'Oscar P.',	'Jefe de obra',	0),
(14,	2,	'Enrique T.',	'Jefe Dto. Comercial',	1),
(15,	2,	'Luis H.',	'PRL',	1),
(16,	3,	'Romualdo D.',	'Tramitador/a',	1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tecnico_id` int(11) DEFAULT NULL,
  `usuario` varchar(60) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `esadmin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `tecnico_id` (`tecnico_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`tecnico_id`) REFERENCES `tecnicos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `users` (`id`, `tecnico_id`, `usuario`, `email`, `password`, `created`, `modified`, `esadmin`) VALUES
(1,	6,	'Admin',	'admin@gmail.com',	'$2y$10$A8mOWYqYJDfvYjgdj8XV1.A2meXXDDnW1ogseTqvtvnlgurS.gqt2',	'2023-05-14 20:21:54',	'2023-05-19 20:22:10',	1),
(2,	1,	'Julian',	'julian@gmail.com',	'$2y$10$t502NyfxCXv0UYegObKwU.9LCdfod03nlcwyA5u6PjoavpL5AFV02',	'2023-05-14 20:21:54',	'2023-05-19 19:19:27',	1),
(3,	4,	'Aurelio',	'aurelio@gmail.com',	'$2y$10$eudxkpaNqghQABxFHFyX/OK11dzQ7/jd..NawgqIn1/o7SmynvGwa',	'2023-05-14 20:22:30',	'2023-05-19 19:41:32',	0),
(4,	11,	'Rosa',	'rosa@gmail.com',	'$2y$10$ZRV20/dmqmyNyQ24ML.Py.FD2AMv/Dv7C9wtnCb9fDw/iUXqp.Zly',	'2023-05-19 19:52:49',	'2023-05-19 19:52:49',	0),
(5,	6,	'Jorge Juan',	'jorge@gmail.com',	'$2y$10$3yXKoRUlV1/kjZB2brRkfukENrlTIDSBY9VwKuQcrvZIQxJMeOBoq',	'2023-05-27 11:21:48',	'2023-05-27 11:21:48',	0);

DROP TABLE IF EXISTS `valores`;
CREATE TABLE `valores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parametro_id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `valor` varchar(100) NOT NULL DEFAULT '[Completar]',
  `siguiente` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parametro_id` (`parametro_id`),
  KEY `proyecto_id` (`proyecto_id`),
  CONSTRAINT `valores_ibfk_1` FOREIGN KEY (`parametro_id`) REFERENCES `parametros` (`id`),
  CONSTRAINT `valores_ibfk_2` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- 2023-06-02 20:48:28
