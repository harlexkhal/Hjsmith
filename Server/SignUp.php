<?php
       session_start();
       require_once 'Dependencies.php';
       require_once 'PHPMailer/PHPMailerAutoload.php';

       header("Content-Type: application/json; charset=UTF-8");
       $UserInfo=json_decode($_POST["x"], false);

	   $FirstName = SanitizeString($UserInfo->FirstName);
	   $LastName = SanitizeString($UserInfo->LastName);
       $UserId =   md5($UserInfo->Email);
       $Password = password_hash($UserInfo->Password,PASSWORD_DEFAULT); #To do Check if it matches with The Confirmed password if it is not done from front-end...
       $Email =    $UserInfo->Email;
	   $Phone =    $UserInfo->Phone;
       $Referral=  $UserInfo->Referral;
	   $GenerateKey= rand();
	   $ConfirmationKey = password_hash($GenerateKey,PASSWORD_DEFAULT);

      $Err_Info='';
      $ResponseCheck = array('Email'=>true, 'Password'=>true, 'FirstName'=>true, 'LastName'=>true, 'Phone'=>true);
      $ResponseCheck_Info= array('Email'=>'', 'Password'=>'', 'FirstName'=>'', 'LastName'=>'', 'Phone'=>'');
	  $EmailANDKey= array('Email'=>$Email, 'key'=>$ConfirmationKey);
      #-----First Phase of the check, checking if Username or Email contain values in them-----
     if(empty($Email) || empty($Password) || empty($FirstName) || empty($LastName) || empty($Phone)){
      $Err_Info = "Please, compulsory fields cannot be left empty";
	  $ResponseCheck['Email']=false;
	  $ResponseCheck['Password']=false;
	  $ResponseCheck['FirstName']=false;
	  $ResponseCheck['LastName']=false;
	  $ResponseCheck['Phone']=false;
      $ResponseCheck_Info['Email'] = $Err_Info;
	  $ResoponseChek_Info['Password'] = $Err_Info;
	  $ResponseCheck_Info['FirstName'] = $Err_Info;
	  $ResponseCheck_Info['LastName'] = $Err_Info;
	  $ResponseCheck_Info['Phone'] = $Err_Info;

	  echo json_encode(array($ResponseCheck,$ResponseCheck_Info));
	  return;
     }

       else{
        if (!preg_match("/^[a-zA-Z\s]*$/",$FirstName)) {
            $Err_Info = "Only letters allowed";
			$ResponseCheck_Info['FirstName'] = $Err_Info;
			$ResponseCheck['FirstName']=false;}

	    if (!preg_match("/^[a-zA-Z\s]*$/",$LastName)) {
            $Err_Info = "Only letters allowed";
			$ResponseCheck_Info['LastName'] = $Err_Info;
			$ResponseCheck['LastName']=false;}

		if (!preg_match("/^[0-9()-]*$/",$Phone)) {
            $Err_Info = "You have Inserted an Invalid Phone number, avoid using special characters";
			$ResponseCheck_Info['Phone'] = $Err_Info;
			$ResponseCheck['Phone']=false;}

	    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)){
               $Err_Info = "Invalid Email format";
			   $ResponseCheck_Info['Email'] = $Err_Info;
			   $ResponseCheck['Email']=false;}  
       }
	            
       if($ResponseCheck['Email']==false || $ResponseCheck['FirstName']==false ||
	      $ResponseCheck['LastName']==false || $ResponseCheck['Phone']==false){
	       echo json_encode(array($ResponseCheck,$ResponseCheck_Info));
		   return;}

	   else{
	       #----Second Phase of the check, checking if Username or Email Exist in Database Already----
	       $DbEmail =    $Connection->query("SELECT * FROM UserInfo WHERE Email='$Email'");
	      
		  if ($DbEmail->num_rows){
	           $Err_Info = 'The Email has already been used by another user';
	           $ResponseCheck_Info['Email'] = $Err_Info;
	           $ResponseCheck['Email']=false;}
		  	 
	      if($ResponseCheck['Email']==false){
	             echo json_encode(array($ResponseCheck,$ResponseCheck_Info));
				 return;}
		 
          else
		  {   
		    $Sql="SELECT * FROM EmailConfirmation WHERE Email= '$Email'";
	        $Result=$Connection->query($Sql);
	        if($Result->num_rows)
	        {
	           $Err_Info = 'The email has already been used.';
	           $ResponseCheck_Info['Email'] = $Err_Info;
	           $ResponseCheck['Email']=false;
			   echo json_encode(array($ResponseCheck,$ResponseCheck_Info));
			    return;
	        }
			else
			{
			   $Sql = "INSERT INTO EmailConfirmation (RandomKey, UserId, FirstName, LastName, Email, Password, Phone ) 
               VALUES ('$ConfirmationKey', '$UserId' ,'$FirstName', '$LastName', '$Email', '$Password', '$Phone')";
		       $Connection->query($Sql);
		       echo json_encode(array($ResponseCheck,$ResponseCheck_Info,$EmailANDKey));
		       return;
			}
          }
	  }
	

	 
?>
