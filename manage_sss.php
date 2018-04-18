<?php
	include('controllers/manage_sss_controller.php');
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
							<h1 class="text-center">Manage SSS Table</h1>
							<div class="col-lg-2 col-lg-offset-5">
								<button class="btn btn-block btn-primary" data-toggle="modal" data-target="#addSSSModal">
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
										<th class="text-center">Range of Compensation (Min-Max)</th>
										<th class="text-center">Monthly Salary Credit</th>
										<th class="text-center">Total Contribution</th>
									</thead>
									<tbody>
										<tr>
											<?php
												echo $list_sss;
											?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
<!-- for adding new records -->
						<div id="addSSSModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Add a New Entry</h4>
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
												<label class="control-label col-lg-3">Monthly Salary Credit</label>
												<div class="col-lg-9">
													<input type="number" id="inpCredit" name="inpCredit" class="form-control" min=1 step=".01" value="1" required="true" />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-lg-3">Total Contribution</label>
												<div class="col-lg-9">
													<input type="number" id="inpTotal" name="inpTotal" class="form-control" min=1 step=".01" value="1" required="true" />
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
											<button type="submit" class="btn btn-primary" id="btnAddSSS" name="btnAddSSS">
												Submit
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
<!-- for password verification (update) -->
						<div id="pwVerify" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Input your password to proceed</h4>
									</div>
									<form class="form-horizontal" method="POST" role="form">
										<div class="modal-body">
											<div class="form-group">
												<label class="control-label col-lg-3">Password</label>
												<div class="col-lg-9">
													<input type="password" id="pass" name="pass" class="form-control" style="display: none" />
													<input type="password" id="inpPW" name="inpPW" class="form-control" required="true" />
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
											<button type="submit" class="btn btn-primary" id="btnVerify" name="btnVerify">
												<span class="glyphicon glyphicon-floppy-disk"></span> Save Changes
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
</body>
</html>