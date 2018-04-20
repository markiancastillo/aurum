<?php
	$pageTitle = "Time Record List";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');

	$sql_record = "SELECT monitorID, stypeID, sDate, eDate, sTime, eTime FROM monitor";
	$stmt_record = sqlsrv_query($con, $sql_record);

	$list_record = "";
	while($row = sqlsrv_fetch_array($stmt_record))
	{
		$monitorID = $row['monitorID'];
		$stypeID = $row['stypeID'];
		$sDate = $row['sDate']->format('Y-m-d');
		$eDate = $row['eDate']->format('Y-m-d');
		$sTime = $row['sTime']->format('h:m');
		$eTime = $row['eTime']->format('h:m');
		
		
		$list_record .= "
			<tr>
				<td class='text-center'>$stypeID</td>
				<td class='text-center'>$sDate</td>
				<td class='text-center'>$eDate</td>
				<td class='text-center'>$sTime am</td>
				<td class='text-center'>$eTime pm</td>
				<td class='text-center'>
					<a href='view_record.php?id=$monitorID' class='btn btn-default'>View</a>
				</td>
			</tr>
		";
	}
?>