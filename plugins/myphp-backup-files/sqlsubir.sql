CREATE DATABASE IF NOT EXISTS `esxstable`;

USE esxstable;

DROP TABLE IF EXISTS `panel_servers`;

CREATE TABLE `panel_servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `ip` text NOT NULL,
  `puerto` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `panel_servers` VALUES("1","#1 WhiteList","149.202.86.121","30155");
INSERT INTO `panel_servers` VALUES("2","#1 No WhiteList","149.202.86.121","30120");
INSERT INTO `panel_servers` VALUES("3","#2 No WhiteList","149.202.86.121","30125");
INSERT INTO `panel_servers` VALUES("4","#3 No WhiteList","149.202.86.121","30130");
INSERT INTO `panel_servers` VALUES("5","#4 No WhiteList","149.202.86.121","30135");
INSERT INTO `panel_servers` VALUES("6","#5 No WhiteList","149.202.86.121","30140");
INSERT INTO `panel_servers` VALUES("7","#6 No WhiteList","149.202.86.121","30145");
INSERT INTO `panel_servers` VALUES("8","#7 No WhiteList","149.202.86.121","30150");
