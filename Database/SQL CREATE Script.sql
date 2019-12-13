-- MySQL Script generated by MySQL Workbench
-- Fri Dec 13 10:33:41 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8mb4 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`job_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`job_categories` (
  `job_categories_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`job_categories_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`job_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`job_type` (
  `job_type_id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`job_type_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`profile_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`profile_user` (
  `profile_user_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`profile_user_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `displayname` VARCHAR(64) NULL,
  `email` VARCHAR(50) NULL,
  `avatar` VARCHAR(128) NULL DEFAULT '/assets/images/default_avatar.png',
  `birthdate` DATE NULL,
  `gender` VARCHAR(8) NULL,
  `cpf` VARCHAR(11) NULL,
  `cellphone` INT(11) NULL,
  `password` VARCHAR(32) NULL,
  `created_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `active` TINYINT NULL DEFAULT 1,
  `profile_user_id` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`user_id`),
  INDEX `fk_user_profile_user1_idx` (`profile_user_id` ASC),
  CONSTRAINT `fk_user_profile_user1`
    FOREIGN KEY (`profile_user_id`)
    REFERENCES `mydb`.`profile_user` (`profile_user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`job`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`job` (
  `job_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  `text` VARCHAR(1024) NULL,
  `author` INT NOT NULL,
  `status` INT NULL DEFAULT 1,
  `published_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `job_categories_id` INT NOT NULL,
  `job_type_id` INT NOT NULL,
  PRIMARY KEY (`job_id`),
  INDEX `fk_job_job_categories_idx` (`job_categories_id` ASC),
  INDEX `fk_job_job_type1_idx` (`job_type_id` ASC),
  INDEX `fk_job_user1_idx` (`author` ASC),
  CONSTRAINT `fk_job_job_categories`
    FOREIGN KEY (`job_categories_id`)
    REFERENCES `mydb`.`job_categories` (`job_categories_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_job_job_type1`
    FOREIGN KEY (`job_type_id`)
    REFERENCES `mydb`.`job_type` (`job_type_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_job_user1`
    FOREIGN KEY (`author`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`settings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`settings` (
  `settings_id` INT NOT NULL AUTO_INCREMENT,
  `sitename` VARCHAR(45) NULL,
  `description` VARCHAR(160) NULL,
  `keywords` VARCHAR(255) NULL,
  PRIMARY KEY (`settings_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user_has_job`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user_has_job` (
  `user_id` INT NOT NULL,
  `job_id` INT NOT NULL,
  `reg_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`, `job_id`),
  INDEX `fk_user_has_job_job1_idx` (`job_id` ASC),
  INDEX `fk_user_has_job_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_has_job_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_job_job1`
    FOREIGN KEY (`job_id`)
    REFERENCES `mydb`.`job` (`job_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`job_categories`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (1, 'Assistência médica');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (2, 'Vendas e varejo');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (3, 'Administração e escritório');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (4, 'Operações comerciais');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (5, 'Recursos Humanos');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (6, 'Transporte e logística');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (7, 'Administração');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (8, 'Publicidade e marketing');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (9, 'Computador e TI');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (10, 'Cuidados com animais');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (11, 'Fabricação e armazenamento');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (12, 'Construção');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (13, 'Instalação, manutenção e reparo');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (14, 'Contabilidade e finanças');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (15, 'Serviços e cuidados pessoais');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (16, 'Ciência e engenharia');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (17, 'Atendimento ao cliente');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (18, 'Jurídico');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (19, 'Limpeza e instalações');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (20, 'Mídia, comunicações e escrita');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (21, 'Arte, moda e design');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (22, 'Educação');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (23, 'Entretenimento e viagem');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (24, 'Agropecuária/atividades ao ar livre');
INSERT INTO `mydb`.`job_categories` (`job_categories_id`, `name`) VALUES (25, 'Energia e mineração');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`job_type`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`job_type` (`job_type_id`, `name`) VALUES (1, 'Tempo integral');
INSERT INTO `mydb`.`job_type` (`job_type_id`, `name`) VALUES (2, 'Estágio');
INSERT INTO `mydb`.`job_type` (`job_type_id`, `name`) VALUES (3, 'Prestador de serviços');
INSERT INTO `mydb`.`job_type` (`job_type_id`, `name`) VALUES (4, 'Meio período');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`profile_user`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`profile_user` (`profile_user_id`, `name`) VALUES (1, 'Candidato');
INSERT INTO `mydb`.`profile_user` (`profile_user_id`, `name`) VALUES (2, 'Empregador');
INSERT INTO `mydb`.`profile_user` (`profile_user_id`, `name`) VALUES (3, 'CEO');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`settings`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`settings` (`settings_id`, `sitename`, `description`, `keywords`) VALUES (0, 'Job Portal', 'Add your description here', 'keyword1, keyword2, keyword3, keyword4, keyword5');

COMMIT;

