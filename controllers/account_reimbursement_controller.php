<?php
	$pageTitle = "My Reimbursement Requests";
	include('function.php');
	include(loadHeader());
	include($_SERVER['DOCUMENT_ROOT'] . '/aurum/css/search.css');

	$sql_countRows = "SELECT COUNT(expenseID) AS 'rowCount' FROM expenses 
					  WHERE accountID = ?";
	$params_countRows = array($accID);
	$stmt_countRows = sqlsrv_query($con, $sql_countRows, $params_countRows);
	while($rowC = sqlsrv_fetch_array($stmt_countRows))						  
	{
		$rowCount = $rowC['rowCount'];
	}

	$sql_getList = "SELECT e.expenseID, e.expenseDate, e.expenseAmount, e.expenseRemarks, t.etypeName, e.expenseStatus, e.expenseReviewedBy, e.expenseNote
					FROM expenses e 
					INNER JOIN expensetypes t ON e.etypeID = t.etypeID
					WHERE e.accountID = ?
					ORDER BY expenseDate DESC";
	$params_getList = array($accID);
	$stmt_getList = sqlsrv_query($con, $sql_getList, $params_getList);

	$list_reimbursements = "";
	#$list_r = "<tr><td colspan='5' class='text-center'><h3>No Records Found</h3></td></tr>";
	while($row = sqlsrv_fetch_array($stmt_getList))
	{
		$expenseID = $row['expenseID'];
		$expenseDate = $row['expenseDate']->format('m/d/Y');
		$expenseAmount = htmlspecialchars($row['expenseAmount'], ENT_QUOTES, 'UTF-8');
		$expenseRemarks = htmlspecialchars($row['expenseRemarks'], ENT_QUOTES, 'UTF-8');
		$etypeName = $row['etypeName'];
		$expenseStatus = $row['expenseStatus'];
		$expenseNote = htmlspecialchars($row['expenseNote'], ENT_QUOTES, 'UTF-8');
		
		$list_reimbursements .= "
			<tr>
				<td class='text-center'>$expenseDate</td>
				<td class='text-right'>$expenseAmount</td>
				<td class='text-center'>$etypeName</td>
				<td class='text-center'>$expenseStatus</td>
				<td class='text-center'>$expenseNote</td>
			</tr>
		";
	}

	if(isset($_POST['btnFilter']))
	{
		$rangeStart = $_POST['dStart'];
		$rangeEnd = $_POST['dEnd'];
/*
		$sql_fil = "SELECT e.expenseID, e.expenseDate, e.expenseAmount, e.expenseRemarks, t.etypeName, e.expenseStatus, e.expenseReviewedBy, e.expenseNote
					FROM expenses e 
					INNER JOIN expensetypes t ON e.etypeID = t.etypeID
					WHERE e.accountID = ? AND expenseDate >= ? AND expenseDate <= ?
					ORDER BY expenseDate DESC";
		$params_fil = array($accID, $dStart, $dEnd);
		$stmt_fil = sqlsrv_query($con, $sql_fil, $params_fil);

		if($stmt_fil === false)
		{
			die(print_r(sqlsrv_error(), true));
		}

		while($row2 = sqlsrv_fetch_array($stmt_fil))
		{
			$eID = $row2['expenseID'];
			$eDate = $row2['expenseDate']->format('m/d/Y');
			$eAmount = htmlspecialchars($row2['expenseAmount'], ENT_QUOTES, 'UTF-8');
			$eRemarks = htmlspecialchars($row2['expenseRemarks'], ENT_QUOTES, 'UTF-8');
			$eName = $row2['etypeName'];
			$eStatus = $row2['expenseStatus'];
			$eNote = htmlspecialchars($row2['expenseNote'], ENT_QUOTES, 'UTF-8');

			$list_r .= "
			<tr>
				<td class='text-center'>$eDate</td>
				<td class='text-right'>$eAmount</td>
				<td class='text-center'>$eName</td>
				<td class='text-center'>$eStatus</td>
				<td class='text-center'>$eNote</td>
			</tr>
			";
		}
*/
		header('location: account_reimbursement.php?f=true&st=' . $rangeStart . '&en=' . $rangeEnd);
	}
?>