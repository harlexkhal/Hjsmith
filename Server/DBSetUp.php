<?php
  $dbhost  = 'localhost';  
  $dbuser  = 'root';   
  $dbpass  = '';   

  $Connection = new mysqli($dbhost, $dbuser, $dbpass);
  if ($Connection->connect_error) die("Fatal Error");

$Sql= "DROP DATABASE HjSmithLocalHost";
  if($Connection->query($Sql)===true){ echo "Database Refreshing......<br/>";}

$Sql= "CREATE DATABASE HjSmithLocalHost";

  if($Connection->query($Sql)===true){ echo "Database created successfully";}
  else { echo "Error creating database: " . $Connection->error;}

$Connection->close();
?>