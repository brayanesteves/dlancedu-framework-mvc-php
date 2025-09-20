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

-- Tabla de usuarios anterior sin la implementación de ACL
CREATE TABLE IF NOT EXISTS `mvc`.`usuarios_not_acl` (
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

ALTER TABLE `usuarios_not_acl` CHANGE `role` `role` INT NOT NULL;

-- Tabla de usuarios anterior sin la implementación de ACL
CREATE TABLE IF NOT EXISTS `mvc`.`usuarios` (
    `id`      INT    (255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
    `nombre`  VARCHAR(100)          NOT NULL                COMMENT '',
    `usuario` VARCHAR(30)           NOT NULL                COMMENT '',
    `pass`    VARCHAR(40)           NOT NULL                COMMENT '',
    `email`   VARCHAR(100)          NOT NULL                COMMENT '',
    `role`    INT    (11)                                   COMMENT '',
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
    `pais` VARCHAR(100)                            COMMENT ''
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

INSERT INTO `paises` VALUES (null, 'Rep. Dominicana');
INSERT INTO `paises` VALUES (null, 'España');

CREATE TABLE IF NOT EXISTS `mvc`.`ciudades` (
    `id`     INT    (255) PRIMARY KEY AUTO_INCREMENT COMMENT '',
    `ciudad` VARCHAR(100)                            COMMENT '',
    `pais`   INT    (11)                             COMMENT ''
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

INSERT INTO `ciudades` VALUES (null, 'Santo Domingo', 1);
INSERT INTO `ciudades` VALUES (null, 'Cartagena', 2);

CREATE TABLE IF NOT EXISTS `mvc`.`roles` (
    `id_role` INT    (255) PRIMARY KEY          AUTO_INCREMENT COMMENT '',
    `role`    VARCHAR(100)             NOT NULL                COMMENT ''
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

INSERT INTO `roles` VALUES (null, 'Administrador');
INSERT INTO `roles` VALUES (null, 'Gestor');
INSERT INTO `roles` VALUES (null, 'Editor');

CREATE TABLE IF NOT EXISTS `mvc`.`permisos` (
    `id_permiso` INT    (255) PRIMARY KEY          AUTO_INCREMENT COMMENT '',
    `permiso`    VARCHAR(100)             NOT NULL                COMMENT '',
    `key`        VARCHAR(100)             NOT NULL                COMMENT ''
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

INSERT INTO `permisos` VALUES (null, 'Tareas de administracion', 'admin_access');
INSERT INTO `permisos` VALUES (null, 'Agregar Posts', 'nuevo_post');
INSERT INTO `permisos` VALUES (null, 'Editar Posts', 'editar_access');
INSERT INTO `permisos` VALUES (null, 'Eliminar Posts', 'eliminar_access');

CREATE TABLE IF NOT EXISTS `mvc`.`permisos_role` (
    `role`     INT    (255) NOT NULL COMMENT '',
    `permiso` INT    (100) NOT NULL COMMENT '',
    `valor`    TINYINT      NOT NULL COMMENT ''
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

ALTER TABLE `permisos_role` ADD UNIQUE `role`(`role`, `permiso`);
ALTER TABLE `permisos_role` CHANGE `permiso` IN NOT NULL;

INSERT INTO `permisos_role` VALUES (1, 1, 1);
INSERT INTO `permisos_role` VALUES (1, 2, 1);
INSERT INTO `permisos_role` VALUES (1, 3, 1);
INSERT INTO `permisos_role` VALUES (1, 4, 1);
INSERT INTO `permisos_role` VALUES (2, 2, 1);
INSERT INTO `permisos_role` VALUES (2, 3, 1);
INSERT INTO `permisos_role` VALUES (2, 4, 1);
INSERT INTO `permisos_role` VALUES (3, 2, 1);
INSERT INTO `permisos_role` VALUES (3, 3, 1);

SELECT `r`.`role`, `p`.`permiso`, `pr`.`valor` FROM `roles` AS `r`, `permisos` AS `p`, `permisos_role` AS `pr` WHERE `pr`.`role` = `r`.`id_role` AND `pr`.`permiso` = `p`.`id_permiso` ORDER BY `pr`.`role`;

CREATE TABLE IF NOT EXISTS `mvc`.`permisos_usuario` (
    `usuario`  INT    (255) NOT NULL COMMENT '',
    `permisos` INT    (100) NOT NULL COMMENT '',
    `valor`    TINYINT      NOT NULL COMMENT '',
    UNIQUE KEY `usuario`(`usuario`, `permiso`)
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

INSERT INTO `permisos_usuario` VALUES (1, 2, 0);
INSERT INTO `permisos_usuario` VALUES (1, 3, 0);