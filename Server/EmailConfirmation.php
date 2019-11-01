<?php
    session_start();
	require_once 'Dependencies.php';

    $Key= $_GET['ConfirmationKey'];
    $Sql = "SELECT * FROM EmailConfirmation WHERE RandomKey = '$Key'";

    $Result=$Connection->query($Sql);

	if(!$Result->num_rows)
	    header("Location: #"); #link to 404 Error the link has Expired page info.

    $Row  = $Result->fetch_array(MYSQLI_ASSOC);
   
    $Username = $Row['Username'];
    $Password = $Row['Password'];
    $Email    = $Row['Email'];
	
    $Sql = "INSERT INTO  UserInfo (Username, Password,  Email) 
                    VALUES ('$Username' ,'$Password', '$Email')";
			        $Connection->query($Sql);

    $Sql= "DELETE FROM EmailConfirmation WHERE RandomKey = '$Key'";
	 $Connection->query($Sql);

	 $_SESSION['Username'] = $Username;
     $_SESSION['Password'] = $Password;

	header("Location: LoginTest.html"); #Redirecting to user Home page.
?>
