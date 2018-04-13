<?php
	#session_start();
	include('function.php');
	include('config.php');

	$accID = $_SESSION['accID'];
	$txtEvent = "User with ID # " . $accID . " logged out.";
	logEvent($con, $accID, $txtEvent);

	session_destroy();
	header('location: ../login.php');
?>