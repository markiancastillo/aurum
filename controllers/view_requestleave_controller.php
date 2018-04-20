<?php
	$pageTitle = "Leave Request Details";
	include('function.php');
	include(loadHeader());

	$reqID = $_GET['id'];	#accountID
	$lID = $_GET['type'];	#ltypeID
	$l = $_GET['l'];		#leaveID

	#get the data for the form
	$sql_countRows = "SELECT COUNT(leaveID) AS 'rowCount' FROM leaves 
					  WHERE leaveStatus != 'Approved' AND leaveStatus != 'Disapproved' AND accountID != $accID";
	$stmt_countRows = sqlsrv_query($con, $sql_countRows);
	while($rowC = sqlsrv_fetch_array($stmt_countRows))	
	{
		$rowCount = $rowC['rowCount'];
	}

	$sql_listRequest= "SELECT leaveID, l.ltypeID, t.ltypeName, leaveFileDate, leaveFrom, leaveTo, leaveReason, leaveStatus FROM leaves l
						INNER JOIN leavetypes t ON l.ltypeID = t.ltypeID
						WHERE accountID = ? AND l.ltypeID = ?";
	$params_listRequest = array($reqID, $lID);
	$stmt_listRequest = sqlsrv_query($con, $sql_listRequest, $params_listRequest);

	$listRequest = "";
	while($row = sqlsrv_fetch_array($stmt_listRequest))
	{
		$leaveID = $row['leaveID'];
		$ltypeID = $row['ltypeID'];
		$ltypeName = $row['ltypeName'];
		$leaveFileDate = $row['leaveFileDate']->format('m/d/Y');
		$leaveFrom = $row['leaveFrom']->format('m/d/Y');
		$leaveTo = $row['leaveTo']->format('m/d/Y');
		$leaveReason = htmlspecialchars($row['leaveReason'], ENT_QUOTES, 'UTF-8');
		$leaveStatus = $row['leaveStatus'];	
	}

	$sql_rem = "SELECT lcAmount	FROM leavecounts 
				WHERE accountID = ? AND ltypeID = ?";
	$params_rem = array($reqID, $ltypeID);
	$stmt_rem = sqlsrv_query($con, $sql_rem, $params_rem);
	while($rowr = sqlsrv_fetch_array($stmt_rem))
	{
		$lcAmount = $rowr['lcAmount'];
	}

	$lcRemaining = 15 - $lcAmount;
	if($lcRemaining > 0)
	{
		$lcDisplay = "<strong>" . $lcRemaining . "</strong>" . " remaining for " . $ltypeName . " leave.";	
	}
	else
	{
		$lcDisplay = "<strong><span style='color: red'>" . $lcRemaining . "</span></strong>" . " remaining for " . $ltypeName . " leave.";
	}
	
	#$lcDisplay = $lcRemaining . " remaining for " . $ltypeName . " leave.";

	$msgDisplay = "";
	$msgError = "<div class='alert alert-danger alert-dismissable fade in'>
					<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Please enter a valid disapproval reason.
				</div>";

	if(isset($_POST['btnApprove']))
	{
		#update the leave request status
		#to "approved"
		$sql_approve = "UPDATE leaves SET leaveStatus = 'Approved' where leaveID = ? AND accountID = ?";
		$params_approve = array($l, $reqID);
		$stmt_approve = sqlsrv_query($con, $sql_approve, $params_approve);

		#send notification in the system
		$sql_notif = "INSERT INTO notifications (notificationMessage, notificationDate, notificationStatus, accountID) 
					  VALUES (?, CURRENT_TIMESTAMP, 'Unread', ?)";
		$notifMessage = "Your request for " . $ltypeName . " leave for " . $leaveFrom . " to " . $leaveTo . " has been approved.";					 
		$params_notif = array($notifMessage, $reqID);
		$stmt_notif = sqlsrv_query($con, $sql_notif, $params_notif);

		$sql_update = "UPDATE leavecounts SET lcAmount = lcAmount + 1 WHERE accountID = ? AND ltypeID = ? AND lcAmount < 15";
		$params_update = array($reqID, $lID);
		$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

		$txtEvent = "User with ID # " . $accID . " approved leave request request # " . $reqID . ".";
		logEvent($con, $accID, $txtEvent);

		header('location: requestto_admin.php?id=' . $reqID . '&approved=yes');
	}

	if(isset($_POST['btnDeny']))
	{
		$inpNote = trim($_POST['inpNote']);

		if($inpNote != null || !empty($inpNote))
		{
			
		#update the leave status request
		#request to denied
		$sql_disapprove = "UPDATE leaves SET leaveStatus = 'Disapproved' WHERE leaveID = ? AND accountID = ?";
		$params_disapprove = array($lID, $reqID);
		$stmt_disapprove = sqlsrv_query($con, $sql_disapprove, $params_disapprove);

		#send notification
		$sql_notif = "INSERT INTO notifications (notificationMessage, notificationDate, notificationStatus, accountID) 
					  VALUES (?, CURRENT_TIMESTAMP, 'Unread', ?)";
		$notifMessage = "Your request for " . $ltypeName . " leave for " . $leaveFrom . " to " . $leaveTo . " has been disapproved.";					 
		$params_notif = array($notifMessage, $reqID);
		$stmt_notif = sqlsrv_query($con, $sql_notif, $params_notif);

		$txtEvent = "User with ID # " . $accID . " denied leave request # " . $reqID . ".";
		logEvent($con, $accID, $txtEvent);

		header('location: requestto_admin.php?id=' . $reqID . '&approved=no');
	}
	else 
		{
			$msgDisplay = $msgError;
		}
	}
?>