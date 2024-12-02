<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "password");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Print host information
echo "Connected Successfully. Host info: " . mysqli_get_host_info($link);

$sql = <<<EOT
   DROP SCHEMA IF EXISTS shopaholic;
   CREATE SCHEMA shopaholic CHARACTER
   SET utf8mb4
   COLLATE utf8mb4_unicode_ci;
EOT;
if (mysqli_multi_query($link, $sql)) {
   echo "\nSCHEMA created successfully\n";
} else {
   echo "\nError creating SCHEMA: " . mysqli_error($link)."\n";
}
mysqli_close($link);

$link = mysqli_connect("localhost", "root", "password", "shopaholic");

$sql = "CREATE TABLE `feedback` (`id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(20) NOT NULL , `surname` VARCHAR(50) NOT NULL , `email` VARCHAR(30) NOT NULL , `message` TEXT NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

if (mysqli_query($link, $sql)) {
   echo "\nTable shopaholic created successfully\n";
} else {
   echo "\nError creating SCHEMA: " . mysqli_error($link)."\n";
}

mysqli_close($link);