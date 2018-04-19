<?php
	$pageTitle = "Adjust Allowance Values";
	include('function.php');
	include(loadHeader());

	$accID = $_SESSION['accID'];
	$posID = $_SESSION['posID'];

	$aid = $_GET['aid'];
	$sid = $_GET['sid'];

	$msgDisplay = "";

	if($posID == 1 || $posID == 6 || $posID == 8)
	{
		#grant access if user's position is either:
		#1 - managing partner
		#6 - executive assistant
		#8 - HR assistant

		$errInp = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Please enter a valid amount.
					</div>";

		#display current values
		$sql_val = "SELECT allowanceMobile, allowanceEcola, allowanceMed 
					FROM allowances WHERE allowanceID = ? AND accountID = ?";
		$params_val = $arrayName = array($sid, $aid);
		$stmt_val = sqlsrv_query($con, $sql_val, $params_val);

		while($row = sqlsrv_fetch_array($stmt_val))
		{
			$allowanceMobile = $row['allowanceMobile'];
			$allowanceEcola = $row['allowanceEcola'];
			$allowanceMed = $row['allowanceMed'];
		}

		$sql_name = "SELECT accountLN, accountFN, accountMN FROM accounts 
					 WHERE accountID = ?";
		$params_name = array($aid);
		$stmt_name = sqlsrv_query($con, $sql_name, $params_name);

		while($rown = sqlsrv_fetch_array($stmt_name))
		{
			$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($rown['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
			$accountMN = htmlspecialchars(openssl_decrypt(base64_decode($rown['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
			$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($rown['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
			$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;
		}

		if($stmt_name === false)
		{
			die(print_r(sqlsrv_errors(), true));
		}

		if(isset($_POST['btnSave']))
		{
			$inpMob = $_POST['inpMob'];
			$inpMed = $_POST['inpMed'];
			$inpEco = $_POST['inpEco'];

			if($inpMob < 0 || $inpMed < 0 || $inpEco < 0)
			{
				#invalid input; display an error
				$msgDisplay = $errInp;
			}
			else
			{
				#update the records
				$sql_upd = "UPDATE allowances SET allowanceMobile = ?, allowanceEcola = ?, allowanceMed = ? WHERE accountID = ? AND allowanceID = ?";
				$params_upd = array($inpMob, $inpEco, $inpMed, $aid, $sid);
				$stmt_upd = sqlsrv_query($con, $sql_upd, $params_upd);

				$txtEvent = "Updated the allowance values for user: " . $accountName;
				logEvent($con, $accID, $txtEvent);

				header('location: manage_allowance.php?update=success');
			}
		}
	}
	else 
	{
		header('location: index.php');
	}
?>