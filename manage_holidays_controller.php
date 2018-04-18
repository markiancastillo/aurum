<?php
	$pageTitle = "Manage Holidays";
	include('function.php');
	include(loadHeader());
	
	if(isset($_POST['btnAdd']))
		{
			$holidayName =  $_POST['holidayName'];
			$holidayDate = $_POST['holidayDate'];

			$sql_insert = "INSERT INTO holidays(holidayName, holidayDate) VALUES (?,?)";
			$params_insert = array($holidayName, $holidayDate);
			$stmt_insert = sqlsrv_query($con, $sql_insert, $params_insert);

		}

	# code for counting rows
	$sql_countHolidays = "SELECT COUNT(holidayID) AS 'rowCount'
						  FROM holidays";
	$stmt_countHolidays = sqlsrv_query($con, $sql_countHolidays);
	while($row2 = sqlsrv_fetch_array($stmt_countHolidays))
	{
		$rowCount = $row2['rowCount'];
	}

	$sql_holiday= "SELECT holidayID, holidayName, holidayDate FROM holidays"; 
	$stmt_holiday = sqlsrv_query($con, $sql_holiday);

	$holiday = "";
	while($row = sqlsrv_fetch_array($stmt_holiday))
	{
		$holidayID = $row['holidayID'];
		$holidayName = $row['holidayName'];
		$holidayDate = $row['holidayDate']->format('Y/m/d');
		

		

		$holiday .= "
			<tr>
				<td class='text-center'>$holidayID</td>
				<td class='text-center'>$holidayName</td>
				<td class='text-center'>$holidayDate</td>	
			

					<td class='text-center'>
							<a href='edit_holiday.php?id=$holidayID' class='btn btn-default' data-toggle='tooltip' data-position='top' title='Edit'>Edit</a>

							
					</td>	

			</tr>";
	}

?>