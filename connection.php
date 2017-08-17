<?php 

//Create a database connection
define("DB_SERVER", "localhost");
define("DB_USER", "haria");
define("DB_PASS", "saveearth");
define("DB_NAME", "widget_corp");


$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	// test if connection successful
	if(mysqli_connect_errno()){
 		die("database connection failed ".mysqli_connect_error()." (".mysqli_connect_errno().")");
	}

?>

