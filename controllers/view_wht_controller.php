<?php
	$pageTitle = "WHT Record Details";
	include('function.php');
	include(loadHeader());

	#validation:
	#request id should exist
	$reqID = $_GET['id'];

	$msgDisplay = "";
	$errVal = "<div class='alert alert-danger alert-dismissable fade in'>
				<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Please check your input for the lower/upper bracket range.
				</div>";
	$errUpd = "<div class='alert alert-danger alert-dismissable fade in'>
				<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Record update failed. Please check your input/s and try again.
				</div>";

	$sql_get = "SELECT whtRangeID, whtMinValue, whtMaxValue, whtPercentageOver, whtBaseTax 
				FROM withholdingtaxes 
				WHERE whtRangeID = ?";
	$params_get = array($reqID);
	$stmt_get = sqlsrv_query($con, $sql_get, $params_get);

	while($row = sqlsrv_fetch_array($stmt_get))
	{
		$whtRangeID = $row['whtRangeID'];
		$whtMinValue = $row['whtMinValue'];
		$whtMaxValue = $row['whtMaxValue'];
		$whtPercentageOver = $row['whtPercentageOver'];
		$whtBaseTax = $row['whtBaseTax'];
	}

	if(isset($_POST['btnUpdate']))
	{
		#lower range should not be higher than the upper range
		if($whtMinValue >= $whtMaxValue)
		{
			$msgDisplay = $errVal;
		}
		else
		{
			$inpLower = $_POST['inpLower'];
			$inpUpper = $_POST['inpUpper'];
			$inpOver = $_POST['inpOver'];
			$inpBase = $_POST['inpBase'];

			$sql_update = "UPDATE withholdingtaxes 
						   SET whtMinValue = ?, whtMaxValue = ?, whtPercentageOver = ?, whtBaseTax = ? 
						   WHERE whtRangeID = ?";
			$params_update = array($inpLower, $inpUpper, $inpOver, $inpBase, $reqID);
			$stmt_update = sqlsrv_query($con, $sql_update, $params_update);

			if($stmt_update === false)
			{
				$msgDisplay = $errUpd;
			}
			else
			{
				$txtEvent = "Updated record # " . $whtRangeID . ".";
				logEvent($con, $accID, $txtEvent);

				header('location: manage_wht.php?update=success');
			}
		}
	}
?>