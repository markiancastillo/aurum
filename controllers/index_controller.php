<?php
	$pageTitle = "Dashboard";
	include('function.php');
	include(loadHeader());

	$accID = $_SESSION['accID'];

	#get the number of unapproved reimbursement requests
	$sql_r = "SELECT COUNT(expenseID) AS 'rCount' FROM expenses 
			  WHERE expenseStatus = 'Pending for Approval' AND accountID != ?";
	$params_r = array($accID);
	$stmt_r = sqlsrv_query($con, $sql_r, $params_r);

	while($rowr = sqlsrv_fetch_array($stmt_r))
	{
		$rCount = $rowr['rCount'];
	}

	#change the display message based on the count
	$rMessage = "";
	if($rCount == 0)
	{
		$rMessage = "No new requests.";
	}
	else
	{
		$rMessage = "<strong style='color: red'>" . $rCount . " pending request/s!</strong>";
	}

	#for service fee applications
	#get the number of unapproved service fee requests
	$sql_s = "SELECT COUNT(sfID) AS 'sCount' FROM servicefees 
			  WHERE sfStatus = 'Pending for Approval' AND accountID != ?";
	$params_s = array($accID);
	$stmt_s = sqlsrv_query($con, $sql_s, $params_s);

	while($rows = sqlsrv_fetch_array($stmt_s))
	{
		$sCount = $rows['sCount'];
	}

	#change the display message based on the count
	$sMessage = "";
	if($sCount == 0)
	{
		$sMessage = "No new requests.";
	}
	else
	{
		$sMessage = "<strong style='color: red'>" . $sCount . " pending request/s!</strong>";
	}

	#for leave applications
	#get the number of unapproved leave requests
	$sql_l = "SELECT COUNT(leaveID) AS 'lCount' FROM leaves 
			  WHERE leaveStatus = 'Pending for Approval' AND accountID != ?";
	$params_l = array($accID);
	$stmt_l = sqlsrv_query($con, $sql_l, $params_l);

	while($rowl = sqlsrv_fetch_array($stmt_l))
	{
		$lCount = $rowl['lCount'];
	}

	#change the display message based on the count
	$lMessage = "";
	if($lCount == 0)
	{
		$lMessage = "No new requests.";
	}
	else
	{
		$lMessage = "<strong style='color: red'>" . $lCount . " pending request/s!</strong>";
	}
?>