<?php
  session_start();
  	require_once 'Dependencies.php';
	header("Content-Type: application/json; charset=UTF-8");
	$UserInfo=json_decode($_POST["x"], false);

	$usernameOrEmail = $UserInfo->email;#------like i dunno what u used for the input name so i assumed email sha ---------#
	$password = $UserInfo->password;

	$error = '';

	$check = array();
	$checkMessage = array();
	$check = array('email' => true, 'password' => true);
	$checkMessage = array('email' => '', 'password' => '');

	# check if username/email and password have values in them . . .
	if (empty('email') || empty('password')) {
		$error = ['email' => 'Please enter your Username/Email', 'password' => 'Please enter your password'];
		$check['email'] = false;
		$check['password'] = false;
		$checkMessage['email'] = $error['email'];
		$checkMessage['password'] = $error['password'];

		echo json_encode(array($check, $checkMessage));
		return;
	}

	if ($check['email'] == true || $check['password'] == true) {
		$dbEmailOrUsername = $Connection->query("SELECT * FROM UserInfo WHERE Email = $usernameOrEmail OR Username = $usernameOrEmail");

		if (!$dbEmailOrUsername->num_rows) {
			$error = 'Incorrect Username/Email or Password';
			$check['email'] = false;
			$checkMessage['email'] = $error; 
		}

		if (!password_verify($password, $dbEmailOrUsername['Password'])) {
			$error = 'Incorrect Username/Email or Password';
			$check['password'] = false;
			$checkMessage['password'] = $error;

		}

		if ($check['email'] == false || $check['password'] == false) {
			echo json_encode(array($check, $checkMessage));
			return;
			
		}else {
			#---Temporary---#
			header('location:hjsmith.com.ng');
		}
	}