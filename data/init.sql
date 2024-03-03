-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema HotelTallafornia
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema HotelTallafornia
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `HotelTallafornia` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema hoteltallafornia
-- -----------------------------------------------------
USE `HotelTallafornia` ;

-- -----------------------------------------------------
-- Table `HotelTallafornia`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`User` (
                                                         `user_id` INT NOT NULL AUTO_INCREMENT,
                                                         `name` VARCHAR(45) NULL,
    `address` VARCHAR(45) NULL,
    `ph_no` VARCHAR(45) NULL,
    `dob` VARCHAR(45) NULL,
    PRIMARY KEY (`user_id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`Departments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`Departments` (
                                                                `dept_id` INT NOT NULL AUTO_INCREMENT,
                                                                `dept_name` VARCHAR(45) NULL,
    `address` VARCHAR(45) NULL,
    PRIMARY KEY (`dept_id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`Rooms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`Rooms` (
                                                          `room_id` INT NOT NULL,
                                                          `room_type` VARCHAR(45) NULL,
    `accessibility` VARCHAR(45) NULL,
    `price` DECIMAL(10,2) NULL,
    PRIMARY KEY (`room_id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`RestaurantTables`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`RestaurantTables` (
                                                                     `table_id` INT NOT NULL,
                                                                     `capacity` INT NULL,
                                                                     PRIMARY KEY (`table_id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`Customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`Customer` (
                                                             `user_id` INT NOT NULL AUTO_INCREMENT,
                                                             `customer_id` INT NOT NULL,
                                                             `passport_no` INT NULL,
                                                             PRIMARY KEY (`customer_id`),
    INDEX `fk_Customer_Person1_idx` (`user_id` ASC) VISIBLE,
    CONSTRAINT `fk_Customer_Person1`
    FOREIGN KEY (`user_id`)
    REFERENCES `HotelTallafornia`.`User` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`Login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`Login` (
                                                          `Login_id` INT NOT NULL AUTO_INCREMENT,
                                                          `email` VARCHAR(45) NULL,
    `password` VARCHAR(45) NULL,
    PRIMARY KEY (`Login_id`))
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`Employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`Employee` (
                                                             `employee_id` INT NOT NULL AUTO_INCREMENT,
                                                             `user_id` INT NOT NULL,
                                                             `dept_id` INT NOT NULL,
                                                             `login_id` INT NOT NULL,
                                                             `job` VARCHAR(45) NULL,
    `permissionlvl` INT NULL,
    PRIMARY KEY (`employee_id`, `login_id`),
    INDEX `fk_Staff_Person_idx` (`user_id` ASC) VISIBLE,
    INDEX `fk_Staff_Departments1_idx` (`dept_id` ASC) VISIBLE,
    INDEX `fk_Staff_Login1_idx` (`login_id` ASC) VISIBLE,
    CONSTRAINT `fk_Staff_Person`
    FOREIGN KEY (`user_id`)
    REFERENCES `HotelTallafornia`.`User` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_Staff_Departments1`
    FOREIGN KEY (`dept_id`)
    REFERENCES `HotelTallafornia`.`Departments` (`dept_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_Staff_Login1`
    FOREIGN KEY (`login_id`)
    REFERENCES `HotelTallafornia`.`Login` (`Login_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`Member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`Member` (
                                                           `member_id` INT NOT NULL AUTO_INCREMENT,
                                                           `customer_id` INT NOT NULL,
                                                           `login_id` INT NOT NULL,
                                                           PRIMARY KEY (`member_id`, `login_id`),
    INDEX `fk_Member_Customer1_idx` (`customer_id` ASC) VISIBLE,
    INDEX `fk_Member_Login1_idx` (`login_id` ASC) VISIBLE,
    CONSTRAINT `fk_Member_Customer1`
    FOREIGN KEY (`customer_id`)
    REFERENCES `HotelTallafornia`.`Customer` (`customer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_Member_Login1`
    FOREIGN KEY (`login_id`)
    REFERENCES `HotelTallafornia`.`Login` (`Login_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`Guest`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`Guest` (
                                                          `guest_id` INT NOT NULL AUTO_INCREMENT,
                                                          `customer_id` INT NOT NULL,
                                                          PRIMARY KEY (`guest_id`),
    INDEX `fk_Guest_Customer1_idx` (`customer_id` ASC) VISIBLE,
    CONSTRAINT `fk_Guest_Customer1`
    FOREIGN KEY (`customer_id`)
    REFERENCES `HotelTallafornia`.`Customer` (`customer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`Reservations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`Reservations` (
                                                                 `reservations_id` INT NOT NULL AUTO_INCREMENT,
                                                                 `staff_id` INT NOT NULL,
                                                                 `member_id` INT NOT NULL,
                                                                 `guest_id` INT NOT NULL,
                                                                 PRIMARY KEY (`reservations_id`),
    INDEX `fk_Reservations_Staff1_idx` (`staff_id` ASC) VISIBLE,
    INDEX `fk_Reservations_Member1_idx` (`member_id` ASC) VISIBLE,
    INDEX `fk_Reservations_Guest1_idx` (`guest_id` ASC) VISIBLE,
    CONSTRAINT `fk_Reservations_Staff1`
    FOREIGN KEY (`staff_id`)
    REFERENCES `HotelTallafornia`.`Employee` (`employee_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_Reservations_Member1`
    FOREIGN KEY (`member_id`)
    REFERENCES `HotelTallafornia`.`Member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_Reservations_Guest1`
    FOREIGN KEY (`guest_id`)
    REFERENCES `HotelTallafornia`.`Guest` (`guest_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`RoomReservations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`RoomReservations` (
                                                                     `reservations_id` INT NOT NULL,
                                                                     `date` TIMESTAMP(2) NULL,
    `check_in` DATETIME(2) NULL,
    `check_out` DATETIME(2) NULL,
    `total_price` DECIMAL(10,2) NULL,
    `payment` VARCHAR(45) NULL,
    PRIMARY KEY (`reservations_id`),
    INDEX `fk_RoomReservations_Reservations1_idx` (`reservations_id` ASC) VISIBLE,
    CONSTRAINT `fk_RoomReservations_Reservations1`
    FOREIGN KEY (`reservations_id`)
    REFERENCES `HotelTallafornia`.`Reservations` (`reservations_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`TableReservations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`TableReservations` (
                                                                      `reservations_id` INT NOT NULL,
                                                                      `date` VARCHAR(45) NULL,
    `time` VARCHAR(45) NULL,
    `no_guests` VARCHAR(45) NULL,
    PRIMARY KEY (`reservations_id`),
    INDEX `fk_TableReservations_Reservations1_idx` (`reservations_id` ASC) VISIBLE,
    CONSTRAINT `fk_TableReservations_Reservations1`
    FOREIGN KEY (`reservations_id`)
    REFERENCES `HotelTallafornia`.`Reservations` (`reservations_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`RoomReservationRecords`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`RoomReservationRecords` (
                                                                           `reservations_id` INT NOT NULL,
                                                                           `room_id` INT NOT NULL,
                                                                           `customer_id` INT NOT NULL,
                                                                           PRIMARY KEY (`reservations_id`, `room_id`, `customer_id`),
    INDEX `fk_RoomReservations_has_Rooms_Rooms1_idx` (`room_id` ASC) VISIBLE,
    INDEX `fk_RoomReservations_has_Rooms_RoomReservations1_idx` (`reservations_id` ASC) VISIBLE,
    INDEX `fk_RoomReservationRecords_Customer1_idx` (`customer_id` ASC) VISIBLE,
    CONSTRAINT `fk_RoomReservations_has_Rooms_RoomReservations1`
    FOREIGN KEY (`reservations_id`)
    REFERENCES `HotelTallafornia`.`RoomReservations` (`reservations_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_RoomReservations_has_Rooms_Rooms1`
    FOREIGN KEY (`room_id`)
    REFERENCES `HotelTallafornia`.`Rooms` (`room_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_RoomReservationRecords_Customer1`
    FOREIGN KEY (`customer_id`)
    REFERENCES `HotelTallafornia`.`Customer` (`customer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HotelTallafornia`.`TableReservationRecords`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HotelTallafornia`.`TableReservationRecords` (
                                                                            `table_id` INT NOT NULL,
                                                                            `reservations_id` INT NOT NULL,
                                                                            `customer_id` INT NOT NULL,
                                                                            PRIMARY KEY (`table_id`, `reservations_id`, `customer_id`),
    INDEX `fk_RestaurantTables_has_TableReservations_TableReservations_idx` (`reservations_id` ASC) VISIBLE,
    INDEX `fk_RestaurantTables_has_TableReservations_RestaurantTables1_idx` (`table_id` ASC) VISIBLE,
    INDEX `fk_TableReservationRecords_Customer1_idx` (`customer_id` ASC) VISIBLE,
    CONSTRAINT `fk_RestaurantTables_has_TableReservations_RestaurantTables1`
    FOREIGN KEY (`table_id`)
    REFERENCES `HotelTallafornia`.`RestaurantTables` (`table_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_RestaurantTables_has_TableReservations_TableReservations1`
    FOREIGN KEY (`reservations_id`)
    REFERENCES `HotelTallafornia`.`TableReservations` (`reservations_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT `fk_TableReservationRecords_Customer1`
    FOREIGN KEY (`customer_id`)
    REFERENCES `HotelTallafornia`.`Customer` (`customer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
