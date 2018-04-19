<?php
	$pageTitle = "Attendance Details";
	include('function.php');
	include(loadHeader());

	if(isset($_GET['id']))
	{
		$reqID = $_GET['id'];

		
		$sql_validate = "SELECT COUNT(attendanceID) AS 'rowCount' FROM attendances WHERE attendanceID = ?";
		$params_validate = array($reqID);
		$stmt_validate = sqlsrv_query($con, $sql_validate, $params_validate);
	
		while($row = sqlsrv_fetch_array($stmt_validate))
		{
			$rowCount = $row['rowCount'];
		}
	
		if($rowCount == 0)
		{
			header('location: error.php');
		}
		else 
		{

			$sql_details = "SELECT accountID, attendanceIn, attendanceOut, attendanceDate
					        FROM attendances 
					        WHERE attendanceID = ?";
			$params_details = array($reqID);
			$stmt_details = sqlsrv_query($con, $sql_details, $params_details);
	
			$list_attendance= "";
			while($row = sqlsrv_fetch_array($stmt_details))
			{
				$accountID = $row['accountID'];
				$attendanceIn = $row['attendanceIn']->format('h:m');
				$attendanceOut = $row['attendanceOut']->format('h:m');
				$attendanceDate = $row['attendanceDate']->format('m/d/Y');
			}
	
			$msgDisplay = "";
			if(isset($_POST['btnUpdate']))
			{
				
				$aID = $_POST['aID'];
				$timeIn = $_POST['timeIn'];
				$timeOut = $_POST['timeOut'];
				$attDate = $_POST['attDate'];
				
				$sql_update = "UPDATE attendances SET accountID = ?, attendanceIn = ?, attendanceOut = ?, attendanceDate = ?  WHERE attendanceID = ?";
				$params_update = array($aID, $timeIn, $timeOut, $attDate, $reqID);
				$stmt_update = sqlsrv_query($con, $sql_update, $params_update);
	
				if($stmt_update === false)
				{
					$msgDisplay = "<div class='alert alert-danger alert-dismissable fade in'>
										<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										Failed to update client information. Please check your input and try again.
									</div>";
				}
				else
				{
					$txtEvent = "User with ID # " . $accID . " updated the details of client # " . $reqID . ".";
					logEvent($con, $accID, $txtEvent);
	
					header('location: list_attendance.php?update=success');
				}
			}
		}
	}
	else
	{
		header('location: list_attendance.php');
	}

?>