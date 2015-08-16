<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

sec_session_start(); // Our custom secure way of starting a php session

if(isset($_POST['email'], $_POST['p'])){
	$email = $_POST['email'];
	$password = $_POST['p']; //The hashed password
	
	$level = login($email, $password, $mysql);
	if($level > 0){
		header('Location: portalredirect.php');
	}else if($level == -1){
		header('Location: ../securityquestions.php');
	}else{
		//Login failed
		header('Location: ../login.php?err=FAIL');
	}
}else{
	// The correct POST variable were not sent to this page
	echo 'Invalid Request';
}

?>