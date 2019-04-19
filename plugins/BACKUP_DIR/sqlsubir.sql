CREATE DATABASE IF NOT EXISTS `esxstable`;

USE esxstable;

DROP TABLE IF EXISTS `panel_estadisticas_servers`;

CREATE TABLE `panel_estadisticas_servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servidor` int(11) NOT NULL,
  `usuarios` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

