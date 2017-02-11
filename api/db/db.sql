-- MySQL Script generated by MySQL Workbench
-- 02/06/17 14:40:49
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema fyw
-- -----------------------------------------------------


DROP SCHEMA IF EXISTS `fyw`; 

-- -----------------------------------------------------
-- Schema fyw
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `fyw` DEFAULT CHARACTER SET utf8 ;
USE `fyw` ;

-- -----------------------------------------------------
-- Table `fyw`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fyw`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `last_name` VARCHAR(255) NULL,
  `first_name` VARCHAR(255) NULL,
  `username` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fyw`.`place`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fyw`.`place` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(25) NOT NULL, 
  `lng` VARCHAR(255) NOT NULL,
  `type_indication` ENUM('text','url'),
  `lat` VARCHAR(255) NOT NULL,
  `indication` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fyw`.`destination`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fyw`.`destination` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(25) NOT NULL, 
  `lng` VARCHAR(255) NOT NULL,
  `lat` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fyw`.`hint`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fyw`.`hint` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `value` VARCHAR(255) NULL,
  `type` ENUM('text','url'),
  `id_destination` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_dest_idx` (`id_destination` ASC),
  CONSTRAINT `id_dest`
    FOREIGN KEY (`id_destination`)
    REFERENCES `fyw`.`destination` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fyw`.`level`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fyw`.`level` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL UNIQUE,
  `max_attempts` VARCHAR(255) NULL,
  `distance` VARCHAR(255) NOT NULL,
  `time` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fyw`.`game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fyw`.`game` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pseudo` VARCHAR(255) NULL,
  `token` VARCHAR(255) NULL,
  `score` VARCHAR(255) NULL,
  `state` INT NULL DEFAULT 0,
  `duration` VARCHAR(255) NULL,
  `id_level` INT NULL,
  `id_destination` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_level_idx` (`id_level` ASC),
  INDEX `id_destination_idx` (`id_destination` ASC),
  CONSTRAINT `id_level`
    FOREIGN KEY (`id_level`)
    REFERENCES `fyw`.`level` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_destination`
    FOREIGN KEY (`id_destination`)
    REFERENCES `fyw`.`destination` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fyw`.`place_game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fyw`.`place_game` (
  `id_place` INT NOT NULL,
  `id_game` INT NOT NULL,
  PRIMARY KEY (`id_place`, `id_game`),
  INDEX `id_partie_idx` (`id_game` ASC),
  CONSTRAINT `id_place`
    FOREIGN KEY (`id_place`)
    REFERENCES `fyw`.`place` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_game`
    FOREIGN KEY (`id_game`)
    REFERENCES `fyw`.`game` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


insert into place(name,lat, lng, indication) 
		values ('Paris','48.862725','2.287592000000018','La ville lumière'),
        ('Metz','49.1193089','6.1757155999999895','Capitale de la Lorraine'),
        ('Château de Versailles','48.804865','2.120355','Elle fut la résidence de Louis XIV'),
        ('Belfort','47.639674','6.863849','Monument du lion'),
        ('Dijon','47.322047','5.041479999999979','La moutarde');

INSERT INTO `destination` (`id`, `name`, `lng`, `lat`) VALUES (NULL, 'Toulouse', '1.450488', '43.607489');
INSERT INTO `destination` (`id`, `name`, `lng`, `lat`) VALUES (NULL, 'Le havre', '0.121646', '49.527592');
INSERT INTO `destination` (`id`, `name`, `lng`, `lat`) VALUES (NULL, 'Le Mont Saint Michel','-1.5120517','48.6360033');                                           
INSERT INTO `destination` (`id`, `name`, `lng`, `lat`) VALUES (NULL, 'Disneyland Paris','2.7736192','48.8722344');


INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Commune du du Sud-Ouest de France', 'text', '1');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Basilique Saint-Sernin', 'text', '1');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Université Paul Sabatier', 'text', '1');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'La ville rose', 'text', '1');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'la quatrième commune la plus peuplée de France', 'text', '1');


INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Située sur la rive droite de l''estuaire de la Seine', 'text', '2');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Le premier port français pour les conteneurs.', 'text', '2');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Musée d''art moderne André-Malraux', 'text', '2');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Saint Thomas Basket', 'text', '2');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'img/blason_le_havre.png', 'url', '2');

INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Une montagne circulaire qui semble s’affaisser sous la pyramide monumentale qui la couronne', 'text', '3');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Le site touristique le plus fréquenté de Normandie', 'text', '3');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Montois', 'text', '3');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Normandie', 'text', '3');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Rattaché depuis l\'époque de Charlemagne au diocèse d\'Avranches', 'text', '3');

INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'complexe touristique et urbain ', 'text', '4');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'img/Mickey_Mouse.png', 'url', '4');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'img/Walt_Disney.JPG', 'url', '4');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'attraction', 'text', '4');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Le Château de la Belle au bois dormant,', 'text', '4');

INSERT INTO `place` (`id`,`name`, `lng`, `lat`, `indication`) VALUES
(NULL, 'Nice', '7.266555', '43.716896', 'Château de Valrose'),
(NULL, 'Strasbourg', '7.753173', '48.580887', 'Palais Rohan'),
(NULL, 'Le Havre', '0.103315', '49.485045', 'Musée d''art moderne André Malraux'),
(NULL, 'Limoges', '1.265599', '45.860447', 'Parc de l''Aurence'),
(NULL, 'Dijon', '5.069667', '47.311461', 'Université de Bourgogne'),
(NULL, 'Lille', '3.069648', '50.640208', 'Notre Dame de la Treille'),
(NULL, 'Calais', '1.865608', '50.966423', 'Port de Calais');
INSERT INTO `place`(`name`, `lng`, `lat`, `indication`) VALUES  
('Le Mont-Saint-Michel','-1.5462265','48.6244853','Située dans le département de la Manche en Normandie'),
('Côte d\'Azur','5.3996418','43.3840896','Entre Beaulieu-sur-Mer et Cap-d''Ail');


INSERT INTO `level` (`id`,`name`, `max_attempts`, `distance`, `time`) VALUES (NULL,'Facile', '20', '100000', '1000');
INSERT INTO `level` (`id`,`name`, `max_attempts`, `distance`, `time`) VALUES (NULL,'Moyen', '20', '50000', '500');
INSERT INTO `level` (`id`,`name`, `max_attempts`, `distance`, `time`) VALUES (NULL,'Difficile', '20', '25000', '100');

INSERT INTO `user` (`id`,`last_name`,`first_name`,`username`,`password`) VALUES (NULL, 'admin','admin','admin','$2y$10$SsU7iJDcBVD3rqRzBBIXA.OYKSCYXScsxvuBMckBYEMNYHHbTuEMu');