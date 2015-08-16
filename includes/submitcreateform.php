<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

sec_session_start(); // Our custom secure way of starting a php session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = test_input($_POST['email']);
	$cpassword = test_input($_POST['confpassword']);
}

function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}

$sql = "SELECT `Password` FROM `Users` WHERE `Username` = ?;";

if ($insert_stmt = $mysql->prepare($sql)) {
	$insert_stmt->bind_param('s', $email);
	// Execute the prepared query.
	$insert_stmt->execute();
	$insert_stmt->store_result();
	$insert_stmt->bind_result($password);
	$insert_stmt->fetch();
	if($insert_stmt->num_rows == 1){
		if($password == NULL){
			//Is new user so enter password
			//echo $cpassword;
			echo 'success';
			exit;
		}else{
			//User already exists
			echo 'user exists';
			exit;
		}
	}else{
		//No Records
		echo 'no user';
		exit;
	}
}else{
   echo 'something went wrong';
   exit;
}




