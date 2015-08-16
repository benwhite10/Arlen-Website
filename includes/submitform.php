<?php

include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

sec_session_start(); // Our custom secure way of starting a php session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$firstname = test_input($_POST['firstname']);
	$surname = test_input($_POST['surname']);
	$email = test_input($_POST['email']);
	$number = test_input($_POST['number']);
	$skype = test_input($_POST['skype']);
	$othersubjects = test_input($_POST['extrasubjects']);
	$addline1 = test_input($_POST['addline1']);
	$addline2 = test_input($_POST['addline2']);
	$addcity = test_input($_POST['addcity']);
	$addcounty = test_input($_POST['addcounty']);
	$postcode = test_input($_POST['postcode']);
	$university = test_input($_POST['university']);
	$course = test_input($_POST['course']);
	$degree = test_input($_POST['degree']);
	$biography = test_input($_POST['biography']);
	$experience = test_input($_POST['experience']);
	$situation = test_input($_POST['situation']);
	$testimonials = test_input($_POST['testimonials']);
	$heard = test_input($_POST['heard']);
	$heardother = test_input($_POST['heardother']);
	$notes = test_input($_POST['notes']);
	date_default_timezone_set('Europe/London');
	$date = date("Y-m-d H:i:s");
	if($heard == 'other') $heard = $heardother;
}

function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}

if($insert_stmt = $mysql->prepare("INSERT INTO `Users` (`UserID`, `Username`, `Access Level`) VALUES (NULL,'temp',6);")){
  $insert_stmt->execute();
}

$prep_stmt = "SELECT `UserID` FROM `Users` WHERE `Username` = 'temp' LIMIT 1";
$stmt = $mysql->prepare($prep_stmt);

if ($stmt) {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($UserID);
    $stmt->fetch();
}

$sql = "INSERT INTO `Tutor Applications` (`Application Date`, `UserID`, `First Name`, `Surname`, `Email`, `Phone`, `Skype Name`, `Address Line 1`, `Address Line 2`, `Town/City`, `County`, `Postcode`, `University`, `University Course`, `University Result`, `Biography`, `Experience`, `Situation`, `Testimonials`, `Found Out`, `Other Notes`, `Other Subjects`, `AcceptedTerms`, `Result`) VALUES ('$date',$UserID,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, TRUE, 'Waiting for review');";

if ($insert_stmt = $mysql->prepare($sql)) {
	$insert_stmt->bind_param('ssssssssssssssssssss', $firstname, $surname, $email, $number, $skype, $addline1, $addline2, $addcity, $addcounty, $postcode, $university, $course, $degree, $biography, $experience, $situation, $testimonials, $heard, $notes, $othersubjects);
	// Execute the prepared query.
	$insert_stmt->execute();
}

if(!empty($_POST['subject1'])){
	$subject = $_POST['subject1'];
	if(!empty($_POST['Sub1'])){
	  foreach($_POST['Sub1'] as $level){
		$test = $mysql->prepare("INSERT INTO `User-Subject Links` (`UserID`,`SubjectID`,`LevelID`) VALUES ('$UserID', $subject, $level);");
		$test->execute();
	  }
	}
}

if(!empty($_POST['subject2'])){
	$subject = $_POST['subject2'];
	if(!empty($_POST['Sub2'])){
	  foreach($_POST['Sub2'] as $level){
		$test = $mysql->prepare("INSERT INTO `User-Subject Links` (`UserID`,`SubjectID`,`LevelID`) VALUES ('$UserID', $subject, $level);");
		$test->execute();
	  }
	}
}

if(!empty($_POST['subject3'])){
	$subject = $_POST['subject3'];
	if(!empty($_POST['Sub3'])){
	  foreach($_POST['Sub3'] as $level){
		$test = $mysql->prepare("INSERT INTO `User-Subject Links` (`UserID`,`SubjectID`,`LevelID`) VALUES ('$UserID', $subject, $level);");
		$test->execute();
	  }
	}
}

if(!empty($_POST['subject4'])){
	$subject = $_POST['subject4'];
	if(!empty($_POST['Sub4'])){
	  foreach($_POST['Sub4'] as $level){
		$test = $mysql->prepare("INSERT INTO `User-Subject Links` (`UserID`,`SubjectID`,`LevelID`) VALUES ('$UserID', $subject, $level);");
		$test->execute();
	  }
	}
}

if(!empty($_POST['subject5'])){
	$subject = $_POST['subject5'];
	if(!empty($_POST['Sub5'])){
	  foreach($_POST['Sub5'] as $level){
		$test = $mysql->prepare("INSERT INTO `User-Subject Links` (`UserID`,`SubjectID`,`LevelID`) VALUES ('$UserID', $subject, $level);");
		$test->execute();
	  }
	}
}

$stmt = "";
$stmt = $mysql->prepare("UPDATE `Users` SET `Username` = '$UserID' WHERE `UserID` = $UserID");
if($stmt){
	$stmt->execute();
}

?>



