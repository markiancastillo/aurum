<?php
	include('controllers/view_attendance_controller.php');
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
							<h1 class="text-center">Attendance Details</h1>
							<br><br>
							
							<form class="form-horizontal col-lg-8 col-lg-offset-2" method="POST" enctype="multipart/form-data">
								<div class="form-group">				
									<label class="control-label col-lg-3">Account ID</label>
									<div class="col-lg-8">
										<input type="text" id="aID" name="aID" class="form-control" value="<?php echo $accountID; ?>">
									</div>
								</div>
								<div class="form-group">				
									<label class="control-label col-lg-3">Time in</label>
									<div class="col-lg-8">
										<input type="time" id="timeIn" name="timeIn" class="form-control" value="<?php echo $attendanceIn; ?>" placeholder="optional">
									</div>
								</div>
								<div class="form-group">				
									<label class="control-label col-lg-3">Time out</label>
									<div class="col-lg-8">
										<input type="time" id="timeOut" name="timeOut" class="form-control" value="<?php echo $attendanceOut; ?>">
									</div>
								</div>
								<div class="form-group">				
									<label class="control-label col-lg-3">Date</label>
									<div class="col-lg-8">
										<input type="date" id="attDate" name="attDate" class="form-control" value="<?php echo $attendanceDate; ?>" placeholder="optional">
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-3">
										<a href="list_attendance.php" class="btn btn-default btn-block">
											<span class="glyphicon glyphicon-chevron-left"></span>
											 Back
										</a>
									</div>
									<div class="col-lg-4 col-lg-offset-4">
										<button type="submit" id="btnUpdate" name="btnUpdate" class="btn btn-primary btn-block pull-right">Update</button>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
				</div>
			</div>
		</section>
	</section>
</body>
</html>