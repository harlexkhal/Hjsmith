<?php 
	
	define('DBNAME', 'hjsmith');
	define('DBUSER', 'root');
	define('DBPASS', 'jarex457');


	try{
		# prepare a PDO  instance....
		$conn = new PDO ('mysql:host=localhost;dbname=' .DBNAME, DBUSER, DBPASS);

		# set verbase error modes  ...
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
	}catch (PDOexception $error){
		echo $error->getMessage();
	}


	//Customer table . . .

	$sql = "CREATE TABLE Customer (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		firstname VARCHAR(225) NOT NULL,
		lastname VARCHAR(225) NOT NULL,
		email VARCHAR(50),
		phone INT(14),
		password VARCHAR(225),
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	// Account Table . . . 

	$sql = "CREATE TABLE Account (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		customer_id INT(225) NOT NULL,
		post FLOAT(10,2),
		video FLOAT(10,2),
		audio FLOAT(10,2),
		email FLOAT(10,2),	
		balance FLOAT(10,2),
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

