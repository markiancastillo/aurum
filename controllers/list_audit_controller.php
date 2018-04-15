<?php
	$pageTitle = "View Audit Log";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');

	#restrict access to administrative accounts only
	$posID = $_SESSION['posID'];
	if($posID == 1 || $posID == 6 || $posID == 8)
	{
		#load header_admin when account's position is either:
		#1 - managing partner
		#6 - executive assistant
		#8 - HR assistant

		#retrieve the list of audit log records
		$sql_list = "SELECT a.accountFN, a.accountLN, l.logDate, l.logEvent
				 FROM logs l 
				 INNER JOIN accounts a ON l.logAccount = a.accountID
				 ORDER BY l.logDate DESC";
		$stmt_list = sqlsrv_query($con, $sql_list);

		$list_audit = "";
		while($row = sqlsrv_fetch_array($stmt_list))
		{
			$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
			$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
			$accountName = $accountLN . ", " . $accountFN;
			$logDate = $row['logDate']->format('m/d/Y h:i A');
			$logEvent = openssl_decrypt(base64_decode($row['logEvent']), $method, $password, OPENSSL_RAW_DATA, $iv);

			$list_audit .= "
				<tr>
					<td class='text-center'>$accountName</td>
					<td class='text-center'>$logDate</td>
					<td class='text-center'>$logEvent</td>
				</tr>
			";
		}
	}
	else
	{
		#deny access
		header('location: index.php');
	}
?>