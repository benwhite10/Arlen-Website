<?php

include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';

sec_session_start(); // Our custom secure way of starting a php session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$sql = "SELECT ID FROM `Website Text`";
	$stmt = $mysql->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($id);
	//$result = $mysql->query($sql);
	while ($stmt->fetch()) {
  		$results_array[] = $id;
	}

	foreach($results_array as $id){
		$test = $_POST[$id];
		$sql = "UPDATE `Website Text` SET `Text` = '$test' WHERE `ID` = $id";
		$stmt = $mysql->prepare($sql);
		$stmt->execute();
	}
	
	header("Location: home.php");
}
