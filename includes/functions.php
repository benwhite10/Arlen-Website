<?php
include_once 'psl-config.php';

function sec_session_start(){
	$session_name = 'sec_session_id';
	$secure = SECURE;
	// This stops Javascript being able to access the session id
	$httponly = true;
	// Forces sessions to only use cookies.
	if (ini_set('session.use_only_cookies',1) === FALSE){
		header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
		exit();
	}
	//Gets current cookie params.
	$cookieParams = session_get_cookie_params();
	session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
	//Sets the session name to the one set above
	session_name($session_name);
	session_start();
	session_regenerate_id(true);
}

function login($username, $password, $mysql){
	//Using prepare statments means that SQL injection is not possible
	if($stmt = $mysql->prepare("SELECT UserID, Username, Password, Salt, `Access Level` FROM Users WHERE Username = ? LIMIT 1")){
		$stmt->bind_param('s',$username); //Bind "$email" to parameter.
		$stmt->execute(); //Execute the prepared query.
		$stmt->store_result();
		
		// Get variables from results
		$stmt->bind_result($userid,$username,$db_password,$salt,$level);
		$stmt->fetch();
		
		// Hash the password with the unique salt.
		$password = hash('sha512', $password . $salt);
		if ($stmt->num_rows == 1){
			//If the user exists we check if their account is locked from too many login attempts
			if (checkbrute($userid, $mysql) == true){
				//Account is locked
				//Send an email to user saying their account is locked
				return 0;
			}else{
				//Check if the password in the database matches the password the user submitted.
				if($db_password == $password){
					//Password is correct! Get the user-agent string of the user.
					$user_browser = $_SERVER['HTTP_USER_AGENT'];
					//XSS protection as we might print this value
					$userid = preg_replace("/[^0-9]+/", "", $userid);
					$_SESSION['userid'] = $userid;
					$username = preg_replace("/[^a-zA-Z0-9_\-]+/","",$username);
					$_SESSION['username'] = $username;
					//Work around no user browser being returned
					$_SESSION['login-string'] = hash('sha512',$password."hello");
					//Login successful
					//Check to see if security questions have been answered
					if($pstmt = $mysql->prepare("SELECT `ID` From `Security Answers` WHERE UserID = ?")){
						$pstmt->bind_param('i',$userid);
						$pstmt->execute();
						$pstmt->store_result();
						if($pstmt->num_rows > 1){
							return $level;
						}else{
							return -1;
						}
					}
					return 0;
				}else{
					//Password is not correct. We record this attempt in the database
					$now = time();
					$mysql->query("INSERT INTO Login_Attempts(UserID, Time) VALUES ('$userid', '$now')");
					return 0;
				}
			}
		}else{
			//No user exists
			return 0;
		}
	}
}

function autologin($username, $password, $mysql){
	//Using prepare statments means that SQL injection is not possible
	if($stmt = $mysql->prepare("SELECT UserID, Username, Password, Salt, `Access Level` FROM Users WHERE Username = ? LIMIT 1")){
		$stmt->bind_param('s',$username); //Bind "$email" to parameter.
		$stmt->execute(); //Execute the prepared query.
		$stmt->store_result();
		
		// Get variables from results
		$stmt->bind_result($userid,$username,$db_password,$salt,$level);
		$stmt->fetch();
		
		if ($stmt->num_rows == 1){
			//If the user exists we check if their account is locked from too many login attempts
			if (checkbrute($userid, $mysql) == true){
				//Account is locked
				//Send an email to user saying their account is locked
				return 0;
			}else{
				//Check if the password in the database matches the password the user submitted.
				if($db_password == $password){
					//Password is correct! Get the user-agent string of the user.
					$user_browser = $_SERVER['HTTP_USER_AGENT'];
					//XSS protection as we might print this value
					$userid = preg_replace("/[^0-9]+/", "", $userid);
					$_SESSION['userid'] = $userid;
					$username = preg_replace("/[^a-zA-Z0-9_\-]+/","",$username);
					$_SESSION['username'] = $username;
					//Work around no user browser being returned
					$_SESSION['login-string'] = hash('sha512',$password."hello");
					//Login successful
					//Check to see if security questions have been answered
					if($pstmt = $mysql->prepare("SELECT `ID` From `Security Answers` WHERE UserID = ?")){
						$pstmt->bind_param('i',$userid);
						$pstmt->execute();
						$pstmt->store_result();
						if($pstmt->num_rows > 1){
							return $level;
						}else{
							return -1;
						}
					}
					return 0;
				}else{
					//Password is not correct. We record this attempt in the database
					$now = time();
					$mysql->query("INSERT INTO Login_Attempts(UserID, Time) VALUES ('$userid', '$now')");
					return 0;
				}
			}
		}else{
			//No user exists
			return 0;
		}
	}
}

function checkbrute($userid, $mysql){
	//Get the timestamp of the current time
	$now = time();
	
	//All the login attempts are counted from the past 2 hours
	$valid_attempts = $now - (2*60*60);
	
	if($stmt = $mysql->prepare("SELECT Time FROM Login_Attempts WHERE UserID = ? AND time > '$valid_attempts'")){
		$stmt->bind_param('i', $userid);
		
		//Execute the prepared query
		$stmt->execute();
		$stmt->store_result();
		
		//If there have been more than 5 failed logins
		if($stmt->num_rows > 5){
			return true;
		}else{
			return false;
		}
	} 
}

function login_check($mysql){
	//Check if all session variables are set
	if(isset($_SESSION['userid'],$_SESSION['username'],$_SESSION['login-string'])){
		$userid = $_SESSION['userid'];
		$login_string = $_SESSION['login-string'];
		$username = $_SESSION['username'];
		
		//Get the user-agent sring of the user.
		$user_browser = $_SESSION['HTTP_USER_AGENT'];
		
		if($stmt = $mysql->prepare("SELECT Password, `Access Level` FROM Users WHERE UserID = ? LIMIT 1")){
			// Bind "$userid" to parameter.
			$stmt->bind_param('i',$userid);
			$stmt->execute();
			$stmt->store_result();
			
			if($stmt->num_rows == 1){
				//If the user exists get the variables from result.
				$stmt->bind_result($password, $level);
				$stmt->fetch();
				//Work around no user browser being returned
				$login_check = hash('sha512', $password . "hello");
				
				$mysql->close;
				
				if($login_check == $login_string){
					//Logged In
					if($pstmt = $mysql->prepare("SELECT `ID` From `Security Answers` WHERE UserID = ?")){
						$pstmt->bind_param('s',$userid);
						$pstmt->execute();
						$pstmt->store_result();
						if($pstmt->num_rows > 1){
							return $level;
						}else{
							return -1;
						}
					}
					return 0;
				}else{
					//Not logged in
					return 0;
				}
			}else{
				//Not logged in
				return 0;
			}
		}else{
			//Not logged in
			return 0;
		}
	}else{
		//Not logged in
		return 0;
	}
}

function esc_url($url){
	
	if('' == $url){
		return $url;
	}
	
	$url = preg_replace('|[^a-z0-9-~+_.?#!&;,/:%@$\|*\'()\\x80-\\xff]|i','',$url);
	
	$strip = array('%0d', '%0a', '%0D', '%0A');
	$url = (string)$url;
	
	$count = 1;
	while($count){
		$url = str_replace($strip, '', $url, $count);
	}
	
	$url = str_replace(';//', '://', $url);
	
	$url = htmlentities($url);
	
	$url = str_replace('&amp;', '&#038;', $url);
	$url = str_replace("'", '&#039;', $url);
	
	if($url[0] !== '/'){
		// We're only interested in relative links from $_SERVER['PHP_SELF]
		return '';
	}else{
		return $url;
	}
}

function getuserid(){
	if(isset($_SESSION['userid'])){
		return $_SESSION['userid'];
	}else{
		return 'FAIL';
	}
}