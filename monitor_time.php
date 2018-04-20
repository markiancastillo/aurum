<?php
	include('controllers/monitor_time_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<section id="main-content">
   <section class="wrapper">
	<div class="row">
		<h1 class="text-center">Timekeeping</h1>
		<hr />
		<?php 
			echo $msgDisplay;
			if(isset($_GET['input']))
			{
				echo "<div class='alert alert-success fade in'>
						<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						Successfully added record.
					</div>";
			}
		?>
		<form class="form-horizontal" method="POST">
			<div class="col-lg-6">
				
				<div class="form-group">
							<label class="control-label col-lg-3 ">Service Rendered</label>
							<div class="col-lg-8">
								<select id="sService" name="sService" class="form-control" required="true">
								<option disabled selected>Choose...</option>
								
								<?php echo $list_stypes; ?>
								</select>
							</div>
				</div>	
				<div class="form-group">
							<label class="control-label col-lg-3">Start Date</label>
							<div class="col-lg-8">
							<input type="date" name="sDate" class="form-control" required="true">
						</div>
				</div>
				<div class="form-group">
						<label class="control-label col-lg-3">End Date</label>
						<div class="col-lg-8">
							<input type="date" name="eDate" class="form-control" required="true">
						</div>
				</div>
				<div class="form-group">
						<label class="control-label col-lg-3">Start Time</label>
						<div class="col-lg-8">
							<input type="time" name="sTime" class="form-control" required="true">
						</div>
				</div>
				<div class="form-group">
						<label class="control-label col-lg-3">End Time</label>
						<div class="col-lg-8">
							<input type="time" name="eTime" class="form-control" required="true">
						</div>
				</div>
						
					</div>
				</div>
				<div class="col-lg-6 col-lg-offset-1">
				<div class="form-group">
					<div class="col-lg-4 col-lg-offset-7">
						<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-block btn-success">Add</button>
					</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>