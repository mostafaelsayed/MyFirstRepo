<?php
class Category {
public $sql1 = "create table Category (
Id int(6) unsigned auto_increment primary key,
Name varchar(30) not null,
Image varchar(50),
CafeteriaId int(6) unsigned not null,
foreign key (CafeteriaId) references Cafeteria(Id)
)";

public $sql2 = "drop table Category";
}

?>
