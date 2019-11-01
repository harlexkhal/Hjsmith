<?php
  session_start();
  	require_once 'Dependencies.php';
	header("Content-Type: application/json; charset=UTF-8");
	$UserInfo=json_decode($_POST["x"], false);


     $Username =  SanitizeString($UserInfo->Username);
     $Password =  $UserInfo->Password;

     $Authentication = array('Check'=>true,'Info'=>'');

	 if(empty($Username) || empty($Password)){
	  $Authentication['Check']= false;
	  $Authentication['Info']= "Please, compulsory fields cannot be left empty";
	  echo json_encode($Authentication);
	  return;
     }
	
	if ($Authentication['Check']==true) {
	#---Second phase of the check-> checking if Username matches the Password---
	    
		$DbAuthentication = $Connection->query("SELECT * FROM UserInfo WHERE Username = '$Username'");
		$Fetch = $DbAuthentication->fetch_array(MYSQLI_ASSOC);
		$Hash = $Fetch['Password'];

		if (!$DbAuthentication->num_rows || !password_verify($Password, $Hash)){
	         $Authentication['Check']=false;
	         $Authentication['Info']= "Incorrect username or password";
			 echo json_encode($Authentication);
	         return;
		}

		else {
		     $_SESSION['Username'] = $Username;
             $_SESSION['Password'] = $Password;
			echo json_encode($Authentication);
			return;
		}
	}
?>