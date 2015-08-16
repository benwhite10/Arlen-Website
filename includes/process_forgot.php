<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

sec_session_start(); // Our custom secure way of starting a php session

if(isset($_POST['email'])){
	$email = $_POST['email'];
	
	$sql = "SELECT `UserID` FROM Users WHERE Username = ?";
	if($stmt = $mysql->prepare($sql)){
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->bind_result($userid);
		$stmt->fetch();
		$stmt->close();
	}
	
	if($userid > 0){
		header('Location: ../forgot2.php?x3cb2st='.$userid);
	}else{
		//Login failed
		$errormsg = 'No user with that e-mail exists';
		header('Location: ../forgot1.php?err='.$errormsg);
	}
}else if(isset($_POST['answer1'], $_POST['answer2'], $_POST['questionid1'], $_POST['questionid2'])){
	
	$sql = "SELECT `Answer` FROM `Security Answers` WHERE `ID` = ?";
	if($stmt = $mysql->prepare($sql)){
		$stmt->bind_param('i',$_POST['questionid1']);
		$stmt->execute();
		$stmt->bind_result($dbanswer1);
		$stmt->fetch();
		$stmt->close();
	}
	if($stmt = $mysql->prepare($sql)){
		$stmt->bind_param('i',$_POST['questionid2']);
		$stmt->execute();
		$stmt->bind_result($dbanswer2);
		$stmt->fetch();
		$stmt->close();
	}
	
	$answer1 = $_POST['answer1'];
	$answer2 = $_POST['answer2'];
	
	if($answer1 == $dbanswer1 && $answer2 == $dbanswer2){
		//Correct
		//Get userid
		$sql = "SELECT `UserID` FROM `Security Answers` WHERE `ID` = ?";
		if($stmt = $mysql->prepare($sql)){
			$stmt->bind_param('i',$_POST['questionid1']);
			$stmt->execute();
			$stmt->bind_result($userid);
			$stmt->fetch();
			$stmt->close();
		}
		
		$sql = "UPDATE Users SET Password = 'b7d£so!', Salt = '' WHERE UserID = ?";
		if($stmt = $mysql->prepare($sql)){
			$stmt->bind_param('i',$userid);
			$stmt->execute();
			$stmt->close();
		}
		
		header('Location: ../resetpassword.php?u1d='.$userid);
		
		exit;
	}else{
		//Incorrect
		$errormsg = 'Your answers were incorrect, please try again';
		header('Location: ../forget2.php?err=');
		exit;
	}
	

}else{
	// The correct POST variable were not sent to this page
	$errormsg = 'Sorry but something went wrong, please try again';
	header('Location: ../forgot1.php?err='.$errormsg);
}

?>