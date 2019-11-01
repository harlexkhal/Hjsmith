<?php
      session_start();
	  require_once 'Dependencies.php';
	  require_once 'PHPMailer/PHPMailerAutoload.php';

	  $UsernameOREmail =  $_POST['Username'];

	  if(empty($UsernameOREmail))
	  {
	     // header("Location: #"); #redirect back to page with error of empty field...
	  }

	  $DbCheck = $Connection->query("SELECT * FROM UserInfo WHERE Username = '$UsernameOREmail' OR Email = '$UsernameOREmail'");

	  if ($DbCheck->num_rows)
	  {
           $Row  = $DbCheck->fetch_array(MYSQLI_ASSOC);
		   $Email = $Row['Email'];
		   $Password = $Row['Password'];

		   $mail = new PHPMailer;
           $mail->isSMTP();
		   $mail->SMTPDebug = 2;
           $mail->Host = 'smtp.gmail.com';
           $mail->SMTPAuth = true;
           $mail->Username = 'harlexibeh04@gmail.com';
           $mail->Password = 'Nickelodeo';
           $mail->SMTPSecure = 'tls';
           $mail->Port = 587;
           $mail->setFrom('harlexibeh04@gmail.com', 'Hjbsmith');
           $mail->addAddress("$Email",'User'); 
           $mail->Subject = 'Hjbsmith Password';
           $mail->Body    = "Your Password is $Password, please keep this confidential to your self and delete this email after confirming. for security reasons";
           #$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		   header("Location: #"); #----direct back to page that gives info about checking your Email----
	  }
?>
