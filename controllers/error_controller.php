<?php
	$pageTitle = "Error";
	include('function.php');
	include(loadHeader());

	#header('refresh: 5; url=index.php');

	if(isset($_POST['btnHome']))
	{
		header('location: '. $_SERVER['DOCUMENT_ROOT'] . '/aurum/index.php');
	}
?>