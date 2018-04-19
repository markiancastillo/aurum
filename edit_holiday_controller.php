<?php
	
	include('function.php');
	include(loadHeader());

	$holidayID = $_GET['id'];

	$dispMsg = "";
	$successMsg = "<div class='alert alert-success alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Successfully updated.
					</div>";
	$errorMsg = "<div class='alert alert-danger alert-dismissable fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Failed to update.
					</div>";					


	# code for counting rows
	$sql_countHolidays = "SELECT COUNT(holidayID) AS 'rowCount'
						  FROM holidays";
	$stmt_countHolidays = sqlsrv_query($con, $sql_countHolidays);
	while($row2 = sqlsrv_fetch_array($stmt_countHolidays))
	{
		$rowCount = $row2['rowCount'];
	}


	$sql_holiday = "SELECT holidayName, holidayDate FROM holidays WHERE holidayID=?";
	$params_holiday = array($holidayID);
	$stmt_holiday = sqlsrv_query($con, $sql_holiday, $params_holiday);

	$holiday = "";
	while($row = sqlsrv_fetch_array($stmt_holiday))
	{
		$holidayName = $row['holidayName'];
		$holidayDate = $row['holidayDate']->format('Y/m/d');
		
	}
	
	if(isset($_POST['btnUpdate']))
	{
		#update the holiday 
		$updatedholidayName = $_POST['updatedholidayName'];
		

		
		$sql_update = "INSERT INTO holidays(holidayName, holidayDate) VALUES (?,?) WHERE holidayID = ?";
		$params_update = array($holidayName, $holidayDate);
		$stmt_update = sqlsrv_query($con, $sql_update, $params_update);


		
		


		if($stmt_update === false)
		{
			#print_r(sqlsrv_error(), true);
			$dispMsg = $errorMsg;
		}
		else 
		{
			$dispMsg = $successMsg;
		}

		header('location: manage_holidays.php');

	}

	
?>