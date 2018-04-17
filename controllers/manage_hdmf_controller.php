<?php
	$pageTitle = "Manage HDMF Contribution";
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

		$sql_hdmf = "SELECT hdmfAmount FROM hdmfs";
		$stmt_hdmf = sqlsrv_query($con, $sql_hdmf);

		while($row = sqlsrv_fetch_array($stmt_hdmf))
		{
			$hdmfAmt = $row['hdmfAmount'];
		}

		if(isset($_POST['btnSave']))
		{
			$inpHDMF = $_POST['inpHDMF'];

			$sql_upd = "UPDATE hdmfs SET hdmfAmount = ?";
			$params_upd = array($inpHDMF);
			$stmt_hdmf = sqlsrv_query($con, $sql_upd, $params_upd);

			$txtEvent = "Updated the HDMF contribution amount to: Php " . $inpHDMF . ".";
			logEvent($con, $accID, $txtEvent);

			header('location: manage_hdmf.php?u=success');
		}
	}
	else 
	{
		header('location: index.php');
	}
?>