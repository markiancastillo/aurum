<?php
	$pageTitle = "Attendance Details";
	include('function.php');
	include(loadHeader());

	if(isset($_GET['id']))
	{
		$reqID = $_GET['id'];

		
		$sql_validate = "SELECT COUNT(monitorID) AS 'rowCount' FROM monitor WHERE monitorID = ?";
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

			$sql_details = "SELECT stypeID, sDate, eDate, sTime, eTime
					        FROM monitor
					        WHERE monitorID = ?";
			$params_details = array($reqID);
			$stmt_details = sqlsrv_query($con, $sql_details, $params_details);
	
			$list_records = "";
			while($row = sqlsrv_fetch_array($stmt_details))
			{
				$stypeID = $row['stypeID'];
				$sDate = $row['sDate']->format('Y-m-d');
				$eDate = $row['eDate']->format('Y-m-d');
				$sTime = $row['sTime']->format('hh:12');
				$eTime = $row['eTime']->format('hh:12');
			}
	
			$msgDisplay = "";
			if(isset($_POST['btnUpdate']))
			{
				$stypeID = $_POST['stypeID'];
				$sDate = $_POST['sDate'];
				$eDate = $_POST['eDate'];
				$sTime = $_POST['sTime'];
				$eTime = $_POST['eTime'];
				
				$sql_update = "UPDATE monitor SET stID = ?, sDate = ?, eDate = ?, sTime = ?, eTime = ?  WHERE monitorID = ?";
				$params_update = array($stID, $sDate, $eDate, $sTime,$eTime, $reqID);
				$stmt_update = sqlsrv_query($con, $sql_update, $params_update);
	
				if($stmt_update === false)
				{
					$msgDisplay = "<div class='alert alert-danger alert-dismissable fade in'>
										<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										Failed to update time information. Please check your input and try again.
									</div>";
				}
				else
				{
					$txtEvent = "User with ID # " . $accID . " updated the details of client # " . $reqID . ".";
					logEvent($con, $accID, $txtEvent);
	
					header('location: list_record.php?update=success');
				}
			}
		}
	}
	else
	{
		header('location: list_record.php');
	}

?>