<?php
	include('controllers/manage_pd_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<body>
<section id="main-content">
	<section class="wrapper">
		<div class="container">
			<div class="row mt">
				<div class="form-panel">
					<fieldset>
						<div class="col-lg-6">
							<h1 class="text-center">Manage Positions</h1>
							<div class="col-lg-10 col-lg-offset-1">
								<?php 
									if(isset($_GET['pos']))
									{
										$msgDisplay1 = "<div class='alert alert-success alert-dismissable fade in'>
											<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
											Successfully added a new position.
										</div>";
									}

									echo $msgDisplay1;
								?>
							</div>
							<div class="col-lg-4 col-lg-offset-4">
								<button class="btn btn-block btn-primary" data-toggle="modal" data-target="#addPositionModal">
									<span class='glyphicon glyphicon-plus'></span> Add New
								</button>
							</div>
							<div class="col-lg-12">
								<table id="listPos" name="listPos" class="table table-hover">
									<thead>
										<th class="text-center">Position Title</th>
									</thead>
									<tbody>
										<tr>
											<?php
												echo $list_pos;
											?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-lg-6">
							<h1 class="text-center">Manage Departments</h1>
							<div class="col-lg-10 col-lg-offset-1">
								<?php 
									if(isset($_GET['dep']))
									{
										$msgDisplay2 = "<div class='alert alert-success alert-dismissable fade in'>
											<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
											Successfully added a new department.
										</div>";
									}

									echo $msgDisplay2;
								?>
							</div>
							<div class="col-lg-4 col-lg-offset-4">
								<button class="btn btn-block btn-primary" data-toggle="modal" data-target="#addDepartmentModal">
									<span class='glyphicon glyphicon-plus'></span> Add New
								</button>
							</div>
							<div class="col-lg-12">
								<table id="listPos" name="listPos" class="table table-hover">
									<thead>
										<th class="text-center">Department Name</th>
									</thead>
									<tbody>
										<tr>
											<?php
												echo $list_dept;
											?>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
<!-- for adding new records -->
						<div id="addPositionModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Add a New Position</h4>
									</div>
									<form class="form-horizontal" method="POST" role="form">
										<div class="modal-body">
											<div class="form-group">
												<label class="control-label col-lg-3">Position Title</label>
												<div class="col-lg-9">
													<input type="text" id="inpPosition" name="inpPosition" class="form-control" maxlength="50" required="true" />
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
											<button type="submit" class="btn btn-primary" id="btnAddPos" name="btnAddPos">
												Submit
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div id="addDepartmentModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Add a New Department</h4>
									</div>
									<form class="form-horizontal" method="POST" role="form">
										<div class="modal-body">
											<div class="form-group">
												<label class="control-label col-lg-3">Department Name</label>
												<div class="col-lg-9">
													<input type="text" id="inpDepartment" name="inpDepartment" class="form-control" maxlength="50" required="true" />
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
											<button type="submit" class="btn btn-primary" id="btnAddDept" name="btnAddDept">
												Submit
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
		</div>
	</section>
</section>
</body>
</html>