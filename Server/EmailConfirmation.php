<?php
    session_start();
	require_once 'Dependencies.php';

    $Key= $_GET['ConfirmationKey'];
    $Sql = "SELECT * FROM EmailConfirmation WHERE RandomKey = '$Key'";

    $Result=$Connection->query($Sql);

	if(!$Result->num_rows)
	    header("Location: #"); #link to 404 Error the link has Expired page info.

    $Row  = $Result->fetch_array(MYSQLI_ASSOC);
   
    $UserId    =  $Row['UserId'];
	$FirstName =  $Row['FirstName'];
	$LastName  =  $Row['LastName'];
    $Password  =  $Row['Password'];
    $Email     =  $Row['Email'];
	$Phone     =  $Row['Phone'];
	
    $Sql = "INSERT INTO  UserInfo (UserId, FirstName, LastName, Email, Password, Phone) 
                    VALUES ('$UserId' ,'$FirstName', '$LastName', '$Email', '$Password', '$Phone')";
			        $Connection->query($Sql);

    $Sql= "DELETE FROM EmailConfirmation WHERE RandomKey = '$Key'";
	 $Connection->query($Sql);

	 $_SESSION['User'] = $UserId;
     
	header("Location: ../Client/profile.html"); 
?>
