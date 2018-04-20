<?php
	$pageTitle = "Manage Leaves";
	include('function.php');
	include(loadHeader());

	$sql_list = "SELECT c.lcID, c.lcAmount, c.accountID, a.accountFN, a.accountLN, t.ltypeName 
				 FROM leavecounts c 
				 INNER JOIN accounts a ON c.accountID = a.accountID 
				 INNER JOIN leavetypes t ON c.ltypeID = t.ltypeID";
	$stmt_list = sqlsrv_query($con, $sql_list);

	$list_leave = "";
	while($row = sqlsrv_fetch_array($stmt_list))
	{
		$lcID = $row['lcID'];
		$lcAmount = $row['lcAmount'];
		$accountID = $row['accountID'];
		$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountName = $accountFN . " " . $accountLN;
		$ltypeName = $row['ltypeName'];

		$list_leave .= "
			<tr>
				<td class='text-center'>$accountName</td>
				<td class='text-center'>$ltypeName</td>
				<td class='text-center'>$lcAmount</td>
				<td>
					<a href='view_leave.php?id=$lcID&acct=$accountID' class='btn btn-default'>Edit Details</a>
				</td>
			</tr>
		";
	}
?>