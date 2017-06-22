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
DROP TABLE IF EXISTS `cachuelapp`.`usuario` ;

CREATE TABLE IF NOT EXISTS `cachuelapp`.`usuario` (
  `codUsuario` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `usuario` VARCHAR(45) NOT NULL COMMENT '',
  `clave` VARCHAR(100) NOT NULL COMMENT '',
  `nombres` VARCHAR(45) NULL COMMENT '',
  `primerApellido` VARCHAR(45) NULL COMMENT '',
  `segundoApellido` VARCHAR(45) NULL COMMENT '',
  `numeroDNI` VARCHAR(8) NOT NULL COMMENT '',
  `imagenDNI` VARCHAR(45) NULL COMMENT '',
  `enlaceFacebook` VARCHAR(45) NULL COMMENT '',
  `fechaNacimiento` DATE NULL COMMENT '',
  `correo` VARCHAR(45) NOT NULL COMMENT '',
  `celular` VARCHAR(9) NOT NULL COMMENT '',
  `direccion` VARCHAR(45) NULL COMMENT '',
  `distrito` VARCHAR(45) NULL COMMENT '',
  `departamento` VARCHAR(45) NULL COMMENT '',
  `provincia` VARCHAR(45) NULL COMMENT '',
  `imagenPerfil` VARCHAR(200) NULL COMMENT '',
  `imagenAdicional` VARCHAR(200) NULL COMMENT '',
  PRIMARY KEY (`codUsuario`)  COMMENT '',
  UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC)  COMMENT '',
  UNIQUE INDEX `correo_UNIQUE` (`correo` ASC)  COMMENT '',
  UNIQUE INDEX `celular_UNIQUE` (`celular` ASC)  COMMENT '',
  UNIQUE INDEX `numeroDNI_UNIQUE` (`numeroDNI` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cachuelapp`.`empleo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cachuelapp`.`empleo` ;

CREATE TABLE IF NOT EXISTS `cachuelapp`.`empleo` (
  `codEmpleo` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `titulo` VARCHAR(200) NOT NULL COMMENT '',
  `descripcion` VARCHAR(2000) NOT NULL COMMENT '',
  `remuneracion` DECIMAL NOT NULL COMMENT '',
  `fechaCreacion` DATETIME NULL COMMENT '',
  `horas` VARCHAR(3) NULL COMMENT '',
  `categoria` ENUM('PetLovers', 'Creativos', 'MilOficios') NULL COMMENT '',
  `etiquetas` VARCHAR(500) NULL COMMENT '',
  PRIMARY KEY (`codEmpleo`)  COMMENT '')
PACK_KEYS = DEFAULT;


-- -----------------------------------------------------
-- Table `cachuelapp`.`interaccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cachuelapp`.`interaccion` ;

CREATE TABLE IF NOT EXISTS `cachuelapp`.`interaccion` (
  `codInteracion` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `codUsuario` INT NULL COMMENT '',
  `codEmpleo` INT NULL COMMENT '',
  `estado` ENUM('Publico', 'Postulo') NULL COMMENT '',
  PRIMARY KEY (`codInteracion`)  COMMENT '',
  INDEX `fk_usuario_has_empleo_empleo1_idx` (`codEmpleo` ASC)  COMMENT '',
  INDEX `fk_usuario_has_empleo_usuario_idx` (`codUsuario` ASC)  COMMENT '',
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
