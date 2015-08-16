<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

sec_session_start(); // Our custom secure way of starting a php session
	
$level = login_check($mysql);

if($level > 0){
	//Login success
	switch($level){
	  case 1:
		//Applicant
		header('Location: ../applicanthome.php');
		break;
	  case 2:
		//Tutor
		header('Location: ../tutorhome.php');
		break;
	  case 3:
		//Client
		header('Location: ../clienthome.php');
		break;
	  case 4:
		//User
		header('Location: ../userhome.php');
		break;
	  case 5:
		//Admin
		header('Location: ../admin/home.php');
		break;
	  default:
		//If other value returned then return to the login page
		header('Location: logout.php');
	}
}else if($level == -1){
	header('Location: ../securityquestions.php');
}else{
	header('Location: ../index.php');
}

?>