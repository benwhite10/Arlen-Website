<?php
include_once 'functions.php';
include_once 'db_connect.php';
include_once 'psl-config.php';

sec_session_start(); // Our custom secure way of starting a php session

$error_msg = "";
 
if (isset($_POST['email'], $_POST['p'])) {
    // Sanitize and validate the data passed in
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
 
    $prep_stmt = "SELECT UserID, Username, Password FROM Users WHERE Username = ? LIMIT 1";
    $stmt = $mysql->prepare($prep_stmt);
 
   // check existing email  
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($userid, $email, $pwd);
        $stmt->fetch();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists so you may continue
            if($userid == $email){
            	$error_msg .= '<p class="error">Your email has not been authorised to create an account</p>';
        		$stmt->close();
            }else{
            	if($pwd != ''){
					//The user is not authorised to set up an account
					$error_msg .= '<p class="error">This email already exists on the system</p>';
				}
				$stmt->close();
            }
        }else{
        	$error_msg .= '<p class="error">Your email has not been authorised to create an account</p>';
        	$stmt->close();
        }
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
        //$stmt->close();
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
                header('Location: ./create.php?err=Registration failure: INSERT');
            }
        }else{
        	header('Location: ./create.php?err=Registration failure: INSERT');
        }
        //Login user and then take them to their account
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
    	header('Location: ./create.php?err='.$error_msg);
    }
}