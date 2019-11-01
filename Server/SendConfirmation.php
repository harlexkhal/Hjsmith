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
    $mail->Body    = "<a href='localhost/HjSmith/Hjsmith/Server/EmailConfirmation.php?ConfirmationKey=$ConfirmationKey'>Click</a>";

   if($mail->send())
   {
	   $Connection->query($Sql);
	   header("Location: ConfirmTextDemo.html");
   }

	
?>