<?php
  session_start();
  require_once 'Dependencies.php';
header("Content-Type: application/json; charset=UTF-8");
$UserInfo=json_decode($_POST["x"], false);


 $Username =  SanitizeString($UserInfo->Username);
 $Password =  md5($UserInfo->Password); #---using md5 encryption algorithm---
 $Email =     $UserInfo->Email;
 $Referral=   $UserInfo->Referral;

 $Err_Info='';

 $ResponseCheck = array('Username'=>true,'Email'=>true, 'Password'=>true);
 $ResponseCheck_Info= array('Username'=>'','Email'=>'', 'Password'=>'');

  #-----First Phase of the check, checking if Username or Email contain values in them-----
     if(empty($Username) || empty($Email) || empty($Password)){
      $Err_Info = "Please, compulsory fields cannot be left empty";
	  $ResponseCheck['Username']=false;
	  $ResponseCheck['Email']=false;
	  $ResponseCheck['Password']=false;
      $ResponseCheck_Info['Email'] = $Err_Info;
	  $ResponseCheck_Info['Username'] = $Err_Info;
	  $ResoponseChek_Info['Password'] = $Err_Info;

	  echo json_encode(array($ResponseCheck,$ResponseCheck_Info));
	  return;
     }

     else{
       if (!preg_match("/^[a-zA-Z0-9]*$/",$Username)) {
            $Err_Info = "Only letters and numbers allowed";
			$ResponseCheck_Info['Username'] = $Err_Info;
			$ResponseCheck['Username']=false;
       }

	    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)){
               $Err_Info = "Invalid Email format";
			   $ResponseCheck_Info['Email'] = $Err_Info;
			   $ResponseCheck['Email']=false;
        }  
     }
	            
      if($ResponseCheck['Email']==false || $ResponseCheck['Username']==false){
	       echo json_encode(array($ResponseCheck,$ResponseCheck_Info));
		   return;
	    }

	  else{
	   #----Second Phase of the check, checking if Username or Email Exist in Database Already----
	     $DbEmail =    $Connection->query("SELECT * FROM UserInfo WHERE Email='$Email'");
	     $DbUsername = $Connection->query("SELECT * FROM UserInfo WHERE Username='$Username'");
	    
          
		  if ($DbEmail->num_rows){
	           $Err_Info = 'The Email has already been used by another user';
	           $ResponseCheck_Info['Email'] = $Err_Info;
	           $ResponseCheck['Email']=false;
	      }
		  
		  if ($DbUsername->num_rows){
	        $Err_Info = 'That Username already exists';
	        $ResponseCheck_Info['Username'] = $Err_Info;
	         $ResponseCheck['Username']=false;
	      }
         
	      if($ResponseCheck['Email']==false || $ResponseCheck['Username']==false){
	             echo json_encode(array($ResponseCheck,$ResponseCheck_Info));
				 return;
	      }

          else{
            $Sql = "INSERT INTO UserInfo (Username, Password, Email) 
                    VALUES ('$Username' ,'$Password', '$Email')";
			        $Connection->query($Sql);
					echo json_encode(array($ResponseCheck,$ResponseCheck_Info));
					return;
          }
	  }
	

	 
?>
