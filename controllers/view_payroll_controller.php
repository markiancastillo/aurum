<?php
	$pageTitle = "Payroll Details";
	require_once $_SERVER['DOCUMENT_ROOT'] . '/aurum/lib/fpdf/fpdf.php';
	include('function.php');
	include(loadHeader());

	$accID = $_SESSION['accID'];
	$reqID = $_GET['id'];

	#validate if the requested record exists
	$sql_validate = "SELECT COUNT(pID) AS 'rowCount' FROM payrolls WHERE accountID = ? AND pID = ?";
	$params_validate = array($accID, $reqID);
	$stmt_validate = sqlsrv_query($con, $sql_validate, $params_validate);

	while($row = sqlsrv_fetch_array($stmt_validate))
	{
		$rowCount = $row['rowCount'];
	}

	if($rowCount == 0)
	{
		header('location: error.php');
	}
	else 
	{

		$sql_det = "SELECT pID, pDateFiled, pDateFrom, pDateTo, pOR, pBasicPay, pEcola, pWTax, pSSS, pMedical, pHDMF, pCPAllowance, pMedAllowance, pHoliday, pAbsence, pNetPay FROM payrolls
					WHERE accountID = ? AND pID = ?";
		$params_det = array($accID, $reqID);
		$stmt_det = sqlsrv_query($con, $sql_det, $params_det);

		while($rowd = sqlsrv_fetch_array($stmt_det))
		{
			$pDateFiled = $rowd['pDateFiled']->format('m/d/Y');
			$pDateFrom = $rowd['pDateFrom']->format('m/d/Y');
			$pDateTo = $rowd['pDateTo']->format('m/d/Y');
			$pOR = $rowd['pOR'];
			$pBasicPay = $rowd['pBasicPay'];
			$pEcola = $rowd['pEcola'];
			$pWTax = $rowd['pWTax'];
			$pSSS = $rowd['pSSS'];
			$pMedical = $rowd['pMedical'];
			$pHDMF = $rowd['pHDMF'];
			$pCPAllowance = $rowd['pCPAllowance'];
			$pHoliday = $rowd['pHoliday'];
			$pMedAllowance = $rowd['pMedAllowance'];
			$pNetPay = $rowd['pNetPay'];
			$pAbsence = $rowd['pAbsence'];

			$grossPay = $pBasicPay + ($pCPAllowance/2) + ($pEcola/2) + ($pMedAllowance/2) + $pHoliday;
			#$calcAtt = ($grossPay - ($pSSS + $pMedical + $pHDMF + $pWTax)) - $pNetPay;
		}

		if(isset($_POST['btnSave']))
		{
			#get account details for the PDF

			$sql_acc = "SELECT accountFN, accountMN, accountLN, d.departmentName
						FROM accounts a 
						INNER JOIN departments d ON a.departmentID = d.departmentID 
						WHERE a.accountID = ?";
			$params_acc = array($accID);
			$stmt_acc = sqlsrv_query($con, $sql_acc, $params_acc);

			while($rowa = sqlsrv_fetch_array($stmt_acc))
			{
				$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($rowa['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
				$accountMN = htmlspecialchars(openssl_decrypt(base64_decode($rowa['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
				$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($rowa['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
				$accountName = $accountLN . ", " . $accountFN . " " . $accountMN;
				$departmentName = $rowa['departmentName'];
			}

			saveAsPDF($pDateFiled, $pOR, $accountName, $departmentName, $pDateFrom, $pDateTo, $pBasicPay, $pCPAllowance, $pEcola, $pMedAllowance, $grossPay, $pSSS, $pMedical, $pHDMF, $pWTax, $calcAtt, $pNetPay, $pHoliday, $pAbsence);
		}
	}
?>