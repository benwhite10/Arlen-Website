<?php

include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

sec_session_start(); // Our custom secure way of starting a php session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = test_input($_POST['name']);
	$email = test_input($_POST['email']);
	$number = test_input($_POST['number']);
	$method = test_input($_POST['method']);
	$extra = test_input($_POST['extrainfo']);
	$level = test_input($_POST['level']);
	$levelother = test_input($_POST['levelother']);
	$description = test_input($_POST['description']);
	$heard = test_input($_POST['heard']);
	$heardother = test_input($_POST['heardother']);
	date_default_timezone_set('Europe/London');
	$date = date("Y-m-d H:i:s");
	if($heard == 'other') $heard = $heardother;
	if($level == 'Other') $level = $levelother;
}

function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}

$sql = "INSERT INTO `Client Applications` (`Application Date`, `Status`, `Name`, `Number`, `Email`, `Method`, `Extra Contact Info`, `Level`, `Description`, `Heard`) VALUES ('$date','Waiting for review',?,?,?,?,?,?,?,?);";

if ($insert_stmt = $mysql->prepare($sql)) {
	$insert_stmt->bind_param('ssssssss', $name, $number, $email, $method, $extra, $level, $description, $heard);
	// Execute the prepared query.
	$insert_stmt->execute();
}

?>



