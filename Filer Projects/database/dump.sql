SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`users` (
  `id_user` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `nickname` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  PRIMARY KEY (`id_user`) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `mydb`.`log`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`log` (
  `id_log` INT NOT NULL AUTO_INCREMENT ,
  `action` VARCHAR(45) NOT NULL ,
  `element` VARCHAR(45) NOT NULL ,
  `params` VARCHAR(45) NOT NULL ,
  `date` DATETIME NOT NULL ,
  `id_user` INT UNSIGNED NOT NULL ,
  `IP_user` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_log`) ,
  INDEX `fk_log_users` (`id_user` ASC) ,
  CONSTRAINT `fk_log_users`
    FOREIGN KEY (`id_user` )
    REFERENCES `mydb`.`users` (`id_user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
