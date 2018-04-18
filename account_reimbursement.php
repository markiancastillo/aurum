<?php
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
		<div class="container">
			<div class="row mt">
				<div class="form-panel">
					<h1 class="text-center">My Reimbursement Applications</h1>
					<br />
					<div class="form-group">
						<div class="input-group col-lg-8 col-lg-offset-2">
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
							<input type="text" name="keySearch" id="keySearch" class="form-control" placeholder="Enter a keyword...">
						</div>
					</div>
					<fieldset>
						<table class="table table-hover">
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
										echo $list_reimbursements;
									}
									?>
								</tr>
							</tbody>
						</table>
					</fieldset>
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