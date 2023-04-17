<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "register";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if(!$conn){
	echo("error");
	die("connection Failed.");
}

?>
       