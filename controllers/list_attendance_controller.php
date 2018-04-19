<?php
	$pageTitle = "Attendance List";
	include('function.php');
	include(loadHeader());

	$sql_attendance = "SELECT accountID, attendanceIn, attendanceOut, attendanceDate FROM attendances";
	$stmt_attendance = sqlsrv_query($con, $sql_attendance);

	$list_attendance = "";
	while($row = sqlsrv_fetch_array($stmt_attendance))
	{
		$accountID = $row['accountID'];
		$attendanceIn = $row['attendanceIn']->format('h:m');
		$attendanceOut = $row['attendanceOut']->format('h:m');
		$attendanceDate = $row['attendanceDate']->format('m/d/Y');
		
		
		$list_attendance .= "
			<tr>
				<td class='text-center'>$accountID</td>
				<td class='text-center'>$attendanceIn am</td>
				<td class='text-center'>$attendanceOut pm</td>
				<td class='text-center'>$attendanceDate</td>
				<td class='text-center'>
					<a href='view_attendance.php?id=$accountID' class='btn btn-default'>View</a>
				</td>
			</tr>
		";
	}
?>