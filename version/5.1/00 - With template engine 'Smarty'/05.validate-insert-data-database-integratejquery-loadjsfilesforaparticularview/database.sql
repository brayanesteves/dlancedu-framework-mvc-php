CREATE DATABASE IF NOT EXISTS `mvc`;

USE `mvc`;

CREATE TABLE IF NOT EXISTS `mvc`.`posts` (
    `id`     INT(255)     NOT NULL AUTO_INCREMENT COMMENT '',
    `titulo` VARCHAR(150) NOT NULL                COMMENT '',
    `cuerpo` TEXT                                 COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE='InnoDB' DEFAULT CHARSET='utf8' COLLATE='utf8_bin' COMMENT='';