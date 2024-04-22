-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema hoteltallafornia
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema hoteltallafornia
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hoteltallafornia` DEFAULT CHARACTER SET utf8mb3 ;
USE `hoteltallafornia` ;

-- -----------------------------------------------------
-- Table `hoteltallafornia`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hoteltallafornia`.`user` (
                                                         `user_id` INT NOT NULL AUTO_INCREMENT,
                                                         `name` VARCHAR(45) NULL DEFAULT NULL,
    `address` VARCHAR(45) NULL DEFAULT NULL,
    `ph_no` VARCHAR(45) NULL DEFAULT NULL,
    `dob` VARCHAR(45) NULL DEFAULT NULL,
    PRIMARY KEY (`user_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hoteltallafornia`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hoteltallafornia`.`customer` (
                                                             `customer_id` INT NOT NULL AUTO_INCREMENT,
                                                             `user_id` INT NOT NULL,
                                                             `passport_no` INT NULL DEFAULT NULL,
                                                             PRIMARY KEY (`customer_id`),
    INDEX `fk_Customer_Person1_idx` (`user_id` ASC) VISIBLE,
    CONSTRAINT `fk_Customer_Person1`
    FOREIGN KEY (`user_id`)
    REFERENCES `hoteltallafornia`.`user` (`user_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hoteltallafornia`.`departments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hoteltallafornia`.`departments` (
                                                                `dept_id` INT NOT NULL AUTO_INCREMENT,
                                                                `dept_name` VARCHAR(45) NULL DEFAULT NULL,
    `address` VARCHAR(45) NULL DEFAULT NULL,
    PRIMARY KEY (`dept_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hoteltallafornia`.`login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hoteltallafornia`.`login` (
                                                          `Login_id` INT NOT NULL AUTO_INCREMENT,
                                                          `email` VARCHAR(45) NULL DEFAULT NULL,
    `password` VARCHAR(45) NULL DEFAULT NULL,
    `permissionlvl` INT NULL DEFAULT NULL,
    PRIMARY KEY (`Login_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hoteltallafornia`.`employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hoteltallafornia`.`employee` (
                                                             `employee_id` INT NOT NULL AUTO_INCREMENT,
                                                             `user_id` INT NOT NULL,
                                                             `dept_id` INT NOT NULL,
                                                             `login_id` INT NOT NULL,
                                                             `job` VARCHAR(45) NULL DEFAULT NULL,
    PRIMARY KEY (`employee_id`, `login_id`),
    INDEX `fk_Staff_Person_idx` (`user_id` ASC) VISIBLE,
    INDEX `fk_Staff_Departments1_idx` (`dept_id` ASC) VISIBLE,
    INDEX `fk_Staff_Login1_idx` (`login_id` ASC) VISIBLE,
    CONSTRAINT `fk_Staff_Departments1`
    FOREIGN KEY (`dept_id`)
    REFERENCES `hoteltallafornia`.`departments` (`dept_id`),
    CONSTRAINT `fk_Staff_Login1`
    FOREIGN KEY (`login_id`)
    REFERENCES `hoteltallafornia`.`login` (`Login_id`),
    CONSTRAINT `fk_Staff_Person`
    FOREIGN KEY (`user_id`)
    REFERENCES `hoteltallafornia`.`user` (`user_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hoteltallafornia`.`guest`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hoteltallafornia`.`guest` (
                                                          `guest_id` INT NOT NULL AUTO_INCREMENT,
                                                          `customer_id` INT NOT NULL,
                                                          PRIMARY KEY (`guest_id`),
    INDEX `fk_Guest_Customer1_idx` (`customer_id` ASC) VISIBLE,
    CONSTRAINT `fk_Guest_Customer1`
    FOREIGN KEY (`customer_id`)
    REFERENCES `hoteltallafornia`.`customer` (`customer_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hoteltallafornia`.`member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hoteltallafornia`.`member` (
                                                           `member_id` INT NOT NULL AUTO_INCREMENT,
                                                           `customer_id` INT NOT NULL,
                                                           `login_id` INT NOT NULL,
                                                           PRIMARY KEY (`member_id`, `login_id`),
    INDEX `fk_Member_Customer1_idx` (`customer_id` ASC) VISIBLE,
    INDEX `fk_Member_Login1_idx` (`login_id` ASC) VISIBLE,
    CONSTRAINT `fk_Member_Customer1`
    FOREIGN KEY (`customer_id`)
    REFERENCES `hoteltallafornia`.`customer` (`customer_id`),
    CONSTRAINT `fk_Member_Login1`
    FOREIGN KEY (`login_id`)
    REFERENCES `hoteltallafornia`.`login` (`Login_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hoteltallafornia`.`reservations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hoteltallafornia`.`reservations` (
                                                                 `reservations_id` INT NOT NULL AUTO_INCREMENT,
                                                                 `employee_id` INT NOT NULL,
                                                                 `customer_id` INT NOT NULL,
                                                                 PRIMARY KEY (`reservations_id`, `customer_id`),
    INDEX `fk_Reservations_Staff1_idx` (`employee_id` ASC) VISIBLE,
    INDEX `fk_reservations_customer1_idx` (`customer_id` ASC) VISIBLE,
    CONSTRAINT `fk_reservations_customer1`
    FOREIGN KEY (`customer_id`)
    REFERENCES `hoteltallafornia`.`customer` (`customer_id`),
    CONSTRAINT `fk_Reservations_Staff1`
    FOREIGN KEY (`employee_id`)
    REFERENCES `hoteltallafornia`.`employee` (`employee_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hoteltallafornia`.`restauranttables`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hoteltallafornia`.`restauranttables` (
                                                                     `table_id` INT NOT NULL,
                                                                     `capacity` INT NULL DEFAULT NULL,
                                                                     PRIMARY KEY (`table_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hoteltallafornia`.`rooms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hoteltallafornia`.`rooms` (
                                                          `room_id` INT NOT NULL,
                                                          `room_type` VARCHAR(45) NULL DEFAULT NULL,
    `accessibility` VARCHAR(45) NULL DEFAULT NULL,
    `price` DECIMAL(10,2) NULL DEFAULT NULL,
    PRIMARY KEY (`room_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hoteltallafornia`.`roomreservations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hoteltallafornia`.`roomreservations` (
                                                                     `reservations_id` INT NOT NULL,
                                                                     `date` TIMESTAMP(2) NULL DEFAULT NULL,
    `check_in` DATETIME(2) NULL DEFAULT NULL,
    `check_out` DATETIME(2) NULL DEFAULT NULL,
    `total_price` DECIMAL(10,2) NULL DEFAULT NULL,
    `payment` VARCHAR(45) NULL DEFAULT NULL,
    `room_id` INT NOT NULL,
    `num_guests` INT NOT NULL,
    `checked_in` INT NULL,
    PRIMARY KEY (`reservations_id`, `room_id`),
    INDEX `fk_RoomReservations_Reservations1_idx` (`reservations_id` ASC) VISIBLE,
    INDEX `fk_roomreservations_rooms1_idx` (`room_id` ASC) VISIBLE,
    CONSTRAINT `fk_RoomReservations_Reservations1`
    FOREIGN KEY (`reservations_id`)
    REFERENCES `hoteltallafornia`.`reservations` (`reservations_id`),
    CONSTRAINT `fk_roomreservations_rooms1`
    FOREIGN KEY (`room_id`)
    REFERENCES `hoteltallafornia`.`rooms` (`room_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hoteltallafornia`.`tablereservations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hoteltallafornia`.`tablereservations` (
                                                                      `reservations_id` INT NOT NULL,
                                                                      `date` VARCHAR(45) NULL DEFAULT NULL,
    `time` VARCHAR(45) NULL DEFAULT NULL,
    `no_guests` INT NOT NULL,
    `table_id` INT NOT NULL,
    PRIMARY KEY (`reservations_id`, `table_id`),
    INDEX `fk_TableReservations_Reservations1_idx` (`reservations_id` ASC) VISIBLE,
    INDEX `fk_tablereservations_restauranttables1_idx` (`table_id` ASC) VISIBLE,
    CONSTRAINT `fk_TableReservations_Reservations1`
    FOREIGN KEY (`reservations_id`)
    REFERENCES `hoteltallafornia`.`reservations` (`reservations_id`),
    CONSTRAINT `fk_tablereservations_restauranttables1`
    FOREIGN KEY (`table_id`)
    REFERENCES `hoteltallafornia`.`restauranttables` (`table_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


INSERT INTO departments (dept_name, address)
VALUES
    ('Restaurant', 'Tallaght Co. Dublin'),
    ('Accommodation', 'Tallaght Co. Dublin'),
    ('Events', 'Tallaght Co. Dublin'),
    ('Administration', 'Tallaght Co. Dublin');

INSERT INTO user (name, address, ph_no, dob)
VALUES
    ('Admin', 'HQ', '0123456', '2024-01-01'),
   ('Emily', 'Kildare', '0123456', '2020-01-01'),
   ('Anna', 'Cork', '0123456', '2021-01-01'),
   ('Sam', 'Kildare', '0123456', '2022-01-01'),
    ('member', 'Kildare', '0123456', '2022-01-01');

INSERT INTO login (email, password, permissionlvl)
VALUES
    ('admin@gmail.com', '123', 3),
    ('emily@gmail.com', 'pass', 3),
    ('anna@gmail.com', 'passw', 3),
    ('sam@gmail.com', 'passwo', 3),
    ('member@gmail.com', 'passwor',1);

INSERT INTO employee (user_id, dept_id, login_id, job)
VALUES
    (1, 4, 1, 'site administrator'),
    (2, 1, 2, 'waitress'),
    (3, 3, 3, 'event manager'),
    (4, 2, 4, 'cleaning-supervisor');

INSERT INTO restauranttables (table_id, capacity)
VALUES
    (1,4),
    (2,4),
    (3,6),
    (4,4),
    (5,10),
    (6,4),
    (7,2),
    (8,4),
    (9,6);

INSERT INTO rooms (room_id, room_type, accessibility,price)
VALUES
    (1,'double','accessible',100),
    (2,'suite','accessible',200),
    (3,'twin','accessible',150),
    (4,'family','accessible',180),
    (5,'double','non-accessible',100),
    (6,'suite','non-accessible',200),
    (7,'twin','non-accessible',150),
    (8,'family','non-accessible',180),
    (9,'double','accessible',100),
    (10,'suite','accessible',200),
    (11,'twin','accessible',150),
    (12,'family','accessible', 180);


INSERT INTO customer(customer_id,user_id,passport_no)
VALUES
    (1, 5, 1234);

INSERT INTO member(customer_id ,login_id)
VALUES
    (1, 5)
