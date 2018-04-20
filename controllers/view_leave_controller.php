<?php
	$pageTitle = "Edit Leave Values";
	include('function.php');
	include(loadHeader());

	$accID = $_SESSION['accID'];
	$lID = $_GET['id'];		#leavecountID
	$reqID = $_GET['acct']; #owner of record

	$dispMsg = "";
	$successMsg = "<div class='alert alert-success alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Successfully updated.
					</div>";
	$errorMsg = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Failed to update.
					</div>";

	$sql_leave = "SELECT c.lcID, c.lcAmount, c.accountID, a.accountFN, a.accountLN, c.ltypeID, t.ltypeName 
				 FROM leavecounts c 
				 INNER JOIN accounts a ON c.accountID = a.accountID 
				 INNER JOIN leavetypes t ON c.ltypeID = t.ltypeID
				 WHERE c.lcID = ? AND c.accountID = ?";
	$params_leave = array($lID, $reqID);
	$stmt_leave = sqlsrv_query($con, $sql_leave, $params_leave);

	while($row = sqlsrv_fetch_array($stmt_leave))
	{
		$lcID = $row['lcID'];
		$lcAmount = $row['lcAmount'];
		$accountID = $row['accountID'];
		$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountName = $accountFN . " " . $accountLN;
		$ltypeID = $row['ltypeID'];
		$ltypeName = $row['ltypeName']; 
	}

	if(isset($_POST['btnSave']))
	{
		$inpAmount = $_POST['inpAmount'];

		$sql_upd = "UPDATE leavecounts SET lcAmount = ? WHERE lcID = ?";
		$params_upd = array($inpAmount, $lcID);
		$stmt_upd = sqlsrv_query($con, $sql_upd, $params_upd);

		if($stmt_upd === false)
		{
			#print_r(sqlsrv_error(), true);
			$dispMsg = $errorMsg;
		}
		else 
		{
			$txtEvent = "User updated the leave value/s for: " . $accountName . " (" . $ltypeName . " leave).";
			logEvent($con, $accID, $txtEvent);
			header('location: manage_leave.php?update=success');
			#header('location: manage_leave.php?lcID=' . $lcID . '??' . $ltypeID . '??' . $inpAmount);
		}
	}
?>