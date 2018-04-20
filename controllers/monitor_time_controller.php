<?php
	$pageTitle = "Time Keeping";
	include('function.php');
	include(loadHeader());
	$accID = $_SESSION['accID'];


	$list_stypes = getServiceTypes($con);

	$msgDisplay = "";
	$errDate = "<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Please enter a valid start/end date.
				</div>";
	$errTitle = "<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Please enter a valid project name.
				</div>";
	
	if(isset($_POST['btnSubmit']))
	{
		$sService = $_POST['sService'];
		$sDate = $_POST['sDate'];
		$eDate = $_POST['eDate'];
		$sTime = $_POST['sTime'];
		$eTime = $_POST['eTime'];

		
		#validate start and end date:
		#1. end date > start date
		#2. start date must not be before current date
		#3. end date != start date

		#$currentDate = date('Y-m-d');

		#if($eDate <= $sDate || $sDate < $currentDate)
		#{
			#invalid date entry/entries. show error promt
		#	$msgDisplay = $errDate;
		#}
		#else
		#{
			$sql_insert = "INSERT INTO monitor (stypeID, sDate, eDate, sTime, eTime) 
					   		   VALUES(?, ?, ?, ?, ?)";
				$params_insert = array($sService, $sDate, $eDate, $sTime, $eTime);
				$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

				$txtEvent = "Created a new time keeping record has been added. " . $stypeID;
				logEvent($con, $accID, $txtEvent);

				header('location: monitor_time.php?input=success');
			}
			


?>