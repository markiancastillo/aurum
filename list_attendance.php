<?php
	include('controllers/list_attendance_controller.php');
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
					<div class="content-panel">
						<h1 class="text-center">List of Attendance</h1>
						<br>
						<div class="col-lg-8 col-lg-offset-2">
							<?php
							if(isset($_GET['update']))
							{
								echo "<div class='alert alert-success alert-dismissable fade in'>
										<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										Attendance successfully updated.
									</div>";
							}
							?>
						</div>
						<table class="table table-hover">
							<thead>
								<th class="text-center">Employee ID</th>
								<th class="text-center">Time in</th>
								<th class="text-center">Time out</th>
								<th class="text-center">Date</th>
							</thead>
							<tbody>
								<?php echo $list_attendance; ?>	
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</section>
</body>
</html>