-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema QuartoHoteis
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema QuartoHoteis
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `QuartoHoteis` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema QuartoHoteis
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema QuartoHoteis
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `QuartoHoteis` DEFAULT CHARACTER SET latin1 ;
USE `QuartoHoteis` ;

-- -----------------------------------------------------
-- Table `QuartoHoteis`.`Estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `QuartoHoteis`.`Estado` (
  `IDEstado` INT(11) NOT NULL,
  `NomeEstado` VARCHAR(75) NULL DEFAULT NULL,
  `UF` VARCHAR(5) NULL DEFAULT NULL,
  PRIMARY KEY (`IDEstado`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `QuartoHoteis`.`Cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `QuartoHoteis`.`Cidade` (
  `IDCidade` INT(11) NOT NULL,
  `NomeCidade` VARCHAR(120) NULL DEFAULT NULL,
  `IDEstado` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`IDCidade`),
  INDEX `IDEstado` (`IDEstado` ASC),
  CONSTRAINT `Cidade_ibfk_1`
    FOREIGN KEY (`IDEstado`)
    REFERENCES `QuartoHoteis`.`Estado` (`IDEstado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `QuartoHoteis`.`Hoteis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `QuartoHoteis`.`Hoteis` (
  `IDHotel` INT(10) UNSIGNED NOT NULL,
  `NomeHotel` VARCHAR(50) NULL DEFAULT NULL,
  `EmailResponsavel` VARCHAR(20) NULL DEFAULT NULL,
  `Senha` VARCHAR(50) NULL DEFAULT NULL,
  `Logo` VARCHAR(50) NULL DEFAULT NULL,
  `FotoCapa` VARCHAR(50) NULL DEFAULT NULL,
  `DescricaoHotel` TEXT NULL DEFAULT NULL,
  `CEP` VARCHAR(9) NULL DEFAULT NULL,
  `Bairro` VARCHAR(100) NULL DEFAULT NULL,
  `Rua` VARCHAR(200) NULL DEFAULT NULL,
  `Numero` VARCHAR(10) NULL DEFAULT NULL,
  `Complemento` VARCHAR(50) NULL DEFAULT NULL,
  `IDEstado` INT(11) NULL DEFAULT NULL,
  `IDCidade` INT(11) NULL DEFAULT NULL,
  `Telefone` VARCHAR(15) NULL DEFAULT NULL,
  `Estrelas` INT(1) NULL DEFAULT '2',
  PRIMARY KEY (`IDHotel`),
  INDEX `fk_Hoteis_1_idx` (`IDEstado` ASC),
  INDEX `fk_Hoteis_2_idx` (`IDCidade` ASC),
  CONSTRAINT `fk_Hoteis_1`
    FOREIGN KEY (`IDEstado`)
    REFERENCES `QuartoHoteis`.`Estado` (`IDEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Hoteis_2`
    FOREIGN KEY (`IDCidade`)
    REFERENCES `QuartoHoteis`.`Cidade` (`IDCidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `QuartoHoteis`.`Quarto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `QuartoHoteis`.`Quarto` (
  `IDQuarto` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IDHotel` INT(10) UNSIGNED NULL DEFAULT NULL,
  `Preco` FLOAT NULL DEFAULT NULL,
  `DescricaoQuarto` TEXT NULL DEFAULT NULL,
  `TipoQuarto` VARCHAR(13) NULL DEFAULT NULL,
  `SalvoEm` DATE NULL DEFAULT NULL,
  `TituloQuarto` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`IDQuarto`),
  INDEX `IDRepublica` (`IDHotel` ASC),
  CONSTRAINT `Vaga_ibfk_1`
    FOREIGN KEY (`IDHotel`)
    REFERENCES `QuartoHoteis`.`Hoteis` (`IDHotel`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `QuartoHoteis`.`Reservas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `QuartoHoteis`.`Reservas` (
  `IDReserva` INT(10) UNSIGNED NOT NULL,
  `IDQuarto` INT(10) UNSIGNED NOT NULL,
  `DataInicial` DATE NOT NULL,
  `HoraEntrada` TIME NOT NULL,
  `DataFinal` DATE NOT NULL,
  `HoraSaida` TIME NOT NULL,
  `NomeCliente` VARCHAR(55) NOT NULL,
  `EmailCliente` VARCHAR(200) NOT NULL,
  `QuantidadePessoas` INT(3) NOT NULL,
  PRIMARY KEY (`IDReserva`),
  INDEX `fk_Reservas_1_idx` (`IDQuarto` ASC),
  CONSTRAINT `fk_Reservas_1`
    FOREIGN KEY (`IDQuarto`)
    REFERENCES `QuartoHoteis`.`Quarto` (`IDQuarto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

USE `QuartoHoteis` ;

-- -----------------------------------------------------
-- Table `QuartoHoteis`.`FotoHotel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `QuartoHoteis`.`FotoHotel` (
  `IDFoto` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IDHotel` INT(10) UNSIGNED NULL DEFAULT NULL,
  `Foto` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`IDFoto`),
  INDEX `IDRepublica` (`IDHotel` ASC),
  CONSTRAINT `FotoRepublica_ibfk_1`
    FOREIGN KEY (`IDHotel`)
    REFERENCES `QuartoHoteis`.`Hoteis` (`IDHotel`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `QuartoHoteis`.`FotoQuarto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `QuartoHoteis`.`FotoQuarto` (
  `IDFoto` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IDQuarto` INT(10) UNSIGNED NULL DEFAULT NULL,
  `Foto` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`IDFoto`),
  INDEX `IDVaga` (`IDQuarto` ASC),
  CONSTRAINT `FotoVaga_ibfk_1`
    FOREIGN KEY (`IDQuarto`)
    REFERENCES `QuartoHoteis`.`Quarto` (`IDQuarto`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
