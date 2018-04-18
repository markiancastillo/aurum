<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/aurum/lib/fpdf/fpdf.php';

		$pdf = new FPDF('P', 'mm', 'Letter');
		$pdf->AddPage();
		#$pdf->SetMargins(25.4, 25.4, 25.4);
	
		$pdf->SetFont('Times','B',20);
		$pdf->Cell(0, 10, 'Reyes Francisco Tecson & Associates Law Office', 0, 1, 'C');
		$pdf->SetFont('Arial', '', 12);

		#page header (company name and info)
		$pdf->Cell(0, 5, 'Unit 1710 Cityland 10 Tower 1, H.V. dela Costa Street, Salcedo Village, Makati City', 0, 1, 'C');
		$pdf->Cell(0, 5, 'Telephone Nos. 892-4360 / 813-1553 / 892-4435 / 892-1872   Fax: 812-6026', 0, 1, 'C');
		$pdf->Cell(0, 5, 'Website: www.rflaw.com     E-mail: info@rflaw.com', 0, 1, 'C');
		$pdf->Ln(20);

		#start of billing details
		$pdf->Cell(0, 5, 'Date: ' . $pDateFiled, 0, 1, 'R');
		$pdf->Cell(0, 5, 'OR# ' . $pOR, 0, 1, 'R');
		$pdf->Cell(0, 5, 'Account: ' . $accountName, 0, 1, 'L');
		$pdf->Cell(0, 5, 'Department: ' . $departmentName, 0, 1, 'L');
		$billType = "Payroll";
		$pdf->Cell(0, 5, 'Type: ' . $billType, 0, 1, 'L');

		#horizontal line (divider)
		$pdf->Line(10,90,215.9-10,90);
		$pdf->Ln(20);

		$pdf->Cell(0, 5, 'BREAKDOWN', 0, 1, 'L');
		$pdf->Cell(0, 5, '(For the period ' . $pDateFrom . ' to ' . $pDateTo . ')', 0, 1, 'L');
		$pdf->Ln(5);

		#table body
		#row 1 -- basic pay display
		$pdf->Cell(40, 5, 'Basic Pay', 1, 0, 'L');
		$pdf->Cell(85.9, 5, '', 1, 0, 'L');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 0, 'R');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $pBasicPay, 'TRB', 1, 'R');

		#row 2 -- Add:
		$pdf->Cell(40, 5, 'Add:', 1, 0, 'L');
		$pdf->Cell(85.9, 5, '', 1, 0, 'L');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#rows 3-5 --  allowances breakdown
		#row 3
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'Mobile Allowance', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $pCPAllowance, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 4
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'ECOLA', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $pEcola, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 5
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'Medical Allowance', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $pMedAllowance, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 6 -- gross pay
		$pdf->Cell(40, 5, 'Gross Pay', 1, 0, 'L');
		$pdf->Cell(85.9, 5, '', 1, 0, 'L');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 0, 'R');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $grossPay, 'TRB', 1, 'R');

		#row 7 -- Less:
		$pdf->Cell(40, 5, 'Less:', 1, 0, 'L');
		$pdf->Cell(85.9, 5, '', 1, 0, 'L');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#rows 8-11 --  deductions breakdown
		#row 8
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'SSS Contribution', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $pSSS, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 9
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'PhilHealth Contribution', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $pMedical, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 10
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'Pag-IBIG', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $pHDMF, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 11
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'Income Tax', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $pWTax, 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 12 -- attendance deduction
		$pdf->Cell(40, 5, '', 1, 0, 'L');
		$pdf->Cell(85.9, 5, 'Absences', 1, 0, 'L');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '999', 'TRB', 0, 'R');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 1, 'R');

		#row 13 -- net pay
		$pdf->Cell(40, 5, 'Net Pay', 1, 0, 'L');
		$pdf->Cell(85.9, 5, '', 1, 0, 'L');
		$pdf->Cell(10, 5, '', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, '', 'TRB', 0, 'R');
		$pdf->Cell(10, 5, 'Php', 'LTB', 0, 'L');
		$pdf->Cell(25, 5, $pNetPay, 'TRB', 1, 'R');

		#output the file on the browser
		$pdf->Output();
?>