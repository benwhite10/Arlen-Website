<?php
include_once 'functions.php';
include_once 'db_connect.php';
include_once 'psl-config.php';

sec_session_start(); // Our custom secure way of starting a php session

$error_msg = "";
 
if (isset($_POST['email'], $_POST['p'])) {
    // Sanitize and validate the data passed in
    $userid = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
 
    $prep_stmt = "SELECT Password FROM Users WHERE UserID = ? LIMIT 1";
    $stmt = $mysql->prepare($prep_stmt);
 
   // check existing email  
    if ($stmt) {
        $stmt->bind_param('s', $userid);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($test);
        $stmt->fetch();
 
        if ($test != "b7d£so!"){
        	$error_msg .= '<p class="error">Something has gone wrong, please try again.</p>';
        }
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
    }
 
    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
 
        //Update the password for the user in the database
        if($insert_stmt = $mysql->prepare("UPDATE Users SET Password = ?, Salt = ? WHERE UserID = $userid")){
        	$insert_stmt->bind_param('ss', $password, $random_salt);
        	if (! $insert_stmt->execute()) {
                header('Location: ./login.php?err=Registration failure: INSERT');
            }
        }else{
        	header('Location: ./login.php?err=Registration failure: INSERT');
        }
        //Login user and then take them to their account
        
    	//NEED TO GET THE EMAIL
        $level = autologin($email, $password, $mysql);
        
		if($level > 0){
			header('Location: ./includes/portalredirect.php');
		}else if($level == -1){
			header('Location: ./securityquestions.php');
		}else{
			//Login failed
			header('Location: ./login.php?err=FAIL');
		}
    }else{
    	header('Location: ./login.php?err='.$error_msg);
    }
}