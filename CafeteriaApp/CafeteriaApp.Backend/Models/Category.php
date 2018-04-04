<?php
class Category {
public $create = "create table `cafetria`.`Category` (
Id int auto_increment primary key,
Name varchar(130) not null,
Image varchar(150) not null,
CafeteriaId int not null,
About text not null DEFAULT 'Awsome Category !!',
foreign key (CafeteriaId) references `Cafeteria`(Id) ON DELETE CASCADE 
) ENGINE = InnoDB; ";

public $drop = "drop table `cafetria`.`Category`";
}

?>
