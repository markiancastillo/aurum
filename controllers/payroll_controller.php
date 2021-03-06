<?php
	$pageTitle = "Manage Payroll";
	require $_SERVER['DOCUMENT_ROOT'] . '/aurum/lib/fpdf/fpdf.php';
	include('function.php');
	include(loadHeader());

	#user should be in accounting; else deny access
	#(posID is taken from the header function)
	determineAccounting();

	//view list of accounts eligible for payroll generation - Active statuses
	$sql_listAccounts = "SELECT a.accountID, a.accountFN, a.accountMN, a.accountLN, a.accountStatus, p.positionName, d.departmentName 
						FROM accounts a 
						INNER JOIN positions p ON a.positionID = p.positionID 
						INNER JOIN departments d ON a.departmentID = d.departmentID
						WHERE a.accountStatus = 'Active'
						ORDER BY a.accountID";
	$stmt_listAccounts = sqlsrv_query($con, $sql_listAccounts);

	$displayList = "";
	while($row = sqlsrv_fetch_array($stmt_listAccounts))
	{
		$accountID = $row['accountID'];
		$accountFN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountMN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountLN = htmlspecialchars(openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv), ENT_QUOTES, 'UTF-8');
		$accountStatus = $row['accountStatus'];
		$positionName = $row['positionName'];
		$departmentName = $row['departmentName'];

		$listName = $accountLN . ", " . $accountFN . " " . $accountMN;

		$displayList .= "
			<tr>
				<td></td>
				<td class='text-center'>$listName</td>
				<td class='text-center'>$positionName</td>
				<td class='text-center'>$departmentName</td>
			</tr>
		";
	}

	# code for counting rows
	$sql_countAccounts = "SELECT COUNT(accountID) AS 'rowCount'
						  FROM accounts";
	$stmt_countAccounts = sqlsrv_query($con, $sql_countAccounts);
	while($row2 = sqlsrv_fetch_array($stmt_countAccounts))
	{
		$rowCount = $row2['rowCount'];
	}

	$msgDisplay = "";
	#generate the payroll for each account listed
    if(isset($_POST['btnGenerate']))
	{	
		#get the input period data 
		$payStartingDate = $_POST['payStartingDate'];
		$payEndingDate = $_POST['payEndingDate'];

		#check the payroll records in the database
		#using the start and end dates
		$sql_val = "SELECT COUNT(pID) AS 'existingCount' FROM payrolls 
					WHERE pDateFrom <= ? AND pDateTo >= ?";
		$params_val = array($payEndingDate, $payStartingDate);
		$stmt_val = sqlsrv_query($con, $sql_val, $params_val);

		while($rowex = sqlsrv_fetch_array($stmt_val))
		{
			$existingCount = $rowex['existingCount'];
		}

		if($existingCount > 0)
		{
			#selected start/end date conflicts with
			#one or more payroll records
			$msgDisplay = "<div class='alert alert-danger alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							The selected date range conflicts with one or more payroll record. Please specify another start/end date.
						</div>";
		}
		else
		{
			#no conflicts in date range
			#validate the # of days in the range (must not be more than 20)
			$countStart = new DateTime($payStartingDate);
			$countEnd = new DateTime($payEndingDate);
			$rangeCount = $countStart->diff($countEnd)->days;
			
			if($rangeCount > 20)
			{
				#limit the maximum coverage to 20 days
				$msgDisplay = "<div class='alert alert-danger alert-dismissable fade in'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								The maximum coverage date is 20 days (for twice per month payroll).
							</div>";
			}
			else
			{
				#validate that the input date coverage is valid
				if($payStartingDate >= $payEndingDate)
				{
					#invalid coverage
					$msgDisplay = "<div class='alert alert-danger alert-dismissable fade in'>
									<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									Please enter a valid coverage date.
									</div>";
				}
				else
				{
					#get the accounts that are eligible for payroll generation
					$sql_active = "SELECT accountID, accountFN, accountMN, accountLN, accountEmail, accountBaseRate 
								   FROM accounts 
								   WHERE accountStatus = 'Active'";
					$stmt_active = sqlsrv_query($con, $sql_active);
			
					while($rowgen = sqlsrv_fetch_array($stmt_active))
					{
						#bind the account values
						$accountID = $rowgen['accountID'];
						$accountFN = openssl_decrypt(base64_decode($rowgen['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
						$accountMN = openssl_decrypt(base64_decode($rowgen['accountMN']), $method, $password, OPENSSL_RAW_DATA, $iv);
						$accountLN = openssl_decrypt(base64_decode($rowgen['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
						$accountEmail = openssl_decrypt(base64_decode($rowgen['accountEmail']), $method, $password, OPENSSL_RAW_DATA, $iv);
						$accountName = $accountLN . ", " . $accountFN . " " . $accountMN;
						$accountBaseRate = $rowgen['accountBaseRate'];
						
						#compute for SSS deduction
						$sql_dedSSS = "SELECT sssTotal 
									   FROM ssscontributions 
									   WHERE sssMinimum <= ? AND sssMaximum >= ?";
						$params_dedSSS = array($accountBaseRate, $accountBaseRate);
						$stmt_dedSSS = sqlsrv_query($con, $sql_dedSSS, $params_dedSSS);
			
						while($rowsss = sqlsrv_fetch_array($stmt_dedSSS))
						{
							#sss deduction based on bracket
							#insert this
							$sssTotal = $rowsss['sssTotal'];
						}
			
						#compute PhilHealth deduction
						$sql_dedPH = "SELECT phPremium 
									  FROM philhealthcontributions 
									  WHERE phMinimum <= ? AND phMaximum >= ?";
						$params_dedPH = array($accountBaseRate, $accountBaseRate);
						$stmt_dedPH = sqlsrv_query($con, $sql_dedPH, $params_dedPH);
			
						while($rowded = sqlsrv_fetch_array($stmt_dedPH))
						{
							#premium contribution based on bracket
							#this is inserted into the deductions table
							$phPremium = $rowded['phPremium'];
						}
			
						#get the HDMF deduction
						$sql_dedhdmf = "SELECT hdmfAmount FROM hdmfs";
						$stmt_dedhdmf = sqlsrv_query($con, $sql_dedhdmf);
			
						while($rowhdmf = sqlsrv_fetch_array($stmt_dedhdmf))
						{
							$hdmfAmount = $rowhdmf['hdmfAmount'];
						}
			
						#compute tax deduction
						$sql_dedTax = "SELECT whtMinValue, whtMaxValue, whtPercentageOver, whtBaseTax
									   FROM withholdingtaxes 
									   WHERE whtMinValue <= ? AND whtMaxValue >= ?";
						$params_dedTax = array($accountBaseRate, $accountBaseRate);
						$stmt_dedTax = sqlsrv_query($con, $sql_dedTax, $params_dedTax);
			
						while($rowtax = sqlsrv_fetch_array($stmt_dedTax))
						{
							$whtMinValue = $rowtax['whtMinValue'];
							$whtPercentageOver = $rowtax['whtPercentageOver'];
							$whtBaseTax = $rowtax['whtBaseTax'];
			
							#tax deduction computation
							#this will be inserted into the database
							$dedIT = (($accountBaseRate - $whtMinValue) * $whtPercentageOver) + $whtBaseTax;
						}
			
						#compute for the gross pay
						#get the allowances first 
						$sql_allowance = "SELECT allowanceMobile, allowanceEcola, allowanceMed 
										  FROM allowances WHERE accountID = ?";
						$params_allowance = array($accountID);
						$stmt_allowance = sqlsrv_query($con, $sql_allowance, $params_allowance);
					    while($rowAll = sqlsrv_fetch_array($stmt_allowance))
						{
						    $allowanceMobile = $rowAll['allowanceMobile'];
						    $allowanceEcola = $rowAll['allowanceEcola'];
						    $allowanceMed = $rowAll['allowanceMed'];
						}
			
						#each allowance is a fixed value
						#divided between the 2 pay terms
						$allowanceTotal = ($allowanceMobile/2) + ($allowanceEcola/2) + ($allowanceMed/2);
			
						#compute for the net pay
						#formula: gross pay - deductions - (absences) = netpay
			
						#get the attendance data for deductions:
						#count the number of days logged in the record for the employee
						$sql_att = "SELECT COUNT(attendanceDate) AS 'attendanceCount'
									FROM attendances 
									WHERE NOT EXISTS (
										SELECT holidayDate 
										FROM holidays 
										WHERE holidayDate = attendanceDate
									)
									AND attendanceDate >= ? AND attendanceDate <= ? AND accountID = ?";
						$params_att = array($payStartingDate, $payEndingDate, $accountID);
						$stmt_att = sqlsrv_query($con, $sql_att, $params_att);

						if($stmt_att === false)
						{
							echo 'paystart: ' . $payStartingDate . '<br>' . $payEndingDate;
							die( print_r( sqlsrv_errors(), true));
						}

					  	while($rowatt = sqlsrv_fetch_array($stmt_att))
					    {
					    	#this is the amount of days the employee was
					    	#present within the selected time frame
						    $attendanceCount = $rowatt['attendanceCount'];
						}
			
						#total number of days in the selected time frame
						$intervalStart = new DateTime($payStartingDate);
						$intervalEnd = new DateTime($payEndingDate);
						$payInterval = $intervalStart->diff($intervalEnd);
						$payDateCoverage = $payInterval->format('%a');
			
						#changed: instead of computing attendance deductions,
						#we compute base pay based on daily rate instead
						#get daily rate from base rate with the formula:
						#base monthly rate x 12 months / 313 working days in a year
						$dailyRate = ($accountBaseRate*12)/313;

						$basePay = $dailyRate * $payDateCoverage;
						$dedAttendance = ($payDateCoverage - $attendanceCount) * $dailyRate;

						#compute for the holiday bonuses (if any)
						$sql_hb = "SELECT holidayDate, holidayRate FROM holidays 
								   INNER JOIN attendances ON holidayDate = attendanceDate
								   WHERE accountID = $accountID";
						$stmt_hb = sqlsrv_query($con, $sql_hb);

						while($rowhb = sqlsrv_fetch_array($stmt_hb))
						{
							$holidayRate = $rowhb['holidayRate'];

							$hbTotal = $hbTotal + ($dailyRate*$holidayRate);
						}

						#final computation for the gross pay
						#$grossPay = $accountBaseRate + $allowanceTotal;
						$grossPay = $basePay + $allowanceTotal + $hbTotal;
			
						#compute for the total deductions
						#by adding the values computed previously
						$deductionsTotal = $sssTotal + $phPremium + $hdmfAmount + $dedIT; 
						$netPay = $grossPay - $deductionsTotal - $dedAttendance;
			
						#insert the computations performed
						#1. insert them into the deductions table
						$sql_insDeductions = "INSERT INTO deductions (dedSSS, dedPhilhealth, dedPagIbig, dedIncTax, accountID)
											  VALUES (?, ?, ?, ?, ?)";
						$params_insDeductions = array($sssTotal, $phPremium, $hdmfAmount, $dedIT, $accountID);
						$stmt_insDeductions = sqlsrv_query($con, $sql_insDeductions, $params_insDeductions);
						
						$OR = "P-" . date('ymd') . "-" . $accID;
		
						#2. insert into the payrolls table
						$sql_insPayroll = "INSERT INTO payrolls (pDateFiled, pDateFrom, pDateTo, pOR,  pBasicPay, pEcola, pWTax, pSSS, pMedical, pHDMF, pCPAllowance, pMedAllowance, pHoliday, pNetPay, pAbsence, accountID)
											VALUES (CURRENT_TIMESTAMP, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
						$params_insPayroll = array($payStartingDate, $payEndingDate, $OR, $basePay, $allowanceEcola, $dedIT, $sssTotal, $phPremium, $hdmfAmount, $allowanceMobile, $allowanceMed, $hbTotal, $netPay, $dedAttendance, $accountID);
						$stmt_insPayroll = sqlsrv_query($con, $sql_insPayroll, $params_insPayroll);
		
						#3. generate the pdf file
						$saveName = generatePayrollPDF($accID, $accountName, $payStartingDate, $payEndingDate, $basePay, $departmentName, $allowanceMobile, $allowanceEcola, $allowanceMed, $grossPay, $sssTotal, $phPremium, $hdmfAmount, $dedIT, $dedAttendance, $netPay, $hbTotal);
		
						#4. insert the pdf file into the database
						$receiptFile = base64_encode(openssl_encrypt($saveName . ".pdf", $method, $password, OPENSSL_RAW_DATA, $iv));
						$sql_uploader = "SELECT accountFN, accountLN FROM accounts WHERE accountID = ?";
						$params_uploader = array($accID);
						$stmt_uploader = sqlsrv_query($con, $sql_uploader, $params_uploader);
						while($row = sqlsrv_fetch_array($stmt_uploader))
						{
							$accountFN = openssl_decrypt(base64_decode($row['accountFN']), $method, $password, OPENSSL_RAW_DATA, $iv);
							$accountLN = openssl_decrypt(base64_decode($row['accountLN']), $method, $password, OPENSSL_RAW_DATA, $iv);
							$acctName = $accountLN . ', ' . $accountFN;
						}
						$receiptRemarks = "Payroll generated by " . $acctName;
		
						$sql_insReceipt = "INSERT INTO receipts (receiptFile, receiptDate, receiptRemarks, receiptStatus, accountID)
										   VALUES (?, CURRENT_TIMESTAMP, ?, ?, ?)";
						$params_insReceipt = array($receiptFile, $receiptRemarks, 'Generated', $accountID);
						$stmt_insReceipt = sqlsrv_query($con, $sql_insReceipt, $params_insReceipt);
		
						#5. insert into the log files
						$txtEvent = "User with ID # " . $accID . " processed the reimbursement billing for " . $accountName . ".";
						logEvent($con, $accID, $txtEvent);
		
						#6. send a notification to the employee/s
						$notifText = "Your payroll has been processed (OR # " . $saveName . ").";
						insertNotification($con, $accountID, $notifText);
		
						#7. send an email notification
						$OR = $saveName;
						$caseTitle = "N/A";
						$billType = "Payroll";
						#sendNotificationEmail($accountEmail, $OR, $accountName, $caseTitle, $billType);

						#echo 'paystart: ' . $payStartingDate . '<br>' . $payEndingDate;
						#header('location: page.php?attendanceCount=' . $attendanceCount . "ps=" . $payStartingDate . "pe=" . $payEndingDate . "accountID=" . $accountID);
			
						if($stmt_insPayroll === false)
						{
							$msgDisplay = "<div class='alert alert-danger alert-dismissable fade in'>
											<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
											Failed to generate payroll.
										</div>";
						}
						else
						{
							$msgDisplay = "<div class='alert alert-success alert-dismissable fade in'>
											<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
											Successfully generated the payroll for the period " . $payStartingDate . " to " . $payEndingDate . "
										</div>";
						}
					}
				}
			}	
		}
	}
?>