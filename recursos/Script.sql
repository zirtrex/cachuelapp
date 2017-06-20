-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema cachuelapp
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cachuelapp
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cachuelapp` ;
USE `cachuelapp` ;

-- -----------------------------------------------------
-- Table `cachuelapp`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cachuelapp`.`usuario` (
  `codUsuario` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(45) NOT NULL,
  `clave` VARCHAR(100) NOT NULL,
  `nombres` VARCHAR(45) NULL,
  `primerApellido` VARCHAR(45) NULL,
  `segundoApellido` VARCHAR(45) NULL,
  `numeroDNI` VARCHAR(8) NOT NULL,
  `imagenDNI` VARCHAR(45) NULL,
  `enlaceFacebook` VARCHAR(45) NULL,
  `correo` VARCHAR(45) NOT NULL,
  `celular` VARCHAR(9) NOT NULL,
  `direccion` VARCHAR(45) NULL,
  `distrito` VARCHAR(45) NULL,
  `departamento` VARCHAR(45) NULL,
  `provincia` VARCHAR(45) NULL,
  `imagenPerfil` VARCHAR(200) NULL,
  `imagenAdicional` VARCHAR(200) NULL,
  PRIMARY KEY (`codUsuario`),
  UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC),
  UNIQUE INDEX `correo_UNIQUE` (`correo` ASC),
  UNIQUE INDEX `celular_UNIQUE` (`celular` ASC),
  UNIQUE INDEX `numeroDNI_UNIQUE` (`numeroDNI` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cachuelapp`.`empleo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cachuelapp`.`empleo` (
  `codEmpleo` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(200) NOT NULL,
  `descripcion` VARCHAR(2000) NOT NULL,
  `remuneracion` DECIMAL NOT NULL,
  `horas` VARCHAR(3) NULL,
  `categoria` ENUM('PetLovers', 'Creativos', 'MilOficios') NULL,
  `etiquetas` VARCHAR(500) NULL,
  PRIMARY KEY (`codEmpleo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cachuelapp`.`interaccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cachuelapp`.`interaccion` (
  `codInteracion` INT NOT NULL AUTO_INCREMENT,
  `codUsuario` INT NULL,
  `codEmpleo` INT NULL,
  `estado` ENUM('Publico', 'Postulo') NULL,
  PRIMARY KEY (`codInteracion`),
  INDEX `fk_usuario_has_empleo_empleo1_idx` (`codEmpleo` ASC),
  INDEX `fk_usuario_has_empleo_usuario_idx` (`codUsuario` ASC),
  CONSTRAINT `fk_usuario_has_empleo_usuario`
    FOREIGN KEY (`codUsuario`)
    REFERENCES `cachuelapp`.`usuario` (`codUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_empleo_empleo1`
    FOREIGN KEY (`codEmpleo`)
    REFERENCES `cachuelapp`.`empleo` (`codEmpleo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
