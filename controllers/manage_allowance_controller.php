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
			}
			else
			{
				#update the records
			}
		}
	}
	else 
	{
		header('location: index.php');
	}
?>