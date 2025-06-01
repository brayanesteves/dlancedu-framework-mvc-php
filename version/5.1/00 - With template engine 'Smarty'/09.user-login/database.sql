CREATE DATABASE IF NOT EXISTS `mvc`;

USE `mvc`;

CREATE TABLE IF NOT EXISTS `mvc`.`posts` (
    `id`     INT(255)     NOT NULL AUTO_INCREMENT COMMENT '',
    `titulo` VARCHAR(150) NOT NULL                COMMENT '',
    `cuerpo` TEXT                                 COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

CREATE TABLE IF NOT EXISTS `mvc`.`usuarios` (
    `id`      INT    (255) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
    `nombre`  VARCHAR(100)          NOT NULL                COMMENT '',
    `usuario` VARCHAR(30)           NOT NULL                COMMENT '',
    `pass`    VARCHAR(40)           NOT NULL                COMMENT '',
    `email`   VARCHAR(100)          NOT NULL                COMMENT '',
    `role`    ENUM   ("admin", "especial", "usuario")       COMMENT '',
    `estado`  TINYINT
    PRIMARY KEY (`id`)
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';

INSERT INTO `usuarios` VALUES(null, 'nombre1', 'admin', '81dc9bdb52d04dc20036db8313ed055', 'admin@admin.adm', 'admin', 1);