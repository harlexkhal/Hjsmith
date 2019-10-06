<?php
  session_start();
  require_once 'Dependencies.php';
header("Content-Type: application/json; charset=UTF-8");
$UserInfo=json_decode($_POST["x"], false);


 $Username = SanitizeString($UserInfo->Username);
 $Password = password_hash($UserInfo->Password);
 $Email = SanitizeString($UserInfo->Email);
 $Referral=$UserInfo->Referral;

 $Err_Info='';

 $ResponseCheck=array();
  $ResponseCheckInfo=array(); 
 $ResponseCheck = array('Username'=>1,'Email'=>1);
 $ResponseCheck_Info= array('Username'=>$Error_Info,'Email'=>$Error_Info);

  #-----First Phase of the check, checking if Username or Email contain values in them-----
     if(empty($Username) || empty($Email))
     {
      $Err_Info = "Please, compulsory fields cannot be left empty"
	  $ResPonseCheck['Username']=0;
	  $ResPonseCheck['Email']=0;
      $ResPonseCheck_Info['Email'] = $Err_Info;
	  $ResPonseCheck_Info['Username'] = $Err_Info;

	  echo json_encode(array($ResponseCheck,$ResponseCheck_Info));
     }

     else
     {
       if (!preg_match("/^[a-zA-Z0-9]*$/",$Username)) 
	   {
            $Err_Info = "Only letters and numbers allowed";
			$ResPonseCheck_Info['Username'] = $Err_Info;
			$ResPonseCheck['Username']=false;
       }

	   if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) 
	   {
            $Err_Info = "Invalid Email format";
			$ResPonseCheck_Info['Email'] = $Err_Info;
			$ResPonseCheck['Email']=false;
       }

	   if($ResPonseCheck['Email']==false || $ResPonseCheck['Username']==false)
	   {
	       // echo json_encode(array($ResponseCheck,$ResponseCheck_Info));
	   }
     }

	 #----Second Phase of the check, checking if Username or Email Exist in Database Already----
	   $DbUsername = $Connection->query("SELECT * FROM UserInfo WHERE Username='$Username'");
	   $DbEmail =    $Connection->query("SELECT * FROM UserInfo WHERE Email='$Email'");
      if ($DbUsername->num_rows)
	  {
	   $Err_Info = 'That Username already exists';
	   $ResPonseCheck_Info['Username'] = $Err_Info;
	   $ResPonseCheck['Email']=false;
	  }
      if ($DbEmail->num_rows)
	  {
	   $Err_Info = 'The Email has already been used by another user';
	   $ResPonseCheck_Info['Email'] = $Err_Info;
	   $ResPonseCheck['Email']=false;
	  }

	 if($ResPonseCheck['Email']==false || $ResPonseCheck['Username']==false)
	 {
	   //echo json_encode(array($ResponseCheck,$ResponseCheck_Info));
	 }

     else
     {
       $Sql = "INSERT INTO UserInfo (Username, Password, Email) 
               VALUES ('$Username' ,'$Password', '$Email')";
			   $Connection->query($Sql);
     }

	 
?>
