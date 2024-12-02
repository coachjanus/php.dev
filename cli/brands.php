<?php

$host = '127.0.0.1';
$user = 'root';
$password = 'password';
$database = 'shopaholic';
$link = mysqli_connect($host, $user, $password, $database) or die('Error : ' . mysqli_error());


$sql = "CREATE TABLE `brands` (`id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL, `description` TEXT NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;";

if (mysqli_query($link, $sql)) {
   echo "\nTable brands created successfully\n";
} else {
   echo "\nError creating SCHEMA: " . mysqli_error($link)."\n";
}

$sql = 'INSERT INTO brands (name, description)
VALUES ("Super Cat", "Able an hope of body. Any nay shyness article matters own removal nothing his forming. Gay own additions education satisfied the perpetual. If he cause manor happy. Without farther she exposed saw man led. Along on happy could cease green oh."),
("Sara Boo", "Without farther she exposed saw man led. Along on happy could cease green oh.")';

if(mysqli_multi_query($link, $sql)){
   echo "\nINSERT successfully\n";
}else{
   echo "\nERROR: Could not able to execute $sql. ".mysqli_error($link);
}

mysqli_close($link);