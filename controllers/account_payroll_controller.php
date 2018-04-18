<?php
	$pageTitle = "My Payroll Receipts";
	include('function.php');
	include(loadHeader());

	$accID = $_SESSION['accID'];

	$sql_count = "SELECT COUNT(pID) as 'rowCount' FROM payrolls 
				  WHERE accountID = ?";
	$params_count = array($accID);
	$stmt_count = sqlsrv_query($con, $sql_count, $params_count);
	while($rowC = sqlsrv_fetch_array($stmt_count))						  
	{
		$rowCount = $rowC['rowCount'];
	}

	$sql_list = "SELECT pID, pDateFiled, pDateFrom, pDateTo, pBasicPay, (pEcola + pCPAllowance + pMedAllowance) AS 'Allowances', (pSSS + pMedical + pHDMF + pWTax) AS 'Deductions', pNetPay FROM payrolls WHERE accountID = ?";
	$params_list = array($accID);
	$stmt_list = sqlsrv_query($con, $sql_list, $params_list);

	$list_payrolll = "";
	while($row = sqlsrv_fetch_array($stmt_list))
	{
		$pID = $row['pID'];
		$pDateFiled = $row['pDateFiled']->format('m/d/Y');
		$pDateFrom = $row['pDateFrom']->format('m/d/Y');
		$pDateTo = $row['pDateTo']->format('m/d/Y');
#		$df = $pDateFrom->format('m/d/Y');
#		$dt = $pDateTo->format('m/d/Y');
		$pBasicPay = htmlspecialchars($row['pBasicPay'], ENT_QUOTES, 'UTF-8');
		$Allowances = htmlspecialchars($row['Allowances'], ENT_QUOTES, 'UTF-8');
		$Deductions = htmlspecialchars($row['Deductions'], ENT_QUOTES, 'UTF-8');
		$pNetPay = $row['pNetPay'];

		$list_payroll .= "
			<tr>
				<td class='text-center'>$pDateFiled</td>
				<td class='text-center'>$pDateFrom to $pDateTo</td>
				<td class='text-center'>$pBasicPay</td>
				<td class='text-center'>$Allowances</td>
				<td class='text-center'>$Deductions</td>
				<td class='text-center'>$pNetPay</td>
				<td>
					<a href='view_payroll.php?id=$pID' class='btn btn-default'>
						View Details
					</a>
				<td>
			</tr>
		";
	}

?>