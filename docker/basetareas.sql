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
  `critico` tinyint(1) NOT NULL DEFAULT 1,
  `iniciada` date DEFAULT NULL,
  `finalizada` date DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `documentar` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `avance_id` (`avance_id`),
  CONSTRAINT `acciones_ibfk_1` FOREIGN KEY (`avance_id`) REFERENCES `avances` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `acciones` (`id`, `avance_id`, `code`, `accion`, `created`, `modified`, `realizada`, `critico`, `iniciada`, `finalizada`, `descripcion`, `documentar`) VALUES
(1,	1,	'00.1',	'Primera visita comercial',	'2023-04-30 09:45:28',	'2023-04-30 09:45:28',	1,	1,	NULL,	NULL,	'Busqueda de posibles clientes y contacto con el gestor que pueda decidir',	'Se registran los datos de empresa, contactos e imagen de tarjetas de visita si las hay'),
(2,	1,	'00.2',	'Obtener datos de consumos',	'2023-05-02 08:48:28',	'2023-05-02 08:48:28',	0,	1,	'2023-04-10',	NULL,	'Obtención de datos de consumo eléctrico para el estudio',	'Se registran las facturas de consumos.'),
(3,	2,	'00.31',	'Previsión de subvenciones',	'2023-05-02 08:48:09',	'2023-05-02 08:48:09',	0,	1,	NULL,	NULL,	'Incorporación al estudio de las posibles subvenciones de las administraciones',	'Se comunicará al Departamento de Estudios y se registrará la fuente de información para la consecución (enlaces web, teléfonos, etc..)'),
(4,	2,	'00.32',	'Cálculos de producción',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Incorporación al estudio del cálculo de producción que se obtiene tras diseñar el campo solar',	'Se registrará este diseño (planos, pdfs) y se indicará  qué herramienta y cuenta se utilizó. Se comunicará al Departamento de Estudios'),
(5,	2,	'00.33',	'Creación del estudio',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Creación del estudio y oferta con el diseño especificado',	'Se registrará este diseño (pdf) , que incluirá el presupuesto, pasará a estar disponible para aprobación'),
(6,	2,	'00.34',	'Aprobación de la oferta ',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Aprobación de la oferta al Cliente por el Departamento Comercial, entrega al Cliente',	'No necesita documentarse. Las comunicaciones al Cliente son confidenciales en esta acción'),
(7,	2,	'00.35',	'Aprobación de ampliaciones',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	NULL,	NULL),
(8,	3,	'00.41',	'Seguimiento de cliente',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Seguimiento del cliente, empieza cuando se entrega la oferta, solo acaba con la consecución del contrato',	'Se anotarán las comunicaciones con el Cliente por parte de un único comunicador designado'),
(9,	3,	'00.42',	'Visita técnica de detalle',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Visita técnica de detalle, puede ser antes o después de la entrega de alguna oferta al cliente',	'Se hará un informe, con descripción y fotos y con conclusiones que puedan ser de utilidad en la oferta'),
(10,	3,	'00.5',	'Conformidad técnica',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'La obra puede requerir una discusión técnica por sus caracteristicas especiales, debe pasar una aprobación tipo pasa/no pasa',	'En caso de necesitarse alguna característica adicional, se comunicará al Departamento comercial'),
(11,	3,	'00.6',	'Conforme Cliente',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'El fin de la negoción debe quedar clara, habiéndo resuelto toda duda del cliente',	'No necesita documentarse si no requiere acciones de otros técnicos.'),
(12,	3,	'00.7',	'Obtención del Contrato',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Esta acción acaba con la consecución del contrato',	'No necesita documentarse. Las comunicaciones son confidenciales en esta acción'),
(13,	4,	'01.1',	'Elaboración de proyecto',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Redacción del proyecto. Puede estar visado o no.',	'Se almacenan parciales y proyecto'),
(14,	4,	'01.2',	'Tramites de subvención',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Se tramita la aprobación de subvención o se delega en Cliente.',	'Las comunicaciones con la administración se documentan'),
(15,	4,	'01.3',	'Permisos Especiales',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'La obra puede requerir permisos especiales que tarden en resolverse. Esta acción finaliza cuando esté aprobada o se decida que no es necesaria',	'El técnico debe preguntar a la administración local al tramitar los permisos ordinarios'),
(16,	4,	'01.4',	'Logística de acopios',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Comunicación de necesidades. El jefe de obra comunicará las necesidades de aquellos elementos de compra difícil',	'Se registrará la comunicación y las resoluciones tomadas y las acciones con nuestros operadores logísticos'),
(17,	4,	'01.5',	'Luz verde a Ejecución',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Se da luz verde a inicio de obras, considerando acciones futuras como resolubles en tiempo por no haber acciones críticas pendientes',	'Se comunicará también verbalmente'),
(18,	4,	'01.6',	'Luz verde a subcontratacion',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	NULL,	NULL),
(19,	5,	'02.11',	'Compras críticas',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Se iniciarán aquellas compras o acopios que puedan ocasionar retrasos si no se toman a tiempo',	'Se registran los pedidos y los portes. No se registran aquí los medios auxiliares de descarga.'),
(20,	5,	'02.12',	'Compras en general',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Compras de material de obra',	'Se registran los pedidos y albaranes.'),
(21,	5,	'02.13',	'Contratac. Medios aux.',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Alquiler de medios auxiliares de carga, izado, andamios o plataformas',	'Se registran los pedidos.'),
(22,	5,	'02.14',	'Subcontratación',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Se define la relación y el contrato con las empresas subcontratadas.',	'Documentar las comunicaciones y las negociaciones'),
(23,	6,	'02.21',	'PRL Analisis PSS',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Redacción del plan de seguridad y salud',	'Se registra el plan y las deliveraciones entre técnicos'),
(24,	6,	'02.22',	'PRL Evaluacion de subcontratas',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Evaluación de la PRL de los medios subcontratados',	'Se registran la documentación y las comunicaciones'),
(25,	6,	'02.23',	'PRL Eval. de medios mecánicos',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Se requiere documentación a las empresas proveedoras de plataformas, medios de izado de cargas, etc..',	'Documentar comunicaciones.'),
(26,	6,	'02.24',	'PRL Coord. Cliente',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Nombramientos de coordinador PRL del cliente. Aprobación del plan',	'Se registran los nombramientos y la aprobación por parte del cliente'),
(27,	6,	'02.25',	'PRL Responsable en obra',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Nombramiento de nuestro responsable en obra',	'Se registran los nombramientos'),
(28,	6,	'02.26',	'PRL Seguimiento',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Seguimientos de acciones de PRL',	'Se registran incidencias o quejas'),
(29,	7,	'03.1',	'Planificación de obra',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Planificación de la obra, con fechas de inicio y final',	'Documentar en excel de planificación, documentar los cambios como anotación'),
(30,	7,	'03.2',	'Permiso de obra',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Obtención de permisos de obra',	'Documentar las comunicaciones'),
(31,	7,	'03.3',	'Permiso de ocupacion',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Obtención de permisos de ocupación',	'Documentar las comunicaciones'),
(32,	8,	'04.1',	'Ejecución de obra',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Ejecución de la obra, real con fechas de inicio y final',	'Documentar los cambios como anotación. documentar los empleados asignados y sus fechas'),
(33,	8,	'04.2',	'Ampliaciones de obra',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Ampliaciones de obra que surjan, como instalación de líneas de vida permanentes',	'Consultar si están en contrato. Especificar en anotación'),
(34,	8,	'04.3',	'Certificaciones',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Certificaciones',	'Anotar como 04.3X en anotación, indicando concepto (\'mensual\', \'acopio\', etc..) y fecha'),
(35,	8,	'04.41',	'Puesta en Marcha',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Puesta en marcha de la instalación. Pruebas, ajustes',	'Anotar las incidencias posibles'),
(36,	8,	'04.42',	'Comunicaciones a cliente',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Comunicar al cliente la aplicación de supervisión de la planta y sus ajustes, si proceden',	'Anotar la fecha'),
(37,	8,	'04.5',	'Fin de obra',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Decretar fin de la obra (y sus ampliaciones) tras chequeo de las partidas y acciones',	'Anotar la fecha'),
(38,	9,	'05.1',	'Protocolo de fin de obra',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Cumplimentación del protocolo de fin de obra, con operarios',	'Adjuntar informe, comunicar a Proyectos'),
(39,	9,	'05.2',	'Listado de n. serie placas',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Anotar los números de serie de placas u otros elementos cuando sea necesario',	'Archivar y comunicar a Legalizaciones'),
(40,	9,	'05.3',	'Visado de Proyecto',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Visado de proyecto, si no lo está aún',	'Archivar en su sitio, comunicar'),
(41,	9,	'05.4',	'Certificado de fin de obra',	'2023-04-30 09:40:51',	'2023-04-30 09:40:51',	0,	1,	NULL,	NULL,	'Certificado de fin de obra',	'Archivar en su sitio, comunicar');

DROP TABLE IF EXISTS `asignados`;
CREATE TABLE `asignados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarea_id` int(11) NOT NULL,
  `tecnico_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tarea_id` (`tarea_id`),
  KEY `tecnico_id` (`tecnico_id`),
  CONSTRAINT `asignados_ibfk_1` FOREIGN KEY (`tarea_id`) REFERENCES `tareas` (`id`),
  CONSTRAINT `asignados_ibfk_2` FOREIGN KEY (`tecnico_id`) REFERENCES `tecnicos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `asignados` (`id`, `tarea_id`, `tecnico_id`) VALUES
(7,	1,	2),
(8,	2,	1),
(10,	3,	3),
(11,	4,	1),
(12,	4,	2),
(14,	5,	4),
(15,	3,	5),
(16,	6,	6),
(17,	6,	7),
(18,	1,	8),
(19,	2,	2),
(20,	2,	8),
(21,	4,	8),
(22,	5,	9),
(23,	7,	10),
(24,	7,	9),
(25,	8,	11),
(26,	7,	12),
(27,	10,	12),
(28,	11,	11),
(29,	9,	5),
(30,	6,	13),
(32,	13,	14),
(33,	14,	4),
(34,	12,	4),
(35,	15,	6),
(36,	15,	13),
(37,	15,	7),
(38,	16,	15),
(39,	17,	15),
(40,	18,	15),
(41,	19,	11),
(42,	19,	16),
(43,	20,	11),
(44,	20,	16),
(45,	21,	4),
(46,	21,	7),
(47,	21,	13),
(48,	21,	6),
(49,	12,	6),
(50,	12,	13),
(51,	12,	7),
(52,	22,	6),
(53,	22,	7),
(54,	22,	13),
(55,	23,	6),
(56,	23,	13),
(57,	23,	7),
(58,	24,	6),
(59,	24,	13),
(60,	24,	7),
(61,	29,	10),
(62,	29,	6),
(63,	29,	13),
(64,	29,	7),
(65,	30,	9),
(66,	30,	14),
(67,	31,	16),
(68,	11,	16),
(69,	32,	7),
(70,	32,	6),
(71,	32,	13),
(72,	33,	6),
(73,	33,	13),
(74,	33,	7),
(75,	34,	15),
(76,	35,	13),
(77,	35,	15),
(78,	35,	6),
(79,	35,	7),
(80,	40,	4),
(81,	41,	14),
(82,	41,	9),
(83,	38,	4),
(84,	39,	15),
(85,	36,	6),
(86,	36,	7),
(87,	36,	13),
(88,	27,	6),
(89,	27,	13),
(90,	27,	7),
(91,	25,	6),
(92,	25,	7),
(93,	25,	13),
(94,	26,	6),
(95,	26,	7),
(96,	26,	13),
(99,	37,	12),
(100,	28,	6),
(101,	28,	13),
(102,	28,	7),
(118,	1,	1);

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
  KEY `proyecto_id` (`proyecto_id`),
  KEY `lft` (`lft`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `avances_ibfk_1` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`),
  CONSTRAINT `avances_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `avances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `avances` (`id`, `parent_id`, `lft`, `rght`, `proyecto_id`, `prefix`, `avance`, `created`, `modified`, `completado`) VALUES
(1,	NULL,	1,	18,	2,	'01',	'Primer contacto',	'2023-05-15 12:54:11',	'2023-05-15 12:54:11',	0),
(2,	1,	2,	17,	2,	'02',	'Estudio',	'2023-05-15 12:54:11',	'2023-05-15 12:54:11',	0),
(3,	2,	3,	16,	2,	'03',	'Negociación',	'2023-05-15 12:54:11',	'2023-05-15 12:54:11',	0),
(4,	3,	4,	5,	2,	'04',	'Trámites previos',	'2023-05-15 12:54:11',	'2023-05-15 12:54:11',	0),
(5,	3,	6,	7,	2,	'05',	'Acopios',	'2023-05-15 12:54:11',	'2023-05-15 12:54:11',	0),
(6,	3,	8,	9,	2,	'06',	'PRL',	'2023-05-15 12:54:11',	'2023-05-15 12:54:11',	0),
(7,	3,	10,	15,	2,	'07',	'Planificacion',	'2023-05-15 12:54:11',	'2023-05-15 12:54:11',	0),
(8,	7,	11,	14,	2,	'08',	'Obra',	'2023-05-15 12:54:11',	'2023-05-15 12:54:11',	0),
(9,	8,	12,	13,	2,	'09',	'Documentación',	'2023-05-15 12:54:11',	'2023-05-15 12:54:11',	0);

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

INSERT INTO `confavances` (`id`, `parent_id`, `lft`, `rght`, `prefijo`, `cavance`, `explicacion`) VALUES
(1,	NULL,	NULL,	NULL,	NULL,	'No asignado',	NULL),
(2,	NULL,	1,	18,	'01',	'Primer contacto',	'Tareas comerciales de captación del cliente previas al estudio de una oferta.'),
(3,	2,	2,	17,	'02',	'Estudio',	''),
(4,	3,	3,	16,	'03',	'Negociación',	''),
(5,	4,	4,	5,	'04',	'Trámites previos',	''),
(6,	4,	6,	7,	'05',	'Acopios',	''),
(7,	4,	8,	9,	'06',	'PRL',	''),
(8,	4,	10,	15,	'07',	'Planificacion',	''),
(9,	8,	11,	14,	'08',	'Obra',	''),
(10,	9,	12,	13,	'09',	'Documentación',	'');

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

INSERT INTO `contactos` (`id`, `empresa_id`, `persona`, `rol`, `tlfno_mail`) VALUES
(1,	1,	'Juan Ortiz',	'contacto',	'');

DROP TABLE IF EXISTS `delegaciones`;
CREATE TABLE `delegaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delegacion` varchar(50) NOT NULL,
  `corto` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `delegaciones` (`id`, `delegacion`, `corto`) VALUES
(1,	'Madrid',	'MAD'),
(2,	'Coruña',	'C'),
(3,	'Lugo',	'LU');

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(80) NOT NULL,
  `provincia` varchar(30) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `empresas` (`id`, `empresa`, `provincia`, `direccion`) VALUES
(1,	'Chocolates S.A.',	'Toledo',	'');

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
  CONSTRAINT `implicados_ibfk_1` FOREIGN KEY (`accione_id`) REFERENCES `acciones` (`id`),
  CONSTRAINT `implicados_ibfk_2` FOREIGN KEY (`tecnico_id`) REFERENCES `tecnicos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `implicados` (`id`, `accione_id`, `tecnico_id`, `fecha_limite`, `fecha_inicio`) VALUES
(1,	1,	1,	NULL,	NULL),
(2,	2,	1,	NULL,	NULL),
(3,	3,	11,	NULL,	NULL),
(4,	6,	9,	NULL,	NULL),
(5,	6,	14,	NULL,	NULL),
(6,	7,	9,	NULL,	NULL),
(7,	7,	14,	NULL,	NULL),
(8,	8,	1,	NULL,	NULL),
(9,	9,	6,	NULL,	NULL),
(10,	10,	10,	NULL,	NULL),
(11,	10,	9,	NULL,	NULL),
(12,	10,	12,	NULL,	NULL),
(13,	11,	14,	NULL,	NULL),
(14,	12,	4,	NULL,	NULL),
(15,	12,	9,	NULL,	NULL),
(16,	13,	12,	NULL,	NULL),
(17,	14,	11,	NULL,	NULL),
(18,	14,	16,	NULL,	NULL),
(19,	15,	16,	NULL,	NULL),
(20,	16,	6,	NULL,	NULL),
(21,	16,	4,	NULL,	NULL),
(22,	17,	4,	NULL,	NULL),
(23,	18,	4,	NULL,	NULL),
(24,	19,	6,	NULL,	NULL),
(25,	20,	6,	NULL,	NULL),
(26,	21,	6,	NULL,	NULL),
(27,	22,	4,	NULL,	NULL),
(28,	23,	15,	NULL,	NULL),
(29,	24,	15,	NULL,	NULL),
(30,	25,	15,	NULL,	NULL),
(31,	26,	15,	NULL,	NULL),
(32,	27,	15,	NULL,	NULL),
(33,	28,	6,	NULL,	NULL),
(34,	28,	15,	NULL,	NULL),
(35,	29,	6,	NULL,	NULL),
(36,	29,	4,	NULL,	NULL),
(37,	30,	11,	NULL,	NULL),
(38,	30,	16,	NULL,	NULL),
(39,	31,	11,	NULL,	NULL),
(40,	31,	16,	NULL,	NULL),
(41,	32,	6,	NULL,	NULL),
(42,	33,	6,	NULL,	NULL),
(43,	34,	6,	NULL,	NULL),
(44,	34,	10,	NULL,	NULL),
(45,	35,	6,	NULL,	NULL),
(46,	36,	6,	NULL,	NULL),
(47,	37,	6,	NULL,	NULL),
(48,	38,	6,	NULL,	NULL),
(49,	39,	6,	NULL,	NULL),
(50,	40,	12,	NULL,	NULL),
(51,	41,	6,	NULL,	NULL),
(54,	5,	5,	NULL,	NULL),
(55,	4,	5,	NULL,	NULL);

DROP TABLE IF EXISTS `notas`;
CREATE TABLE `notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `notas` (`id`, `user_id`, `titulo`, `texto`) VALUES
(1,	1,	'Recordatorio',	'Hola, es prueba');

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

INSERT INTO `parametros` (`id`, `familia`, `indice`, `parametro`, `requiere_doc`, `puede_otro`, `describe`) VALUES
(1,	'01 -General',	1,	'Número de paneles',	0,	0,	'Se indicará el número de paneles en el campo solar.'),
(2,	'01 -General',	2,	'Modelo de panel',	0,	0,	'Se indicará la marca y el modelo del panel'),
(3,	'01 -General',	5,	'Modelo del inversor',	0,	1,	'Se indicará la marca y el modelo del inversor.'),
(4,	'01 -General',	6,	'Potencia del inversor',	0,	1,	'Se indicará la potencia nominal de este inversor.'),
(5,	'01 -General',	3,	'Potencia del panel',	0,	0,	'Se indicara la potencia en vatios del panel. '),
(6,	'01 -General',	4,	'Potencia total del campo solar',	0,	0,	'Se indicará la potencia total, que es num. paneles x potencia de panel.'),
(7,	'01 -General',	7,	'Disposición de placas (coplanar, inclinada) y material de soporte.',	0,	1,	'Indicar el tipo de instalación, si es coplanar o inclinada. Indicar si es metálico o si es de hormigón u otro material.\r\nEs posible que haya más de un tipo.'),
(8,	'01 -General',	8,	'Marca y modelo de la estructura de soporte de placas',	0,	1,	'Indicar la marca y el modelo del soporte. \r\nPuede haber varios, en consonancia con las diferentes soluciones en el campo solar. ');

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

INSERT INTO `proyectos` (`id`, `delegacione_id`, `lugar`, `empresa_id`, `proyecto`, `codigo`, `corto`, `es_fv`, `es_clima`, `es_industrial`, `es_residencial`, `created`, `modified`) VALUES
(2,	1,	'Madrid, Calle Luna 4',	1,	'Instalación fotovoltaica sin excedentes en nave',	'0003',	'M_0003_LUNA',	1,	0,	1,	0,	'2023-04-04 08:58:19',	'2023-04-04 08:58:19');

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

INSERT INTO `rojos` (`id`, `propio`, `noantesde`, `conlimitede`) VALUES
(7,	2,	1,	NULL),
(8,	3,	2,	NULL),
(9,	3,	8,	NULL),
(10,	3,	9,	NULL),
(11,	30,	3,	NULL),
(12,	4,	30,	NULL),
(13,	6,	2,	NULL),
(14,	7,	30,	NULL),
(15,	13,	7,	NULL),
(16,	5,	13,	NULL),
(17,	10,	5,	NULL),
(18,	11,	5,	NULL),
(19,	31,	5,	NULL),
(20,	12,	5,	NULL),
(21,	14,	10,	NULL),
(22,	14,	11,	NULL),
(23,	14,	31,	NULL),
(24,	14,	12,	NULL),
(25,	15,	14,	NULL),
(26,	32,	14,	NULL),
(27,	33,	14,	NULL),
(30,	38,	17,	NULL),
(32,	33,	39,	NULL),
(33,	16,	14,	NULL),
(34,	17,	14,	NULL),
(35,	39,	14,	NULL),
(36,	18,	14,	NULL),
(37,	34,	21,	NULL),
(38,	35,	22,	NULL),
(39,	21,	14,	NULL),
(40,	19,	14,	NULL),
(41,	20,	21,	NULL),
(42,	22,	21,	NULL),
(43,	22,	19,	NULL),
(44,	22,	20,	NULL),
(45,	23,	14,	NULL),
(47,	29,	14,	NULL),
(48,	36,	22,	NULL),
(49,	27,	36,	NULL),
(50,	24,	22,	NULL),
(51,	25,	24,	NULL),
(52,	26,	24,	NULL),
(53,	37,	22,	NULL),
(54,	28,	37,	NULL),
(55,	8,	2,	NULL),
(56,	9,	2,	NULL),
(57,	7,	6,	NULL),
(58,	3,	6,	NULL),
(59,	40,	5,	NULL),
(60,	38,	40,	NULL),
(61,	41,	30,	NULL),
(62,	23,	41,	NULL);

DROP TABLE IF EXISTS `tareas`;
CREATE TABLE `tareas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(30) DEFAULT NULL,
  `tarea` varchar(30) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `documentar` text DEFAULT NULL,
  `critico` tinyint(1) NOT NULL DEFAULT 1,
  `confavance_id` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `confavance_id` (`confavance_id`),
  CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`confavance_id`) REFERENCES `confavances` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `tareas` (`id`, `codigo`, `tarea`, `descripcion`, `documentar`, `critico`, `confavance_id`) VALUES
(1,	'00.1',	'Primera visita comercial',	'Busqueda de posibles clientes y contacto con el gestor que pueda decidir',	'Se registran los datos de empresa, contactos e imagen de tarjetas de visita si las hay',	1,	2),
(2,	'00.2',	'Obtener datos de consumos',	'Obtención de datos de consumo eléctrico para el estudio',	'Se registran las facturas de consumos.',	1,	2),
(3,	'00.33',	'Creación del estudio',	'Creación del estudio y oferta con el diseño especificado',	'Se registrará este diseño (pdf) , que incluirá el presupuesto, pasará a estar disponible para aprobación',	1,	3),
(4,	'00.41',	'Seguimiento de cliente',	'Seguimiento del cliente, empieza cuando se entrega la oferta, solo acaba con la consecución del contrato',	'Se anotarán las comunicaciones con el Cliente por parte de un único comunicador designado',	1,	4),
(5,	'00.7',	'Obtención del Contrato',	'Esta acción acaba con la consecución del contrato',	'No necesita documentarse. Las comunicaciones son confidenciales en esta acción',	1,	4),
(6,	'00.42',	'Visita técnica de detalle',	'Visita técnica de detalle, puede ser antes o después de la entrega de alguna oferta al cliente',	'Se hará un informe, con descripción y fotos y con conclusiones que puedan ser de utilidad en la oferta',	0,	4),
(7,	'00.5',	'Conformidad técnica',	'La obra puede requerir una discusión técnica por sus caracteristicas especiales, debe pasar una aprobación tipo pasa/no pasa',	'En caso de necesitarse alguna característica adicional, se comunicará al Departamento comercial',	1,	4),
(8,	'00.31',	'Previsión de subvenciones',	'Incorporación al estudio de las posibles subvenciones de las administraciones',	'Se comunicará al Departamento de Estudios y se registrará la fuente de información para la consecución (enlaces web, teléfonos, etc..)',	1,	3),
(9,	'00.32',	'Cálculos de producción',	'Incorporación al estudio del cálculo de producción que se obtiene tras diseñar el campo solar',	'Se registrará este diseño (planos, pdfs) y se indicará  qué herramienta y cuenta se utilizó. Se comunicará al Departamento de Estudios',	1,	3),
(10,	'01.1',	'Elaboración de proyecto',	'Redacción del proyecto. Puede estar visado o no.',	'Se almacenan parciales y proyecto',	1,	5),
(11,	'01.2',	'Tramites de subvención',	'Se tramita la aprobación de subvención o se delega en Cliente.',	'Las comunicaciones con la administración se documentan',	1,	5),
(12,	'01.4',	'Logística de acopios',	'Comunicación de necesidades. El jefe de obra comunicará las necesidades de aquellos elementos de compra difícil',	'Se registrará la comunicación y las resoluciones tomadas y las acciones con nuestros operadores logísticos',	1,	5),
(13,	'00.6',	'Conforme Cliente',	'El fin de la negoción debe quedar clara, habiéndo resuelto toda duda del cliente',	'No necesita documentarse si no requiere acciones de otros técnicos.',	1,	4),
(14,	'01.5',	'Luz verde a Ejecución',	'Se da luz verde a inicio de obras, considerando acciones futuras como resolubles en tiempo por no haber acciones críticas pendientes',	'Se comunicará también verbalmente',	1,	5),
(15,	'02.11',	'Compras críticas',	'Se iniciarán aquellas compras o acopios que puedan ocasionar retrasos si no se toman a tiempo',	'Se registran los pedidos y los portes. No se registran aquí los medios auxiliares de descarga.',	1,	6),
(16,	'02.21',	'PRL Analisis PSS',	'Redacción del plan de seguridad y salud',	'Se registra el plan y las deliveraciones entre técnicos',	1,	7),
(17,	'02.22',	'PRL Evaluacion de subcontratas',	'Evaluación de la PRL de los medios subcontratados',	'Se registran la documentación y las comunicaciones',	1,	7),
(18,	'02.24',	'PRL Coord. Cliente',	'Nombramientos de coordinador PRL del cliente. Aprobación del plan',	'Se registran los nombramientos y la aprobación por parte del cliente',	1,	7),
(19,	'03.2',	'Permiso de obra',	'Obtención de permisos de obra',	'Documentar las comunicaciones',	1,	8),
(20,	'03.3',	'Permiso de ocupacion',	'Obtención de permisos de ocupación',	'Documentar las comunicaciones',	1,	8),
(21,	'03.1',	'Planificación de obra',	'Planificación de la obra, con fechas de inicio y final',	'Documentar en excel de planificación, documentar los cambios como anotación',	1,	8),
(22,	'04.1',	'Ejecución de obra',	'Ejecución de la obra, real con fechas de inicio y final',	'Documentar los cambios como anotación. documentar los empleados asignados y sus fechas',	1,	9),
(23,	'04.2',	'Ampliaciones de obra',	'Ampliaciones de obra que surjan, como instalación de líneas de vida permanentes',	'Consultar si están en contrato. Especificar en anotación',	1,	9),
(24,	'04.5',	'Fin de obra',	'Decretar fin de la obra (y sus ampliaciones) tras chequeo de las partidas y acciones',	'Anotar la fecha',	1,	9),
(25,	'05.1',	'Protocolo de fin de obra',	'Cumplimentación del protocolo de fin de obra, con operarios',	'Adjuntar informe, comunicar a Proyectos',	1,	10),
(26,	'05.2',	'Listado de n. serie placas',	'Anotar los números de serie de placas u otros elementos cuando sea necesario',	'Archivar y comunicar a Legalizaciones',	1,	10),
(27,	'04.42',	'Comunicaciones a cliente',	'Comunicar al cliente la aplicación de supervisión de la planta y sus ajustes, si proceden',	'Anotar la fecha',	1,	9),
(28,	'05.4',	'Certificado de fin de obra',	'Certificado de fin de obra',	'Archivar en su sitio, comunicar',	1,	10),
(29,	'04.3',	'Certificaciones',	'Certificaciones',	'Anotar como 04.3X en anotación, indicando concepto (\'mensual\', \'acopio\', etc..) y fecha',	1,	9),
(30,	'00.34',	'Aprobación de la oferta ',	'Aprobación de la oferta al Cliente por el Departamento Comercial, entrega al Cliente',	'No necesita documentarse. Las comunicaciones al Cliente son confidenciales en esta acción',	1,	3),
(31,	'01.3',	'Permisos Especiales',	'La obra puede requerir permisos especiales que tarden en resolverse. Esta acción finaliza cuando esté aprobada o se decida que no es necesaria',	'El técnico debe preguntar a la administración local al tramitar los permisos ordinarios',	1,	5),
(32,	'02.12',	'Compras en general',	'Compras de material de obra',	'Se registran los pedidos y albaranes.',	1,	6),
(33,	'02.13',	'Contratac. Medios aux.',	'Alquiler de medios auxiliares de carga, izado, andamios o plataformas',	'Se registran los pedidos.',	1,	6),
(34,	'02.25',	'PRL Responsable en obra',	'Nombramiento de nuestro responsable en obra',	'Se registran los nombramientos',	1,	7),
(35,	'02.26',	'PRL Seguimiento',	'Seguimientos de acciones de PRL',	'Se registran incidencias o quejas',	1,	7),
(36,	'04.41',	'Puesta en Marcha',	'Puesta en marcha de la instalación. Pruebas, ajustes',	'Anotar las incidencias posibles',	1,	9),
(37,	'05.3',	'Visado de Proyecto',	'Visado de proyecto, si no lo está aún',	'Archivar en su sitio, comunicar',	1,	10),
(38,	'02.14',	'Subcontratación',	'Se define la relación y el contrato con las empresas subcontratadas.',	'Documentar las comunicaciones y las negociaciones',	1,	6),
(39,	'02.23',	'PRL Eval. de medios mecánicos',	'Se requiere documentación a las empresas proveedoras de plataformas, medios de izado de cargas, etc..',	'Documentar comunicaciones.',	1,	7),
(40,	'01.6',	'Luz verde a subcontratacion',	NULL,	NULL,	1,	5),
(41,	'00.35',	'Aprobación de ampliaciones',	NULL,	NULL,	0,	3);

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
(1,	6,	'Admin',	'admin@gmail.com',	'$2y$10$Jd/EFQ9C4rJAp2hveagApOkl/nlO00vsfAOi0keJVRG89rDLI12eK',	'2023-05-13 05:23:35',	'2023-05-15 00:39:44',	1),
(2,	1,	'Julian',	'admin2@gmail.com',	'$2y$10$IlfMO5h6flgCLXDQaXAwpuL1bLZR5Ae5AR0IIosWFUx95Xm/IxcJm',	'2023-05-14 20:21:54',	'2023-05-14 22:34:26',	1),
(3,	2,	'Aurelio',	'user@gmail.com',	'$2y$10$6DtB5cLHSr8ftglmzAGquuYDveEQ1UlJqxHUbji9z9NEnO/eCsFUe',	'2023-05-14 20:22:30',	'2023-05-15 09:17:22',	0);

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

INSERT INTO `valores` (`id`, `parametro_id`, `proyecto_id`, `valor`, `siguiente`) VALUES
(48,	1,	2,	'[Completar]',	'0'),
(49,	2,	2,	'[Completar]',	'0'),
(52,	5,	2,	'[Completar]',	'0'),
(53,	6,	2,	'[Completar]',	'0'),
(54,	7,	2,	'[Completar]',	'0'),
(55,	8,	2,	'[Completar]',	'0'),
(56,	3,	2,	'[Completar]',	'0'),
(57,	4,	2,	'[Completar]',	'0');

-- 2023-05-15 20:09:00
