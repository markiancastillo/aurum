<?php
	$pageTitle = "Manage Allowance Values";
	include('function.php');
	include(loadHeader());

	$accID = $_SESSION['accID'];
	$posID = $_SESSION['posID'];

	if($posID == 1 || $posID == 6 || $posID == 8)
	{
		#grant access if user's position is either:
		#1 - managing partner
		#6 - executive assistant
		#8 - HR assistant

		$msgDisplay = "";
		$errInp = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Please enter a valid amount.
					</div>";

		#display current values
		$sql_val = "SELECT allowanceMobile, allowanceEcola, allowanceMed 
					FROM allowances";
		$stmt_val = sqlsrv_query($con, $sql_val);

		while($row = sqlsrv_fetch_array($stmt_val))
		{
			$allowanceMobile = $row['allowanceMobile'];
			$allowanceEcola = $row['allowanceEcola'];
			$allowanceMed = $row['allowanceMed'];
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
				$sql_upd = "UPDATE allowances SET allowanceMobile = ?, allowanceEcola = ?, allowanceMed = ?";
				$params_upd = array($inpMob, $inpEco, $inpMed);
				$stmt_upd = sqlsrv_query($con, $sql_upd, $params_upd);

				$txtEvent = "Updated the allowance table definitions";
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