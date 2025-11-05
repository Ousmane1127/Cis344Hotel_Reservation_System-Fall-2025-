-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema hotel_reservation_sys
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema hotel_reservation_sys
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hotel_reservation_sys` DEFAULT CHARACTER SET utf8mb3 ;
USE `hotel_reservation_sys` ;

-- -----------------------------------------------------
-- Table `hotel_reservation_sys`.`guest`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel_reservation_sys`.`guest` (
  `GuestID` INT NOT NULL AUTO_INCREMENT,
  `ResvID` INT NULL DEFAULT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  `Email` VARCHAR(45) NULL DEFAULT NULL,
  `Phone_Num` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`GuestID`),
  INDEX `ResvID` (`ResvID` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 57
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hotel_reservation_sys`.`transactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel_reservation_sys`.`transactions` (
  `Trans_ID` INT NOT NULL AUTO_INCREMENT,
  `GuestID` INT NULL DEFAULT NULL,
  `amount` DECIMAL(10,2) NULL DEFAULT NULL,
  `Payment_Method` VARCHAR(45) NULL DEFAULT NULL,
  `Date` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`Trans_ID`),
  INDEX `GuestID` (`GuestID` ASC) ,
  CONSTRAINT `transactions_ibfk_1`
    FOREIGN KEY (`GuestID`)
    REFERENCES `hotel_reservation_sys`.`guest` (`GuestID`))
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hotel_reservation_sys`.`reservations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel_reservation_sys`.`reservations` (
  `ResevID` INT NOT NULL AUTO_INCREMENT,
  `GuestID` INT NULL DEFAULT NULL,
  `Room_num` INT NULL DEFAULT NULL,
  `Check_IN` DATETIME NULL DEFAULT NULL,
  `Check_Out` DATETIME NULL DEFAULT NULL,
  `Trans_num` INT NULL DEFAULT NULL,
  PRIMARY KEY (`ResevID`),
  INDEX `GuestID` (`GuestID` ASC) ,
  INDEX `Trans_num` (`Trans_num` ASC) ,
  CONSTRAINT `reservations_ibfk_1`
    FOREIGN KEY (`GuestID`)
    REFERENCES `hotel_reservation_sys`.`guest` (`GuestID`),
  CONSTRAINT `reservations_ibfk_2`
    FOREIGN KEY (`Trans_num`)
    REFERENCES `hotel_reservation_sys`.`transactions` (`Trans_ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hotel_reservation_sys`.`bookings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel_reservation_sys`.`bookings` (
  `GuestID` INT NOT NULL,
  `ResvID` INT NOT NULL,
  PRIMARY KEY (`GuestID`, `ResvID`),
  INDEX `bookings_ibfk_2` (`ResvID` ASC) ,
  CONSTRAINT `bookings_ibfk_1`
    FOREIGN KEY (`GuestID`)
    REFERENCES `hotel_reservation_sys`.`guest` (`GuestID`),
  CONSTRAINT `bookings_ibfk_2`
    FOREIGN KEY (`ResvID`)
    REFERENCES `hotel_reservation_sys`.`reservations` (`ResevID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hotel_reservation_sys`.`charges`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel_reservation_sys`.`charges` (
  `GuestID` INT NOT NULL,
  `TransID` INT NOT NULL,
  PRIMARY KEY (`GuestID`, `TransID`),
  INDEX `TransID` (`TransID` ASC) ,
  CONSTRAINT `charges_ibfk_1`
    FOREIGN KEY (`GuestID`)
    REFERENCES `hotel_reservation_sys`.`guest` (`GuestID`),
  CONSTRAINT `charges_ibfk_2`
    FOREIGN KEY (`TransID`)
    REFERENCES `hotel_reservation_sys`.`transactions` (`Trans_ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hotel_reservation_sys`.`employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel_reservation_sys`.`employee` (
  `EmployeeID` INT NOT NULL AUTO_INCREMENT,
  `SSN` VARCHAR(45) NOT NULL,
  `Position` VARCHAR(45) NOT NULL,
  `Address` VARCHAR(45) NULL DEFAULT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Sex` VARCHAR(5) NULL DEFAULT NULL,
  `Birthday` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`),
  UNIQUE INDEX `SSN_UNIQUE` (`SSN` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hotel_reservation_sys`.`manager`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel_reservation_sys`.`manager` (
  `Manger_ID` INT NOT NULL AUTO_INCREMENT,
  `EmpID` INT NOT NULL,
  PRIMARY KEY (`Manger_ID`),
  INDEX `EmpID` (`EmpID` ASC) ,
  CONSTRAINT `manager_ibfk_1`
    FOREIGN KEY (`EmpID`)
    REFERENCES `hotel_reservation_sys`.`employee` (`EmployeeID`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `hotel_reservation_sys`.`staff`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel_reservation_sys`.`staff` (
  `StaffID` INT NOT NULL AUTO_INCREMENT,
  `EmpID` INT NOT NULL,
  PRIMARY KEY (`StaffID`),
  INDEX `EmpID` (`EmpID` ASC) ,
  CONSTRAINT `staff_ibfk_1`
    FOREIGN KEY (`EmpID`)
    REFERENCES `hotel_reservation_sys`.`employee` (`EmployeeID`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb3;

USE `hotel_reservation_sys`;

DELIMITER $$
USE `hotel_reservation_sys`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `hotel_reservation_sys`.`Charges`
AFTER INSERT ON `hotel_reservation_sys`.`transactions`
FOR EACH ROW
begin
Insert into charges (GuestID,TransID) values (new.GuestID, new.Trans_ID);
end$$

USE `hotel_reservation_sys`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `hotel_reservation_sys`.`Bookings`
AFTER INSERT ON `hotel_reservation_sys`.`reservations`
FOR EACH ROW
begin
Insert into bookings (GuestID,ResvID) values (new.GuestID, new.ResevID);
end$$

USE `hotel_reservation_sys`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `hotel_reservation_sys`.`Emp_position`
AFTER INSERT ON `hotel_reservation_sys`.`employee`
FOR EACH ROW
BEGIN
    IF new.Position = 'Manager' THEN 
        Insert into manager(EmpID) values (new.EmployeeID);
    ELSEIF new.Position = 'Staff' THEN 
        Insert into staff (EmpID) values (new.EmployeeID);
    END IF;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
