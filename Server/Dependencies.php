<?php
  
  $dbhost  = 'localhost';  
  $dbname  = 'HjSmithLocalHost';   
  $dbuser  = 'root';   
  $dbpass  = '';   

  $Connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($Connection->connect_error) die("Fatal Error");

  function QueryMySql($query)
  {
    global $Connection;
    $result = $Connection->query($query);
    if (!$result) die("Fatal Error");
    return $result;
  }

  function DestroySession()
  {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }

  function SanitizeString($var)
  {
    global $Connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if (get_magic_quotes_gpc())
      $var = stripslashes($var);
    return $Connection->real_escape_string($var);
  }

   function CreateTable($name, $query)
  {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
  }
?>