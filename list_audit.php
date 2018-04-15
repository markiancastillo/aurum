<?php
	include('controllers/list_audit_controller.php');
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
						<h1 class="text-center">Activity Log</h1>
						<br />
						<div class="form-group">
							<div class="input-group col-lg-8 col-lg-offset-2">
								<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
								<input type="text" name="keySearch" id="keySearch" class="form-control" onkeyup="searchList()" placeholder="Search by date/time...">
							</div>
						</div>
						<br />
						<table id="listTable" name="listTable" class="table table-hover">
							<thead>
								<th class="text-center">Account</th>
								<th class="text-center">Log Date</th>
								<th class="text-center">Event</th>
							</thead>
							<tbody>
								<tr>
									<?php
										echo $list_audit;
									?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</section>
</body>
</html>