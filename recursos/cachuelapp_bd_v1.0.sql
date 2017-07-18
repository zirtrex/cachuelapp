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
-- Table `cachuelapp`.`ubicacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cachuelapp`.`ubicacion` ;

CREATE TABLE IF NOT EXISTS `cachuelapp`.`ubicacion` (
  `codUbicacion` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `direccion` VARCHAR(45) NOT NULL COMMENT '',
  `distrito` VARCHAR(45) NULL COMMENT '',
  `provincia` VARCHAR(45) NULL COMMENT '',
  `departamento` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`codUbicacion`)  COMMENT '')
ENGINE = InnoDB;


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
  `imagenPerfil` VARCHAR(200) NULL COMMENT '',
  `imagenAdicional` VARCHAR(200) NULL COMMENT '',
  `fechaRegistro` DATETIME NOT NULL COMMENT '',
  `tokenRegistro` VARCHAR(100) NOT NULL COMMENT '',
  `correoConfirmado` ENUM('1', '0') NOT NULL DEFAULT '0' COMMENT '',
  `codUbicacion` INT NOT NULL COMMENT '',
  PRIMARY KEY (`codUsuario`)  COMMENT '',
  CONSTRAINT `fk_usuario_ubicacion1`
    FOREIGN KEY (`codUbicacion`)
    REFERENCES `cachuelapp`.`ubicacion` (`codUbicacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `usuario_UNIQUE` ON `cachuelapp`.`usuario` (`usuario` ASC)  COMMENT '';

CREATE UNIQUE INDEX `correo_UNIQUE` ON `cachuelapp`.`usuario` (`correo` ASC)  COMMENT '';

CREATE UNIQUE INDEX `celular_UNIQUE` ON `cachuelapp`.`usuario` (`celular` ASC)  COMMENT '';

CREATE UNIQUE INDEX `numeroDNI_UNIQUE` ON `cachuelapp`.`usuario` (`numeroDNI` ASC)  COMMENT '';

CREATE INDEX `fk_usuario_ubicacion1_idx` ON `cachuelapp`.`usuario` (`codUbicacion` ASC)  COMMENT '';


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
  `codUbicacion` INT NOT NULL COMMENT '',
  PRIMARY KEY (`codEmpleo`)  COMMENT '',
  CONSTRAINT `fk_empleo_ubicacion1`
    FOREIGN KEY (`codUbicacion`)
    REFERENCES `cachuelapp`.`ubicacion` (`codUbicacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = DEFAULT;

CREATE INDEX `fk_empleo_ubicacion1_idx` ON `cachuelapp`.`empleo` (`codUbicacion` ASC)  COMMENT '';


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

CREATE INDEX `fk_usuario_has_empleo_empleo1_idx` ON `cachuelapp`.`interaccion` (`codEmpleo` ASC)  COMMENT '';

CREATE INDEX `fk_usuario_has_empleo_usuario_idx` ON `cachuelapp`.`interaccion` (`codUsuario` ASC)  COMMENT '';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `cachuelapp`.`ubicacion`
-- -----------------------------------------------------
START TRANSACTION;
USE `cachuelapp`;
INSERT INTO `cachuelapp`.`ubicacion` (`codUbicacion`, `direccion`, `distrito`, `provincia`, `departamento`) VALUES (DEFAULT, 'Jr. Progreso S/N', 'Sunampe', 'Chincha', 'Ica');

COMMIT;


-- -----------------------------------------------------
-- Data for table `cachuelapp`.`usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `cachuelapp`;
INSERT INTO `cachuelapp`.`usuario` (`codUsuario`, `usuario`, `clave`, `nombres`, `primerApellido`, `segundoApellido`, `numeroDNI`, `imagenDNI`, `enlaceFacebook`, `fechaNacimiento`, `correo`, `celular`, `imagenPerfil`, `imagenAdicional`, `fechaRegistro`, `tokenRegistro`, `correoConfirmado`, `codUbicacion`) VALUES (DEFAULT, 'zirtrex', 'zirtrex', 'Rafael', 'Contreras', 'Martinez', '47623721', NULL, '/r.zirtrex', '1991-05-21', 'zirtrex@live.com', '966102508', NULL, NULL, DEFAULT, DEFAULT, DEFAULT, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `cachuelapp`.`empleo`
-- -----------------------------------------------------
START TRANSACTION;
USE `cachuelapp`;
INSERT INTO `cachuelapp`.`empleo` (`codEmpleo`, `titulo`, `descripcion`, `remuneracion`, `fechaCreacion`, `horas`, `categoria`, `etiquetas`, `codUbicacion`) VALUES (DEFAULT, 'Cuidar a mis perritos', 'Cuidar perritos por algunas horas', 20.00, NULL, NULL, 'PetLovers', NULL, 1);
INSERT INTO `cachuelapp`.`empleo` (`codEmpleo`, `titulo`, `descripcion`, `remuneracion`, `fechaCreacion`, `horas`, `categoria`, `etiquetas`, `codUbicacion`) VALUES (DEFAULT, 'Diseñar un logo', 'Diseñar un logo para mi negocio familiar', 50.00, NULL, NULL, 'Creativos', NULL, 1);
INSERT INTO `cachuelapp`.`empleo` (`codEmpleo`, `titulo`, `descripcion`, `remuneracion`, `fechaCreacion`, `horas`, `categoria`, `etiquetas`, `codUbicacion`) VALUES (DEFAULT, 'Pintar mi casa', 'Pintar mi casa de color verder', 40.00, NULL, NULL, 'MilOficios', NULL, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `cachuelapp`.`interaccion`
-- -----------------------------------------------------
START TRANSACTION;
USE `cachuelapp`;
INSERT INTO `cachuelapp`.`interaccion` (`codInteracion`, `codUsuario`, `codEmpleo`, `estado`) VALUES (DEFAULT, 1, 1, 'Publico');
INSERT INTO `cachuelapp`.`interaccion` (`codInteracion`, `codUsuario`, `codEmpleo`, `estado`) VALUES (DEFAULT, 1, 2, 'Publico');
INSERT INTO `cachuelapp`.`interaccion` (`codInteracion`, `codUsuario`, `codEmpleo`, `estado`) VALUES (DEFAULT, 1, 3, 'Publico');

COMMIT;

