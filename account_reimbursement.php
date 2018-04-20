<?php
	error_reporting(0);
	include('controllers/account_reimbursement_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>	
</head>
<body>
<section id="main-content">
	<section class="wrapper">
		<div class="form-panel">
			<div class="container">
				<div class="row mt">
					<h1 class="text-center">My Reimbursement Applications</h1>
					<br />
					<div class="form-group">
						<div class="input-group col-lg-8 col-lg-offset-2">
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
							<input type="text" name="keySearch" id="keySearch" class="form-control" placeholder="Enter a keyword...">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-8 col-lg-offset-2">
							<form method="POST" class="form-horizontal">
								<div class="col-lg-3">
									<label class="control-label">Filter by Date Range</label>
								</div>
								<div class="col-lg-3">
									<input type="date" id="dStart" name="dStart" class="form-control" />
								</div>
								<div class="col-lg-3">
									<input type="date" id="dEnd" name="dEnd" class="form-control" />
								</div>
								<div class="col-lg-3">
									<button type="submit" id="btnFilter" name="btnFilter" class="btn btn-primary">Go</button>
									<a href='account_reimbursement.php' class="btn btn-default">Reset Form</a>				
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-12" style="padding-top: 25px;">
						<table id="myTable" name="myTable" class="table table-hover">
							<thead>
								<th class="text-center">Date Filed</th>
								<th class="text-center">Amount (Php)</th>
								<th class="text-center">Service Type</th>
								<th class="text-center">Status</th>
								<th class="text-center">Remarks</th>
							</thead>
							<tbody id="listTable" name="listTable">
								<tr>
									<?php
									if($rowCount <= 0)
									{
										echo "
											<tr>
												<td colspan='5' class='text-center'><h3>No Pending Requests</h3></td>
											</tr>
										";
									}
									else 
									{
										if(isset($_GET['f']))
										{
											#echo $list_r;
											$dStart = $_GET['st'];
											$dEnd = $_GET['en'];

											$sql_fil = "SELECT e.expenseID, e.expenseDate, e.expenseAmount, e.expenseRemarks, t.etypeName, e.expenseStatus, e.expenseReviewedBy, e.expenseNote
														FROM expenses e 
														INNER JOIN expensetypes t ON e.etypeID = t.etypeID
														WHERE e.accountID = ? AND expenseDate >= ? AND expenseDate <= ?
														ORDER BY expenseDate DESC";
											$params_fil = array($accID, $dStart, $dEnd);
											$stmt_fil = sqlsrv_query($con, $sql_fil, $params_fil);

											$list_r = "";
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

											echo $list_r;
										}
										else
										{
											echo $list_reimbursements;
										}
									}
									?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>
<script>
$(document).ready(function(){
	$("#keySearch").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#listTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
});
</script>
</body>
</html>