SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `ghibli_blog` ;
USE `ghibli_blog` ;

-- -----------------------------------------------------
-- Table `ghibli_blog`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ghibli_blog`.`users` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_mail` VARCHAR(255) NOT NULL ,
  `user_password` VARCHAR(32) NOT NULL ,
  `user_name` VARCHAR(255) NOT NULL ,
  `user_firstname` VARCHAR(255) NOT NULL ,
  `user_nickname` VARCHAR(255) NOT NULL ,
  `user_create` DATETIME NOT NULL ,
  `user_lastconnect` DATETIME NOT NULL ,
  PRIMARY KEY (`user_id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `ghibli_blog`.`posts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ghibli_blog`.`posts` (
  `post_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `created` DATETIME NOT NULL ,
  `updated` DATETIME NOT NULL ,
  `title` VARCHAR(255) NOT NULL ,
  `content` TEXT NOT NULL ,
  `posts_user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`post_id`) ,
  INDEX `fk_posts_users` (`posts_user_id` ASC) ,
  CONSTRAINT `fk_posts_users`
    FOREIGN KEY (`posts_user_id` )
    REFERENCES `ghibli_blog`.`users` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `ghibli_blog`.`comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ghibli_blog`.`comments` (
  `comm_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `date_create` DATETIME NOT NULL ,
  `updated` DATETIME NOT NULL ,
  `content` TEXT NOT NULL ,
  `post_id` INT UNSIGNED NOT NULL ,
  `post_user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`comm_id`) ,
  INDEX `fk_comments_posts1` (`post_id` ASC) ,
  INDEX `fk_comments_users1` (`post_user_id` ASC) ,
  CONSTRAINT `fk_comments_posts1`
    FOREIGN KEY (`post_id` )
    REFERENCES `ghibli_blog`.`posts` (`post_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`post_user_id` )
    REFERENCES `ghibli_blog`.`users` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
