<?php
	include('controllers/list_record_controller.php');
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
						<h1 class="text-center">Time Record</h1>
						<br>
						<div class="col-lg-8 col-lg-offset-2">
							<?php
							if(isset($_GET['update']))
							{
								echo "<div class='alert alert-success alert-dismissable fade in'>
										<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										Time record successfully updated.
									</div>";
							}
							?>
						</div>
						<table class="table table-hover">
							<thead>
								<th class="text-center">Service Rendered</th>
								<th class="text-center">Start Date</th>
								<th class="text-center">End Date</th>
								<th class="text-center">Start Time</th>
								<th class="text-center">End Time</th>
							</thead>
							<tbody>
								<?php echo $list_record; ?>	
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</section>
</body>
</html>