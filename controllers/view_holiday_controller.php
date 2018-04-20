<?php
	$pageTitle = "";
	include('function.php');
	include(loadHeader());

	$accID = $_SESSION['accID'];
	$hID = $_GET['id'];

	$dispMsg = "";
	$successMsg = "<div class='alert alert-success alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Successfully updated.
					</div>";
	$errorMsg = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Failed to update.
					</div>";					

	$sql_holiday = "SELECT holidayName, holidayDate, holidayRate FROM holidays WHERE holidayID = ?";
	$params_holiday = array($hID);
	$stmt_holiday = sqlsrv_query($con, $sql_holiday, $params_holiday);

	while($row = sqlsrv_fetch_array($stmt_holiday))
	{
		$holidayName = $row['holidayName'];
		$holidayDate = $row['holidayDate']->format('YYYY-MM-DD');
		$holidayRate = $row['holidayRate'];
	}
	
	if(isset($_POST['btnSave']))
	{
		#update the holiday 
		$inpName = $_POST['inpName'];
		$inpDate = $_POST['inpDate'];
		$inpRate = $_POST['inpRate'];
		
		$sql_update = "UPDATE holidays SET holidayName = ?, holidayDate = ?, holidayRate = ? WHERE holidayID = ?";
		$params_update = array($inpName, $inpDate, $inpRate, $hID);
		$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

		if($stmt_update === false)
		{
			#print_r(sqlsrv_error(), true);
			$dispMsg = $errorMsg;
		}
		else 
		{
			$txtEvent = "User updated the value/s for the holiday: " . $inpName . "(" . $holidayName . ").";
			logEvent($con, $accID, $txtEvent);
			header('location: manage_holidays.php?update=success');
		}
	}
?>