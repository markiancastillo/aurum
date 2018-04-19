<?php
	$pageTitle = "Manage Allowance Values";
	include('function.php');
	include(loadHeader());

	#get the list of allowance records
	$sql_list = "SELECT allowanceID, allowanceMobile, allowanceEcola, allowanceMed, s.accountID, a.accountFN, a.accountMN, a.accountLN FROM allowances s 
				 INNER JOIN accounts a ON s.accountID = a.accountID";
	$stmt_list = sqlsrv_query($con, $sql_list);

	$all_list = "";
	while($row = sqlsrv_fetch_array($stmt_list))
	{
		$allowanceID = $row['allowanceID'];
		$accountID = $row['accountID'];
		$allowanceMobile = $row['allowanceMobile'];
		$allowanceEcola = $row['allowanceEcola'];
		$allowanceMed = $row['allowanceMed'];
		$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountMN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountName = $accountLN . ', ' . $accountFN . ' ' . $accountMN;

		$all_list .= "
			<tr>
				<td class='text-center'>$accountName</td>
				<td class='text-center'>$allowanceMobile</td>
				<td class='text-center'>$allowanceEcola</td>
				<td class='text-center'>$allowanceMed</td>
				<td>
					<a href='view_allowance.php?aid=$accountID&sid=$allowanceID' class='btn btn-default'>View Details</a>
				</td>
			</tr>
		";
	}
?>