<?php
	$pageTitle = "Manage Holidays";
	include('function.php');
	include(loadHeader());
	
	if(isset($_POST['btnAddHol']))
	{
		$holidayName = $_POST['holidayName'];
		$holidayDate = $_POST['holidayDate'];
		$holidayRate = $_POST['holidayRate'];

		$sql_insert = "INSERT INTO holidays(holidayName, holidayDate, holidayRate) 
					   VALUES (?, ?, ?)";
		$params_insert = array($holidayName, $holidayDate, $holidayRate);
		$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);
	}

	#code for counting rows
	$sql_countHolidays = "SELECT COUNT(holidayID) AS 'rowCount' FROM holidays";
	$stmt_countHolidays = sqlsrv_query($con, $sql_countHolidays);

	while($rowc = sqlsrv_fetch_array($stmt_countHolidays))
	{
		$rowCount = $rowc['rowCount'];
	}

	$sql_list= "SELECT holidayID, holidayName, holidayDate, holidayRate FROM holidays"; 
	$stmt_list = sqlsrv_query($con, $sql_list);

	$list_holiday = "";
	while($row = sqlsrv_fetch_array($stmt_list))
	{
		$holidayID = $row['holidayID'];
		$holidayName = $row['holidayName'];
		$holidayDate = $row['holidayDate']->format('Y/m/d');
		$holidayRate = $row['holidayRate'];

		$list_holiday .= "
			<tr>
				<td class='text-center'>$holidayName</td>
				<td class='text-center'>$holidayDate</td>
				<td class='text-center'>$holidayRate</td>
				<td class='text-center'>
					<a href='view_holiday.php?id=$holidayID' class='btn btn-default'>Edit</a>
				</td>	
			</tr>";
	}
?>