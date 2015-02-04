SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `pride_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `pride_db` ;

-- -----------------------------------------------------
-- Table `pride_db`.`administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pride_db`.`administrador` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rfc` VARCHAR(14) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apaterno` VARCHAR(45) NOT NULL,
  `amaterno` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`, `rfc`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pride_db`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pride_db`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rfc` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apaterno` VARCHAR(45) NOT NULL,
  `amaterno` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`, `rfc`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pride_db`.`periodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pride_db`.`periodo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `periodo` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pride_db`.`comision`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pride_db`.`comision` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comision` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pride_db`.`evaluador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pride_db`.`evaluador` (
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  CONSTRAINT `id_usuario`
    FOREIGN KEY (`id`)
    REFERENCES `pride_db`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_periodo`
    FOREIGN KEY (`id`)
    REFERENCES `pride_db`.`periodo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_comision`
    FOREIGN KEY (`id`)
    REFERENCES `pride_db`.`comision` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pride_db`.`evaluado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pride_db`.`evaluado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  CONSTRAINT `id_usuario`
    FOREIGN KEY (`id`)
    REFERENCES `pride_db`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_periodo`
    FOREIGN KEY (`id`)
    REFERENCES `pride_db`.`periodo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_comision`
    FOREIGN KEY (`id`)
    REFERENCES `pride_db`.`comision` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pride_db`.`evaluador_evaluado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pride_db`.`evaluador_evaluado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  CONSTRAINT `id_evaluador`
    FOREIGN KEY (`id`)
    REFERENCES `pride_db`.`evaluador` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_evaluado`
    FOREIGN KEY (`id`)
    REFERENCES `pride_db`.`evaluado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
