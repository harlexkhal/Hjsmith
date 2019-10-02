<?php
  $dbhost  = 'localhost';  
  $dbname  = 'HjSmith';   
  $dbuser  = 'root';   
  $dbpass  = '';   

  $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($connection->connect_error) die("Fatal Error");

  function QueryMySql($query)
  {
    global $connection;
    $result = $connection->query($query);
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

  function checkIfExist($firstname, $lastname, $email, $phone, $password) {
    $check = false;
    $encrypt = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $dbconn->prepare('SELECT * FROM customer WHERE email = :email OR password = :password');
    $stmt->execute([
      ':email' => $email,
      ':password' => $encrypt
    ]);

    if ($stmt->rowCount() == 1) {
      return $check;
    }else{
      register($dbconn, $firstname, $lastname, $email, $phone, $encrypt);
      $check = true;
    }

    return $check;
  }
  
  //Register a Customer
  function register($dbconn, $firstname, $lastname, $email, $phone, $encrypt) {
    $stmt = $dbconn->prepare('INSERT INTO customer WHERE (firstname, lastname, email, phoneNumber, password) VALUES (:fname, :lname, :email, :phone, :password)');

    $data = [
      ':fname' => $firstname,
      ':lname' => $lastname,
      ':email' => $email,
      ':phone' => $phone,
      ':password' => $encrypt
    ];

    $stmt->execute($data);

    if ($stmt->rowCount() == 1) {
      createAccount($dbconn);
    }
  }

  // To login the Customer
  function doLogin($dbconn, $email, $password) {
    $login = false;
    $stmt = $dbconn->prepare('SELECT * FROM customer WHERE email=:em');
    $stmt->execute([
      ':em' => $email,
    ]);
    if ($stmt->rowCount() != 1) {
      return $login;
    }
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($password, $record['password'])) {
      return $login;
    }

    $login = true;

    return $login;
  }

  //to create an account immediatly for the customer
  function getCustomerDetail($dbconn){
    $stmt = $dbconn->prepare("SELECT * FROM customer ORDER BY id DESC LIMIT 1");
    $stmt->execute();

    $detail = $stmt->fetch(PDO::FETCH_ASSOC);
    return $detail;
  }

  function addAccount($dbconn, $customer_id, $video, $audio, $post, $balance) {

    $stmt = $dbconn->prepare("INSERT INTO account(customer_id, video, audio, post, balance) VALUES(:id, :video, :audio, :post, :bal)");
      $data = [
      ':id' => $customer_id,
      ':video' => $video,
      ':audio' => $audio,
      ':post' => $post,
      ':bal' => $balance
    ];
    $stmt->execute($data);
  }

  function createAccount($dbconn) {
    $audio = 0;
    $video = 0;
    $post = 0;
    $balance = 500;
    $customer = getCustomerDetail($dbconn);
    $customer_id = $customer['id'];

    addAccount($dbconn, $customer_id, $video, $audio, $post, $balance);

  }

  function createPost($dbconn, $title, $body) {
    $stmt = $dbconn->prepare('INSERT INTO post WHERE (title, body) VALUES (:title, :body)');
    $stmt->execute([
      ':title' => $tilte,
      ':body' => $body
    ]);
  }


?>