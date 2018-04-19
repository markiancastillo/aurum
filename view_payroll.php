<?php
	include('controllers/view_payroll_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<section id="main-content">
	<section class="wrapper">
		<div class="container">
			<div class="row mt">
				<div class="form-panel">
					<h1 class="text-center">Payroll Details</h1>
					<h3 class="text-center">Breakdown</h3>
					<br />
					<fieldset>
						<div class="col-lg-10 col-lg-offset-1">
						<table id="listTable" name="listTable" class="table table-bordered table-hover">
							<thead>
								<th class="text-center" colspan="2">
									(For the period <?php echo $pDateFrom . ' to ' . $pDateTo; ?>)
								</th>
								<th class="text-center" colspan="2">
									OR# <?php echo $pOR; ?>
								</th>
							</thead>
							<tbody>
								<tr>
									<td><h5>Basic Pay</h5></td>
									<td></td>
									<td></td>
									<td class="text-right">
										<h5><span class='pull-left'>Php </span><?php echo number_format($pBasicPay,2); ?></h5>
									</td>
								</tr>
								<tr>
									<td>Add:</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>Mobile Allowance</td>
									<td class="text-right">
										<span class='pull-left'>Php </span><?php echo number_format(($pCPAllowance/2), 2); ?>
									</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>ECOLA</td>
									<td class="text-right">
										<span class='pull-left'>Php </span><?php echo number_format(($pEcola/2), 2); ?>
									</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>Medical Allowance</td>
									<td class="text-right">
										<span class='pull-left'>Php </span><?php echo number_format(($pMedAllowance/2), 2); ?>
									</td>
									<td></td>
								</tr>
								<tr>
									<td><h5><strong>Gross Pay</strong></h5></td>
									<td></td>
									<td></td>
									<td class="text-right">
										<h5><span class='pull-left'>Php </span><strong><?php echo number_format($grossPay,2); ?></strong></h5>
									</td>
								</tr>
								<tr>
									<td>Less:</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>SSS Contribution</td>
									<td class="text-right">
										<span class='pull-left'>Php </span><?php echo number_format($pSSS, 2); ?>
									</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>PhilHealth Contribution</td>
									<td class="text-right">
										<span class='pull-left'>Php </span><?php echo number_format($pMedical, 2); ?>
									</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>Pag-IBIG</td>
									<td class="text-right">
										<span class='pull-left'>Php </span><?php echo number_format($pHDMF, 2); ?>
									</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>Income Tax</td>
									<td class="text-right">
										<span class='pull-left'>Php </span><?php echo number_format($pWTax, 2); ?>
									</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>Absences</td>
									<td class="text-right">
										<span class='pull-left'>Php </span><?php echo number_format($calcAtt, 2); ?>
									</td>
									<td></td>
								</tr>
								<tr>
									<td><h5><strong>Net Pay</strong></h5></td>
									<td></td>
									<td></td>
									<td class="text-right">
										<h5><strong><span class='pull-left'>Php </span><?php echo number_format($pNetPay,2); ?></strong></h5>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="form-group">
							<div class="col-lg-4">
								<a href='account_payroll.php' class="btn btn-default btn-block">
									<span class="glyphicon glyphicon-chevron-left"></span> Back to List
								</a>
							</div>
						</div>
						<form method="POST">
							<div class="form-group">
								<div class="col-lg-4 col-lg-offset-4">
									<button type="submit" id="btnSave" name="btnSave" class="btn btn-primary btn-block pull-right">
										<span class="glyphicon glyphicon-floppy-disk"></span> Save a Copy (PDF)
									</button>
								</div>
							</div>
						</form>
						</div>
						
</body>
</html>