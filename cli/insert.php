<?php
$link = mysqli_connect("localhost", "root", "password", "shopaholic");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$sql = 'INSERT INTO feedback (name, surname, email, message)
VALUES ("Tom", "Cat", "tom@my.cat", "Able an hope of body. Any nay shyness article matters own removal nothing his forming. Gay own additions education satisfied the perpetual. If he cause manor happy. Without farther she exposed saw man led. Along on happy could cease green oh."),
("Sara", "Baraboo", "sb@my.cat",  "Without farther she exposed saw man led. Along on happy could cease green oh.")';

if(mysqli_multi_query($link, $sql)){
   echo "\nINSERT successfully\n";
}else{
   echo "\nERROR: Could not able to execute $sql. ".mysqli_error($link);
}
mysqli_close($link);
