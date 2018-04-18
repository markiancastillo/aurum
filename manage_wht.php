<?php
	include('controllers/manage_wht_controller.php');
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
					<fieldset>
						<div class="col-lg-12">
							<h1 class="text-center">Manage Withholding Tax Table</h1>
							<div class="col-lg-2 col-lg-offset-5">
								<button class="btn btn-block btn-primary" data-toggle="modal" data-target="#addWHTModal">
									<span class='glyphicon glyphicon-plus'></span> Add New
								</button>
							</div>
							<div class="col-lg-10 col-lg-offset-1">
							<?php
								if(isset($_GET['add']))
								{
									$msgDisplay = "<div class='alert alert-success alert-dismissable fade in'>
											<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
											Successfully added a new table entry.
										</div>";

									echo $msgDisplay;
								}
							?>
							</div>
							<div class="col-lg-12">
								<table id="listsss" name="listsss" class="table table-hover">
									<thead>
										<th class="text-center">Bracket (Min-Max)</th>
										<th class="text-center">Percentage Over</th>
										<th class="text-center">Base Tax</th>
									</thead>
									<tbody>
										<tr>
											<?php
												echo $list_wht;
											?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
<!-- for adding new records -->
						<div id="addWHTModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Add a New Bracket</h4>
									</div>
									<form class="form-horizontal" method="POST" role="form">
										<div class="modal-body">
											<div class="form-group">
												<label class="control-label col-lg-3">Lower Bracket (Range)</label>
												<div class="col-lg-9">
													<input type="number" id="inpRangeL" name="inpRangeL" class="form-control" min=1 step=".01" value="1" required="true" />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-lg-3">Upper Bracket (Range)</label>
												<div class="col-lg-9">
													<input type="number" id="inpRangeU" name="inpRangeU" class="form-control" min=1 step=".01" value="1" required="true" />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-lg-3">Percentage Over</label>
												<div class="col-lg-9">
													<input type="number" id="inpPO" name="inpPO" class="form-control" min=0.1 step=".01" value="1" required="true" />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-lg-3">Base Tax</label>
												<div class="col-lg-9">
													<input type="number" id="inpBase" name="inpBase" class="form-control" min=1 step=".01" value="1" required="true" />
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
											<button type="submit" class="btn btn-primary" id="btnAddWHT" name="btnAddWHT">
												Submit
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>

</body>
</html>