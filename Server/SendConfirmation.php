<?php 
    session_start();
    require_once 'Dependencies.php';
    require_once 'PHPMailer/PHPMailerAutoload.php';
    
	$Email= $_GET['Email'];
	$ConfirmationKey= $_GET['Key'];

	$Sql="SELECT * FROM EmailConfirmation WHERE Email= '$Email'";
	$Result=$Connection->query($Sql);
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'harlexibeh04@gmail.com';
    $mail->Password = 'Nickelodeo';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->setFrom('harlexibeh04@gmail.com', 'Hjbsmith');
    $mail->addAddress("$Email",'New User'); 
    $mail->Subject = 'Signup Email Confirmation';
    $mail->Body    = "Click on the button to continue complete the registration process 
	                   <button style='padding:5px; background-color:deeppink; border:none;  border-radius: 50px; -moz-border-radius: 50px; -webkit-border-radius: 50px;'>
					   <a href='localhost/HjSmith/Hjsmith/Server/EmailConfirmation.php?ConfirmationKey=$ConfirmationKey' style='color=white !important; text-decoration:none; padding:13px;'>
					   Click
					   </a></button>";

   if($mail->send())
   {
	   $Connection->query($Sql);
	   header("Location: ../Client/mailsent.html");
   }

	
?>