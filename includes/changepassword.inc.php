<?php
include_once 'functions.php';
include_once 'db_connect.php';
include_once 'psl-config.php';

sec_session_start(); // Our custom secure way of starting a php session

$error_msg = "";
 
if (isset($_POST['p'], $_POST['op'])) {
    
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
    
    $oldpassword = filter_input(INPUT_POST, 'op', FILTER_SANITIZE_STRING);
    if (strlen($oldpassword) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
    
    $userid = getuserid();
    if($userid == 'FAIL'){
    	$error_msg .= '<p class="error">You are not logged in, please try again.</p>';
    }
 
    $prep_stmt = "SELECT Username, Password, Salt FROM Users WHERE UserID = ? LIMIT 1";
    $stmt = $mysql->prepare($prep_stmt);
    
    if($stmt){
    	$stmt->bind_param('i',$userid);
    	$stmt->execute();
    	$stmt->bind_result($email, $dboldpassword, $salt);
    	$stmt->fetch();
    	$stmt->close();
    }
    
    // Hash the password with the unique salt.
	$oldpassword = hash('sha512', $oldpassword . $salt);
    
    if($oldpassword != $dboldpassword){
    	$error_msg .= '<p class="error">Incorrect password.</p>';
    }
 
    if (empty($error_msg)) {
    
        // Create a random salt
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
 
        //Update the password for the user in the database
        if($insert_stmt = $mysql->prepare("UPDATE Users SET Password = ?, Salt = ? WHERE UserID = $userid")){
        	$insert_stmt->bind_param('ss', $password, $random_salt);
        	if (! $insert_stmt->execute()) {
                header('Location: ./changepassword.php?err=Registration failure: INSERT1');
                exit;
            }
        }else{
        	header('Location: ./changepassword.php?err=Registration failure: INSERT2');
        	exit;
        }
        
        //Login user and then take them to their account
        $level = autologin($email, $password, $mysql);
		if($level > 0){
			header('Location: ./includes/portalredirect.php');
        	exit;
		}else if($level == -1){
			header('Location: ./securityquestions.php');
		}else{
			//Login failed
			header('Location: ./login.php?err=FAIL');
		}
    }else{
    	header('Location: ./changepassword.php?err='.$error_msg);
    }
}