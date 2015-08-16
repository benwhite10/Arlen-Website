<?php

include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

sec_session_start(); // Our custom secure way of starting a php session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$questionid1 = test_input($_POST['question1']);
	$questionid2 = test_input($_POST['question2']);
	$answer1 = test_input($_POST['answer1']);
	$answer2 = test_input($_POST['answer2']);
}

function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}

$userid = $_SESSION['userid'];
$sql = "SELECT `Question` FROM `Security Questions` WHERE ID = $questionid1";
$stmt = $mysql->prepare($sql);

if ($stmt) {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($question1);
    $stmt->fetch();
}

$sql = "SELECT `Question` FROM `Security Questions` WHERE ID = $questionid2";
$stmt = $mysql->prepare($sql);

if ($stmt) {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($question2);
    $stmt->fetch();
}

$sqla = "INSERT INTO `Security Answers`(`UserID`, `Question`, `Answer`) VALUES (?,?,?)";

if ($insert_stmt = $mysql->prepare($sqla)) {
	$insert_stmt->bind_param('iss', $userid, $question1, $answer1);
	// Execute the prepared query.
	$insert_stmt->execute();
}else{
	echo 'fail';
	exit;
}

$sqla = "INSERT INTO `Security Answers`(`UserID`, `Question`, `Answer`) VALUES (?,?,?)";

if ($insert_stmt = $mysql->prepare($sqla)) {
	$insert_stmt->bind_param('iss', $userid, $question2, $answer2);
	// Execute the prepared query.
	$insert_stmt->execute();
}else{
	echo 'fail';
	exit;
}

?>



