<?php 

class Fee 
{
	
public $create="CREATE TABLE `cafetria`.`fee` ( `Id` INT NOT NULL AUTO_INCREMENT ,
 `Name` VARCHAR(150) NOT NULL ,
 `Price` DECIMAL(6,2) NOT NULL ,
 PRIMARY KEY (`Id`)
 ) ENGINE = InnoDB;";

public $drop = "drop table `cafetria`.`fee`";


}




?>