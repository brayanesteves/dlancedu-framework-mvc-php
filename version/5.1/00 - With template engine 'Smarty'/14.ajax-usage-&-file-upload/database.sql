CREATE DATABASE IF NOT EXISTS `mvc`;

USE `mvc`;

CREATE TABLE IF NOT EXISTS `mvc`.`posts` (
    `id`     INT(255)     NOT NULL AUTO_INCREMENT COMMENT '',
    `titulo` VARCHAR(150) NOT NULL                COMMENT '',
    `cuerpo` TEXT                                 COMMENT '',
    `imagen` VARCHAR(100)                         COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

ALTER TABLE `posts` ADD `imagen` VARCHAR(100);

CREATE TABLE IF NOT EXISTS `mvc`.`usuarios` (
    `id`      INT    (255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
    `nombre`  VARCHAR(100)          NOT NULL                COMMENT '',
    `usuario` VARCHAR(30)           NOT NULL                COMMENT '',
    `pass`    VARCHAR(40)           NOT NULL                COMMENT '',
    `email`   VARCHAR(100)          NOT NULL                COMMENT '',
    `role`    ENUM   ("admin", "especial", "usuario")       COMMENT '',
    `estado`  TINYINT(4),
    `fecha`   DATETIME              NOT NULL                COMMENT '',
    `codigo`  INT    (10) UNSIGNED  NOT NULL UNIQUE         COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

-- Contraseña encriptada con MD5  y la contraseña es 1234
INSERT INTO `usuarios` VALUES(null, 'nombre1', 'admin', '81dc9bdb52d04dc20036db8313ed055', 'admin@admin.adm', 'admin', 1);
-- Contraseña encriptada con 'getHash' de 'Hash.php' con 'sha1' con clave '4f6a6d832be79' que es de la constante 'HASH_KEY' y la contraseña es 1234
UPDATE `usuarios` SET `pass` = 'd1b254c9620425f582e27f0044be34bee087d8b4' WHERE `id` = 1;
ALTER TABLE `usuarios` ADD `fecha` DATETIME NOT NULL;
ALTER TABLE `usuarios` ADD `codigo` INT(10) UNSIGNED NOT NULL, ADD UNIQUE(`codigo`);

CREATE TABLE IF NOT EXISTS `mvc`.`prueba` (
    `id`      INT    (255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
    `nombre`  VARCHAR(100)          NOT NULL                COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

CREATE TABLE IF NOT EXISTS `mvc`.`paises` (
    `id`   INT    (255) PRIMARY KEY AUTO_INCREMENT COMMENT '',
    `pais` VARCHAR(100)                            COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

INSERT INTO `paises` VALUES (null, 'Rep. Dominicana');
INSERT INTO `paises` VALUES (null, 'España');

CREATE TABLE IF NOT EXISTS `mvc`.`ciudades` (
    `id`     INT    (255)PRIMARY KEY AUTO_INCREMENT COMMENT '',
    `ciudad` VARCHAR(100)                           COMMENT '',
    `pais`   INT    (11)                            COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

INSERT INTO `ciudades` VALUES (null, 'Santo Domingo', 1);
INSERT INTO `ciudades` VALUES (null, 'Cartagena', 2);