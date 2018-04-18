<?php
	$pageTitle = "Manage Withholding Tax Table";
	include('function.php');
	include(loadHeader());

	$accID = $_SESSION['accID'];
	$posID = $_SESSION['posID'];
	$msgDisplay = "";

	if($posID == 1 || $posID == 6 || $posID == 8)
	{
		#grant access if user's position is either:
		#1 - managing partner
		#6 - executive assistant
		#8 - HR assistant

		$sql_list = "SELECT whtRangeID, whtMinValue, whtMaxValue, whtPercentageOver, whtBaseTax FROM withholdingtaxes";
		$stmt_list = sqlsrv_query($con, $sql_list);

		$list_wht = "";
		while($row = sqlsrv_fetch_array($stmt_list))
		{
			$whtRangeID = $row['whtRangeID'];
			$whtMinValue = htmlspecialchars($row['whtMinValue'], ENT_QUOTES, 'UTF-8');
			$whtMaxValue = htmlspecialchars($row['whtMaxValue'], ENT_QUOTES, 'UTF-8');
			$whtPercentageOver = htmlspecialchars($row['whtPercentageOver'], ENT_QUOTES, 'UTF-8');
			$whtBaseTax = htmlspecialchars($row['whtBaseTax'], ENT_QUOTES, 'UTF-8');

			$list_wht .= "
				<tr>
					<td class='text-center'>$whtMinValue - $whtMaxValue</td>
					<td class='text-center'>$whtPercentageOver</td>
					<td class='text-center'>$whtBaseTax</td>
					<td class='text-center'>
						<a href='view_wht.php?id=$whtRangeID' class='btn btn-default'>
							Edit Row Details
						</a>
					</td>
				</tr>
			";
		}

		if(isset($_POST['btnAddWHT']))
		{
			$inpRangeL = $_POST['inpRangeL'];
			$inpRangeU = $_POST['inpRangeU'];
			$inpPO = $_POST['inpPO'];
			$inpBase = $_POST['inpBase'];

			$sql_ins = "INSERT INTO withholdingtaxes (whtMinValue, whtMaxValue, whtPercentageOver, whtBaseTax) 
						VALUES (?, ?, ?, ?)";
			$params_ins = array($inpRangeL, $inpRangeU, $inpPO, $whtBaseTax);
			$stmt_ins = sqlsrv_query($con, $sql_ins, $params_ins);

			$txtEvent = "Added a new record in the withholding tax table with a lower bracket of: " . $inpRangeL . ".";
			logEvent($con, $accID, $txtEvent);

			header('location: manage_wht.php?add=success');
		}
	}
	else
	{
		header('location: index.php');
	}
?>	