<?php
 session_start();
header("Content-Type: application/json; charset=UTF-8");
$obj=json_decode($_POST["x"], false);//@jboi this is just basically how you should be receiving it from the backend;


  $dbhost  = 'localhost';    // Unlikely to require changing
  $dbname  = 'HJSmith';   // Modify these...depending on the name of the local host database name you create using wamp, i guess its wamps you probably have so it should work fine
  $dbuser  = 'root';   // ...variables according to your username. i guess its also root the last time we met. i saw it. ;-) @jboi
  $dbpass  = '';   // ...according to your password. i couldnt guess what your password was. i am not a hacker.... @jboi

  //You should be farmiliar with all of these...
  $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($connection->connect_error) die("Fatal Error");


 $Post = $obj->Post;
 $Title = $obj->Title;

 $sql = "INSERT INTO Blog (Id, TITLE, POST) 
VALUES (NULL ,'$Title', '$Post')"; //if you want to test these on your PC. make sure when creating your table. you create it in these order. Id, TITLE, POST. Also take note of the case sensitivity Caps and small leters in that same order.


$connection->query($sql);

$sql = "SELECT * FROM Blog";
$result=$connection->query($sql);
$Data=array();
$Data[0]=array('Size'=>$result->num_rows);
for ($count = 1 ; $count < $result->num_rows+1  ; ++$count)
     {
	   $row  = $result->fetch_array(MYSQLI_ASSOC);
	   $Data[$count]= array('Id'=>$row['Id'],'Post'=>$row['POST'],'Title'=>$row['TITLE']);
	 }

 echo json_encode($Data);//delivering back the content to the client

 //if you need anyother help with anything or you dont understand my comments. offcourse you have my number. @jboi. would be expecting the database setup from you and would do the modal signup page by the end of today... peace!!!
?>
