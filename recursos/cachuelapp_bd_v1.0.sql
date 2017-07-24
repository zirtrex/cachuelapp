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
  `codUbicacion` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
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
  `codUsuario` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `rol` ENUM('admin', 'user') NOT NULL COMMENT '',
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
  `codUbicacion` INT NULL COMMENT '',
  PRIMARY KEY (`codUsuario`)  COMMENT '',
  UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC)  COMMENT '',
  UNIQUE INDEX `correo_UNIQUE` (`correo` ASC)  COMMENT '',
  UNIQUE INDEX `celular_UNIQUE` (`celular` ASC)  COMMENT '',
  UNIQUE INDEX `numeroDNI_UNIQUE` (`numeroDNI` ASC)  COMMENT '',
  INDEX `fk_usuario_ubicacion1_idx` (`codUbicacion` ASC)  COMMENT '',
  CONSTRAINT `fk_usuario_ubicacion1`
    FOREIGN KEY (`codUbicacion`)
    REFERENCES `cachuelapp`.`ubicacion` (`codUbicacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cachuelapp`.`empleo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cachuelapp`.`empleo` ;

CREATE TABLE IF NOT EXISTS `cachuelapp`.`empleo` (
  `codEmpleo` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `titulo` VARCHAR(200) NOT NULL COMMENT '',
  `descripcion` VARCHAR(2000) NOT NULL COMMENT '',
  `remuneracion` DECIMAL NOT NULL COMMENT '',
  `fechaCreacion` DATETIME NULL COMMENT '',
  `horas` VARCHAR(3) NULL COMMENT '',
  `categoria` ENUM('PetLovers', 'Creativos', 'MilOficios') NULL COMMENT '',
  `etiquetas` VARCHAR(500) NULL COMMENT '',
  `codUbicacion` INT NULL COMMENT '',
  PRIMARY KEY (`codEmpleo`)  COMMENT '',
  INDEX `fk_empleo_ubicacion1_idx` (`codUbicacion` ASC)  COMMENT '',
  CONSTRAINT `fk_empleo_ubicacion1`
    FOREIGN KEY (`codUbicacion`)
    REFERENCES `cachuelapp`.`ubicacion` (`codUbicacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cachuelapp`.`interaccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cachuelapp`.`interaccion` ;

CREATE TABLE IF NOT EXISTS `cachuelapp`.`interaccion` (
  `codInteracion` DATETIME NULL COMMENT '',
  `codUsuario` INT(11) NOT NULL COMMENT '',
  `codEmpleo` INT(11) NOT NULL COMMENT '',
  `estado` ENUM('Publico', 'Postulo') NOT NULL COMMENT '',
  PRIMARY KEY (`codUsuario`, `codEmpleo`)  COMMENT '',
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

-- -----------------------------------------------------
-- Data for table `cachuelapp`.`ubicacion`
-- -----------------------------------------------------
START TRANSACTION;
USE `cachuelapp`;
INSERT INTO `cachuelapp`.`ubicacion` (`codUbicacion`, `direccion`, `distrito`, `provincia`, `departamento`) VALUES (DEFAULT, 'Jr. Progreso S/N', 'Sunampe', 'Chincha', 'Ica');
INSERT INTO `cachuelapp`.`ubicacion` (`codUbicacion`, `direccion`, `distrito`, `provincia`, `departamento`) VALUES (DEFAULT, 'Av. America', 'Chincha Alta', 'Chincha', 'Ica');

COMMIT;


-- -----------------------------------------------------
-- Data for table `cachuelapp`.`usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `cachuelapp`;
INSERT INTO `cachuelapp`.`usuario` (`codUsuario`, `rol`, `usuario`, `clave`, `nombres`, `primerApellido`, `segundoApellido`, `numeroDNI`, `imagenDNI`, `enlaceFacebook`, `fechaNacimiento`, `correo`, `celular`, `imagenPerfil`, `imagenAdicional`, `fechaRegistro`, `tokenRegistro`, `correoConfirmado`, `codUbicacion`) VALUES (DEFAULT, 'admin', 'zirtrex', 'zirtrex', 'Rafael', 'Contreras', 'Martinez', '47623721', NULL, '/r.zirtrex', '1991-05-21', 'zirtrex@live.com', '966102508', 'zirtrex.jpg', NULL, DEFAULT, DEFAULT, DEFAULT, 1);
INSERT INTO `cachuelapp`.`usuario` (`codUsuario`, `rol`, `usuario`, `clave`, `nombres`, `primerApellido`, `segundoApellido`, `numeroDNI`, `imagenDNI`, `enlaceFacebook`, `fechaNacimiento`, `correo`, `celular`, `imagenPerfil`, `imagenAdicional`, `fechaRegistro`, `tokenRegistro`, `correoConfirmado`, `codUbicacion`) VALUES (DEFAULT, 'user', 'usuario1', 'usuario1', 'Jorge', 'Fernandez', 'Sierra', '45896321', NULL, NULL, '1980-04-30', 'usuario@correo.com', '985745236', 'usuario.jpg', NULL, DEFAULT, DEFAULT, DEFAULT, 1);
INSERT INTO `cachuelapp`.`usuario` (`codUsuario`, `rol`, `usuario`, `clave`, `nombres`, `primerApellido`, `segundoApellido`, `numeroDNI`, `imagenDNI`, `enlaceFacebook`, `fechaNacimiento`, `correo`, `celular`, `imagenPerfil`, `imagenAdicional`, `fechaRegistro`, `tokenRegistro`, `correoConfirmado`, `codUbicacion`) VALUES (DEFAULT, 'user', 'usuario2', 'usuario2', 'Carlos', 'Yarleque', 'Yarleque', '25632156', NULL, 'facebook.com/yarleque', '1990-09-14', 'usuario2@correo.com', '965823695', 'usuario2.png', NULL, DEFAULT, DEFAULT, DEFAULT, 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `cachuelapp`.`empleo`
-- -----------------------------------------------------
START TRANSACTION;
USE `cachuelapp`;
INSERT INTO `cachuelapp`.`empleo` (`codEmpleo`, `titulo`, `descripcion`, `remuneracion`, `fechaCreacion`, `horas`, `categoria`, `etiquetas`, `codUbicacion`) VALUES (DEFAULT, 'Cuidar a mis perritos', 'Cuidar perritos por algunas horas', 20.00, NULL, NULL, 'PetLovers', NULL, 1);
INSERT INTO `cachuelapp`.`empleo` (`codEmpleo`, `titulo`, `descripcion`, `remuneracion`, `fechaCreacion`, `horas`, `categoria`, `etiquetas`, `codUbicacion`) VALUES (DEFAULT, 'Diseñar un logo', 'Diseñar un logo para mi negocio familiar', 50.00, NULL, NULL, 'Creativos', NULL, 1);
INSERT INTO `cachuelapp`.`empleo` (`codEmpleo`, `titulo`, `descripcion`, `remuneracion`, `fechaCreacion`, `horas`, `categoria`, `etiquetas`, `codUbicacion`) VALUES (DEFAULT, 'Pintar mi casa', 'Pintar mi casa de color verder', 40.00, NULL, NULL, 'MilOficios', NULL, 1);
INSERT INTO `cachuelapp`.`empleo` (`codEmpleo`, `titulo`, `descripcion`, `remuneracion`, `fechaCreacion`, `horas`, `categoria`, `etiquetas`, `codUbicacion`) VALUES (DEFAULT, 'Cortar el Cespéd', 'Cortar el cespéd verde de mi casa roja que queda al lado de la casa de mi venico', 25.00, NULL, NULL, 'MilOficios', 'Cespéd, Casa, Vecino', 2);
INSERT INTO `cachuelapp`.`empleo` (`codEmpleo`, `titulo`, `descripcion`, `remuneracion`, `fechaCreacion`, `horas`, `categoria`, `etiquetas`, `codUbicacion`) VALUES (DEFAULT, 'Enseñarme Matemáticas', 'Quiero aprendar matemáticas por mi cuenta y busco docente', 80.00, NULL, '1', 'MilOficios', 'Mate, Enseñar', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `cachuelapp`.`interaccion`
-- -----------------------------------------------------
START TRANSACTION;
USE `cachuelapp`;
INSERT INTO `cachuelapp`.`interaccion` (`codInteracion`, `codUsuario`, `codEmpleo`, `estado`) VALUES (NULL, 1, 1, 'Publico');
INSERT INTO `cachuelapp`.`interaccion` (`codInteracion`, `codUsuario`, `codEmpleo`, `estado`) VALUES (NULL, 1, 2, 'Publico');
INSERT INTO `cachuelapp`.`interaccion` (`codInteracion`, `codUsuario`, `codEmpleo`, `estado`) VALUES (NULL, 1, 3, 'Publico');
INSERT INTO `cachuelapp`.`interaccion` (`codInteracion`, `codUsuario`, `codEmpleo`, `estado`) VALUES (NULL, 2, 1, 'Postulo');
INSERT INTO `cachuelapp`.`interaccion` (`codInteracion`, `codUsuario`, `codEmpleo`, `estado`) VALUES (NULL, 2, 2, 'Postulo');
INSERT INTO `cachuelapp`.`interaccion` (`codInteracion`, `codUsuario`, `codEmpleo`, `estado`) VALUES (NULL, 2, 3, 'Postulo');
INSERT INTO `cachuelapp`.`interaccion` (`codInteracion`, `codUsuario`, `codEmpleo`, `estado`) VALUES (NULL, 2, 4, 'Publico');
INSERT INTO `cachuelapp`.`interaccion` (`codInteracion`, `codUsuario`, `codEmpleo`, `estado`) VALUES (NULL, 2, 5, 'Publico');
INSERT INTO `cachuelapp`.`interaccion` (`codInteracion`, `codUsuario`, `codEmpleo`, `estado`) VALUES (NULL, 1, 4, 'Postulo');

COMMIT;

