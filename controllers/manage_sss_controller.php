<?php
	$pageTitle = "Manage SSS Table";
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

		$sql_list = "SELECT sssRangeID, sssMinimum, sssMaximum, sssCredit, sssTotal FROM ssscontributions ORDER BY sssMinimum ASC";
		$stmt_list = sqlsrv_query($con, $sql_list);

		$list_sss = "";
		while($row = sqlsrv_fetch_array($stmt_list))
		{
			$sssRangeID = $row['sssRangeID'];
			$sssMinimum = htmlspecialchars($row['sssMinimum'], ENT_QUOTES, 'UTF-8');
			$sssMaximum = htmlspecialchars($row['sssMaximum'], ENT_QUOTES, 'UTF-8');
			$sssCredit = htmlspecialchars($row['sssCredit'], ENT_QUOTES, 'UTF-8');
			$sssTotal = htmlspecialchars($row['sssTotal'], ENT_QUOTES, 'UTF-8');

/*			$list_sss .= "
				<tr>
					<td class='text-center'>
						<input type='number' id='inpFN' name='inpFN' class='form-control' maxlength='50' required='true' value='$sssMinimum' />	
					</td>
					<td class='text-center'>
						<input type='number' id='inpFN' name='inpFN' class='form-control' maxlength='50' required='true' value='$sssMaximum' />	
					</td>
					<td class='text-center'>
						<input type='number' id='inpFN' name='inpFN' class='form-control' maxlength='50' required='true' value='$sssCredit' />	
					</td>
					<td class='text-center'>
						<input type='number' id='inpFN' name='inpFN' class='form-control' maxlength='50' required='true' value='$sssTotal' />	
					</td>
					<td>
				</tr>
			";
*/
			$list_sss .= "
				<tr>
					<td class='text-center'>$sssMinimum - $sssMaximum</td>
					<td class='text-center'>$sssCredit</td>
					<td class='text-center'>$sssTotal</td>
					<td class='text-center'>
						<a href='view_sss.php?id=$sssRangeID' class='btn btn-default'>
							Edit Row Details
						</a>
					</td>
				</tr>
			";
		}

		if(isset($_POST['btnAddSSS']))
		{
			$inpRangeL = $_POST['inpRangeL'];
			$inpRangeU = $_POST['inpRangeU'];
			$inpCredit = $_POST['inpCredit'];
			$inpTotal = $_POST['inpTotal'];

			$sql_ins = "INSERT INTO ssscontributions (sssMinimum, sssMaximum, sssCredit, sssTotal) 
						VALUES (?, ?, ?, ?)";
			$params_ins = array($inpRangeL, $inpRangeU, $inpCredit, $inpTotal);
			$stmt_ins = sqlsrv_query($con, $sql_ins, $params_ins);

			$txtEvent = "Added a new record in the SSS table with a lower bracket of: " . $inpRangeL . ".";
			logEvent($con, $accID, $txtEvent);

			header('location: manage_sss.php?add=success');
		}

		if(isset($_POST['btnVerify']))
		{
			$inpPassword = base64_encode(openssl_encrypt($_POST['inpPW'], $method, $password, OPENSSL_RAW_DATA, $iv));

			#check if the password matches
			$sql_verify = "SELECT COUNT(accountID) as 'verifyCount' FROM accounts 
						   WHERE accountID = ? AND accountPassword = ?";
			$params_verify = array($accID, $inpPassword);
			$stmt_verify = sqlsrv_query($con, $sql_verify, $params_verify);

			while($row = sqlsrv_fetch_array($stmt_verify))
			{
				$verifyCount = $row['verifyCount'];
			}

			if($verifyCount == 0)
			{
				#abort updating of table records
			}
			else
			{
				#update the values
			}
		}
	}
	else 
	{
		header('location: index.php');
	}
?>